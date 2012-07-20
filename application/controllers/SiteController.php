<?php

class SiteController extends Controller
{
    public function init()
    {
        parent::init();
        Yii::import('application.models.Chat.*');
        Yii::import('application.models.News.*');
        return true;
    }

    public function filters()
    {
        return array(
            'accessControl'
        );
    }

    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions'   => array(
                    'index',
                    'error',
                    'search',
                    'pull',
                    'register',
                    'login',
                    'channel'
                ),
                'users'     => array('*')
            ),
            array(
                'allow',
                'actions'   => array('logout'),
                'users'     => array('@')
            ),
            array(
                'allow',
                'actions'   => array('marquee'),
                'roles'     => array('admin')
            ),
            array(
                'deny',
                'users'     => array('*')
            )
        );
    }

    public function actionIndex()
    {
        $this->setPageTitle(Yii::app()->name);
        $this->render('index', array(
            'latests'   => News::model()->getPopularNews(10),
            'articles'  => array(),
            'marquees'  => Marquee::model()->getMarquees()
        ));
    }

    public function actionMarquee()
    {
        $id = 0;
        if ( isset($_POST['marquee']) )
        {
            $delete = false;
            if ( isset($_POST['marquee']['id']) )
            {
                $id = (integer)$_POST['marquee']['id'];
                if ( $id < 0 )
                {
                    $id *= -1;
                    $delete = true;
                }
            }

            if ( isset($_POST['marquee']['message']) || $delete )
            {
                if ( $id )
                {
                    $model = Marquee::model()->findByPk($id);
                }
                else
                {
                    $model = new Marquee();
                }
                
                if ( $delete && $id )
                {
                    $model->deleteMarquee();
                }
                else
                {
                    $model->attributes = $_POST['marquee'];
                    if ( $model->validate() && $model->save() )
                    {
                        $this->_data['message'] = $model->message;
                    }
                    else
                    {
                        $this->_data['error'] = true;
                    }
                }
            }
            else
            {
                $this->_data['error'] = true;
            }
            $this->_data['token'] = Yii::app()->security->getToken();

            if ( Yii::app()->request->getIsAjaxRequest() ) return true;
            $this->redirect(Yii::app()->user->returnUrl);
        }

        $this->setPageTitle(Yii::app()->name . ' - 跑馬燈管理');
        $this->render('marquee', array(
            'marquees'  => Marquee::model()->getMarquees()
        ));
    }

    public function actionPull($lasttime = 0)
    {
        $this->_data['counter'] = array(
            'online'    => $this->getOnlineCount(),
            'browsered' => $this->getTotalCount()
        );
        if ( $lasttime == 0 ) // Debug only
        {
            $this->_data['friends'] = array(
                array(
                    'id'        => 1,
                    'name'      => 'Test 1',
                    'icon'      => null,
                    'active'    => true
                ),
                array(
                    'id'        => 2,
                    'name'      => 'Demodemo',
                    'icon'      => null,
                    'active'    => true
                ),
                array(
                    'id'        => 3,
                    'name'      => 'Adminadmin',
                    'icon'      => null,
                    'active'    => true
                )
            );
        }
        $this->_data['messages'] = Chat::model()->getMessages($lasttime);
        $this->_data['lasttime'] = TIMESTAMP;
    }

    public function actionSearch($query)
    {
        $this->setPageTitle(Yii::app()->name . ' - 搜尋結果');
        $this->render('search', array(
            'query'     => $query
        ));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ( $error = Yii::app()->errorHandler->error )
        {
            if ( Yii::app()->request->getIsAjaxRequest() )
            {
                echo $error['message'];
            }
            else
            {
                $this->setPageTitle(Yii::app()->name . ' - 發生錯誤');
                switch ( $error['code'] )
                {
                    case 403 :
                        Yii::app()->user->loginRequired();
                        break;
                    case 404 :
                        $this->render('notfound', $error);
                        break;
                    default :
                        $this->render('error', $error);
                        break;
                }
            }
        }
    }

    /**
     * Displays the login page
     */
    public function actionLogin($facebook = false)
    {
        if ( $facebook ) Yii::app()->facebook->login();
        if ( isset($_POST['login']) )
        {
            $model = new User();
            $model->attributes = $_POST['login'];

            if ( $model->login() )
            {
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }

        $this->setPageTitle(Yii::app()->name . ' - 登入');
        $this->render('login');
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout($facebook = false)
    {
        if ( ! $facebook ) Yii::app()->facebook->logout();
        Yii::app()->user->logout(false);
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionChannel()
    {
        $expire = 60 * 60 * 24 * 365;
        header('Pragma: public');
        header('Cache-Control: max-age=' . $expire);
        header('Expires: ' . gmdate('D, d M Y H:i:s', TIMESTAMP + $expire) . ' GMT');
        echo '<script src="
        "></script>';
        $this->layout = false;
    }

    public function actionRegister()
    {
        $path = dirname(Yii::app()->basePath) . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'avatars';
        if ( isset($_POST['register']) && isset($_POST['profile']) ) 
        {
            $user = new User();
            $user->attributes = $_POST['register'];
            if ( $user->validate() )
            {
                $profile = new Profile();
                $profile->attributes = $_POST['profile'];
                $profile->department_id = $_POST['profile']['department'];
                $profile->grade = $_POST['profile']['grade'];
                $profile->picture = $_FILES['picture']['name'];
                $target = $path . DIRECTORY_SEPARATOR . $profile->picture;
                move_uploaded_file($_FILES['picture']['tmp_name'], $target);
                $picture_size=$_FILES['picture']['size'];
                $picture_type=$_FILES['picture']['type'];
                if ( $profile->validate() )
                {
                    if ( $user->save() )
                    {
                        $profile->id = $user->id;
                        if ( $profile->save() )
                        {
                            $this->redirect(array('site/index'));
                        }
                    }
                }
            }
        }
        $this->_data['token'] = Yii::app()->security->getToken();
        $this->render('register', array(
            'departments'  => Department::model()->getDepartment() 
        ));
    }
}
<?php

class SiteController extends Controller
{
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

    public function actionMarquee($id = 0)
    {
        $id = (integer)$id;
        if ( isset($_POST['marquee']) )
        {
            if ( isset($_POST['marquee']['id']) )
            {
                $id = (integer)$_POST['marquee']['id'];
            }

            if ( isset($_POST['marquee']['message']) )
            {
                if ( $id )
                {
                    $model = Marquee::model()->findByPk($id);
                }
                else
                {
                    $model = new Marquee();
                }
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
    public function actionLogin()
    {
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
    public function actionLogout()
    {
        Yii::app()->user->logout(false);
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionChannel()
    {
        $expire = 60 * 60 * 24 * 365;
        header('Pragma: public');
        header('Cache-Control: max-age=' . $expire);
        header('Expires: ' . gmdate('D, d M Y H:i:s', TIMESTAMP + $expire) . ' GMT');
        echo '<script src="//connect.facebook.net/zh_TW/all.js"></script>';
        $this->layout = false;
    }
    
    public function actionRegister()
    {
        if ( isset($_POST['register']) ) 
        {
            $model = new User();
            $model->attributes = $_POST['register'];

            if ( $model->validate() && $model->save() )
            {
                $this->redirect(array('site/index'));
            }
        }
        $this->render('register');
    }
}

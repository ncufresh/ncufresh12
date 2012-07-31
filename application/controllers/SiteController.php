<?php

class SiteController extends Controller
{
    public function init()
    {
        parent::init();
        Yii::import('application.models.News.*');
        Yii::import('application.models.Game.*');
        Yii::import('application.models.Calendar.*');
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
                    'channel',
                    'profile',
                    'editor'
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
            'online'    => Activity::getOnlineCount(),
            'browsered' => Activity::getTotalCount()
        );
        if ( $lasttime == 0 ) // Debug only
        {
            $this->_data['friends'] = array(
                array(
                    'id'        => 1,
                    'name'      => 'Test 1',
                    'active'    => false
                ),
                array(
                    'id'        => 2,
                    'name'      => 'Demodemo',
                    'active'    => true
                ),
                array(
                    'id'        => 3,
                    'name'      => 'Adminadmin',
                    'active'    => true
                ),
                array(
                    'id'        => 4,
                    'name'      => 'WhoAmI',
                    'active'    => false
                )
            );
        }
        if ( Yii::app()->user->getIsMember() )
        {
            $this->_data['messages'] = Chat::getMessages($lasttime);
        }
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
        echo '<script src="http://connect.facebook.net/zh_TW/all.js"></script>';
        $this->layout = false;
    }

    public function actionRegister()
    {
        $path = dirname(Yii::app()->basePath) . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'avatars';
        $profile = new Profile();
        $user = new User();
        if ( isset($_POST['register']) && isset($_POST['profile']) )
        {
            $user->attributes = $_POST['register'];
            $profile->attributes = $_POST['profile'];
            // var_dump($user->validate());
            // echo '<br />';
            // var_dump($profile->validate());
            // exit;
            if ( $user->validate() && $profile->validate() )
            {
                if ( $user->save() )
                {
                    $character = new Character(); //Character Model
                    $character->id = $user->id;//同步寫入user的id至遊戲資料列表
                    $character->exp = 1; //一開始使用者經驗設為1
                    $character->money = 25000; //一開始使用者金錢設為25000
                    $character->total_money = 35000; //一開始使用者總金錢設為25000
                    if($_POST['profile']['sex'] == 0)
                    {
                        $character->skin_id = 81; //男生 皮膚預設id=81
                    }
                    else
                    {
                        $character->skin_id = 85; //女生 皮膚預設id=85
                    }
                    $item = new ItemBag(); //ItemBag Model
                    $item->user_id = $user->id; //同步寫入user的id至道具列表
                    $item->items_id = $character->skin_id; //寫入獲得道具的id
                    $item->equip = 1; //寫入裝備狀態
                    $item->acquire_time = TIMESTAMP; //寫入獲得時間
                    //行事曆的部分
                    $calendar = new Calendar();
                    $calendar->user_id = $user->id;
                    $calendar->category = 1;
                    $calendar_subscriptions = new Subscription();
                    $calendar_subscriptions->user_id = $user->id;
                    $calendar_subscriptions->calendar_id = 1;
                    $calendar_subscriptions->visible = 1;
                    if ( $profile->save() && $character->save() && $item->save() && $calendar->save() && $calendar_subscriptions->save() )
                    {
                        $this->redirect(array('profile/profile'));
                    }
                }
                else
                {
                    $this->render('register', array(
                            'departments'   => Department::model()->getDepartment(),
                            'nickname_isExist'      => false,
                            'username_errors'        => $user->getErrors(),
                            'profile_errors'        => $profile->getErrors()
                    ));
                }
            }
            else
            {
                var_dump($user->getErrors());
                echo '<br />';
                var_dump($profile->getErrors());
                exit;
                $this->render('register', array(
                        'departments'   => Department::model()->getDepartment(),
                        'username_errors'        => $user->getErrors(),
                        'profile_errors'        => $profile->getErrors()
                ));
            }
        }
        else
        {
            $this->render('register', array(
                    'departments'   => Department::model()->getDepartment(),
                    'username_errors'        => $user->getErrors(),
                    'profile_errors'        => $profile->getErrors()
            ));
        }
    }
}
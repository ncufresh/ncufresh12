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
                    'editor',
                    'sitemap',
                    'success'
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
        $news = News::model()->getPopularNews(10);
        foreach ( $news as & $entry )
        {
            $title = $entry->title;
            $entry->title = mb_strcut($title, 0, 24);
            if ( strlen($title) > strlen($entry->title) ) $entry->title .= '…';
        }

        $this->setPageTitle(Yii::app()->name);
        $this->render('index', array(
            'latests'   => $news,
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
            'friends'   => Activity::getFriendCount(),
            'online'    => Activity::getOnlineCount(),
            'browsered' => Activity::getTotalCount()
        );
        if ( Yii::app()->user->getIsMember() )
        {
            foreach ( Yii::app()->user->getUser()->friends as $friend )
            {
                $this->_data['friends'][] = array(
                    'id'        => $friend->id,
                    'name'      => $friend->profile->nickname,
                    'active'    => Activity::getUserActivity($friend->id)
                );
            }
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
                if ( empty($model->profile) )
                {
                    $this->redirect(array('profile/editor'));
                }
                $this->redirect(array('site/index'));
            }
        }
        $this->setPageTitle(Yii::app()->name . ' - 需要驗證您的身分');
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
        $profile = new Profile('register');
        $user = new User();
        if ( isset($_POST['register']) && isset($_POST['profile']) )
        {
            $user->attributes = $_POST['register'];
            $profile->attributes = $_POST['profile'];
            $user_validate = $user->validate();
            $profile_validate = $profile->validate();
            if ( $user_validate && $profile_validate )
            {
                if ( $user->save() )
                {
                    $profile->id = $user->id;
                    if ( $profile->save() )
                    {
                        $item_save = ItemBag::model()->characterNewItem($user->id);
                        $character_save = Character::model()->createNewCharacter($user->id);
                        //行事曆的部分
                        $calendar = new Calendar();
                        $calendar->user_id = $user->id;
                        $calendar->category = 1;
                        $calendar_subscriptions = new Subscription();
                        $calendar_subscriptions->user_id = $user->id;
                        $calendar_subscriptions->calendar_id = 1;
                        $calendar_subscriptions->invisible = 0;
                         if ( $character_save && $item_save && $calendar->save() && $calendar_subscriptions->save() )
                        { 
                            $this->redirect(array('site/success'));
                        }
                    }
                   
                }
            }
        }
        $this->render('register', array(
            'departments'           => Department::model()->getDepartment(),
            'username_errors'       => $user->getErrors(),
            'profile_errors'        => $profile->getErrors()
        ));
    }

    public function actionSitemap()
    {
        $this->render('sitemap');
    }

    public function actionSuccess()
    {
        $this->render('success');
    }
}
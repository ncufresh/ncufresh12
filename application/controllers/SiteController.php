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
                'actions'   => array('index', 'error', 'search', 'keep', 'login', 'channel'),
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
            'latests'   => News::model()->getPage(1, 10, true),
            'articles'   => array(),
            'marquees'  => Marquee::model()->getMarquees()
        ));
    }

    public function actionMarquee($id = 0)
    {
        if ( isset($_POST['marquee']) )
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
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }

        $this->setPageTitle(Yii::app()->name . ' - 跑馬燈管理');
        $this->render('marquee', array(
            'marquees'  => Marquee::model()->getMarquees()
        ));
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
}
<?php

class SiteController extends Controller
{
    public function actionIndex()
    {
        $this->setPageTitle(Yii::app()->name);
        $this->render('index', array(
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

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ( $error = Yii::app()->errorHandler->error )
        {
            if ( Yii::app()->request->isAjaxRequest )
            {
                echo $error['message'];
            }
            else
            {
                $this->setPageTitle(Yii::app()->name . ' - 發生錯誤');
                $this->render('error', $error);
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
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
}
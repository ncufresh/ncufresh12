<?php

class Security extends CApplicationComponent
{
    public function init()
    {
        parent::init();
        Yii::app()->attachEventHandler('onBeginRequest', array($this, 'checkToken'));
    }
    
    public function getToekn()
    {
        if ( ! isset(Yii::app()->session['token']) )
        {
            Yii::app()->session['token'] = md5(uniqid(mt_rand(), true));
        }
        return Yii::app()->session['token'];
    }

    public function checkToken()
    {
        if ( Yii::app()->request->getIsPostRequest() )
        {
            $token = Yii::app()->session['token'];
            unset(Yii::app()->session['token']);
            if ( ! isset($_POST['token']) || $token !== $_POST['token'] )
            {
                if ( YII_DEBUG )
                {
                    echo 'Token檢查出現錯誤！';
                }
                else
                {
                    throw new CHttpException(400, '表單發生錯誤，請重試一次！');
                }
                return false;
            }
        }
        return true;
    }
}
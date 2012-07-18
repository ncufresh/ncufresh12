<?php

require_once('sdk/facebook.php');

class NFWFacebook extends CApplicationComponent
{
    public $appId;

    public $secret;

    public $facebook;

    public function init()
    {
        if ( ! $this->facebook )
        {
            $this->facebook = new Facebook(array(
                'appId'         => $this->appId,
                'secret'        => $this->secret,
                'fileUpload'    => false
            ));
        }
        return $this->facebook;
    }

    public function getLoginUrl()
    {
        return $this->facebook->getLoginUrl(array(
            // 'scope'             => 'read_stream, friends_likes',
            'display'           => 'popup',
            'redirect_uri'      =>  Yii::app()->request->hostInfo . Yii::app()->user->returnUrl
        ));
    }
}
<?php

require_once('sdk/facebook.php');

class NFWFacebook extends CApplicationComponent
{
    public $appId;

    public $secret;

    public $facebook;

    public $profile;

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

    public function getIsGuest()
    {
        return $this->facebook->getUser() == 0;
    }

    public function getUserProfile()
    {
        if ( ! $this->profile )
        {
            $this->profile = $this->facebook->api('/me', 'GET');
        }
        return $this->profile;
    }

    public function getUsername()
    {
        $this->getUserProfile();
        return $this->profile['name'];
    }

    public function getAppId()
    {
        return $this->facebook->getAppId();
    }

    public function getLoginUrl()
    {
        return $this->facebook->getLoginUrl(array(
            'display'           => 'popup',
            'redirect_uri'      =>  Yii::app()->request->hostInfo . Yii::app()->user->returnUrl
        ));
    }

    public function logout()
    {
        return $this->facebook->destroySession();
    }
}
<?php

require_once('sdk/facebook.php');

class NFWFacebook extends CApplicationComponent
{
    public $appId;

    public $secret;

    public $enable = true;

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
        if ( $this->enable ) return $this->facebook->getUser() == 0;
        return true;
    }

    public function getUsername()
    {
        $profile = $this->facebook->api('/me', 'GET');
        return $profile['name'];
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

    public function destroySession()
    {
        $this->facebook->destroySession();
    }

    public function getLogoutUrl()
    {
        return $this->facebook->getLogoutUrl(array(
            'next'              =>  Yii::app()->createAbsoluteUrl('site/logout')
        ));
    }
}
<?php

class WebUser extends CWebUser
{
    private $_model;

    public function getIsGuest()
    {
        return parent::getIsGuest() && Yii::app()->facebook->getIsGuest();
    }

    public function getIsMember()
    {
        return ! $this->getIsGuest();
    }

    public function getIsAdmin()
    {
        return $this->getIsMember() && $this->user()->getIsAdmin();
    }

    public function getName()
    {
        if ( ! Yii::app()->facebook->getIsGuest() )
        {
            return Yii::app()->facebook->getUsername();
        }
        return parent::getName();
    }

    public function getLastLoginTimestamp()
    {
        return $this->user()->getLastLoginTimestamp();
    }

    public function checkAccess($operation, $params = array(), $allowCaching = true)
    {
        switch ( strtolower($operation) )
        {
            case 'admin':
                return $this->getIsAdmin();
            case 'member':
                return $this->getIsMember();
            case 'guest':
                return $this->getIsGuest();
        }
        return parent::checkAccess($operation, $params, $allowCaching);
    }

    protected function afterLogin($fromCookie)
    {
        parent::afterLogin($fromCookie);
        $this->user()->updateOnlineState();
    }

    public function afterLogout()
    {
        parent::afterLogout();
        if ( ! Yii::app()->facebook->getIsGuest() )
        {
            Yii::app()->facebook->destroySession();
            // Yii::app()->request->redirect(Yii::app()->facebook->getLogoutUrl());
        }
    }

    protected function user()
    {
        if ( $this->_model === null )
        {
            $this->_model = User::model()->findByPk($this->id);
        }
        return $this->_model;
    }
}
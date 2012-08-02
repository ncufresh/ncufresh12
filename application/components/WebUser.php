<?php

class WebUser extends CWebUser
{
    private $_model;

    public function getIsGuest()
    {
        if ( ! $this->getUser() ) return true;
        return parent::getIsGuest();
    }

    public function getIsMember()
    {
        return ! $this->getIsGuest();
    }

    public function getIsAdmin()
    {
        return $this->getIsMember() && $this->getUser()->getIsAdmin();
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
        $this->getUser()->updateOnlineState();
    }

    public function getUser()
    {
        if ( $this->_model === null )
        {
            $this->_model = User::model()->findByPk($this->id);
        }
        return $this->_model;
    }
}
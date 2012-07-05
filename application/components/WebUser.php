<?php

class WebUser extends CWebUser
{
    private $_model;

    public function getIsMember()
    {
        return ! $this->getIsGuest();
    }

    public function getIsAdmin()
    {
        return $this->getIsMember() && $this->user()->is_admin;
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
        $this->user()->save();
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
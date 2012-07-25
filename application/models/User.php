<?php

class User extends CActiveRecord
{
    private $_identity;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{users}}';
    }

    public function rules()
    {
        return array(
            array('username, password', 'required'),
            array('username', 'length', 'min' => 8, 'max' => 256),
            array('password', 'length', 'max' => 128)
        );
    }

    public function behaviors()
    {
        return array(
            'RawDataBehavior',
            'Helper'
        );
    }

    public function relations()
    {
        return array(
            'profile'  => array(
                self::HAS_ONE,
                'Profile',
                'id'
            ),
            'friends'     => array(
                self::MANY_MANY,
                'User',
                'friends(user_id,friend_id)'
            ),
        );
    }

    public static function findByUsername($username)
    {
        return User::model()->find(array(
            'condition' => 'username = :username',
            'params'    => array(
                ':username' => $username
            )
        ));
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login()
    {
        if ( $this->_identity === null )
        {
            $this->_identity = new UserIdentity($this->username, $this->password);
            $this->_identity->authenticate();
        }

        if ( $this->_identity->errorCode === UserIdentity::ERROR_NONE )
        {
            // auto-login in 7 days
            $duration = 3600 * 24 * 7;
            Yii::app()->user->login($this->_identity, $duration);
            return true;
        }
        return false;
    }

    /**
     * Checks if the given password is correct.
     *
     * @param string the password to be validated
     * @return boolean whether the password is valid
     */
    public function validatePassword($password)
    {
        return $this->encryptPassword($password, $this->salt) === $this->password;
    }

    /**
     * Generates the encrypted password.
     *
     * @param string password
     * @return string encrypted password
     */
    public function encryptPassword($password, $salt)
    {
        return md5($salt . $password);
    }

    public function getIsAdmin()
    {
        return $this->is_admin;
    }

    public function getOnlineCount()
    {
        return $this->online_count;
    }

    public function getLastLoginTimestamp()
    {
        return $this->last_login_timestamp;
    }

    public function updateOnlineState()
    {
        $this->online_count += 1;
        $this->last_login_timestamp = $this->getRawValue('updated');
        return $this->save();
    }

    protected function generatePasswordSalt()
    {
        return md5(uniqid($this->username . mt_rand() . TIMESTAMP, true));
    }

    protected function afterFind()
    {
        parent::afterFind();
        $this->is_admin = $this->is_admin ? true : false;
        $this->register_ip = $this->long2ip($this->register_ip);
        $this->last_login_ip = $this->long2ip($this->last_login_ip);
        $this->created = Yii::app()->format->datetime($this->created);
        $this->updated = Yii::app()->format->datetime($this->updated);
    }

    protected function beforeSave()
    {
        if ( parent::beforeSave() )
        {
            if ( $this->getIsNewRecord() )
            {
                $this->is_admin = 0;
                $this->created = TIMESTAMP;
                $this->register_ip = $this->ip2long($this->getClientIP());
                $this->salt = $this->generatePasswordSalt();
                $this->password = $this->encryptPassword($this->password, $this->salt);
            }
            else
            {
                $this->is_admin = $this->is_admin ? 1 : 0;
                $this->created = $this->getRawValue('created');
                $this->register_ip = $this->getRawValue('register_ip');
            }
            $this->updated = TIMESTAMP;
            $this->last_login_ip = $this->ip2long($this->getClientIP());
            return true;
        }
        return false;
    }
}
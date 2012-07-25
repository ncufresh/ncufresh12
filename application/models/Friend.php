<?php

class Friend extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{friends}}';
    }

    public function rules()
    {
        return array(
            array('user_id, friend_id', 'required')
        );
    }

    public function deleteFriend()
    {
        return $this->updateByPk($this->id, array(
            'invisible' => true
        ));
    }

    public function FriendExist($userid, $friendid)
    {
        $_exist = false;
        $data = $this->find(array(
            'condition' => 'friend_id = :friendid AND user_id = :userid',
            'params'    => array(
                ':friendid' => $friendid,
                ':userid'   => $userid
            )
        ));
        if ( isset($data) )
        {
            $_exist = true;
        }
        return $_exist;
    }
}
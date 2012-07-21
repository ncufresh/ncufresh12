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
}
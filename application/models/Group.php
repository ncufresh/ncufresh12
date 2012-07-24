<?php

class  Group extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{groups}}';
    }

    public function rules()
    {
        return array(
            array('name', 'required')
        );
    }

    public function relations()
    {
        return array(
            'profile'  => array(
                self::BELONGS_TO,
                'Profile',
                'user_id'
            ),
            'mygroups'     => array(
                self::HAS_MANY,
                'Group',
                'user_id'
            ),
            'group_members'     => array(
                self::HAS_MANY,
                'UserGroup',
                'group_id'
            )
        );
    }

    public function getAllGroup()
    {
        return $this->findAll(array(
            'order'=>'id ASC'
        ));
    }

    public function FindGroup($groupId)
    {
        return $this->findAll(array(
            'condition' => 'id = :id',
            'params'    => array(
                ':id' => $groupId,
            )
        ));
    }

    public function getGroupAmount($userID)
    {
        $temp = $this->findAll(array(
            'condition' => 'user_id = :id',
            'params'    => array(
                ':id' => $userID,
            )
        ));
        $group_amounts = 0;
        foreach( $temp as $group)
        {
            $group_amounts++;
        }
        return $group_amounts;
    }
}    
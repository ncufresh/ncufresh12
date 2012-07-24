<?php

class  UserGroup extends CActiveRecord
{
    private $_identity;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{user_groups}}';
    }

    public function getMemberId($groupID)
    {
        return $this->findAll(array(
            'condition' => 'group_id = :id',
            'params'    => array(
                ':id' => $groupID
            )
        ));
    }
}
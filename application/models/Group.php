<?php

class Group extends CActiveRecord
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
            array('user_id, group_id', 'required')
        );
    }
}
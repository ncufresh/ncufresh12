<?php

class  NameOfGroup extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{name_of_groups}}';
    }

    public function rules()
    {
        return array(
            array('name', 'required')
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
}    
<?php

class Department extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{departments}}';
    }

    public function rules()
    {
        return array(
            array('name , id', 'required')
        );
    }

    public function getDepartment()
    {
        return $this->findAll(array(  
            'order'     => 'id ASC', 
        ));
    }

    public function getSelfDepartment($id)
    {
        return $this->findAll(array(
            'condition' => 'id = :id',
            'params'    => array(
                ':id' => $id
            )
        ));
    }
}
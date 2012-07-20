<?php

class Department extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{building_info_content}}';
    }

    public function rules()
    {
        return array(
            array('content, department_id', 'required')
        );
    }

    public function getDepartment()
    {
        return $this->findAll(array(  
            'order'     => 'department_id ASC', 
        ));
    }
}
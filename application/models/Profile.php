<?php

class Profile extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{profiles}}';
    }

    public function rules()
    {   
        return array(
            array(
                'name, nickname, department_id, senior, birthday', 
                'required'
            )
        );
    }

    public function relations()
    {
        return array(
            'department'    => array(
                self::HAS_ONE,
                'Department', 
                'id' 
            ),
        ); 
    }
}
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
                self::BELONGS_TO,
                'Department', 
                'department_id' 
            ),
        ); 
    }

    public function getSameDepartmentSameGrade($id, $grade)
    {
        return $this->findAll(array(
            'condition' => 'department_id = :id AND grade = :grade',
            'params'    => array(
                ':id' => $id,
                ':grade' => $grade 
            )
        ));
    }

    public function getSameDepartmentDiffGrade($id, $grade)
    {
        return $this->findAll(array(
            'condition' => 'department_id = :id AND grade <> :grade',
            'params'    => array(
                ':id' => $id,
                ':grade' => $grade
            )
        ));
    }

    public function getOtherDepartment($id)
    {
        return $this->findAll(array(
            'condition' => 'department_id <> :id',
            'params'    => array(
                ':id' => $id
            )
        ));
    }
}
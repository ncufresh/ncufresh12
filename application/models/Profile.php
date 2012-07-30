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
                'name, nickname, department_id, grade,senior, birthday,gender', 
                'required'
            ),
            array('department_id', 'numerical', 'integerOnly'=>true), //範圍1-21
            array('grade', 'numerical', 'integerOnly'=>true) //範圍1-5
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
            'groups'  => array(
                self::HAS_MANY,
                'Group',
                'user_id'
            )
        ); 
    }

    public function deleteProfile()
    {
        return $this->updateByPk($this->id, array(
            'invisible' => true
        ));
    }

    public function getSameDepartmentSameGrade($id, $grade)
    {
        return $this->findAll(array(
            'condition' => 'department_id = :id AND grade = :grade',
            'params'    => array(
                ':id' => $id,
                ':grade' => $grade,
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

    public function getAllMember()
    {
        return $this->findAll(array(
            'order'  => 'id ASC' 
        ));
    }

    public function getProfile()
    {
        return $this->findAll(array(
            'order'  => 'id ASC' 
        ));
    }

}
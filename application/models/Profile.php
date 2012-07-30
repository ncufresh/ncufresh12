<?php

class Profile extends CActiveRecord
{
    public $department;
    
    public $year;
    
    public $month;
    
    public $day;
    
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
                'name, nickname, department, grade, senior, year, month, day ,sex', 
                'required'
            ),
            array('department', 'length','min' => 1, 'max' => 21),
            array('grade', 'length','min' => 1, 'max' => 5),
            array('nickname', 'unique', 'className' => 'Profile'),
            array('year', 'numerical', 'integerOnly'=>true),
            array('month', 'numerical', 'integerOnly'=>true), 
            array('day', 'numerical', 'integerOnly'=>true),
            //array('year', 'length' => 4),
            array('month', 'length', 'min' => 1, 'max' => 2),
            array('day', 'length', 'min' => 1, 'max' => 2),
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

    public function isNickNameExist($nickname)
    {
        $data = $this->find(array(
                    'condition' => 'nickname = :nickname',
                        'params' => array(
                            ':nickname' =>$nickname
                    )
                ));
        if ( isset($data) )
        {
            return true;
        }
        return false;
    }

    public function beforeSave()
    {
        if ( parent::beforeSave() )
        {
            $this->department_id = $department;
            $this->birthday = $year.'/'.$month.'/'.$day;
            return true;
        }
        return false;
    }
}
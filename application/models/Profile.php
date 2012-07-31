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
            array('name, nickname, department, grade, senior, year, month, day ,gender','required'),
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
            'mydepartment'    => array(
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
        return $this->updateByPk(Yii::app()->user->getId(), array(
            'invisible' => true
        ));
    }

    public function getSameDepartmentSameGrade($Depid, $grade)
    {
        return $this->findAll(array(
            'condition' => 'department_id = :id AND grade = :grade AND id <> :userid',
            'params'    => array(
                ':id' => $Depid,
                ':grade' => $grade,
                ':userid' => Yii::app()->user->getId()
            )
        ));
    }

    public function getSameDepartmentDiffGrade($Depid, $grade)
    {
        return $this->findAll(array(
            'condition' => 'department_id = :id AND grade <> :grade',
            'params'    => array(
                ':id' => $Depid,
                ':grade' => $grade
            )
        ));
    }

    public function getOtherDepartment($Depid)
    {
        return $this->findAll(array(
            'condition' => 'department_id <> :id',
            'params'    => array(
                ':id' => $Depid
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

    public function behaviors()
    {
        return array(
            'RawDataBehavior'
        );
    }

    protected function beforeValidate()
    {
        if ( parent::beforeValidate() )
        {
            $this->birthday = mktime(0, 0, 0, $this->month, $this->day, $this->year);
            return true;
        }
        return false; 
        
    }
    
    protected function afterFind()
    {
        parent::afterFind();
        $this->birthday = Yii::app()->format->date($this->birthday);
    }

    protected function beforeSave()
    {
        if ( parent::beforeSave() )
        {
            if ( $this->getIsNewRecord() )
            {
                $this->birthday = $this->birthday;
            }
            else
            {
                $this->birthday = $this->getRawValue('birthday');//先複製一份資料庫那欄中的資料
            }
            $this->department_id = $this->department;
            return true;
        }
        return false;
    }
}
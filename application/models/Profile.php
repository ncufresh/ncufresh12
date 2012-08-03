<?php

class Profile extends CActiveRecord
{
    public $department;
    
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
            array('name, nickname, department, grade, senior, birthday ,gender','required'),
            array('nickname', 'length','min' => 1, 'max' => 8, 'on' => 'register, editor'),
            array('department', 'numerical','min' => 1, 'max' => 21),
            array('grade', 'numerical','min' => 0, 'max' => 4),
            array('nickname', 'unique', 'className' => 'Profile', 'on' => 'register, editor'),
            array('birthday', 'isDate'),
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

    public function isDate($attr)
    {
        $birthday = $this->{$attr};
        if ( preg_match('/^\d{4}\-\d{2}-\d{2}$/', $birthday) )
        {
            list($year, $month, $day) = explode('-', $birthday);
            $birthday = mktime(0, 0, 0, $month, $day, $year);
            if ( $birthday === false ) $this->addError('birthday', 'WRONG!!!');
            return true;
        }
        $this->addError('birthday', 'WRONG!!!');
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

    protected function afterFind()
    {
        parent::afterFind();
        $this->birthday = Yii::app()->format->date($this->birthday);
        $this->name = htmlspecialchars( $this->name );
        $this->nickname = htmlspecialchars( $this->nickname );
        $this->senior = htmlspecialchars( $this->senior );
    }
    
    public function beforeSave()
    {
        if ( parent::beforeSave() )
        {
            if ( $this->getIsNewRecord() || $this->getScenario('editor') )
            {
                list($year, $month, $day) = explode('-', $this->birthday);
                $this->birthday = mktime(0, 0, 0, $month, $day, $year);
            }
            else
            {
                $this->birthday = $this->getRawValue('birthday'); // 先複製一份資料庫那欄中的資料
            }
            $this->department_id = $this->department;
            return true;
        }
        return false;
    }

}
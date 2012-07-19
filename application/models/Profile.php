<?php

define('USER_UPLOAD_IMAGE', 'images/'); // 預設路徑名稱

class Profile extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{profile}}';
    }

    public function rules()
    {
        return array(
            array(
                'user_id, name, nickname, department_id, grade,
                email, senior, birthday, picture', 
                'required'
            ),
        );
        
    }
    public function relations()
    {
        return array(
            'department'    => array(
                self::HAS_ONE,
                'Department', //model
                'department_id' //column
            ),
            'user'  => array(
                self::HAS_ONE,
                'User',
                'user_id'
            ),
        );
        /*$profile = Profile::model()->findByPk(1);
          $department = Department::model()->findByPk($profile->department_id); 
          若有寫relation的話  就可改成      $profile = Profile::model()->findByPk(1);
                                          $profile->department*/
    }
}
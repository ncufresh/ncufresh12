<?php
define('user-upload-image','images/'); //預設路徑名稱
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
			array('user_id, 
            name,
            nickname,
            department_id,
            grade,
            email,
            senior,
            birthday,
            bbsuser,
            ipcture', 
            'required'
            ),
		);
        
	}



}
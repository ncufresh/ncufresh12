<?php

class Activity extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'activities';
    }

    public function getId()
    {
        return $this->user_id ?: 0;
    }

    public function setId($id)
    {
        $this->user_id = $id;
    }

    public static function updateActivityState()
    {
        return Activity::model()->deleteAll(array(
            'condition' => 'updated < ' . (TIMESTAMP - 30)
        ));
    }

    public static function getOnlineCount()
    {
        return Activity::model()->count();
    }

    public static function getTotalCount()
    {
        // return Activity::model()->count();
        return 0;
    }

    protected function beforeSave()
    {
        $uuid = function($prefix = '')
        {
            $chars = md5(uniqid(mt_rand(), true));
            $uuid = substr($chars,0,8) . '-';
            $uuid .= substr($chars,8,4) . '-';
            $uuid .= substr($chars,12,4) . '-';
            $uuid .= substr($chars,16,4) . '-';
            $uuid .= substr($chars,20,12);
            return $prefix . $uuid;
        };
        if ( parent::beforeSave() )
        {
            if ( $this->getIsNewRecord() )
            {
                $this->uuid = $uuid();
            }
            $this->id = Yii::app()->user->id ?: 0;
            $this->updated = TIMESTAMP;
            return true;
        }
        return false;
    }
}
<?php 

class Calendar extends CActiveRecord 
{
    /**
     * The followings are availalbe columns in table 'calendars'
     * @var integer $id
     * @var integer $user_id
     * @var integer category
     */

    public function tableName()
    {
        return '{{calendars}}';
    }
}
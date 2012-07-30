<?php 

class Status extends CActiveRecord 
{
    /**
     * The followings are availalbe columns in table 'calendar_events'
     * @var integer $id
     * @var integer $user_id
     * @var integer $event_id
     * @var boolean $done
     */

    public function tableName()
    {
        return '{{calendar_events}}';
    }
}
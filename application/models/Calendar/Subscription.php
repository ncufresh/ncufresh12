<?php 

class Subscription extends CActiveRecord 
{
    /**
     * The followings are availalbe columns in table 'calendar_subscriptions'
     * @var integer $id
     * @var integer $user_id
     * @var integer $calendar_id
     * @var boolean $invisible
     */


    public function relations()
    {
        return array(
            'calendar'  => array(
                self::BELONGS_TO,
                'Calendar',
                'calendar_id',
            )
        );
    }
     
    public function tableName()
    {
        return '{{calendar_subscriptions}}';
    }
}
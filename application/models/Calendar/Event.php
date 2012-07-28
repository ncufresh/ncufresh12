<?php 

class Event extends CActiveRecord 
{
    /**
     * The followings are availalbe columns in table 'calendar_events'
     * @var integer $id
     * @var integer $calendar_id
     * @var varchar $name
     * @var text    $description
     * @var integer $start
     * @var integer $end
     * @var integer $created
     * @var boolean $visible
     */

    public function tableName()
    {
        return '{{calendar_events}}';
    }
}
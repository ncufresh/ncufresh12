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

    public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

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
    
    public function beforesave()
    {
        if ( parent::beforeSave() )
        {
            if ( $this->getIsNewRecord() )
            {
                $this->user_id = Yii::app()->user->getId();
            }
            return true;
        }
        return false;
    }
    
    public function getSubscribedCalendars()
    {
        return $this->findAll('invisible=0 AND user_id='.Yii::app()->user->getId());
    }
}
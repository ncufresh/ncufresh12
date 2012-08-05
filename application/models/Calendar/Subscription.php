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
    
    public function getInvisibleSubscriptionByCalendarID($calendar_id)
    {
        var_dump('calendar_id='.$calendar_id.' AND invisible = 1 AND user_id='.Yii::app()->user->getId());
        return $this->find(array(
                'condition' => 'calendar_id = :calendar_id AND invisible = 1 AND user_id= :user_id',
                'params' => array(
                    ':calendar_id'  => $calendar_id,
                    ':user_id'      => Yii::app()->user->id
                )
            )
        );
    }

    public function getSubscriptionByCalendarID($calendar_id)
    {
        return $this->find('calendar_id='.$calendar_id.' AND invisible = 0 AND user_id='.Yii::app()->user->getId());
    }

    public function getIsSubscriptByClubID($club_id)
    {
        $calendar = Calendar::model()->getClubCalendar($club_id);
        if ( $calendar ) {
            if ( $this->find('calendar_id=' . $calendar->id . ' AND invisible = 0 AND user_id=' . (integer)Yii::app()->user->getId()) )
            {
                return true;
            }
            return false;
        }
        return false;
    }
}
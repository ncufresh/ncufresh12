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
     * @var boolean $invisible
     */
    public function tableName()
    {
        return '{{calendar_events}}';
    }

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function behaviors()
    {
        return array(
            'RawDataBehavior'
        );
    }
    
    public function relations()
    {
        return array(
            'users' => array(
                self::MANY_MANY,
                'User',
                'calendar_status(event_id, user_id)'
            ),
            'calendar'  => array(
                self::BELONGS_TO,
                'Calendar',
                'calendar_id'
            ),
            'status'    => array(
                self::HAS_ONE,
                'Status',
                'event_id',
                'on' => 'status.user_id IS NULL OR status.user_id=' . Yii::app()->user->id
            )
        );
    }

    public function getEventById($id)
    {
        $event = $this->findByPk($id);
        $event->start = $event->getRawValue('start');
        $event->end = $event->getRawValue('end');
        $event->start = Yii::app()->format->datetime($event->start);
        $event->end = Yii::app()->format->datetime($event->end);
        return $event;
    }

    public function getEventsByIds($ids)
    {
        $criteria = new CDbCriteria();
        $criteria->addInCondition('id' ,$ids , 'OR');
        $events = $this->findAll( $criteria );
        // foreach ( $events as $event )
        // {
            // $event->start = $event->getRawValue('start');
            // $event->end = $event->getRawValue('end');
            // $event->start = Yii::app()->format->date($event->start);
            // $event->end = Yii::app()->format->date($event->end);
        // }
        return $events;
    }

    public function getEventsByCalendarId($calendar_id)
    {
        
    }

    // public function getEventsByDate($date, $calendar_id = 0)
    // {
        // $date = strtotime($date);
        // $criteria = new CDbCriteria();
        // $criteria->condition = 'start => :date AND end <= :date AND calendar_id = :calendar_id';
        // $criteria->params = array(
            // ':date' => $date,
            // ':calendar_id' => $calendar_id
        // );
        // $events = $this->findAll( $criteria );
        // foreach ( $events as $event )
        // {
            // $event->start = $event->getRawValue('start');
            // $event->end = $event->getRawValue('end');
            // $event->start = Yii::app()->format->datetime($event->start);
            // $event->end = Yii::app()->format->datetime($event->end);
        // }
        // return $events;
    // }

    public function getRecycledEvents()
    {
        return $this->with(array(
            'users'     => array(
                'select'    => false,
                'joinType'  => 'INNER JOIN',
                'condition' => 'users_users.user_id = :id',
                'params'    => array(
                    ':id'   => Yii::app()->user->getId()
                )
            ),
            'status'    => array(
                'select'    => false,
                'joinType'  => 'INNER JOIN',
                'condition' => 'status.done = 1'
            )
        ))->findAll(array(
            'condition' => 'invisible = 0'
        ));
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->start -= date('Z', $this->start);
        $this->end   -= date('Z', $this->end);
    }
    
    public function beforeSave()
    {
        if ( parent::beforeSave() )
        {
            if ( $this->getIsNewRecord() )
            {
                $this->created = TIMESTAMP;
            }
            return true;
        }
        return false;
    }
}
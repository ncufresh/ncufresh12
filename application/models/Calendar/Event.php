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
                'on' => 'status.user_id IS NULL OR status.user_id=' . (integer)Yii::app()->user->id
            )
        );
    }

    public function getEventById($id)
    {
        $event = $this->with(array(
            'calendar' => array(
                'select'    => false,
                'condition' => 'user_id = :user_id OR category = 0',
                'params'    => array(
                    ':user_id' => Yii::app()->user->id
                )
            )
        ))->findByPk($id);
        if ( $event )
        {
            $event->start = $event->getRawValue('start');
            $event->end = $event->getRawValue('end');
            $event->start = Yii::app()->format->date($event->start);
            $event->end = Yii::app()->format->date($event->end);
        }
        return $event;
    }

    public function getEventsByIds($ids)
    {
        $criteria = new CDbCriteria();
        $criteria->addInCondition('id' ,$ids , 'OR');
        $events = $this->findAll( $criteria );
        return $events;
    }

    public function getEventsByCalendarId($calendar_id)
    {
        return $this->findAll(array(
            'condition' => 'calendar_id = :id',
            'params' => array(
                ':id' => $calendar_id
            )
        ));
    }

    public function getRecycledEvents()
    {
        return $this->with(array(
            'status'    => array(
                'select'    => false,
                'condition' => 'status.done = 1'
            )
        ))->findAll(array(
            'condition' => 'invisible = 0'
        ));
    }

    public function show($id)
    {
        $event = $this->findByPk($id);
        if ( $event )
        {
            $status = $event->status;
            if ( ! $status ) $status = new Status();
            $status->event_id = $id;
            $status->user_id = Yii::app()->user->getId();
            $status->done = false;
            if ( $status->save() ) return true;
        }
        return false;
    }

    public function hide($id)
    {
        $event = $this->findByPk($id);
        if ( $event )
        {
            $status = $event->status;
            if ( ! $status ) $status = new Status();
            $status->event_id = $id;
            $status->user_id = Yii::app()->user->getId();
            $status->done = true;
            if ( $status->save() ) return true;
        }
        return false;
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
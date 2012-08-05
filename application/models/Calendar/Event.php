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
    
    public function rules()
    {
        return array(
            array('start', 'isDate'),
            array('end', 'isDate'),
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

    public function isDate($attr)
    {
        if ( $this->getIsNewRecord() )
        {
            $date = $this->{$attr};
            if ( preg_match('/^\d{4}\-\d{2}-\d{2}$/', $date) )
            {
                list($year, $month, $day) = explode('-', $date);
                $date = mktime(0, 0, 0, $month, $day, $year);
                if ( $date === false ) $this->addError('date', 'WRONG!!!');
                return true;
            }
            $this->addError('date', 'WRONG!!!');
        }
        return true;
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
            ),
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
        $this->description = nl2br(htmlspecialchars($this->description));
        if ( ! Yii::app()->request->isAjaxRequest )
        {
            $this->name = htmlspecialchars($this->name);
        }
    }

    public function beforeSave()
    {
        if ( parent::beforeSave() )
        {
            if ( $this->getIsNewRecord() )
            {
                $this->created = TIMESTAMP;
                list($year, $month, $day) = explode('-', $this->start);
                $this->start = mktime(0, 0, 0, $month, $day, $year);
                list($year, $month, $day) = explode('-', $this->end);
                $this->end = mktime(0, 0, 0, $month, $day, $year);
                if ( $this->start > $this->end ) return false;
            }
            return true;
        }
        return false;
    }

    public function limitMonth($year, $month)
    {
        $begin = mktime(0,0,0,$month,1,$year);
        $end = mktime(0,0,0,$month+1,1,$year);
        $criteria = new CDbCriteria();
        $criteria->addCondition('start < :end AND end >= :begin');
        $criteria->addCondition('(status.done IS NULL OR status.done = 0) AND invisible = 0');
        $criteria->with = array(
            'status' => array(
                'joinType'  => 'LEFT JOIN'
            )
        );
        $criteria->params = array(
            ':begin' => $begin,
            ':end' => $end
        );
        $this->setDbCriteria($criteria);
        return $this;
    }
}
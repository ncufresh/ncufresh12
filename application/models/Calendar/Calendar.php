<?php 

class Calendar extends CActiveRecord 
{
    /**
     * The followings are availalbe columns in table 'calendars'
     * @var integer $id
     * @var integer $user_id
     * @var integer category
     */

    const GENERAL_CALENDAR_USER_ID = 0;
    const CATEGORY_PUBLIC = 0;
    const CATEGORY_PERSONAL = 1;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function tableName()
    {
        return '{{calendars}}';
    }

    public function relations()
    {
        return array(
            'events' => array(
                self::HAS_MANY,
                'Event',
                'calendar_id',
                'condition' => '(status.done IS NULL OR status.done = 0) AND invisible = 0',
                'with' => array(
                    'status' => array(
                        'joinType'  => 'LEFT JOIN'
                    )
                )
            ),
            'author' => array(
                self::BELONGS_TO,
                'User',
                'user_id'
            ),
            'club' => array(
                self::HAS_ONE,
                'Club',
                '',
                'on' => 'club.master_id = user_id',
                'condition' => 't.category=0'
            ),
            'subscriptions' => array(
                self::HAS_ONE,
                'Subscription',
                'calendar_id',
                'on' => 'subscriptions.user_id = :id',
                'params'    => array(
                    ':id'   => Yii::app()->user->getId()
                ),
            ),
        );
    }

    public function createPersonalCalendar()
    {
        $calendar = new Calendar();
        $calendar->user_id = Yii::app()->user->id;
        $calendar->category = Calendar::CATEGORY_PERSONAL;
        if ( $calendar->validate() )
        {
            $calendar->save();
            return $calendar;
        }
        return false;
    }
    
    public function getIsGeneral()
    {
        return $this->category === self::CATEGORY_PUBLIC && $this->user_id === self::GENERAL_CALENDAR_USER_ID;
    }

    public function getIsClub()
    {
        return $this->category === self::CATEGORY_PUBLIC && $this->user_id !== self::GENERAL_CALENDAR_USER_ID;
    }

    public function getIsPersonal()
    {
        return $this->category === self::CATEGORY_PERSONAL;
    }

    public function getIsOwner()
    {
        return $this->user_id !== 0 && $this->user_id == Yii::app()->user->getId();
    }

    public function getClub($user_id)
    {
        return Club::Model()->getClubByMasterId($user_id);
    }

    public function getClubs()
    {
        return $this->with(array(
            'club' => array(
                'select'    => 'name, category',
                'condition' => 'club.master_id != 0'
            ),
            'subscriptions' => array(
                'select'    => 'invisible'
            )
        ))->findAll(array(
            'select'    => 'id',
        ));
    }

    public function getPersonalCalendar()
    {
        return $this->find(array(
            'condition' => 'user_id = :user_id AND category = :category',
            'params' => array(
                ':user_id' => Yii::app()->user->id,
                ':category' => self::CATEGORY_PERSONAL,
            )
        ));
    }

    public function getClubCalendar($id = 0)
    {
        if ( $id )
        {
            return $this->with(array(
                'club' => array(
                    'condition' => 'club.id = :club_id',
                    'params' => array(
                        ':club_id' => $id,
                    )
                )
            ))->find(array(
                'condition' => 't.category = :category AND user_id != 0',
                'params' => array(
                    ':category' => self::CATEGORY_PUBLIC,
                )
            ));
        }
        else
        {
            return $this->find(array(
                'condition' => 'user_id = :user_id AND category = :category',
                'params' => array(
                    ':category' => self::CATEGORY_PUBLIC,
                    ':user_id'  => Yii::app()->user->id
                )
            ));
        }
    }
    
    public function getAllClubCalendars()
    {
        return $this->findAll(array(
            'condition' => 'category = :category',
            'params' => array(
                ':category' => self::CATEGORY_PUBLIC,
            )
        ));
    }

    public function getClubCalendarByUserId($user_id)
    {
        return $this->find(array(
            'condition' => 'user_id = :user_id AND category = :category',
            'params' => array(
                ':user_id' => $user_id,
                ':category' => self::CATEGORY_PUBLIC,
            )
        ));
    }
    
    public function getGeneralCalendar()
    {
        return $this->find(array(
            'condition' => 'user_id = :user_id AND category = :category',
            'params' => array(
                ':user_id' => self::GENERAL_CALENDAR_USER_ID,
                ':category' => self::CATEGORY_PUBLIC
            )
        ));
    }

    public function getClubName()
    {
        if ( $this->getIsClub() )
        {
            $club = Club::model()->getClubByMasterId($this->author->id);
            return $club?$club->name:'unknown';
        }
        return false;
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->user_id = (integer)$this->user_id;
        $this->category = (integer)$this->category;
    }
}
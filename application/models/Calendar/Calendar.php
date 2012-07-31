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
                'condition' => 'status.done IS NULL OR status.done = 0',
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
            'clubs' => array(
                self::HAS_ONE,
                'Club',
                '',
                'on' => 'clubs.master_id = user_id',
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
                
            )
        );
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

    public function getClub($user_id)
    {
        return Club::Model()->getClubByMasterId($user_id);
    }

    public function getClubs()
    {
        return $this->with(array(
            'clubs' => array(
                'select'    => 'name',
                'condition' => 'clubs.master_id != 0'
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

    public function getClubCalendar()
    {
        return $this->find(array(
            'condition' => 'user_id = :user_id AND category = :category',
            'params' => array(
                ':user_id' => Yii::app()->user->id,
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
    
    public function getClubCalendarsSubscriptionStatus()
    {
        
    }
    
    public function getGeneralCalendar()
    {
        return $this->with('events')->find(array(
            'condition' => 'user_id = :user_id',
            'params' => array(
                ':user_id' => self::GENERAL_CALENDAR_USER_ID
            )
        ));
    }

    public function getClubName()
    {
        // if ( $this->category == 'club' )
        if ( $this->getIsClub() )
        {
            $club = Club::model()->getClubByMasterId($this->author->id);
            return $club?$club->name:'unknown';
        }
        return false;
    }

    public static function getCurrentMonth()
    {
        return date('m', TIMESTAMP);
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->user_id = (integer)$this->user_id;
        $this->category = (integer)$this->category;
        // if( $this->user_id == 0 )
        // {
            // $this->category = 'general';
        // }
        // else if( $this->category == 0 )
        // {
            // $this->category = 'club';
        // }
        // else
        // {
            // $this->category = 'personal';
        // }
    }
}
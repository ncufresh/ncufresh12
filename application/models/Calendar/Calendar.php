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
    const CATEGORY_CLUB = 0;
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
                'calendar_id'
            ),
            'author' => array(
                self::BELONGS_TO,
                'User',
                'user_id'
            )
        );
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
                ':category' => self::CATEGORY_CLUB,
            )
        ));
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
        if ( $this->category = 'club' )
        {
            $club = Club::model()->findByManagerId($this->author);
            return $club->name;
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
        if( $this->user_id == 0 )
        {
            $this->category = 'general';
        }
        else if( $this->category == 0 )
        {
            $this->category = 'club';
        }
        else
        {
            $this->category = 'personal';
        }
    }
}
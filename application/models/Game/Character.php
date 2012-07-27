<?php

class Character extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{game_characters}}';
    }

    public function relations()
    {
        return array(
            'profile'    => array(
                self::BELONGS_TO,
                'Profile',
                'id'
            ),
            'hair'    => array(  // hair��Item��hair_id row
                self::BELONGS_TO,
                'Item',
                'hair_id'
            ),
            'eyes'    => array(
                self::BELONGS_TO,
                'Item',
                'eyes_id'
            ),
            'cloths'    => array(
                self::BELONGS_TO,
                'Item',
                'cloths_id'
            ),
            'pants'    => array(
                self::BELONGS_TO,
                'Item',
                'pants_id'
            ),
            'shoes'    => array(
                self::BELONGS_TO,
                'Item',
                'shoes_id'
            ),
            'others'    => array(
                self::BELONGS_TO,
                'Item',
                'others_id'
            ),
            // 'achievements'    => array(
                // self::MANY_MANY,
                // 'Achievement',
                // 'game_achievements_bag(user_id, achievement_id)'
            // ),
            'achievements_bag'    => array(
                self::HAS_MANY,
                'AchievementBag',
                'user_id'
            ),
            // 'items'    => array(
                // self::MANY_MANY,
                // 'Item',
                // 'game_items_bag(user_id, items_id)'
            // ),
            'items_bag'    => array(
                self::HAS_MANY,
                'ItemBag',
                'user_id'
            )
         );
    }
    
    public function getLevel($user_id)
    {
        $level = array(
            array(
                'name'  => '���~��',  //��h�W���|�]��o
                'exp'   => 0
            ),
            array(
                'name'  => '���Ť@',
                'exp'   => 150
            ),
            array(
                'name'  => '���ŤG',
                'exp'   => 500
            ),
            array(
                'name'  => '���ŤT',
                'exp'   => 1200
            ),
            array(
                'name'  => '���ť|',
                'exp'   => 2400
            ),
            array(
                'name'  => '���Ť�',
                'exp'   => 5000
            ),
            array(
                'name'  => '���Ť�',
                'exp'   => 8050
            ),
            array(
                'name'  => '���ŤC',
                'exp'   => 13050
            ),
            array(
                'name'  => '���ŤK',
                'exp'   => 20000
            ),
            array(
                'name'  => '���ŤE',
                'exp'   => 30000
            ),
            array(
                'name'  => '���ŤQ',
                'exp'   => 48050
            ),
            array(
                'name'  => '���ŤQ�@',
                'exp'   => 63000
            ),
            array(
                'name'  => '���ŤQ�G',
                'exp'   => 85000
            ),
            array(
                'name'  => '���ŤQ�T',
                'exp'   => 110000
            ),
            array(
                'name'  => '���ŤQ�|',
                'exp'   => 165000
            ),
            array(
                'name'  => '���ŤQ��',
                'exp'   => 250000
            ),
            array(
                'name'  => '���ŤQ��',
                'exp'   => 360000
            ),
            array(
                'name'  => '���ŤQ�C',
                'exp'   => 520000
            ),
            array(
                'name'  => '���ŤQ�K',
                'exp'   => 750000
            ),
            array(
                'name'  => '���ŤQ�E',
                'exp'   => 1000000
            ),
            array(
                'name'  => '���ŤG�Q',
                'exp'   => 10000000000
            )
        );
    }

    public function getId()
    {
        return $this->id;
    }

    public function addExp($value)
    {
        $this->saveCounters(array('exp' => $value));
    }

    public function addMoney($value)
    {
        $this->saveCounters(array('money' => $value));
    }

    public function AchievementsBag()
    {
        return $this->achievements_bag;
    }

    // public function GetAchievementsTime()
    // {
        // return $this->achievements_bag;
    // }

    public function ItemsBag()
    {
        return $this->items;
    }

    public function GetItemsTime()
    {
        return $this->items_bag;
    }

    public function Owner()
    {
        return $this->achievements;
    }
}
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
            'hair'    => array(  // hair¬°Itemªºhair_id row
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
            'hands'    => array(
                self::BELONGS_TO,
                'Item',
                'hands_id'
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
            'achievements'    => array(
                self::MANY_MANY,
                'Achievement',
                'game_achievements_bag(user_id, achievement_id)'
            ),
            'achievements_time'    => array(
                self::HAS_MANY,
                'AchievementGetTime',
                'user_id'
            ),
            'items'    => array(
                self::MANY_MANY,
                'Item',
                'game_items_bag(user_id, items_id)'
            ),
            'items_time'    => array(
                self::HAS_MANY,
                'ItemGetTime',
                'user_id'
            )
         );
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUserNickName()
    {
        return $this->profile->nickname;
    }

    public function getHairName()
    {
        return $this->hair->name;
    }

    public function getEyesName()
    {
        return $this->eyes->name;
    }

    public function getClothsName()
    {
        return $this->cloths->name;
    }

    public function getPantsName()
    {
        return $this->pants->name;
    }

    public function getHandsName()
    {
        return $this->hands->name;
    }

    public function getShoesName()
    {
        return $this->shoes->name;
    }

    public function getOthersName()
    {
        return $this->others->name;
    }

    public function getExpValue()
    {
        return $this->exp;
    }

    public function getMoneyValue()
    {
        return $this->money;
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
        return $this->achievements;
    }
    
    public function GetAchievementsTime()
    {
        return $this->achievements_time;
    }
    
    public function ItemsBag()
    {
        return $this->items;
    }
    
    public function GetItemsTime()
    {
        return $this->items_time;
    }

    public function Owner()
    {
        return $this->achievements;
    }

}
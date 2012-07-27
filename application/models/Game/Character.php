<?php

class Character extends CActiveRecord
{
    public $exp_level = array(
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
            'exp'   => 405
        ),
        array(
            'name'  => '���ŤT',
            'exp'   => 837
        ),
        array(
            'name'  => '���ť|',
            'exp'   => 1571
        ),
        array(
            'name'  => '���Ť�',
            'exp'   => 2817
        ),
        array(
            'name'  => '���Ť�',
            'exp'   => 4933
        ),
        array(
            'name'  => '���ŤC',
            'exp'   => 8526
        ),
        array(
            'name'  => '���ŤK',
            'exp'   => 14625
        ),
        array(
            'name'  => '���ŤE',
            'exp'   => 24981
        ),
        array(
            'name'  => '���ŤQ',
            'exp'   => 42562
        ),
        array(
            'name'  => '���ŤQ�@',
            'exp'   => 72412
        ),
        array(
            'name'  => '���ŤQ�G',
            'exp'   => 123090
        ),
        array(
            'name'  => '���ŤQ�T',
            'exp'   => 209132
        ),
        array(
            'name'  => '���ŤQ�|',
            'exp'   => 355212
        ),
        array(
            'name'  => '���ŤQ��',
            'exp'   => 603227
        ),
        array(
            'name'  => '���ŤQ��',
            'exp'   => 1024304
        ),
        array(
            'name'  => '���ŤQ�C',
            'exp'   => 1739206
        ),
        array(
            'name'  => '���ŤQ�K',
            'exp'   => 2952962
        ),
        array(
            'name'  => '���ŤQ�E',
            'exp'   => 5100000
        ),
        array(
            'name'  => '���ŤG�Q',
            'exp'   => 10000000000
        )
    );
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
    
    public function getLevel($id)
    {   
        $counter = 0;
        foreach ($this->exp_level as $value)
        {
            if ( Character::model()->findByPk($id)->exp < $value['exp'] )
            {
                return $counter;
                break;
            }
        $counter++;
        }
    }
    
    public function getLevelExp($level)
    {   
        $target = $this->exp_level;
        $exp = $target[$level];
        return $exp['exp'];
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
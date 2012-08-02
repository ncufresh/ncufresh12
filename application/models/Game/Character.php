<?php
class Character extends CActiveRecord
{
    public $exp_level = array(
        array(
            'name'  => '錯誤級', // 原則上不會跑到這
            'exp'   => 0
        ),
        array(
            'name'  => '等級一',
            'exp'   => 150
        ),
        array(
            'name'  => '等級二',
            'exp'   => 405
        ),
        array(
            'name'  => '等級三',
            'exp'   => 837
        ),
        array(
            'name'  => '等級四',
            'exp'   => 1571
        ),
        array(
            'name'  => '等級五',
            'exp'   => 2817
        ),
        array(
            'name'  => '等級六',
            'exp'   => 4933
        ),
        array(
            'name'  => '等級七',
            'exp'   => 8526
        ),
        array(
            'name'  => '等級八',
            'exp'   => 14625
        ),
        array(
            'name'  => '等級九',
            'exp'   => 24981
        ),
        array(
            'name'  => '等級十',
            'exp'   => 42562
        ),
        array(
            'name'  => '等級十一',
            'exp'   => 72412
        ),
        array(
            'name'  => '等級十二',
            'exp'   => 123090
        ),
        array(
            'name'  => '等級十三',
            'exp'   => 209132
        ),
        array(
            'name'  => '等級十四',
            'exp'   => 355212
        ),
        array(
            'name'  => '等級十五',
            'exp'   => 603227
        ),
        array(
            'name'  => '等級十六',
            'exp'   => 1024304
        ),
        array(
            'name'  => '等級十七',
            'exp'   => 1739206
        ),
        array(
            'name'  => '等級十八',
            'exp'   => 2952962
        ),
        array(
            'name'  => '等級十九',
            'exp'   => 5100000
        ),
        array(
            'name'  => '等級二十',
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
            'hairs'    => array( // hair為Item的hair_id row
                self::BELONGS_TO,
                'Item',
                'hair_id'
            ),
            'eyes'    => array(
                self::BELONGS_TO,
                'Item',
                'eyes_id'
            ),
            'clothes'    => array(
                self::BELONGS_TO,
                'Item',
                'clothes_id'
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
            'skins'    => array(
                self::BELONGS_TO,
                'Item',
                'skin_id'
            ),
            'others'    => array(
                self::BELONGS_TO,
                'Item',
                'others_id'
            ),
            'achievements_bag'    => array(
                self::HAS_MANY,
                'AchievementBag',
                'user_id'
            ),
            'items_bag'    => array(
                self::HAS_MANY,
                'ItemBag',
                'user_id'
            )
         );
    }

    public function getItemsByCategory($category)
    {   
        $category = (integer)$category;
        $array = array();
        foreach ($this->items_bag as $item)
        {
            if ( $item->translation->category == $category )
            {
                $array[] = $item;
            }
        }
        return $array;
    }
    
    public function getLevel($id)
    {   
        $counter = 0;
        foreach ($this->exp_level as $value)
        {
            if ( Character::model()->findByPk($id)->experience < $value['exp'] )
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

    public function addExp($value)
    {
        $this->saveCounters(array('experience' => $value));
        return true;
    }

    public function minusMoney($value)
    {
        $this->saveCounters(array('money' => 0-$value));
        return true;
    }

    public function addMoney($value)
    {
        $this->saveCounters(array('money' => $value));
        $this->saveCounters(array('total_money' => $value));
        return true;
    }
    
    public function addMission()
    {
        $this->saveCounters(array('missions' => 1));
        return true;
    }

    public static function getAvatar($id)
    {
        $parts = array(
            '皮膚'    => 'skins',
            '臉部'    => 'eyes',
            '鞋子'    => 'shoes',
            '褲子'    => 'pants',
            '衣服'    => 'clothes',
            '頭髮'    => 'hairs',
            '其他'    => 'others'
        );
        $avatar = array_fill_keys(array_keys($parts), '../images/unknown.png');
        $character = Character::model()->findByPk($id);
        if ( $character )
        {
            foreach ( $parts as $name => $part )
            {
                if ( $character->{$part} )
                {
                    $avatar[$name] = $part . '/' . $character->{$part}->filename . '.png';
                }
            }
        }
        return $avatar;
    }

    public static function getBodyPrice($id)
    {
        $character = Character::model()->findByPk($id);
        $price = 0;
        if( $character->skins !== null)
            $price = $price + $character->skins->price;
        if( $character->eyes !== null)
            $price = $price + $character->eyes->price;
        if( $character->hairs !== null)
            $price = $price + $character->hairs->price;
        if( $character->shoes !== null)
            $price = $price + $character->shoes->price;
        if( $character->pants !== null)
            $price = $price + $character->pants->price;
        if( $character->clothes !== null)
            $price = $price + $character->clothes->price;
        if( $character->others !== null)
            $price = $price + $character->others->price;
        return $price;
    }

    protected function beforeSave()
    {
        if ( parent::beforeSave() )
        {
            if ( $this->getIsNewRecord() )
            {
                $this->experience = 0; //一開始使用者經驗設為0
                $this->money = 25000; //一開始使用者金錢設為25000
                $this->total_money = 35000; //一開始使用者總金錢設為35000
            }
            return true;
        }
        return false;
    }
}
<?php

class Character extends CActiveRecord
{
    public $exp_level = array(
        array(
            'name'  => '錯誤級',  //原則上不會跑到這
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
            'hair'    => array(  // hair為Item的hair_id row
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

    public static function getAvatar()
    {
        return array(
            '身體皮膚名稱'    => 'skin/7e46ccbac1a2ea2bf59f649ea279ff18.png',
            '眼睛部位名稱'    => 'eyes/7d51284d2cdad516bc348104a1d1805e.png',
            '頭髮髮型名稱'    => 'hair/95728fcabcc6cdeafac6d2bd951804be.png',
            '鞋子物品名稱'    => 'shoes/90f4dfcd8cc45edad70c06997973a4b0.png',
            '褲子部位名稱'    => 'pants/414dcd369e5d60aa94cf80d0f0c49792.png',
            '褲子部位名稱'    => 'pants/414dcd369e5d60aa94cf80d0f0c49792.png',
            '衣服衣物名稱'    => 'cloths/0fed7f93d5460bdbb2014393bd865d28.png',
            '其他部位名稱'    => 'others/045950659588c9aac4708a31966636dc.png'
        );
    }
}
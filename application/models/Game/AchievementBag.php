<?php

class AchievementBag extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{game_achievements_bag}}';
    }

    public function relations()
    {
        return array(
            'translation'    => array(
                self::BELONGS_TO,
                'Achievement',
                'achievement_id'
            )
        );
    }
}
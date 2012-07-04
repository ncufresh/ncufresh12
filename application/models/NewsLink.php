<?php

class NewsLink extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'news_links';
    }

    public function relations()
    {
        return array(
        );
    }
}
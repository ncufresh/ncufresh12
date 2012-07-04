<?php

class NewsFile extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'news_files';
    }

    public function relations()
    {
        return array(
        );
    }
}
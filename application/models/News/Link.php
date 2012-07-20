<?php

class Link extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{news_links}}';
    }

    public function rules()
    {
        return array(
            array('name, link, news_id', 'required'),
            array('link', 'length', 'max' => 500),
            array('name', 'length', 'max' => 100),
            array('news_id', 'numerical', 'integerOnly' => true)
        );
    }

    public function relations()
    {
        return array(
            'news'  => array(
                self::BELONGS_TO,
                'News',
                'news_id'
            )
        );
    }
}
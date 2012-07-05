<?php

class ForumArticle extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'forum_article';
    }

    public function relations()
    {
        return array(
        );
    }
}
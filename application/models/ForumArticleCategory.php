<?php

class ForumArticleCategory extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'forum_article_category';
    }

    public function relations()
    {
        return array(
        );
    }
}
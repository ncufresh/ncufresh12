<?php

class ForumComment extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'forum_comment';
    }

    public function relations()
    {
        return array(
        );
    }
}
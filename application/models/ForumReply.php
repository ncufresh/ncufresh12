<?php

class ForumReply extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'forum_reply';
    }

    public function relations()
    {
        return array(
        );
    }
}
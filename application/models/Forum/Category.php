<?php

class Category extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{forum_categories}}';
    }

    public function relations()
    {
        return array(
            'article_categories' => array(
                self::MANY_MANY,
                'ForumArticleCategory',
                'forum_forum2category(fid, cid)'
            ),
        );
    }

    public function getUrl()
    {
        return Yii::app()->createUrl('forum/forum', array(
            'fid'   => $this->id,
        ));
    }
}
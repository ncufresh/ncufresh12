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
                'ArticleCategory',
                'forum_category_relations(forum_id, category_id)'
            ),
        );
    }

    public function getUrl()
    {
        return Yii::app()->createUrl('forum/forum', array(
            'fid'   => $this->id,
        ));
    }
    
    public function getIsMaster()
    {
        if ( Yii::app()->user->getIsMember() )
        {
            if( (Yii::app()->user->getId() != 0 && $this->master_id == Yii::app()->user->getId()) || Yii::app()->user->getIsAdmin() )
                return true;
            else return false;
        }
        return false;
    }
    
    public function getForumLists()
    {
        return $this->findAll('id != 1 AND id != 2');
    }
}
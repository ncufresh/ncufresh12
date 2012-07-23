<?php

class Article extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{forum_articles}}';
    }

    public function relations()
    {
        return array(
            'forum'     => array(
                self::BELONGS_TO,
                'ArticleCategory',
                'forum_id'
            ),
            'replies'    => array(
                self::HAS_MANY,
                'Reply',
                'article_id',
            ),
        );
    }

    
    public function getArticlesSort($fid, $sort){
        switch ($sort)
        {
            case "create":
                $sort='create_time';
                break;
            case "update":
                $sort='update_time';
                break;
            case "reply":
                $sort='replies_count';
                break;
            default:
                throw new Exception('The sort column name does not exist.');
                break;
        }
        return $this->findAll(array(
            'condition' => "forum_id='$fid' AND visibility=1",
            'order' => "$sort DESC",
        ));
    }
    
    /*
    public function getArticlesByForum($fid)
    {
        $criteria = new CDbCriteria();
        $criteria->condition = "forum_id='$fid' AND visibility=1";
        $criteria->order = 'create_time DESC';
        return $this->findAll($criteria);
    }
    
    public function getArticlesOrderByTime($fid)
    {
    
        //throw new Exception('WHY...');
        return $this->findAll(array(
            'condition' => "forum_id='$fid' AND visibility=1",
            'order' => 'update_time DESC',
        ));
    }
    
    public function getArticlesOrderByReplies($fid)
    {
        return $this->findAll(array(
            'condition' => "forum_id='$fid' AND visibility=1",
            'order' => 'replies_count DESC',
        ));
    }
    */
    

    public function getUrl()
    {
        return Yii::app()->createUrl('forum/view', array(
            'fid'   => $this->forum_id,
            'id'    => $this->id
        ));
    }

    public function beforeSave()
    {
        // 尚未檢查是否所有資料都有填寫
        if ( parent::beforeSave() )
        {
            if ( $this->getIsNewRecord() )
            {
                // 如果未登入author_id=0 ; 檢查登入與否
                $this->author_id = Yii::app()->user->getId();
                $this->create_time = TIMESTAMP;
            }
            $this->update_time = TIMESTAMP;
            return true;
        }
        return false;
    }
}
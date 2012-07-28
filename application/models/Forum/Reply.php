<?php

class Reply extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{forum_replies}}';
    }

    public function relations(){
        return array(
            'article'   => array(
                self::BELONGS_TO,
                'Article',
                'article_id'
            )
        );
    }

    //for popo
    public function getArticleReplies($aid)
    {
        return $this->findAll('article_id='.$aid);
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
            // $this->update_time = TIMESTAMP;
            return true;
        }
        return false;
    }
}
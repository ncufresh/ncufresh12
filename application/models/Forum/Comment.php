<?php

class Comment extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{forum_comments}}';
    }

    public function rules()
    {
        return array(
            array('content, article_id', 'required'),
            array('content', 'length', 'max' => 28),
        );
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
    
    // for popo
    public function getArticleComments($aid)
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
                $this->created = TIMESTAMP;
            }
            //$this->update_time = TIMESTAMP;
            return true;
        }
        return false;
    }
    
    public function afterFind()
    {
        parent::afterFind();
        $this->content = htmlspecialchars($this->content);
        $this->created = Yii::app()->format->datetime($this->created);
    }
}
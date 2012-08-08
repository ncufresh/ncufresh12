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
    
    public function rules()
    {
        return array(
            array('content', 'required'),
            array('content', 'length', 'min' => 20),
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

    //for popo
    public function getArticleReplies($aid)
    {
        return $this->findAll('article_id='.$aid);
    }
    
    public function beforeSave()
    {
        if ( parent::beforeSave() )
        {
            if ( $this->getIsNewRecord() )
            {
                $this->author_id = Yii::app()->user->getId();
                $this->created = TIMESTAMP;
            }
            return true;
        }
        return false;
    }
        
    public function getRepliesNumOfUser($author_id)
    {
        return count($this->findAll('author_id='.$author_id));
    }
    
    public static function getReplies($article_id, $page, $entries_per_page)
    {
        $count = self::model()->count();
        $total_pages = ceil($count / $entries_per_page);
        $current_page = ($page<$total_pages?$page:$total_pages);
        
        return self::model()->findAll(array(
                'condition' => 'article_id = '.$article_id,
                'limit'     => $entries_per_page,
                'offset'    => ($current_page - 1) * $entries_per_page
        ));
    }
    
    public static function getPageStatus($page, $entries_per_page=10, $aid)
    {
        $pages = ceil(self::model()->count('article_id= '.$aid) / $entries_per_page);

        return array(
            'pages'         => $pages,
            'current'       => $page,
            'first'         => 1,
            'last'          => $pages
        );
    }
    
    public function afterFind()
    {
        parent::afterFind();
        $this->content = nl2br(htmlspecialchars($this->content));
        //$this->created = Yii::app()->format->datetime($this->created);
    }
    
}
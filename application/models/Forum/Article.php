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
            'category_name'  => array(
                self::BELONGS_TO,
                'ArticleCategory',
                'category',
            ),
        );
    }

    public function getArticlesSort($fid, $sort, $category, $page, $entries_per_page){
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
            case "viewed":
                $sort='viewed_times';
                break;
            default:
                throw new Exception('The sort column name does not exist.');
                break;
        }
        if($category==0){
            $count = $this->count();
            $total_pages = ceil($count / $entries_per_page);
            $current_page = ($page<$total_pages?$page:$total_pages);
            return $this->findAll(array(
                'condition' => 'forum_id='.$fid.' AND visibility=1',
                'order' => "$sort DESC",
                'limit' => $entries_per_page,
                'offset' => ($current_page-1) * $entries_per_page
            ));
        }
        else{
            return $this->findAll(array(
                'condition' => 'forum_id='.$fid.' AND visibility=1 AND category='.$category,
                'order' => "$sort DESC",
            ));
        }
    }

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
    
    public function getPageStatus($current_page, $entries_per_page)
    {
        $total_pages = ceil($this->count('visibility=1') / $entries_per_page);
        if ( $current_page > $total_pages ) $current_page = $total_pages;
        if ( $current_page < 1 ) $current_page = 1;
        $next_page = $current_page == $total_pages ? null : ($current_page + 1);
        $prev_page = $current_page == 1 ? null : ($current_page - 1);
        $first_page = 1;
        $last_page = $total_pages;
        return array(
           'total_pages'     => $total_pages,
           'entries_per_page' => $entries_per_page,
           'current_page'    => $current_page,
           'next_page'       => $next_page,
           'prev_page'       => $prev_page,
           'first_page'      => $first_page,
           'last_page'       => $last_page
        );
    }
}
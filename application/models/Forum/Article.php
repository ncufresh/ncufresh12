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

    public function behaviors()
    {
        return array(
            'RawDataBehavior'
        );
    }
    
    public function rules()
    {
        return array(
            array('forum_id, category_id, title, content', 'required'),
            array('forum_id, category_id', 'numerical'),
            array('title', 'length', 'min' => 1, 'max' => 30),
            array('content', 'length', 'min' => 20),
        );
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
            'comments'    => array(
                self::HAS_MANY,
                'Comment',
                'article_id',
            ),
            'category_name'  => array(
                self::BELONGS_TO,
                'ArticleCategory',
                'category_id',
            ),
        );
    }
    
    // for popo
    public function getUserArticles($author_id){
        //return $this->findAll('author_id='.$author_id.' AND invisible = 0');
        return $this->findAll(array(
            'condition' => 'author_id= :author_id AND invisible = 0',
            'params'    => array(
                ':author_id'    => $author_id
            )
        ));
    }
    
    public static function getArticlesSort($fid, $sort, $category, $page, $entries_per_page){
        
        switch ($sort)
        {
            case 'create':
                $sort = 'created';
                break;
            case 'update':
                $sort = 'updated';
                break;
            case 'reply':
                $sort = 'replies_count';
                break;
            case 'viewed':
                $sort = 'viewed';
                break;
            default:
                throw new Exception('The sort column name does not exist.');
                break;
        }
        $count = self::model()->count();
        $total_pages = ceil($count / $entries_per_page);
        $current_page = ($page<$total_pages?$page:$total_pages);
        
        if ( $category == 0 )
        {
            return self::model()->findAll(array(
                'condition' => 'forum_id= :forum_id AND invisible=0 AND sticky=0',
                'order'     => $sort . ' DESC',
                'limit'     => $entries_per_page,
                'offset'    => ($current_page - 1) * $entries_per_page,
                'params'    => array(
                    ':forum_id' => $fid
                )
            ));
        }
        
        else
        {
            return self::model()->findAll(array(
                'condition' => 'forum_id = :forum_id AND invisible = 0 AND sticky=0 AND category_id = :category',
                'order'     => $sort . ' DESC',
                'limit'     => $entries_per_page,
                'offset'    => ($current_page - 1) * $entries_per_page,
                'params'    => array(
                    ':forum_id' => $fid,
                    ':category' => $category
                )
            ));
        }
    }
    
    public function getLastestArticles($num)
    {
        $articles = $this->findAll(array(
            'condition' => 'invisible=0 AND forum_id=1',
            'order'     => 'created DESC',
            'limit'     => $num
        ));
        foreach ( $articles as $each )
        {
            $each->created = Yii::app()->format->date($each->getRawValue('created'));
        }
        return $articles;
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
                $this->created = TIMESTAMP;
                $this->updated = TIMESTAMP;
                $this->invisible = 0;
                if($this->sticky==1)
                {
                    if ( Category::Model()->getIsMaster()==false ) return false;
                }
                if ( $this->category_id == 12 )
                {
                    if ( Yii::app()->user->getIsAdmin() == false ) return false;
                }
            }
            else
            {
                $this->title = $this->getRawValue('title');
                $this->content = $this->getRawValue('content');
                $this->created = $this->getRawValue('created');
            }
            //[not yet] 判斷$fid 跟 category 對應
            return true;
        }
        return false;
    }
        
    public static function getPageStatus($page, $entries_per_page=10, $fid, $category)
    {
        if($category==0)
            $pages = ceil(self::model()->count(array(
                'condition' => 'forum_id= :forum_id AND invisible = 0', 
                'params' => array(
                    ':forum_id' => $fid)
                )) / $entries_per_page);
        else
            $pages = ceil(self::model()->count(array(
                'condition' => 'forum_id= :forum_id AND invisible = 0 AND category_id=:category_id',
                'params'    => array(
                    ':forum_id'     => $fid,
                    ':category_id'  => $category
                )
            )) / $entries_per_page);

        return array(
            'pages'         => $pages,
            'current'       => $page,
            'first'         => 1,
            'last'          => $pages
        );
    }
    
    public function getArticlesNumOfUser($author_id)
    {
        //return count($this->findAll('author_id='.$author_id.' AND invisible=0'));
        return count($this->findAll(array(
            'condition' =>  'author_id = :author_id AND invisible = 0',
            'params'    => array(
                ':author_id'    => $author_id
            )
        )));
    }
    
    public function afterFind()
    {
        parent::afterFind();
        $this->title = htmlspecialchars($this->title);
        $this->content = nl2br(htmlspecialchars($this->content));
        $this->created = Yii::app()->format->datetime($this->created);
        // for old articles, if the articles has replies, put the latest reply created time into updated
        if( $this->updated == 0 )
        {
            if(Reply::model()->find(array(
                'condition' =>  'article_id = :article_id',
                'params'    =>  array(
                    ':article_id'   =>  $this->id
                )
            )))
            {
                $this->updated = Reply::model()->find(array(
                        'condition' => 'article_id = :article_id',
                        'order'     => 'created DESC',
                        'params'     => array(
                            ':article_id'   =>  $this->id
                        )))->created;
            }
            else
            {
                $this->updated = $this->getRawValue('created');
            }
        }
    }
    
    public function getStickyArticle($fid)
    {
        //return $this->findAll('forum_id='.$fid.' AND sticky=1 AND invisible=0');
        return $this->findAll(array(
            'condition' =>  'forum_id= :forum_id AND sticky= 1 AND invisible= 0',
            'params'    =>  array(
                ':forum_id'     => $fid
            )
        ));
    }
    
    public function checkCategoryIDtoForumID($fid, $category_id)
    {
        $check = false;
        foreach( Category::model()->findByPk((integer)$fid)->article_categories as $each)
        {
            if( $each->id == $category_id ) 
            {
                $check = true;
                break;
            }
        }
        return $check;
    }
}
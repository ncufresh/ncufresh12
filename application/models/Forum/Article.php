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
    
    // for popo
    public function getUserArticles($author_id){
        return $this->findAll('author_id='.$author_id.' AND visibility=1');
    }
    
    public function getArticlesSort($fid, $sort, $category, $page, $entries_per_page){
        
        switch ($sort)
        {
            case 'create':
                $sort = 'create_time';
                break;
            case 'update':
                $sort = 'update_time';
                break;
            case 'reply':
                $sort = 'replies_count';
                break;
            case 'viewed':
                $sort = 'viewed_times';
                break;
            default:
                throw new Exception('The sort column name does not exist.');
                break;
        }
        
        $count = $this->count();
        $total_pages = ceil($count / $entries_per_page);
        $current_page = ($page<$total_pages?$page:$total_pages);
        
        if ( $category == 0 )
        {
            return $this->findAll(array(
                'condition' => 'forum_id='.$fid.' AND visibility=1',
                'order'     => $sort . ' DESC',
                'limit'     => $entries_per_page,
                'offset'    => ($current_page - 1) * $entries_per_page
            ));
        }
        
        else
        {
            return $this->findAll(array(
                'condition' => 'forum_id = ' . $fid . ' AND visibility = 1 AND category = ' . $category,
                'order'     => $sort . ' DESC',
                'limit'     => $entries_per_page,
                'offset'    => ($current_page - 1) * $entries_per_page
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
        // �|���ˬd�O�_�Ҧ���Ƴ�����g
        if ( parent::beforeSave() )
        {
            if ( $this->getIsNewRecord() )
            {
                // �p�G���n�Jauthor_id=0 ; �ˬd�n�J�P�_
                $this->author_id = Yii::app()->user->getId();
                $this->create_time = TIMESTAMP;
            }
            $this->update_time = TIMESTAMP;
            //[not yet] �P�_$fid �� category ����
            return true;
        }
        return false;
    }
    
    public function getPageStatus($page, $entries_per_page=10, $fid, $category)
    {
        if($category==0)
            $pages = ceil($this->count('forum_id= '.$fid.' AND visibility = 1') / $entries_per_page);
        else
            $pages = ceil($this->count('forum_id= '.$fid.' AND visibility = 1 AND category='.$category) / $entries_per_page);

        return array(
            'pages'         => $pages,
            'current'       => $page,
            'first'         => 1,
            'last'          => $pages
        );
    }
}
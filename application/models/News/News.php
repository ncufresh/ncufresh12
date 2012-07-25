<?php

class News extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{news}}';
    }

    public function rules()
    {
        return array(
            array('title, content', 'required')
        );
    }

    public function behaviors()
    {
        return array(
            'RawDataBehavior'
        );
    }

    public function relations()
    {
        return array(
            'urls'      => array(
                self::HAS_MANY,
                'Link',
                'news_id'
            ),
            'author'    => array(
                self::BELONGS_TO,
                'User',
                'author_id'
            )
        );
    }

    public function getPopularNews($num)
    {
        $news = $this->getPage(1, $num, true);
        foreach ( $news as $entry )
        {
            $entry->updated = Yii::app()->format->date($entry->getRawValue('updated'));
            $entry->created = Yii::app()->format->date($entry->getRawValue('created'));
        }
        return $news;
    }

    public function getPage($page, $entries_per_page, $desc = false)
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'invisible=0';
        $criteria->limit = $entries_per_page;
        if ( $desc )
        {
            $criteria->order = 'updated DESC';
        }
        else
        {
            $criteria->order = 'updated ASC';
        }
        $count = $this->count();
        $total_pages = ceil($count / $entries_per_page);
        $current_page = ($page<$total_pages?$page:$total_pages);
        $criteria->offset = ($current_page-1) * $entries_per_page;
        return $this->findAll($criteria);
    }

    public function getPageStatus($page, $entries_per_page)
    {
        $pages = ceil($this->count('invisible = 0') / $entries_per_page);
        return array(
           'pages'          => $pages,
           'current'        => $page,
           'first'          => 1,
           'last'           => $pages
        );
    }

    public function getCurrentPage( $entries_per_page, $desc = false )
    {
        if ( $desc )
        {
            return ceil( $this->count('updated >= ' . $this->getRawValue('updated') . ' AND invisible=0') / $entries_per_page );
        }
        else
        {
            return ceil( $this->count('updated <= ' . $this->getRawValue('updated') . ' AND invisible=0') / $entries_per_page );
        }
    }

    public function getUrl()
    {
        return Yii::app()->createUrl('news/view', array(
            'id'        => $this->id,
            'title'     => $this->title,
        ));
    }

    public function hide()
    {
        $this->invisible = 1;
        return $this->save();
    }

    public function beforeSave()
    {
        if ( parent::beforeSave() )
        {
            if ( $this->isNewRecord )
            {
                $this->author_id = Yii::app()->user->getId();
                $this->created = TIMESTAMP;
            }
            $this->updated = TIMESTAMP;
            return true;
        }
        return false;
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->created = Yii::app()->format->datetime($this->created);
        $this->updated = Yii::app()->format->datetime($this->updated);
    }
}
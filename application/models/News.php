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
			array('title, content', 'required'),
		);
	}
	
    public function behaviors()
    {
        return array(
            'RawDataBehavior',
        );
    }
    
    public function relations()
    {
        return array(
			'urls' => array(self::HAS_MANY, 'NewsLink', 'news_id'),
			'author' => array(self::BELONGS_TO, 'User', 'author_id'),
        );
    }

    public function getPopularNews($num)
    {
        $news = $this->getPage(1,$num,true);
        foreach($news as $each)
        {
            $each->updated = Yii::app()->format->date($each->getRawValue('updated'));
            $each->created = Yii::app()->format->date($each->getRawValue('created'));
        }
        return $news;
    }
    
    public function getPage($page, $entriesPerPage, $desc = false)
    {
        $criteria = new CDbCriteria();
		$criteria->condition = 'invisible=0';
        $criteria->limit = $entriesPerPage;
		if( $desc )
			$criteria->order = 'updated DESC';
		else
			$criteria->order = 'updated ASC';
        $count = $this->count();
        $totalPages = ceil($count / $entriesPerPage);
        $currentPage = ($page<$totalPages?$page:$totalPages);
        $criteria->offset = ($currentPage-1) * $entriesPerPage;
        return $this->findAll($criteria);
    }

    public function getPageStatus($currentPage, $entriesPerPage)
    {
        $totalPages = ceil($this->count('invisible=0') / $entriesPerPage);
        if($currentPage > $totalPages) $currentPage = $totalPages;
        if($currentPage < 1) $currentPage = 1;
        $nextPage = $currentPage==$totalPages?null:($currentPage+1);
        $prevPage = $currentPage==1?null:($currentPage-1);
        $firstPage = 1;
        $lastPage = $totalPages;
        return array(
           'totalPages' => $totalPages,
           'entriesPerPage' => $entriesPerPage,
           'currentPage' => $currentPage,
           'nextPage' => $nextPage,
           'prevPage' => $prevPage,
           'firstPage' => $firstPage,
           'lastPage' => $lastPage,
        );
    }

    public function getCurrentPage( $entriesPerPage, $desc = false )
    {
		if( $desc )
			return ceil( $this->count('updated >= ' . $this->getRawValue('updated') . ' AND invisible=0')/$entriesPerPage );
		else
			return ceil( $this->count('updated <= ' . $this->getRawValue('updated') . ' AND invisible=0')/$entriesPerPage );
    }

    public function getUrl()
    {
        return Yii::app()->createUrl('news/view', array(
            'id'=>$this->id,
            'title'=>$this->title,
        ));
    }
    
	public function hide()
	{
		$this->invisible = 1;
		return $this->save();
	}
	
    public function beforeSave()
    {
        if(parent::beforeSave())
        {
			if( $this->isNewRecord )
			{
				$this->author_id = Yii::app()->user->id;
				$this->created = TIMESTAMP;
			}
            $this->updated = TIMESTAMP;
            return true;
        }
        else
            return false;
        
    }
    
    public function afterFind()
    {
        parent::afterFind();
        $this->created = Yii::app()->format->datetime($this->created);
        $this->updated = Yii::app()->format->datetime($this->updated);
    }
}
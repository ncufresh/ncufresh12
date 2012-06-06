<?php

class News extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
    
    public function tableName()
    {
        return 'news';
    }
    
    public function relations()
    {
        return array(
        );
    }

    
    public function getPage($page = 1, $entriesPerPage = 5)
    {
        $criteria = new CDbCriteria();
        $criteria->limit = $entriesPerPage;
        $count = $this->count();
        $totalPages = ceil($count / $entriesPerPage);
        $currentPage = ($page<$totalPages?$page:$totalPages);
        $criteria->offset = ($currentPage-1) * $entriesPerPage;
        return $this->findAll($criteria);
    }
    
    public function getPageStatus($currentPage = 1, $entriesPerPage = 5)
    {
        $totalPages = ceil($this->count() / $entriesPerPage);
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
    
    public function getCurrentPage($entriesPerPage)
    {
        return ceil($this->count('id <= ' . $this->id)/$entriesPerPage);
    }
    
    public function getUrl()
    {
        return Yii::app()->createUrl('news/view', array(
            'id'=>$this->id,
            'title'=>$this->title,
        ));
    }
    
}
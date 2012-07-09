<?php

class ForumArticle extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'forum_article';
    }

    public function relations()
    {
        return array(
        );
    }
	
	public function getUrl()
	{
		return Yii::app()->createUrl('forum/view', array(
            'fid'=>$this->forum_id,
			'id'=>$this->id,
            'title'=>$this->title,
        ));
	}
	
	public function beforeSave()
    {
        if(parent::beforeSave())
        {
			if( $this->isNewRecord )
			{
				//如果未登入author_id=0 ; 檢查登入與否
				$this->author_id = Yii::app()->user->getId();
				$this->create_time = TIMESTAMP;
			}
            $this->update_time = TIMESTAMP;
            return true;
        }
        else
            return false;
        
    }
}
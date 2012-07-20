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

    public function getUrl()
    {
        return Yii::app()->createUrl('forum/view', array(
            'fid'   => $this->forum_id,
            'id'    => $this->id
        ));
    }

    public function beforeSave()
    {
        //�|���ˬd�O�_�Ҧ���Ƴ�����g
        if ( parent::beforeSave() )
        {
            if ( $this->isNewRecord )
            {
                // �p�G���n�Jauthor_id=0 ; �ˬd�n�J�P�_
                $this->author_id = Yii::app()->user->getId();
                $this->create_time = TIMESTAMP;
            }
            $this->update_time = TIMESTAMP;
            return true;
        }
        return false;
    }
}
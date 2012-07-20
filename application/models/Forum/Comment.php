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

    public function relations(){
        return array(
            'article'   => array(
                self::BELONGS_TO,
                'Article',
                'article_id'
            )
        );
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
            //$this->update_time = TIMESTAMP;
            return true;
        }
        return false;
    }
}
<?php

class Marquee extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'marquees';
    }

    public function rules()
    {
        return array(
            array('message', 'required'),
            array('message', 'length', 'min' => 2, 'max' => 40),
            array('invisible', 'boolean')
        );
    }

    public function getMarquees($count = 5)
    {
        return $this->findAll(array(
            'limit'     => $count,
            'order'     => 'updated DESC',
            'condition' => 'invisible = FALSE'
        ));
    }

    protected function afterFind()
    {
        if ( parent::afterFind() )
        {
            $this->message = Yii::app()->format->formatText($this->message);
            $this->created = Yii::app()->format->datetime($this->created);
            $this->updated = Yii::app()->format->datetime($this->updated);
            $this->invisible = $this->invisible ? true : false;
            return true;
        }
        return false;
    }

    protected function beforeSave()
    {
        if ( parent::beforeSave() )
        {
            if ( $this->getIsNewRecord() )
            {
                $this->created = TIMESTAMP;
                $this->invisible = false;
            }
            $this->updated = TIMESTAMP;
            return true;
        }
        return false;
    }
}
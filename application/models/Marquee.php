<?php

class Marquee extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{marquees}}';
    }

    public function rules()
    {
        return array(
            array('message', 'required'),
            array('message', 'length', 'min' => 2, 'max' => 40),
            array('invisible', 'boolean')
        );
    }

    public function behaviors()
    {
        return array(
            'RawDataBehavior'
        );
    }

    public function getMarquees()
    {
        return $this->findAll(array(
            'limit'     => 5,
            'order'     => 'updated DESC',
            'condition' => 'invisible = FALSE'
        ));
    }

    public function deleteMarquee()
    {
        return $this->updateByPk($this->id, array(
            'invisible' => true
        ));
    }

    protected function afterFind()
    {
        parent::afterFind();
        $this->message = Yii::app()->format->formatText($this->message);
        $this->created = Yii::app()->format->datetime($this->created);
        $this->updated = Yii::app()->format->datetime($this->updated);
        $this->invisible = $this->invisible ? true : false;
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
            else
            {
                $this->created = $this->getRawValue('created');
            }
            $this->updated = TIMESTAMP;
            return true;
        }
        return false;
    }

    protected function afterSave()
    {
        parent::afterSave();

        $counter = 0;
        $data = $this->findAll(array(
            'order'     => 'updated DESC',
            'condition' => 'invisible = FALSE'
        ));

        foreach ( $data as $entry )
        {
            if ( $counter++ < 5 ) continue;
            $entry->invisible = true;
            $entry->save();
        }
    }
}
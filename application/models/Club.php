<?php
class Club extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{clubs}}';
    }

    public function getClub($clubid)
    {
        return $this->findByPk($clubid);
    }
}

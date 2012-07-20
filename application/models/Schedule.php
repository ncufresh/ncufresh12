<?php 
class Schedule extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{schedule}}';
    }

    public function getId($row)
    {
        return $this->findByPk($row);
    }
}
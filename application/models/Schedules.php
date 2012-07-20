<?php 
class Schedules extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{schedules}}';
    }

    public function getId($row)
    {
        return $this->findByPk($row);
    }
}
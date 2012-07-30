<?php

class Mission extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{game_missions}}';
    }
    
    public function getMissions($number)
    {
        return $this->findAll(array(
            'condition' => 'id <= :id',
            'params'    => array(
                ':id' => $number+1
            )
        ));
    }
}
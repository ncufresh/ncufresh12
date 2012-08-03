<?php

class Item extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{game_items}}';
    }
    
    public function getBuyItems($level, $category)
    {
        return $this->findAll(array(
            'condition' => 'level <= :level AND category = :category',
            'order'     => 'price ASC',
            'order'     => 'level ASC',
            'params'    => array(
                ':level' => $level,
                ':category' => $category
            )
        ));
    }
}
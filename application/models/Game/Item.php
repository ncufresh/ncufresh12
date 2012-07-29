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
    
    public function getBuyItems($level, $items_category)
    {
        return $this->findAll(array(
            'condition' => 'level <= :level AND items_category = :items_category',
            'order'     => 'price ASC',
            'params'    => array(
                ':level' => $level,
                ':items_category' => $items_category
            )
        ));
    }
}
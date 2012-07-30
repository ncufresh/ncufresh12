<?php

class ItemBag extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{game_items_bag}}';
    }

    public function relations()
    {
        return array(
            'translation'    => array(
                self::BELONGS_TO,
                'Item',
                'item_id'
            )
        );
    }
    
    public function buyNewItem($item_id)
    {
        $item_data = Item::model()->findByPk($item_id);
        $item = new ItemBag(); //ItemBag Model
        $item->user_id = Yii::app()->user->getId(); //�P�B�g�Juser��id�ܹD��C��
        $item->item_id = $item_data->id; //�g�J��o�D�㪺id
        $item->equip = 0; //�g�J�˳ƪ��A
        $item->acquire_time = TIMESTAMP; //�g�J��o�ɶ�
        $item->save();
        Character::model()->addMoney(5000);
    }
}
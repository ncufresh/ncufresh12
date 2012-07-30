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
        $item->user_id = Yii::app()->user->getId(); //同步寫入user的id至道具列表
        $item->item_id = $item_data->id; //寫入獲得道具的id
        $item->equip = 0; //寫入裝備狀態
        $item->acquire_time = TIMESTAMP; //寫入獲得時間
        $item->save();
        Character::model()->addMoney(5000);
    }
}
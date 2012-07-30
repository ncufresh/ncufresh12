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
        $user_id = Yii::app()->user->getId();
        $character = Character::model()->findByPk($user_id);
        $user_money = $character->money;
        $user_level = $character->getLevel($user_id);
        $item_data = Item::model()->findByPk($item_id);
        $item_price = $item_data->price;
        $item_level = $item_data->level;
        $item_exist = $this->findAll(array(
            'condition' => 'user_id = :user_id AND item_id = :item_id',
            'params'    => array(
                ':user_id' => $user_id,
                ':item_id' => $item_id)
            ));
        //print_r($item_exist);
        if($user_money >= $item_price)
        {
            if($user_level >= $item_level)
            {
                if($item_exist == null)
                {
                    $item = new ItemBag(); //ItemBag Model
                    $item->user_id = $user_id; //同步寫入user的id至道具列表
                    $item->item_id = $item_data->id; //寫入獲得道具的id
                    $item->equip = 0; //寫入裝備狀態
                    $item->acquire_time = TIMESTAMP; //寫入獲得時間
                    if ($item->save() && Character::model()->findByPk($user_id)->addMoney(0-($item_data->price)))
                    return 0;
                    else
                    return 4;
                }
                else
                return 3;
            }
            else
            return 2;
        }
        else
        return 1;

    }
}
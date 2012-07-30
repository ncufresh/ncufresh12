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
                    $item->user_id = $user_id; //�P�B�g�Juser��id�ܹD��C��
                    $item->item_id = $item_data->id; //�g�J��o�D�㪺id
                    $item->equip = 0; //�g�J�˳ƪ��A
                    $item->acquire_time = TIMESTAMP; //�g�J��o�ɶ�
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
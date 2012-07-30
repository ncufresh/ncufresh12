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
                    $item->equipped = 0; //寫入裝備狀態
                    $item->created = TIMESTAMP; //寫入獲得時間
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
    public function equipItem($item_id)
    {
        $user_id = Yii::app()->user->getId();
        $character_data = Character::model()->findByPk($user_id);
        $item_data = Item::model()->findByPk($item_id);
        $item_exist = $this->findAll(array(
            'condition' => 'user_id = :user_id AND item_id = :item_id',
            'params'    => array(
                ':user_id' => $user_id,
                ':item_id' => $item_id)
            ));
        if($item_exist != null)
        {
            $which_to_equip = $item_exist[0]->id; //欲裝備物品在清單的位置
            $equip_status = $item_exist[0]->equipped; //欲裝備物品的裝備狀態
            $item_category = $item_exist[0]->translation->category; //欲裝備物品的物品分類
            
            $character_current_item_id = 0; // 檢查是否有穿裝備用
            
            if($item_category == 1 && $character_data->hair != null)    //穿裝備前先檢查有沒有穿
                $character_current_item_id = $character_data->hair->id;
            else if($item_category == 2 && $character_data->eyes != null)
                $character_current_item_id = $character_data->eyes->id;
            else if($item_category == 3 && $character_data->clothes != null)
                $character_current_item_id = $character_data->clothes->id;
            else if($item_category == 4 && $character_data->pants != null)
                $character_current_item_id = $character_data->pants->id;
            else if($item_category == 5 && $character_data->shoes != null)
                $character_current_item_id = $character_data->shoes->id;
            else if($item_category == 6 && $character_data->skin != null)
                $character_current_item_id = $character_data->skin->id;
            else if($item_category == 7 && $character_data->skin != null)
                $character_current_item_id = $character_data->others->id;
                
            if($character_current_item_id != 0) //原本有穿裝備才會到這
            {
                $other_item_equip = $this->findAll(array(
                'condition' => 'user_id = :user_id AND item_id = :item_id',
                'params'    => array(
                ':user_id' => $user_id,
                ':item_id' => $character_current_item_id)
                ));
                $take_off = new ItemBag();
                $item_to_take_off = $take_off->findByPk($other_item_equip[0]->id);
                $item_to_take_off->equipped = 0;
                $item_to_take_off->save();
            }
            
            $modify = new ItemBag();
            $item_to_equip = $modify->findByPk($which_to_equip);
            if($equip_status == 0)
                $item_to_equip->equipped = 1; //未裝備狀態改成已經裝備
            else
                $item_to_equip->equipped = 0; //已裝備狀態改成未裝備
            $item_to_equip->save();
            echo $item_category;
            
            
            $change = new Character();
            $character_to_equip = $change->findByPk($user_id);
            if($equip_status == 0)
            {
                if($item_category == 1)
                    $character_to_equip->hair_id = $item_exist[0]->item_id;
                else if($item_category == 2)
                    $character_to_equip->eyes_id = $item_exist[0]->item_id;
                else if($item_category == 3)
                    $character_to_equip->clothes_id = $item_exist[0]->item_id;
                else if($item_category == 4)
                    $character_to_equip->pants_id = $item_exist[0]->item_id;
                else if($item_category == 5)
                    $character_to_equip->shoes_id = $item_exist[0]->item_id;
                else if($item_category == 6)
                    $character_to_equip->skin_id = $item_exist[0]->item_id;
                else
                    $character_to_equip->others_id = $item_exist[0]->item_id;
            }
            else
            {
                if($item_category == 1)
                    $character_to_equip->hair_id = 0;
                else if($item_category == 2)
                    $character_to_equip->eyes_id = 0;
                else if($item_category == 3)
                    $character_to_equip->clothes_id = 0;
                else if($item_category == 4)
                    $character_to_equip->pants_id = 0;
                else if($item_category == 5)
                    $character_to_equip->shoes_id = 0;
                else if($item_category == 6)
                    $character_to_equip->skin_id = $character_to_equip->skin_id;
                else
                    $character_to_equip->others_id = 0;
            }
            $character_to_equip->save();
            return true;
        }
        else
        return false; //找不到此物品 無法裝備

    }
}
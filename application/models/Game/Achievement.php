<?php

class Achievement extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{game_achievements}}';
    }

    public function relations()
    {
        return array(
            'profile'    => array(
                self::BELONGS_TO,
                'Profile',
                'id'
            )
        );
    }
    
    public function getAchievementsByUserId($id)
    {
        $user_value = array(
            'login_times' => 24,
            'spend_money' => 234324234,
            'total_money' => 13333,
            'friend' => 23,
            'reply' => 10,
            'post' => 15,
            'cloth' => 15,
            'throw_other_garbage' => 37,
            'clean_self_garbage' => 32,
            'other_throw_garbage' => 123,
            'clean_other_garbage' => 21,
            'body_price' => 51
            );
        $user_login_times = $user_value['login_times'];
        $user_spend_money = $user_value['spend_money'];
        $user_total_money = $user_value['total_money'];
        $user_friend = $user_value['friend'];
        $user_reply = $user_value['reply'];
        $user_post = $user_value['post'];
        $user_cloth = $user_value['cloth'];
        $user_throw_other_garbage = $user_value['throw_other_garbage'];
        $user_clean_self_garbage = $user_value['clean_self_garbage'];
        $user_other_throw_garbage = $user_value['other_throw_garbage'];
        $usre_clean_other_garbage = $user_value['clean_other_garbage'];
        $user_body_price = $user_value['body_price'];
        
        // $character = Character::model()->findByPk($id);
        $achievements = Achievement::model()->findAll();
        $return = array();
        foreach($achievements as $achievement)
        {
            if( $user_login_times >= $achievement->login_times &&
                $user_spend_money >= $achievement->spend_money &&
                $user_total_money >= $achievement->total_money &&
                $user_friend >= $achievement->friend &&
                $user_reply >= $achievement->reply &&
                $user_post >= $achievement->post &&
                $user_cloth >= $achievement->cloth &&
                $user_body_price >= $achievement->body_price )
            {
                $return[] = array('name' => $achievement->name, 'description' => $achievement->description);
                // echo $achievement->name.'=>'.$achievement->description.'</br>';
            }
        }
        return $return;
    } 
   
}
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
        Yii::import('application.models.Forum.*');
        $character_data = Character::model()->findByPk($id); //傳入id 查詢使用者遊戲腳色資料
        $user_data = User::model()->findByPk($id); //傳入id 查詢使用者資料
        $profile_data = Profile::model()->findByPk($id); //傳入id 查詢使用者資料
        $level = Character::model()->getLevel($id); //傳入id 查詢等級
        $level_exp = Character::model()->getLevelExp($level); //傳入等級 查詢等級經驗
        $user_friend = Friend::model()->getAmount($id);
        $nickname = $profile_data->nickname;
        $user_login_times = $user_data->online_count; // $user_value['login_times'];
        $user_spend_money = $character_data->total_money - $character_data->money;
        $user_total_money = $character_data->total_money;
        $user_reply = Reply::model()->getRepliesNumOfUser($id);
        $user_post = Article::model()->getArticlesNumOfUser($id);
        $user_cloth = ItemBag::model()->getClothesNum($id);
        $user_body_price = $character_data->getBodyPrice($id);
        $achievements = Achievement::model()->findAll();
        // echo 'user_login_times => '.$user_login_times.',  ';
        // echo 'user_spend_money => '.$user_spend_money.',  ';
        // echo 'user_total_money => '.$user_total_money.',  ';
        // echo 'user_friend => '.$user_friend.',  ';
        // echo 'user_reply => '.$user_reply.',  ';
        // echo 'user_post => '.$user_post.',  ';
        // echo 'user_cloth => '.$user_cloth.',  ';
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
                $return[] = array('name' => $achievement->name, 'description' => $achievement->description, 'get' => true);
            else
                $return[] = array('name' => $achievement->name, 'description' => $achievement->description, 'get' => false);
        }
        return $return;
    } 
   
}
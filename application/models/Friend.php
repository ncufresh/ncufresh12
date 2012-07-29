<?php

class Friend extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{friends}}';
    }

    public function rules()
    {
        return array(
            array('user_id, friend_id', 'required')
        );
    }

    public function relations()
    {
        return array(
            'profile'  => array(
                self::BELONGS_TO,
                'Profile',
                'friend_id'
            ) 
        );
    }
    
    /*public function isFriend($userid,$friendid) //刪除好友...把自己的invisible變1
    {
        $userid = (integer)$userid;
        $friendid = (integer)$friendid;  
        $this->updateAll(array(
            'invisible' => 1
        ), "user_id = :userid AND friend_id = :friendid OR user_id = :friendid AND friend_id = :userid", array(
            ':userid' => $userid,
            ':friendid' => $friendid
        ));
    }*/
    public function isExist($userid,$friendid)
    {
        $data = $this->find(array(
            'condition' => 'user_id = :userid AND friend_id = :friendid',
            'params'    => array(
                ':userid' => $userid,
                ':friendid' => $friendid
            )
        ));
        if ( $data )
        {
            return true;
        }
        return false;
    }

    public function deleteFriend($userid,$friendid) //刪除好友關係
    {
        $userid = (integer)$userid;
        $friendid = (integer)$friendid;  
        $this->deleteAll(array(
            'condition' => 'user_id = :userid AND friend_id = :friendid OR user_id = :friendid AND friend_id = :userid',
            'params'    => array(
                ':userid' => $userid,
                ':friendid' => $friendid
            )
        ));
    }
    
    public function makeFriend($userid,$friendid) //當兩筆資料都存在
    {
        $userid = (integer)$userid;
        $friendid = (integer)$friendid;  
        $data = $this->findAll(array(
            'condition' => 'user_id = :userid AND friend_id = :friendid OR user_id = :friendid AND friend_id = :userid',
            'params'    => array(
                ':userid' => $userid,
                ':friendid' => $friendid
            )
        ));
        if ( count($data) === 2 )
        {
            $this->updateAll(array(
                'invisible' => 0
            ), "user_id = :userid AND friend_id = :friendid OR user_id = :friendid AND friend_id = :userid", array(
                ':userid' => $userid,
                ':friendid' => $friendid
            ));
        }
    }

    public function addFriend($user_id, $friend_id)// 一次新增一筆資料
    {
        $model = new Friend();
        $model->user_id = $user_id;
        $model->friend_id = $friend_id;
        $save = $model->save();
    }

    public function Request($userid) //好友確認
    {
        return  $this->findAll(array(
                    'condition' => 'friend_id = :userid AND invisible = 1',
                    'params'    => array(
                        ':userid' => $userid,
                        ':friendid' => $friendid
                    )
                ));
    }

}
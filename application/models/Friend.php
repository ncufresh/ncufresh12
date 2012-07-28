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
    
    public function closeFriend($userid,$friendid)
    {
        $userid = (integer)$userid;
        $friendid = (integer)$friendid;  
        $temp = $this->updateAll(array(
            'invisible' => 1
        ), "user_id = :userid AND friend_id = :friendid OR user_id = :friendid AND friend_id = :userid", array(
            ':userid' => $userid,
            ':friendid' => $friendid
        ));
        if ( $temp == 2 )
        {
            return true;
        }
        return false;
    }

    public function openFriend($userid,$friendid)
    {
        $userid = (integer)$userid;
        $friendid = (integer)$friendid;  
        $temp = $this->updateAll(array(
            'invisible' => 0
        ), "user_id = :userid AND friend_id = :friendid OR user_id = :friendid AND friend_id = :userid", array(
            ':userid' => $userid,
            ':friendid' => $friendid
        ));
        /*if ( $temp == 2 )
        {
            return true;
        }*/
        return $temp;
    }

    public function isExist($userid,$friendid) //一次兩筆資料
    {
        $data1 = $this->find(array(
            'condition' => 'user_id = :userid AND friend_id = :friendid',
            'params'    => array(
                ':userid' => $userid,
                ':friendid' => $friendid
            )
        ));
        $data2 = $this->find(array(
            'condition' => 'user_id = :userid AND friend_id = :friendid',
            'params'    => array(
                ':userid' => $friendid,
                ':friendid' => $userid
            )
        ));
        if ( isset($data1) && isset($data2) )
        {
            return true;
        }
        return false;
    }

    public function addFriend($user_id, $friend_id)
    {
        $makefriend = false;
        $model = new Friend();
        $model->user_id = $user_id;
        $model->friend_id = $friend_id;
        $save1 = $model->save();
        if ( isset($save1) )
        {
            $model = new Friend();
            $model->user_id = $friend_id;
            $model->friend_id = $user_id;
            $save2 = $model->save();
            if ( isset($save2) )
            {
                $makefriend = true;
            }
        }
        return $makefriend;
    }

}
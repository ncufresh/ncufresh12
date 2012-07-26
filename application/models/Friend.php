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

    public function deleteFriend($userid,$friendid)
    {
        return $this->updateByPk($this->id, array(
            'invisible' => 1
        ));
    }

    public function addFriend($userid,$friendid)
    {
        return $this->updateByPk($this->id, array(
            'invisible' => 0
        ));
    }

    public function isExist($userid,$friendid) //一次兩筆資料
    {
        $user1 = $this->find(array(
            'condition' => 'user_id = :id1 AND friend_id = id2',
            'params'    => array(
                ':id1' => $userid,
                ':id2' => $friendid
            )
        ));
        $user2 = $this->find(array(
            'condition' => 'user_id = :id1 AND friend_id = id2',
            'params'    => array(
                ':id1' => $friendid,
                ':id2' => $userid
            )
        ));
        if ( isset($user1) && isset($user2) )
        {
            return true;
        }
        return false;
    }
    
    public function FriendExist($userid, $friendid)
    {
        $_exist = false;
        $data = $this->find(array(
            'condition' => 'friend_id = :friendid AND user_id = :userid',
            'params'    => array(
                ':friendid' => $friendid,
                ':userid'   => $userid
            )
        ));
        if ( isset($data) )
        {
            $_exist = true;
        }
        return $_exist;
    }

    public function MakeFriend($user_id, $friend_id)
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
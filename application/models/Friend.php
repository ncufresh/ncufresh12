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
            ),
            'friend_request'  => array(
                self::BELONGS_TO,
                'Profile',
                'user_id'
            ) 
        );
    }

    public function isExist($friendid)
    {
        $data = $this->find(array(
            'condition' => 'user_id = :userid AND friend_id = :friendid',
            'params'    => array(
                ':userid' => Yii::app()->user->getId(),
                ':friendid' => $friendid
            )
        ));
        if ( $data )
        {
            return true;
        }
        return false;
    }

    public function deleteFriend($friendid) //刪除好友關係
    {
        $friendid = (integer)$friendid;  
        $this->deleteAll(array(
            'condition' => 'user_id = :userid AND friend_id = :friendid OR user_id = :friendid AND friend_id = :userid',
            'params'    => array(
                ':userid' => Yii::app()->user->getId(),
                ':friendid' => $friendid
            )
        ));
    }
    
    public function makeFriend($friendid) //當兩筆資料都存在
    {
        $friendid = (integer)$friendid;  
        $data = $this->findAll(array(
            'condition' => 'user_id = :userid AND friend_id = :friendid OR user_id = :friendid AND friend_id = :userid',
            'params'    => array(
                ':userid' => Yii::app()->user->getId(),
                ':friendid' => $friendid
            )
        ));
        if ( count($data) === 2 )
        {
            $this->updateAll(array(
                'invisible' => 0
            ), "user_id = :userid AND friend_id = :friendid OR user_id = :friendid AND friend_id = :userid", array(
                ':userid' => Yii::app()->user->getId(),
                ':friendid' => $friendid
            ));
        }
    }

    public function addFriend($friend_id)// 一次新增一筆資料
    {
        $model = new Friend();
        $model->user_id = Yii::app()->user->getId();
        $model->friend_id = $friend_id;
        $model->invisible = 1;
        $save = $model->save();
    }

    public function getRequests() //好友確認
    {
        return  $this->findAll(array(
                    'condition' => 'friend_id = :userid AND invisible = 1',
                    'params'    => array(
                        ':userid' => Yii::app()->user->getId()
                    )
                ));
    }

    public function getAmount()
    {
        $data = $this->findAll(array(
                    'condition' => 'user_id = :userid AND invisible = 0',
                    'params'    => array(
                        ':userid'   => Yii::app()->user->getId()
                    )
                ));
        return count($data);
    }

}
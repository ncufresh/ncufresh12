<?php

class Friend extends CActiveRecord
{
    const IS_FRIEND = 0;

    const IS_SEND_REQUEST = 1;

    const IS_RECEIVERED_REQUEST = 2;

    const IS_NOT_FRIEND = 3;

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
            ),
            'user_group' => array(
                self::HAS_MANY,
                'UserGroup',
                '',
                'on' => 'friend_id = user_group.user_id'
            )
        );
    }

    public function getFriendsNotInGroup($id)
    {
        return $this->with(array(
            'user_group' => array(
                'condition' => '(user_group.invisible=1 OR user_group.invisible IS NULL)', //不存在該社團的條件
                'on' => 'user_group.group_id = :gid', //現在是哪個社團
                'params' => array(
                    ':gid' => $id
                )
            )
        ))->findAll(array(
            'condition' => 't.user_id = :id AND t.invisible = 0', //是朋友的條件
            'params' => array(
                ':id' => Yii::app()->user->getId()
            )
        ));
    }
    
    public function friendRelation($friendid)
    {
        $friend = $this->find(array(
                'condition' => 'user_id = :userid AND friend_id = :friendid AND invisible = 0',//成為朋友
                'params'    => array(
                ':userid'   => Yii::app()->user->getId(),
                ':friendid' => $friendid
            )
        ));
        if ( $friend ) return self::IS_FRIEND;

        $my_request = $this->find(array(
                'condition' => 'user_id = :userid AND friend_id = :friendid AND invisible = 1', //我已送出邀請
                'params'    => array(
                ':userid'   => Yii::app()->user->getId(),
                ':friendid' => $friendid
            )
        ));
        if ( $my_request ) return self::IS_SEND_REQUEST;

        $other_request = $this->find(array(
                'condition' => 'user_id = :userid AND friend_id = :friendid AND invisible = 1', //對方已送出邀請
                'params'    => array(
                ':userid'   => $friendid,
                ':friendid' => Yii::app()->user->getId()
            )
        ));
        if ( $other_request ) return self::IS_RECEIVERED_REQUEST;

        return self::IS_NOT_FRIEND;
    }

    public function deleteFriend($friendid) //刪除好友關係
    {
        $friendid = (integer)$friendid;  
        $this->deleteAll(array(
                'condition' => 'user_id = :userid AND friend_id = :friendid OR user_id = :friendid AND friend_id = :userid',
                'params'    => array(
                ':userid'   => Yii::app()->user->getId(),
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
                ':userid'   => Yii::app()->user->getId(),
                ':friendid' => $friendid
            )
        ));
        if ( count($data) === 2 )
        {
            $this->updateAll(array(
                'invisible' => 0
            ), "(user_id = :userid AND friend_id = :friendid) OR (user_id = :friendid AND friend_id = :userid)", array(
                ':userid'   => Yii::app()->user->getId(),
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
                        ':userid'   => Yii::app()->user->getId()
                    )
                ));
    }

    public function getAmount($id = 0)
    {
        $id = (integer)$id;
        $user_id = (integer)Yii::app()->user->getId();
        if ( $id === 0 )
             $id = $user_id;
        $data = $this->findAll(array(
                        'condition' => 'user_id = :userid AND invisible = 0',
                        'params'    => array(
                        ':userid'   => $id
                    )
                ));
        return count($data);
    }

    public function getNewMember()
    {
        $group = new Group();
        return $this->findAll(array(
                    'condition' => 'id = :groupid AND invisible = 0'
                ));
    }

}
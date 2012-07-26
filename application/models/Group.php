<?php

class  Group extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{groups}}';
    }

    public function rules()
    {
        return array(
            array('name', 'required')
        );
    }

    public function relations()
    {
        return array(
            'profile'  => array(
                self::BELONGS_TO,
                'Profile',
                'user_id'
            ),
            'mygroups'     => array(
                self::HAS_MANY,
                'Group',
                'user_id'
            ),
            'group_members'     => array(
                self::HAS_MANY,
                'UserGroup',
                'group_id'
            )
        );
    }

    public function deleteGroup()
    {
        return $this->updateByPk($this->id, array(
            'invisible' => 1
        ));
    }

    public function getAllGroup()
    {
        return $this->findAll(array(
            'order'=>'id ASC'
        ));
    }

    public function FindGroup($userid)
    {
        return $this->find(array(
            'condition' => 'user_id = :id',
            'params'    => array(
                ':id' => $userid,
            )
        ));
    }

    public function getGroupAmount($userID)
    {
        $temp = $this->findAll(array(
            'condition' => 'user_id = :id',
            'params'    => array(
                ':id' => $userID,
            )
        ));
        $group_amounts = 0;
        foreach( $temp as $group)
        {
            $group_amounts++;
        }
        return $group_amounts;
    }

    public function addNewGroup($userid, $groupname, $groupdescription, $friends)
    {
        $addnewmember = true;
        $group = new Group();
        $group->user_id = $userid;
        $group->name = $groupname;
        $group->description = $groupdescription;
        $save = $group->save(); 
        if ( isset($save) ) 
        {
            foreach ( $friends as $friend )
            {
                $self_group = new UserGroup();
                $self_group->user_id = $friend;
                $self_group->group_id = $group->id;
                $_save = $self_group->save();
                if ( !isset($_save) )
                {
                    $addnewmember = false;
                    break;
                }
            }
        }
        return $addnewmember;
    }
}    
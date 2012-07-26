<?php

class  UserGroup extends CActiveRecord
{
    private $_identity;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{user_groups}}';
    }

    /*public function deleteUserGroup()
    {
        return $this->updateByPk($this->id, array(
            'invisible' => 1
        ));
    }*/

    public function getMembers($groupID)
    {
        return $this->findAll(array(
            'condition' => 'group_id = :id',
            'params'    => array(
                ':id' => $groupID
            )
        ));
    }

    public function Member_isExist($group_id,$userid)
    {
        $_exist = false;
        foreach ( $this->getMembers($group_id) as $member )
        {
            if (  $member->user_id === $userid )
            {
                $_exist=true;
            }
        }
        return $_exist;
    }

    public function AddNewMember($group_id, $friends)
    {
        $addmember = true;
        foreach ( $friends as $friend )
        {
            $group = new UserGroup();
            if ( !$this->Member_isExist($group_id, $friend) )
            {
                    $group->user_id = $friend;
                    $group->group_id = $group_id;
                    $save = $group->save();
            }
            if ( isset($save) )
            {
                $addmember = false;
                break;
            }
        }
        return $addmember;
    }
}
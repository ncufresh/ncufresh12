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
        return '{{user_group_relations}}';
    }

    public function getMembers($groupID)
    {
        return $this->findAll(array(
            'condition' => 'group_id = :id AND invisible = 0',
            'params'    => array(
                ':id' => $groupID
            )
        ));
    }

    public function closeMember($userid,$groupid)
    {
        $userid = (integer)$userid;
        $groupid = (integer)$groupid;  
        $temp = $this->updateAll(array(
            'invisible' => 1
        ), "user_id = :userid AND group_id = :groupid", array(
            ':userid' => $userid,
            ':groupid' => $groupid
        ));
        if ( $temp == 1 )
        {
            return true;
        }
        return false;
    }

    public function openMember($userid,$groupid)
    {
        $userid = (integer)$userid;
        $groupid = (integer)$groupid;  
        $temp = $this->updateAll(array(
            'invisible' => 0
        ), "user_id = :userid AND group_id = :groupid", array(
            ':userid' => $userid,
            ':groupid' => $groupid
        ));
        if ( $temp == 1 )
        {
            return true;
        }
        return false;
    }

    public function isExist($userid,$group_id)
    {
        $data1 = $this->find(array(
            'condition' => 'user_id = :userid AND group_id = :groupid',
            'params'    => array(
                ':userid' => $userid,
                ':groupid' => $group_id
            )
        ));
        if ( isset($data1) )
        {
            return true;
        }
        return false;
    }

    public function AddNewMember($member_id,$group_id)
    {
        $model = new UserGroup();
        $model->user_id = $member_id;
        $model->group_id = $group_id;
        $save = $model->save();
        if ( isset($save) )
        {
            return true;
        }
        return false;
    }

   /* public function getNewMember($groupid)
    {
        return $this->findAll(array(
                    'condition' => 'id = :groupid AND invisible = 0'
                ));
    }*/
}
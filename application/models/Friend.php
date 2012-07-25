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

    public function deleteFriend()
    {
        return $this->updateByPk($this->id, array(
            'invisible' => true
        ));
    }

    /*protected function afterFind()
    {
        parent::afterFind();
        //$this->created = Yii::app()->format->datetime($this->created);
        //$this->updated = Yii::app()->format->datetime($this->updated);
        $this->invisible = $this->invisible ? true : false;
    }

    protected function beforeSave()
    {
        if ( parent::beforeSave() )
        {
            if ( $this->getIsNewRecord() )
            {
                $this->created = TIMESTAMP;
                $this->invisible = false;
            }
            else
            {
                $this->created = $this->getRawValue('created');
            }
            $this->updated = TIMESTAMP;
            return true;
        }
        return false;
    }

    protected function afterSave()
    {
        parent::afterSave();

        $counter = 0;
        $data = $this->findAll(array(
            'order'     => 'updated DESC',
            'condition' => 'invisible = FALSE'
        ));

        foreach ( $data as $entry )
        {
            if ( $counter++ < 5 ) continue;
            $entry->invisible = true;
            $entry->save();
        }
    }*/

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
}
<?php

class Chat extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{chat_queues}}';
    }

    public function relations()
    {
        return array(
            'sender'    => array(
                self::BELONGS_TO,
                'User',
                'sender_id'
            ),
            'receiver'  => array(
                self::HAS_ONE,
                'User',
                'receiver_id'
            )
        );
    }

    public function getAllMessages($id)
    {
        $data = array();

        $criteria = new CDbCriteria();
        $criteria->select = 'sender_id, message, timestamp';
        $criteria->order = 'timestamp ASC';
        $criteria->condition = 'sender_id = :sender OR receiver_id = :receiver';
        $criteria->params = array(
            ':sender'   => $id,
            ':receiver' => Yii::app()->user->getId()
        );

        foreach ( $this->findAll($criteria) as $entry )
        {
            $data[] = array(
                'sender'    => $entry->sender->username ?: 'Unknown',
                'message'   => $entry->message,
                'timestamp' => $entry->timestamp
            );
        }

        return $data;
    }

    public function getRecentMessages($id)
    {
        $data = array();
        // $timestamp = 0;

        $criteria = new CDbCriteria();
        $criteria->select = 'sender_id, message, timestamp';
        $criteria->order = 'timestamp ASC';
        $criteria->condition = 'sender_id = :id OR receiver_id = :id';
        $criteria->params = array(
            ':id'       => $id
        );

        foreach ( $this->findAll($criteria) as $entry )
        {
            // if ( $timestamp === 0 ) $timestamp = $entry->timestamp;
            $data[] = array(
                'sender'    => $entry->sender->username ?: 'Unknown',
                'message'   => $entry->message,
                'timestamp' => $entry->timestamp
            );
        }

        // $data = $this->getNewMessages();
        return $data;
    }

    // public function getNewMessages($id)
    public function getNewMessages()
    {
        $data = array();
        $lasttime = Yii::app()->session['chatlasttime'];

        $criteria = new CDbCriteria();
        $criteria->select = 'sender_id, message, timestamp';
        $criteria->order = 'timestamp ASC';
        // $criteria->condition = 'sender_id = :sender OR receiver_id = :receiver';
        $criteria->condition = 'receiver_id = :receiver';
        $criteria->params = array(
            // ':sender'   => $id,
            ':receiver' => Yii::app()->user->getId()
        );

        foreach ( $this->findAll($criteria) as $entry )
        {
            if ( $entry->timestamp <= $lasttime ) continue;
            $data[] = array(
                'id'        => $entry->sender->id,
                'sender'    => $entry->sender->username ?: 'Unknown',
                'message'   => $entry->message,
                'timestamp' => $entry->timestamp
            );
        }

        Yii::app()->session['chatlasttime'] = TIMESTAMP;
        return $data;
    }

    protected function afterFind()
    {
        $this->timestamp = (integer)$this->timestamp;
        return parent::afterFind();
    }

    protected function beforeSave()
    {
        if ( $this->getIsNewRecord() ){
            $this->uuid = md5(uniqid(mt_rand(), true));
            $this->timestamp = TIMESTAMP;
        }
        return parent::beforeSave();
    }
}

class ChatInternal extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{chat_messages}}';
    }

    public function relations()
    {
        return array(
            'sender'    => array(
                self::BELONGS_TO,
                'User',
                'sender_id'
            ),
            'receiver'  => array(
                self::HAS_ONE,
                'User',
                'receiver_id'
            )
        );
    }

    public function getRecentMessages($id)
    {
        $data = array();
        $lasttime = Yii::app()->session['chatlasttime'];
        foreach (
            $this->findAll(array(
                'select'    => 'sender_id, message, timestamp',
                'order'     => 'timestamp ASC',
                'condition' => 'receiver_id = ' . $id
            )) as $entry
        )
        {
            if ( $entry['timestamp'] <= $lasttime ) continue;
            $data[] = array(
                'sender'    => $entry['sender']['username'] ?: 'Unknown',
                'message'   => $entry['message'],
                'timestamp' => $entry['timestamp']
            );
        }
        Yii::app()->session['chatlasttime'] = TIMESTAMP;
        return $data;
    }

    protected function afterFind()
    {
        $this->timestamp = (integer)$this->timestamp;
        return parent::afterFind();
    }

    protected function beforeSave()
    {
        if ( $this->getIsNewRecord() ) $this->timestamp = TIMESTAMP;
        return parent::beforeSave();
    }
}
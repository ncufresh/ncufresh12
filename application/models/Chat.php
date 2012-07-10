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

    public function behaviors()
    {
        return array(
            'Helper'
        );
    }

    public function rules()
    {
        return array(
            array('receiver_id, message, sequence', 'required')
        );
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

    public function getMessages($sender = 0, $lasttime = 0)
    {
        $data = array();

        $criteria = new CDbCriteria();
        $criteria->select = 'sender_id, receiver_id, message, timestamp';
        $criteria->order = 'timestamp ASC';
        if ( $sender )
        {
            $criteria->condition = '
                sender_id = :sender AND receiver_id = :receiver
             OR sender_id = :receiver AND receiver_id = :sender
            ';
            $criteria->params = array(
                ':sender'   => $sender,
                ':receiver' => Yii::app()->user->getId()
            );
        }
        else
        {
            $criteria->condition = 'receiver_id = :receiver';
            $criteria->params = array(
                ':receiver' => Yii::app()->user->getId()
            );
        }

        foreach ( $this->findAll($criteria) as $entry )
        {
            if ( $entry->timestamp <= $lasttime ) continue;
            $data[] = array(
                'id'        => $entry->sender_id,
                'sender'    => $entry->sender
                             ? $entry->sender->username
                             : 'Unknown',
                'message'   => $entry->message,
                'timestamp' => $entry->timestamp
            );
        }
        return $data;
    }

    protected function afterFind()
    {
        $this->timestamp = (integer)$this->timestamp;
        return parent::afterFind();
    }

    protected function beforeSave()
    {
        if ( $this->getIsNewRecord() )
        {
            $this->uuid = $this->uuid();
            $this->sender_id = Yii::app()->user->getId();
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
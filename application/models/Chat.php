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

    public static function getAllMessages($id)
    {
        $data = Yii::app()->db->createCommand('
            SELECT `uuid`, `sender_id`, `receiver_id`, `message`, `timestamp`
            FROM `{{chat_messages}}`
            WHERE `sender_id` = :sender AND `receiver_id` = :receiver
            ORDER BY `timestamp` ASC
        ')->queryAll(true, array(  
            ':sender'   => Yii::app()->user->getId(),
            ':receiver' => $id
        ));

        $criteria = new CDbCriteria();
        $criteria->select = '`uuid`, `sender_id`, `receiver_id`, `message`, `timestamp`';
        $criteria->order = '`timestamp` ASC, `sequence` ASC';
        $criteria->condition = '
            `sender_id` = :sender AND `receiver_id` = :receiver AND `timestamp` > :timestamp
        ';
        $criteria->params = array(
            ':sender'   => Yii::app()->user->getId(),
            ':receiver' => $id,
            ':timestamp'=> count($data) ? $data[count($data) - 1]['timestamp'] : 0
        );

        $uuids = array_map(function($entry)
        {
            return $entry['uuid'];
        }, array_values($data));

        foreach ( self::model()->findAll($criteria) as $entry )
        {
            if ( in_array($entry->uuid, $uuids) ) continue;
            $data[] = array(
                'uuid'      => $entry->uuid,
                'id'        => $entry->sender_id == Yii::app()->user->getId()
                             ? $entry->receiver_id
                             : $entry->sender_id,
                'sender'    => $entry->sender
                             ? $entry->sender->username
                             : 'Unknown',
                'message'   => $entry->message
            );
        }
        return $data;
    }

    public static function getRecentMessages($id)
    {
        $lastStateTime = (integer)Yii::app()->db->createCommand('
            SELECT `start`
            FROM `{{chat_states}}`
            WHERE `sender_id` = :sender AND `receiver_id` = :receiver
            ORDER BY `start` DESC
        ;')->queryRow(true, array(  
            ':sender'   => Yii::app()->user->getId(),
            ':receiver' => $id
        ))['start'];
        $lastLoginTime = Yii::app()->user->getUser()->getLastLoginTimestamp();
        $lasttime = $lastStateTime > $lastLoginTime
                  ? $lastStateTime
                  : $lastLoginTime;

        $criteria = new CDbCriteria();
        $criteria->select = '`uuid`, `sender_id`, `receiver_id`, `message`, `timestamp`';
        $criteria->order = '`timestamp` ASC, `sequence` ASC';
        $criteria->condition = '
            ((`sender_id` = :u AND `receiver_id` = :v)
         OR (`sender_id` = :v AND `receiver_id` = :u))
        AND `timestamp` > :t
        ';
        $criteria->params = array(
            ':u'        => Yii::app()->user->getId(),
            ':v'        => $id,
            ':t'        => $lasttime
        );

        $data = array();
        foreach ( self::model()->findAll($criteria) as $entry )
        {
            if ( $entry->timestamp < $lastStateTime ) continue;
            $data[] = array(
                'uuid'      => $entry->uuid,
                'id'        => $entry->sender_id == Yii::app()->user->getId()
                             ? $entry->receiver_id
                             : $entry->sender_id,
                'sender'    => $entry->sender
                             ? $entry->sender->username
                             : 'Unknown',
                'message'   => $entry->message
            );
        }
        return $data;
    }

    public static function getMessages($lasttime = 0)
    {
        $id = Yii::app()->user->getId();
        $lastStateIds = array();
        $lastStateTimes = array();
        if ( $lasttime == 0 )
        {
            $query = Yii::app()->db->createCommand('
                SELECT `sender_id`, `receiver_id`, `start`, `end`
                FROM `{{chat_states}}`
                WHERE `sender_id`
                ORDER BY `end` ASC
            ;')->queryAll(true, array(
                ':id'       => $id
            ));
            foreach ( $query as $entry )
            {
                $key = $entry['sender_id'] == $id
                    ? $entry['receiver_id']
                    : $entry['sender_id'];
                $start = (integer)$entry['start'];
                $end = (integer)$entry['end'];
                $lastStateTimes[$key] = $start <- $end ? $start : $end;
            }
            $lastStateIds = array_keys($lastStateTimes);
        }

        $criteria = new CDbCriteria();
        $criteria->select = '`uuid`, `sender_id`, `receiver_id`, `message`, `timestamp`';
        $criteria->order = '`timestamp` ASC, `sequence` ASC';
        $criteria->condition = '`sender_id` = :id OR `receiver_id` = :id';
        $criteria->params = array(
            ':id'       => $id
        );

        $data = array();
        foreach ( self::model()->findAll($criteria) as $entry )
        {
            $key = $entry->sender_id == $id
                ? $entry->receiver_id
                : $entry->sender_id;
            if ( $entry->timestamp < $lasttime ) continue;
            if (
                in_array($key, $lastStateIds)
             && $entry->timestamp < $lastStateTimes[$key]
            )
            {
                continue;
            }
            $data[] = array(
                'uuid'      => $entry->uuid,
                'id'        => $key,
                'sender'    => $entry->sender
                             ? $entry->sender->username
                             : 'Unknown',
                'message'   => $entry->message
            );
        }
        return $data;
    }

    public static function updateState($id, $start = true)
    {
        $parameters = array(
            ':sender'   => Yii::app()->user->getId(),
            ':receiver' => $id
        );
        if (
            Yii::app()->db->createCommand('
                SELECT `uuid`
                FROM `{{chat_states}}`
                WHERE `sender_id` = :sender AND `receiver_id` = :receiver
            ;')->queryRow(true, $parameters)
        )
        {
            if (
                Yii::app()->db->createCommand('
                    UPDATE `{{chat_states}}`
                    SET
                        `sender_id` = :sender,
                        `receiver_id` = :receiver,
                        `' . ($start ? 'start' : 'end') . '` = ' . TIMESTAMP . '
                    WHERE `sender_id` = :sender AND `receiver_id` = :receiver
                ;')->execute($parameters)
            )
            {
                return true;
            }
        }
        else
        {
            if (
                Yii::app()->db->createCommand('
                    INSERT INTO `{{chat_states}}`
                    (`uuid`, `sender_id`, `receiver_id`, `' . ($start ? 'start' : 'end') . '`)
                    VALUES
                    (\'' . self::model()->uuid() . '\', :sender, :receiver, ' . TIMESTAMP . ')
                ;')->execute($parameters)
            )
            {
                return true;
            }
        }
        return false;
    }

    protected function afterFind()
    {
        $this->sender_id = (integer)$this->sender_id;
        $this->receiver_id = (integer)$this->receiver_id;
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
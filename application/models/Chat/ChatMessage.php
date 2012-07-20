<?php

class ChatMessage extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{chat_messages}}';
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
}
<?php

class ChatController extends Controller
{
    public function filters()
    {
        return array(
            'accessControl'
        );
    }

    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions'   => array('list', 'retrieve', 'messages', 'send'),
                'users'     => array('@')
            ),
            array(
                'deny',
                'users'     => array('*')
            )
        );
    }

    public function actionList()
    {
        $this->_data['friends'] = array(
            array(
                'id'        => 1,
                'name'      => 'Test 1',
                'icon'      => null
            ),
            array(
                'id'        => 2,
                'name'      => 'Test 2',
                'icon'      => null
            ),
            array(
                'id'        => 3,
                'name'      => 'Test 3',
                'icon'      => null
            )
        );
    }

    public function actionRetrieve()
    {
        $id = Yii::app()->user->getId() ?: 0;
        $this->_data['messages'] = Chat::model()->getRecentMessages($id);
    }

    public function actionMessages()
    {
        $id = Yii::app()->user->getId() ?: 0;
        $this->_data['messages'] = Chat::model()->getAllMessages($id);
    }

    public function actionSend()
    {
        // NOTE: $_POST['chat'] consists of sender_id, receiver_id, and message.
        $id = Yii::app()->user->id ?: 0;
        if ( Yii::app()->request->isPostRequest )
        {
            $model = new Chat();
            $model->attributes = $_POST['chat'];
            if ( $model->validate() && $model->save() )
            {
                $this->_data['messages'] = Chat::model()->getRecentMessages($id);
            }
        }
        else
        {
            $this->_data['errors'][] = '發生錯誤！';
        }
    }
}
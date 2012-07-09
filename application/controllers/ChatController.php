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
                'actions'   => array('list', 'retrieve', 'receive', 'send'),
                'users'     => array('*')
            ),
            array(
                'deny',
                'users'     => array('*')
            )
        );
    }

    public function actionList()
    {
        $this->_data = array(
            array(
                'id'        => 1,
                'name'      => 'Test 1',
                'icon'      => null
            ),
            array(
                'id'        => 2,
                'name'      => 'Demodemo',
                'icon'      => null
            ),
            array(
                'id'        => 3,
                'name'      => 'Adminadmin',
                'icon'      => null
            )
        );
    }

    public function actionReceive($id)
    {
        $this->_data['messages'] = Chat::model()->getAllMessages((integer)$id);
    }

    public function actionRetrieve()
    {
        // $id = Yii::app()->user->getId() ?: 0;
        $this->_data = Chat::model()->getNewMessages();
    }

    public function actionSend()
    {
        //NOTE: $_POST['chat'] consists of sender_id, receiver_id, and message.
        $id = Yii::app()->user->id ?: 0;
        if ( Yii::app()->request->isPostRequest )
        {
            $model = new Chat();
            $model->receiver_id = $_POST['chat']['receiver_id'];
            $model->sender_id = $id;
            $model->message = $_POST['chat']['message'];
            if ( $model->validate() && $model->save() )
            {
                $this->_data['message'] = $_POST['chat']['message'];
                $this->_data['token'] = Yii::app()->security->getToekn();
                $this->_data['me'] = $model->sender->username;
            }
        }
        else
        {
            $this->_data['errors'][] = '發生錯誤！';
        }
    }
}
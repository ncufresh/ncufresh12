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
                'actions'   => array('list', 'retrieve', 'send'),
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

    // public function actionReceive($id)
    // {
        // $this->_data['messages'] = Chat::model()->getAllMessages((integer)$id);
    // }

    public function actionRetrieve($lasttime = 0)
    {
        $id = Yii::app()->user->getId() ?: 0;

        if ( isset($_GET['lasttime']) )
        {
            $this->_data['messages'] = Chat::model()->getMessages(
                (integer)$id,
                (integer)$lasttime
            );
            $this->_data['lasttime'] = TIMESTAMP;
            return true;
        }
        $this->_data['error'] = true;
    }

    public function actionSend()
    {
        // NOTE: $_POST['chat'] consists of sender_id, receiver_id, and message.
        $id = Yii::app()->user->getId() ?: 0;
        if ( Yii::app()->request->getIsPostRequest() )
        {
            $model = new Chat();
            $model->attributes = $_POST['chat'];
            if ( $model->validate() && $model->save() )
            {
                $this->_data['messages'] = Chat::model()->getMessages(
                    (integer)$id,
                    (integer)$_POST['lasttime']
                );
            }
            $this->_data['token'] = Yii::app()->security->getToken();
            return true;
        }
        $this->_data['errors'][] = '發生錯誤！';
    }
}
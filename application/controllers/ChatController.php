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
                'actions'   => array('open', 'send', 'close', 'avatar'),
                'users'     => array('@')
            ),
            array(
                'deny',
                'users'     => array('*')
            )
        );
    }

    public function actionOpen($id)
    {
        $this->_data['messages'] = Chat::getRecentMessages($id);
        if ( ! Chat::updateState($id, true) )
        {
            $this->_data['errors'][] = '發生錯誤！';
        }
    }

    public function actionSend()
    {
        $this->_data['lasttime'] = TIMESTAMP;

        if ( Yii::app()->request->getIsPostRequest() )
        {
            if ( Yii::app()->user->getId() != $_POST['receiver'] )
            {
                $model = new Chat();
                $model->message = $_POST['message'];
                $model->receiver_id = $_POST['receiver'];
                $model->sequence = $_POST['sequence'];
                if ( $model->validate() && $model->save() )
                {
                    $this->_data['messages'] = Chat::model()->getMessages(
                        $_POST['lasttime']
                    );
                }
                return true;
            }
        }

        $this->_data['errors'][] = '發生錯誤！';
    }

    public function actionClose()
    {
        if ( Yii::app()->request->getIsPostRequest() )
        {
            if ( ! Chat::updateState($_POST['receiver'], false) )
            {
                $this->_data['errors'][] = '發生錯誤！';
            }
            return true;
        }

        $this->_data['errors'][] = '發生錯誤！';
    }

    public function actionAvatar($id)
    {
        $this->_data['id'] = (integer)$id;
        $this->_data['avatar'] = $this->widget('Avatar', array(
            'id'        => $this->_data['id']
        ), true);
    }
}
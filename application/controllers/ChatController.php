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
                'actions'   => array('retrieve', 'send'),
                'users'     => array('*')
            ),
            array(
                'deny',
                'users'     => array('*')
            )
        );
    }

    public function actionRetrieve($lasttime = 0)
    {
        $id = Yii::app()->user->getId() ?: 0;

        if ( isset($_GET['lasttime']) )
        {
            $this->_data['messages'] = Chat::model()->getMessages(
                (integer)$id,
                (integer)$lasttime
            );
            $this->_data['me'] = Yii::app()->user->getId();
            $this->_data['lasttime'] = TIMESTAMP;
            return true;
        }
        $this->_data['error'] = true;
    }

    public function actionSend()
    {
        $id = Yii::app()->user->getId() ?: 0;
        if ( Yii::app()->request->getIsPostRequest() )
        {
            $model = new Chat();
            $model->attributes = $_POST['chat'];
            $model->sequence = $_POST['sequence'];
            if ( $model->validate() && $model->save() )
            {
                $this->_data['messages'] = Chat::model()->getMessages(
                    (integer)$id,
                    (integer)$_POST['lasttime']
                );
                
            }
            $this->_data['token'] = Yii::app()->security->getToken();
            $this->_data['lasttime'] = TIMESTAMP;
            return true;
        }
        $this->_data['errors'][] = '發生錯誤！';
    }
}
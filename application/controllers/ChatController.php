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
                'actions'   => array('send'),
                'users'     => array('*')
            ),
            array(
                'deny',
                'users'     => array('*')
            )
        );
    }

    public function actionSend()
    {
        if ( Yii::app()->request->getIsPostRequest() )
        {
            $model = new Chat();
            $model->attributes = $_POST['chat'];
            $model->sequence = $_POST['sequence'];
            if ( $model->validate() && $model->save() )
            {
                $this->_data['messages'] = Chat::model()->getMessages(
                    $_POST['lasttime']
                );
            }
            $this->_data['token'] = Yii::app()->security->getToken();
            $this->_data['lasttime'] = TIMESTAMP;
            return true;
        }
        $this->_data['errors'][] = '發生錯誤！';
    }
}
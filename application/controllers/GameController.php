<?php

class GameController extends Controller
{
    public function init()
    {
        parent::init();
        Yii::import('application.models.Game.*');
        return true;
    }

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
                'actions'   => array('index', 'togetExp'),
                'users'     => array('*')
            ),
            array(
                'deny',
                'users'     => array('*')
            )
        );
    }

    public function actionIndex()
    {
        $model = Character::model()->findByPk(3);
        $model->addExp(47);
        $model->addMoney(10);
        $this->render('index');
    }

    public function actiontogetExp()
    {
        $model = Character::model()->findByPk(3);
        $model->addExp(1);
        $model->addMoney(1);
        $this->render('index');
    }
}
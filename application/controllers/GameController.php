<?php

class GameController extends Controller
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
        $model = GameCharacter::model()->findByPk(3);
        $model->addExp(47);
        $model->addMoney(10);
        $this->render('index');
    }

    public function actiontogetExp()
    {
        $model = GameCharacter::model()->findByPk(3);
        $model->addExp(1);
        $model->addMoney(1);
        $this->render('index');
    }
}
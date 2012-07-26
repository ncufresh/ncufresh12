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
                'users'     => array('@')
            ),
            // array(
                // 'allow',
                // 'actions'   => array('index', 'togetExp'),
                // 'users'     => array('*')
            // ),
            array(
                'deny',
                'users'     => array('*')
            )
        );
    }

    public function actionIndex($id = 0)
    {
        if($id==0)
        {
            $id=Yii::app()->user->getId();
        }
        $this->setPageTitle(Yii::app()->name . ' - 遊戲專區');
        // $this->render('index', array('user_id' => $id));
        $content = $this->renderPartial('index', null, true);
        $this->render('game_system', array('content' => $content, 'user_id' => $id));
    }

    public function actionAchievements($id = 0)
    {
        if($id==0)
        {
            $id=Yii::app()->user->getId();
        }
        $return = Achievement::model()->getAchievementsByUserId(Yii::app()->user->getId());
        $this->setPageTitle(Yii::app()->name . ' - 成就系統');
        $this->render('index', array('user_id' => $id,'achievements' => $return));
    }

    // public function actiontogetExp()
    // {
        // $model = Character::model()->findByPk(3);
        // $model->addExp(1);
        // $model->addMoney(1);
        // $this->render('index');
    // }
}
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
        $this->render('game_system', array('content' => $content, 'watch_id' => $id));
    }
    
    public function actionMissions($id = 0)
    {
        $user_id = Yii::app()->user->getId();
        if($id==0) //判斷是否有傳入id
        {
            $id=Yii::app()->user->getId();
        }
        
        if(Character::model()->findByPk($id)==null) //判斷使用者是否存在
        {
            $this->redirect(Yii::app()->createUrl('game/index', array('id'=>$user_id)));
        }
        
        else
        {
            if($id==$user_id)
            {
                $this->setPageTitle(Yii::app()->name . ' - 任務列表');
                $content = $this->renderPartial('missions', null, true);
                $this->render('game_system', array('content' => $content, 'watch_id' => $id));
            }
            else
            {
                $this->redirect(Yii::app()->createUrl('game/index', array('id'=>$id)));
            }
        }
    }

    public function actionAchievements($id = 0)
    {
        if($id==0)
        {
            $id=Yii::app()->user->getId();
        }
        $return = Achievement::model()->getAchievementsByUserId(Yii::app()->user->getId());
        $this->setPageTitle(Yii::app()->name . ' - 成就系統');
        $content = $this->renderPartial('achievements', array('achievements' => $return), true);
        $this->render('game_system', array('content' => $content, 'watch_id' => $id));
        //$this->render('achievements', array('user_id' => $id,'achievements' => $return));
    }
    
    public function actionItems($id = 0)
    {
        if($id==0)
        {
            $id=Yii::app()->user->getId();
        }
        $this->setPageTitle(Yii::app()->name . ' - 道具列表');
        // $this->render('index', array('user_id' => $id));
        $content = $this->renderPartial('items', null, true);
        $this->render('game_system', array('content' => $content, 'watch_id' => $id));
    }
    
    public function actionShop($id = 0)
    {
        $user_id = Yii::app()->user->getId();
        if($id==0)
        {
            $id=Yii::app()->user->getId();
        }
        if($id==$user_id)
        {
            $this->setPageTitle(Yii::app()->name . ' - 商城列表');
            $content = $this->renderPartial('shop', null, true);
            $this->render('game_system', array('content' => $content, 'watch_id' => $id));
        }
        else
        {
            $this->redirect(Yii::app()->createUrl('game/index', array('id'=>$id)));
        }
    }
    
    public function actionFunny($id = 0)
    {
        if($id==0)
        {
            $id=Yii::app()->user->getId();
        }
        $this->setPageTitle(Yii::app()->name . ' - 惡搞列表');
        $content = $this->renderPartial('funny', null, true);
        $this->render('game_system', array('content' => $content, 'watch_id' => $id));
    }

    // public function actiontogetExp()
    // {
        // $model = Character::model()->findByPk(3);
        // $model->addExp(1);
        // $model->addMoney(1);
        // $this->render('index');
    // }
}
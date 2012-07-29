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
        $user_id = Yii::app()->user->getId();
        if($id==0)
        {
            $id=Yii::app()->user->getId();
        }
        
        if(Character::model()->findByPk($id)==null) //判斷使用者是否存在
        {
            $this->redirect(Yii::app()->createUrl('game/index', array('id'=>$user_id)));
        }
        else
        {
            $this->setPageTitle(Yii::app()->name . ' - 遊戲專區');
            // $this->render('index', array('user_id' => $id));
            $character_data = Character::model()->findByPk($id);
            $user_data = User::model()->findByPk($id);
            $profile_data = Profile::model()->findByPk($id);
            $level = Character::model()->getLevel($id); //傳入id 查詢等級
            $level_exp = Character::model()->getLevelExp($level); //傳入等級 查詢等級經驗
            $nickname = $profile_data->nickname;
            $online_count = $user_data->online_count;
            $username = $user_data->username;
            $content = $this->renderPartial('index', array('exp' => $character_data->exp, 'level' => $level, 'level_exp' => $level_exp,
            'character_data' => $character_data, 'user_data' => $user_data, 'profile_data' => $profile_data, 'online_count' => $online_count,
            'money' => $character_data->money,'nickname' => $nickname, 'username' => $username, 'watch_id' => $id), true);
            $this->render('game_system', array('content' => $content, 'watch_id' => $id));
        }
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
        $user_id = Yii::app()->user->getId();
        if($id==0)
        {
            $id=Yii::app()->user->getId();
        }
        if(Character::model()->findByPk($id)==null) //判斷使用者是否存在
        {
            $this->redirect(Yii::app()->createUrl('game/index', array('id'=>$user_id)));
        }
        else
        {
            $return = Achievement::model()->getAchievementsByUserId(Yii::app()->user->getId());
            $this->setPageTitle(Yii::app()->name . ' - 成就系統');
            $content = $this->renderPartial('achievements', array('achievements' => $return), true);
            $this->render('game_system', array('content' => $content, 'watch_id' => $id));
            //$this->render('achievements', array('user_id' => $id,'achievements' => $return));
        }
    }
    
    public function actionItems($id = 0)
    {
        $user_id = Yii::app()->user->getId();
        if($id==0)
        {
            $id=Yii::app()->user->getId();
        }
        if(Character::model()->findByPk($id)==null) //判斷使用者是否存在
        {
            $this->redirect(Yii::app()->createUrl('game/index', array('id'=>$user_id)));
        }
        else
        {
            $this->setPageTitle(Yii::app()->name . ' - 道具列表');
            $character_data = Character::model()->findByPk($id);
            // $this->render('index', array('user_id' => $id));
            $items_bag = $character_data->items_bag;
            $content = $this->renderPartial('items',array('character_data' => $character_data), true);
            $this->render('game_system', array('content' => $content, 'watch_id' => $id));
        }
    }
    
    public function actionShop($id = 0)
    {
        $user_id = Yii::app()->user->getId();
        if($id==0)
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
                $this->setPageTitle(Yii::app()->name . ' - 商城列表');
                $content = $this->renderPartial('shop', null, true);
                $this->render('game_system', array('content' => $content, 'watch_id' => $id));
            }
            else
            {
                $this->redirect(Yii::app()->createUrl('game/index', array('id'=>$id)));
            }
        }
    }
    
    // public function actionFunny($id = 0)
    // {
        // if($id==0)
        // {
            // $id=Yii::app()->user->getId();
        // }
        // $this->setPageTitle(Yii::app()->name . ' - 惡搞列表');
        // $content = $this->renderPartial('funny', null, true);
        // $this->render('game_system', array('content' => $content, 'watch_id' => $id));
    // }

    // public function actiontogetExp()
    // {
        // $model = Character::model()->findByPk(3);
        // $model->addExp(1);
        // $model->addMoney(1);
        // $this->render('index');
    // }
}
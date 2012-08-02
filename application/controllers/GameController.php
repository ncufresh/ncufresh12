<?php

class GameController extends Controller
{
    public $userId; // 存入使用者id

    public $characterData; // 使用者腳色資料

    public function init()
    {
        parent::init();
        Yii::import('application.models.*');
        $this->userId = Yii::app()->user->getId();
        $this->userId = (integer)$this->userId;
        $this->characterData = Character::model()->findByPk($this->userId);
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
            array(
                'deny',
                'users'     => array('*')
            )
        );
    }

    public function actionIndex($id = 0)
    {
        $id = (integer)$id;
        if ( $id === 0 ) $id = $this->userId;
        
        if ( Character::model()->findByPk($id) ) //判斷使用者是否存在
        {
            $this->setPageTitle(Yii::app()->name . ' - 遊戲專區');
            $watch_character_data = Character::model()->findByPk($id); //傳入id 查詢使用者遊戲腳色資料
            $watch_user_data = User::model()->findByPk($id); //傳入id 查詢使用者資料
            $watch_profile_data = Profile::model()->findByPk($id); //傳入id 查詢使用者資料
            $level = Character::model()->getLevel($id); //傳入id 查詢等級
            $level_exp = Character::model()->getLevelExp($level); //傳入等級 查詢等級經驗
            $nickname = $watch_profile_data->nickname;
            $online_count = $watch_user_data->online_count;
            $username = $watch_user_data->username;
            $content = $this->renderPartial('index', array(
                'exp'           => $watch_character_data->experience,
                'level'         => $level,
                'level_exp'     => $level_exp,
                'character_data'=> $watch_character_data,
                'user_data'     => $watch_user_data,
                'profile_data'  => $watch_profile_data,
                'online_count'  => $online_count,
                'money'         => $watch_character_data->money,
                'nickname'      => $nickname,
                'username'      => $username,
                'watch_id'      => $id
            ), true);
            $this->render('game_system', array(
                'content'       => $content,
                'watch_id'      => $id
            ));
        }
        else
        {
            $this->redirect(Yii::app()->createUrl('game/index', array(
                'id'    => $this->userId
            )));
        }
    }
    
    public function actionMissions($id = 0)
    {
        $id = (integer)$id;
        if ( $id === $this->userId )
        {
            $mission_count = $this->characterData->missions;
            $missions = Mission::model()->getMissions($mission_count); //回傳相對數目的任務陣列
            $this->setPageTitle(Yii::app()->name . ' - 任務列表');
            $content = $this->renderPartial('missions', array(
                'mission_count' => $mission_count,
                'missions'      => $missions)
            , true);
            $this->render('game_system', array(
                'content'       => $content,
                'watch_id'      => $id
            ));
        }
        else
        {
            $this->redirect(Yii::app()->createUrl('game/missions', array(
                'id'    => $this->userId
            )));
        }
    }

    public function actionAchievements($id = 0)
    {
        $id = (integer)$id;
        if ( $id === 0 ) $id = $this->userId;

        if ( Character::model()->findByPk($id) ) //判斷使用者是否存在
        {
            $this->setPageTitle(Yii::app()->name . ' - 成就系統');
            $return = Achievement::model()->getAchievementsByUserId($id);
            $content = $this->renderPartial('achievements', array(
                'achievements'  => $return
            ), true);
            $this->render('game_system', array(
                'content'       => $content,
                'watch_id'      => $id
            ));
        }
        else
        {
            $this->redirect(Yii::app()->createUrl('game/index', array(
                'id'    => $this->userId
            )));
        }
    }
    
    public function actionItems($id = 0)
    {
        $id = (integer)$id;
        if ( $id !== $this->userId )
        {
            $this->redirect(Yii::app()->createUrl('game/items', array(
                'id'    => $this->userId
            )));
        }
        if ( Character::model()->findByPk($id) ) //判斷使用者是否存在
        {
            $watch_character_data = Character::model()->findByPk($id);
            $items_bag = $watch_character_data->items_bag;
            $this->setPageTitle(Yii::app()->name . ' - 道具列表');
            $content = $this->renderPartial('items',array(
                'character_data'=> $watch_character_data
            ), true);
            $this->render('game_system', array(
                'content'       => $content,
                'watch_id'      => $id
            ));
        }
        else
        {
            $this->redirect(Yii::app()->createUrl('game/index', array(
                'id'    => $this->userId
            )));
        }
    }
    
    public function actionShop($id = 0)
    {
        $id = (integer)$id;
        if ( $id === $this->userId ) //使用者只能看到屬於自己的商城
        {
            $level = Character::model()->getLevel($this->userId); //傳入id 查詢等級
            $content = $this->renderPartial('shop', array(
                'level'     => $level,
                'money'     => $this->characterData->money
            ), true);
            $this->setPageTitle(Yii::app()->name . ' - 商城列表');
            $this->render('game_system', array(
                'content'   => $content,
                'watch_id'  => $this->userId
            ));
        }
        else
        {
            $this->redirect(Yii::app()->createUrl('game/shop', array(
                'id'    => $this->userId
            )));
        }
    }
    
    public function actionBuy($id = 0)
    {
        $id = (integer)$id;
        if ( $id === 0 )
        {
            $this->redirect(Yii::app()->createUrl('game/shop', array(
                'id'    => $this->userId
            )));
        }

        $status = ItemBag::model()->buyNewItem($id);
        echo $status;
        $reason ='test';
        switch ($status)
        {
            case 0:
                $reason = '恭喜您：購買成功！';
                break;
            case 1:
                $reason = '金幣不足！';
                break;
            case 2:
                $reason = '等級不足！';
                break;
            case 3:
                $reason = '已經擁有此物品！';
                break;
            default:
                $reason = '資料庫寫入錯誤！';
        }
        $content = $this->renderPartial('reason', array(
            'reason'    => $reason,
            'watch_id'  => $this->userId
        ), true);
        $this->render('game_system', array(
            'content'   => $content,
            'watch_id'  => $this->userId
        ));
    }

    public function actionEquip($id = 0)
    {
        $id = (integer)$id;
        if ( $id === 0 )
        {
            $this->redirect(Yii::app()->createUrl('game/items', array(
                'id'    => $this->userId
            )));
        }

        $status = ItemBag::model()->equipItem($id);
        $this->redirect(Yii::app()->createUrl('game/items', array(
            'id'    => $this->userId
        )));
    }
    
    public function actionProblem($id = 0)
    {
        $mission = Mission::model()->findByPk($id);
        $this->_data['name'] = $mission->name;
        $this->_data['content'] = $mission->content;
    }
    
    public function actionSolve($id = 0)
    {
        if ( isset($_POST['answer']) )
        {
            $mission = Mission::model()->findByPk($id);
            $user_mission_counter = ($this->characterData->missions)+1;
            $answer = $mission->answer;
            $get_money = $mission->money;
            $get_experience = $mission->experience;
            if( $_POST['answer'] == $answer )
            {
                $this->_data['result'] = true;
                if( $id == $user_mission_counter ) // 解一題沒解過的題目
                {
                    $this->characterData->addMission();
                    $this->characterData->addMoney($get_money);
                    $this->characterData->addexp($get_experience);
                }
                else
                {
                    $this->characterData->addMoney($get_money*0.05);
                    $this->characterData->addexp($get_experience*0.02);
                }
            }
            else
            {
                $this->_data['result'] = false;
            }
            $this->_data['token'] = Yii::app()->security->getToken();
        }
    }
}
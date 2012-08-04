<?php

class ProfileController extends Controller
{
    public $id;

    public $user;
    
    public function init()
    {
        parent::init();
        Yii::import('application.models.Forum.*');
        $this->id = Yii::app()->user->getId();
        $this->user = User::model()->findByPk($this->id);
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

    public function actionProfile() 
    {
        if ( empty($this->user->profile) )
        {
            $this->redirect(array('profile/editor'));
        }
        else
        {
            $this->render('profile', array(
                'user'      => $this->user
            ));
        }
        
    }

    public function actionEditor() 
    {
        $profile = $this->user->profile; //�ӵ���ƫD�ŭ�
        if ( isset($_POST['profile']) ) 
        {
            $this->user->attributes = $_POST['register'];
            $profile->find(array(
                'condition' => 'id = :userid AND nickname != :myNickName',
                'params'    => array(
                    ':userid'       => $this->id,
                    ':myNickName'   => $_POST['profile']['nickname']
                )
            ));
            $profile->setScenario('editor');
            $profile->attributes = $_POST['profile'];
            $user_validate = $this->user->validate();
            $profile_validate = $profile->validate();
            if ( $user_validate && $profile_validate )
            {
                if ( $profile->save() )
                {
                    $this->redirect(array('profile/profile'));
                }
            }
        }
        else
        {
            if ( empty($profile) )
            {
                $profile = new Profile();
                $profile->id = $this->user->id;
                $profile->attributes = array(     
                    'name'              => 'QQ',
                    'nickname'          => 'QQ',
                    'gender'            => 0, //�w�]�k��
                    'department'        => 2, //�w�]�L�O��u�t
                    'grade'             => 0,//��L�~��
                    'senior'            => 'QQ',
                    'birthday'          => '2000-01-01'
                );
                $profile_validate = $profile->validate();
                if (  $profile_validate && $profile->save() )
                {
                    $this->redirect(array('profile/editor'));
                }
            }
        }
        $this->render('editor', array(                
            'user'                   => $this->user, 
            'departments'            => Department::model()->getDepartment(),
            'profile_errors'         => $profile->getErrors()
        ));       
    }

    public function actionMessage()
    {
        $this->render('message', array(
            'articles'       => Article::model()->getUserArticles($this->id)
        ));
    }

    public function actionMessageReply($aid)
    {
        $this->render('messagereply', array( //�٭n�A�P�_�O�_������Φ^�_---���M�^�O�ŭȭC
            'article'       => Article::model()->findByPk($aid),
            'replys'        => Reply::model()->getArticleReplies($aid),
            'comments'      => Comment::model()->getArticleComments($aid)
        ));
    }

    public function actionOtherProfile($friend_id)
    {
        $this->render('otherprofile', array(
            'user'            => User::model()->findByPk($friend_id),
            'friend_relation' => Friend::model()->friendRelation($friend_id),
            'messages'        => Chat::model()->getAllMessages($friend_id)
        ));
        
    }
}
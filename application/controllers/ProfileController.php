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
        $this->render('profile', array(
            'user'      => $this->user
        ));
        
    }

    public function actionEditor() 
    {
        if ( isset($_POST['profile']) ) 
        {
            $this->user->attributes = $_POST['register'];
            $profile = $this->user->profile;
            $profile->attributes = $_POST['profile'];
            if ( $this->user->validate() && $profile->validate() )
            {
                
                if ( $profile->save() )
                {
                    $this->redirect(array('profile/profile'));
                }
            }
            else
            {
                $this->render('editor', array(                
                        'user'          => $this->user, 
                        'departments'   => Department::model()->getDepartment()
                ));
            }
        }
        $this->render('editor', array(                
            'user'          => $this->user, 
            'departments'   => Department::model()->getDepartment()
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
            'user'          => User::model()->findByPk($friend_id)
        ));
        
    }
}

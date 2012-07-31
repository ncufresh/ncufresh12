<?php

class ProfileController extends Controller
{
    public function init()
    {
        parent::init();
        Yii::import('application.models.Forum.*');
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
        $id = Yii::app()->user->id;
        $this->render('profile', array(
            'user'      => User::model()->findByPk($id),
        ));
        
    }

    public function actionEditor() 
    {
        $userID = Yii::app()->user->id;
        $user = User::model()->findByPk($userID);
        if ( isset($_POST['profile']) ) 
        {
            $user->attributes = $_POST['register'];
            $profile = $user->profile;
            $profile->attributes = $_POST['profile'];
            if ( $user->validate() && $profile->validate() )
            {
                if ( $profile->save() )
                {
                    $this->redirect(array('profile/profile'));
                }
            }
        }
        else
        {
            $this->render('editor', array(                
                    'user'          => $user, 
                    'departments'   => Department::model()->getDepartment(), 
                    'target'        => $img_url
            ));
        }
    }

    public function actionMessage()
    {
        $userID = Yii::app()->user->id;
        $this->render('message', array(
            'articles'        => Article::model()->getUserArticles($userID)
        ));
    }

    public function actionMessageReply()
    {
        $userID = Yii::app()->user->id;
        if ( isset($_GET['aid']) )
        {
            $this->render('messagereply', array( //�٭n�A�P�_�O�_������Φ^�_---���M�^�O�ŭȭC
                'article'       => Article::model()->findByPk($_GET['aid']),
                'replys'      => Reply::model()->getArticleReplies($_GET['aid']),
                'comments'       => Comment::model()->getArticleComments($_GET['aid'])
            ));
        }
        else
        {
           $this->redirect(array('friends/friends'));
        }
    }

    public function actionOtherProfile()
    {
        if ( isset($_GET['friend_id']) )
        {
            $userID = Yii::app()->user->id;
            $this->render('otherprofile', array(
                'user'       => User::model()->findByPk($_GET['friend_id'])
                
                
            ));
        }
    }
}

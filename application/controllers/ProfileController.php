<?php

class ProfileController extends Controller
{
    public $userid;

    public function init()
    {
        parent::init();
        Yii::import('application.models.Forum.*');
        $this->userid = Yii::app()->user->getId();
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
            'user'      => User::model()->findByPk($this->userid),
        ));
        
    }

    public function actionEditor() 
    {
        $user = User::model()->findByPk($this->userid);
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
                    'departments'   => Department::model()->getDepartment()
            ));
        }
    }

    public function actionMessage()
    {
        $this->render('message', array(
            'articles'        => Article::model()->getUserArticles($this->userid)
        ));
    }

    public function actionMessageReply()
    {
        if ( isset($_GET['aid']) )
        {
            $this->render('messagereply', array( //還要再判斷是否有推文或回復---不然回是空值耶
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

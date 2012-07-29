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
        $url = Yii::app()->baseUrl . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'avatars';
        if ( isset($_POST['form-profile-editor']) )
        {
            $this->redirect(array('profile/editor'));
        }
        else if ( isset($_POST['form-profile-back']) )
        {
            $this->redirect(array('friends/friends'));
        }
        else
        {
            $this->render('profile', array(
                'user'      => User::model()->findByPk($id), 
                'target'    => $url
            ));
        }
    }

    public function actionEditor() 
    {
        $userID = Yii::app()->user->id;
        $img_url = Yii::app()->baseUrl . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'avatars';
        $path = dirname(Yii::app()->basePath) . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'avatars';
        $user = User::model()->findByPk($userID);
        $this->_data['token'] = Yii::app()->security->getToken();
        if ( isset($_POST['profile']) ) 
        {
            $user->attributes = $_POST['register'];
            if ( $user->validate() )
            {
                $profile = $user->profile;
                $profile->attributes = $_POST['profile'];
                $profile->department_id = $_POST['profile']['department'];
                $profile->grade = $_POST['profile']['grade'];
                // $profile->picture = $_FILES['picture']['name'];
                // $target = $path . DIRECTORY_SEPARATOR . $profile->picture;
                // move_uploaded_file($_FILES['picture']['tmp_name'], $target);
                // $picture_size = $_FILES['picture']['size'];
                // $picture_type = $_FILES['picture']['type'];
                if ( $profile->validate() )
                {
                    if ( $user->save() )
                    {
                        $profile->id = $user->id;
                        if ( $profile->save() )
                        {
                            $this->redirect(array('profile/profile'));
                        }
                    }
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
        $this->_data['token'] = Yii::app()->security->getToken();
        $this->render('message', array(
            'articles'        => Article::model()->getUserArticles($userID)
        ));
    }

    public function actionMessageReply()
    {
        $userID = Yii::app()->user->id;
        if ( isset($_GET['aid']) )
        {
            $this->render('messagereply', array(
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
            $userID = Yii::app()->user->id;
            $this->render('otherprofile', array(
                'user'       => User::model()->findByPk($_GET['friend_id'])
                
                
            ));
    }
}

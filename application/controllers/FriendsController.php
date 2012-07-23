<?php

class FriendsController extends Controller
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
            array(
                'deny',
                'users'     => array('*')
            )
        );
    }

    public function actionFriends() 
    {
        $userID = Yii::app()->user->id;
        $departmentId = Profile::model()->findByPK($userID)->department_id;
        $grade = Profile::model()->findByPK($userID)->grade;
        $imgUrl = Yii::app()->baseUrl . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'avatars';
        if ( isset($_POST['addgroup']) )
        {
            foreach ( $_POST['friends'] as $friend )
            {   
                $nameofgroup = new NameOfGroup();
                $nameofgroup->name = $_POST['group-name'];
                $group = new Group();
                $group->user_id = Yii::app()->user->id;
                $group->friend_id = $friend;
                $group->save();
                $group = new Friend();
                $group->user_id = $friend;
                $group->friend_id = Yii::app()->user->id;
                $group->save();
            }
            $this->redirect(array('friends/friends'));
        }
        $this->setPageTitle(Yii::app()->name . ' - 好友專區');
        $this->render('friends', array(
            'profileFir'    => Profile::model()->getSameDepartmentSameGrade($departmentId, $grade),
            'profileSec'    => Profile::model()->getSameDepartmentDiffGrade($departmentId, $grade),
            'profileThir'   => Profile::model()->getOtherDepartment($departmentId, $grade),
            'profileFor'    => User::model()->findByPk($userID),                   
            'profiles'      => Profile::model()->getAllMember(), 
            'user'          => User::model()->findByPk($userID),
            'target'        => $imgUrl
        ));
    }

    public function actionSameDepartmentSameGrade() 
    {
        $userID = Yii::app()->user->id;
        $departmentId = Profile::model()->findByPK($userID)->department_id;
        $grade = Profile::model()->findByPK($userID)->grade;
        $imgUrl = Yii::app()->baseUrl . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'avatars';
        $this->setPageTitle(Yii::app()->name . ' - 同系同屆');
        $this->_data['token'] = Yii::app()->security->getToken();
        $this->render('samedepartmentsamegrade', array(
            'profiles'      => Profile::model()->getSameDepartmentSameGrade($departmentId, $grade),
            'user'          => User::model()->findByPk($userID),
            'target'        => $imgUrl
        ));
    }

    public function actionSameDepartmentDiffGrade() 
    {
        $userID = Yii::app()->user->id;
        $departmentId = Profile::model()->findByPK($userID)->department_id;
        $grade = Profile::model()->findByPK($userID)->grade;
        $imgUrl = Yii::app()->baseUrl . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'avatars';
        $this->setPageTitle(Yii::app()->name . ' - 同系不同屆');
        $this->render('samedepartmentdiffgrade', array(
            'profiles'      => Profile::model()->getSameDepartmentDiffGrade($departmentId, $grade),
            'user'          => User::model()->findByPk($userID),
            'target'        => $imgUrl
        ));
    }

    public function actionOtherDepartment() 
    {
        $userID = Yii::app()->user->id;
        $departmentId  = Profile::model()->findByPK($userID)->department_id;
        $imgUrl = Yii::app()->baseUrl . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'avatars';
        $this->setPageTitle(Yii::app()->name . ' - 其他科系');
        $this->render('otherdepartment', array(
            'profiles'      => Profile::model()->getOtherDepartment($departmentId),
            'user'          => User::model()->findByPk($userID),
            'target'        => $imgUrl
        ));
    }

    public function actionMyFriends()
    {
        $userID = Yii::app()->user->id;
        $imgUrl = Yii::app()->baseUrl . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'avatars';
        $this->setPageTitle(Yii::app()->name . ' - 我的好友');
        $this->_data['token'] = Yii::app()->security->getToken();
        $this->render('myfriends', array(                
            'user'          => User::model()->findByPk($userID),
            'target'        => $imgUrl
        ));
    }

    public function actionMakeFriends()
    {
        if (
            isset($_POST['samedepartmentsamegrade-ensure'])
         || isset($_POST['samedepartmentdiffgrade-ensure'] )
         || isset($_POST['otherdepartment-ensure'])
        )
        {
            foreach ( $_POST['friends'] as $friend )
            {   
                $userId = Yii::app()->user->id;
                if ( $userId<>$friend )
                {
                    $model = new Friend();
                    $model->user_id = $userId;
                    $model->friend_id = $friend;
                    $model->save();
                    $model = new Friend();
                    $model->user_id = $friend;
                    $model->friend_id = $userId;
                    $model->save();
                }
            }
            $this->redirect(array('friends/friends'));
        }
        else if ( isset($_POST['samedepartmentsamegrade-rechoose']) )
        {
            $this->redirect(array('friends/samedepartmentsamegrade'));
        }
        else if ( isset($_POST['samedepartmentdiffgrade-rechoose']) )
        {
             $this->redirect(array('friends/samedepartmentdiffgrade'));
        }
        else if ( isset($_POST['otherdepartmente-rechoose']) )
        {
            $this->redirect(array('friends/otherdepartmente'));
        }
        else
        {
            $this->redirect(array('friends/friends'));
        }
    }
    
    public function actionDeleteFriends()
    {
        if ( isset($_POST['myfriends-cancel']) && isset($_POST['friends']) )
        {
            foreach ( $_POST['friends'] as $cancelfriend )
            {   
                $data1 = Friend::model()->find(array(
                    'condition' => 'user_id = :user_id AND friend_id = :friend_id',
                    'params'    => array(
                        ':user_id'      => Yii::app()->user->id,
                        ':friend_id'    => $cancelfriend 
                    )
                ));
                Friend::model()->deleteByPk($data1->id);
                $data2 = Friend::model()->find(array(
                    'condition' => 'user_id = :user_id AND friend_id = :friend_id',
                    'params'    => array(
                        ':user_id'      => $cancelfriend,
                        ':friend_id'    => Yii::app()->user->id 
                    )
                ));
                Friend::model()->deleteByPk($data2->id); 
            }   
        }
        $this->redirect(array('friends/friends'));
    }

}
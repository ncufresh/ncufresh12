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
            $group = new Group();        
            $group->user_id = $userID;
            $group->name = $_POST['group-name'];
            $group->description = $_POST['group-description'];
            $group->save(); 
            if ( $group->save() ) 
            {
                foreach ( $_POST['friends'] as $friend )
                {
                    $self_group = new UserGroup();
                    $self_group->user_id = $friend;
                    $self_group->group_id = $group->id;
                    $self_group->save();
                }
            }
        }
        
        $this->setPageTitle(Yii::app()->name . ' - 好友專區');
        $this->render('friends', array(
            'profileFir'    => Profile::model()->getSameDepartmentSameGrade($departmentId, $grade),
            'profileSec'    => Profile::model()->getSameDepartmentDiffGrade($departmentId, $grade),
            'profileThir'   => Profile::model()->getOtherDepartment($departmentId, $grade),
            'profileFor'    => User::model()->findByPk($userID),                   
            'profiles'      => Profile::model()->getAllMember(), 
            'user'          => User::model()->findByPk($userID),
            'group'         => Group::model()->findByPk($userID),
            'amonut'        => Group::model()->getGroupAmount($userID),
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
        $this->_data['token'] = Yii::app()->security->getToken();
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
        $this->_data['token'] = Yii::app()->security->getToken();
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
            $userId = Yii::app()->user->id;
            $model = new Friend();
            $model->user_id = $userId;
            $model->friend_id = $userId;
            $model->save();
            foreach ( $_POST['friends'] as $friend )
            {   
                if ( $userId<>$friend )
                {
                    $model = new Friend();
                     if ( $model->user_id<>$userId &&  $model->friend_id<>$friend )
                     {
                        $model->user_id = $userId;
                        $model->friend_id = $friend;
                        $model->save();
                        $model = new Friend();
                        $model->user_id = $friend;
                        $model->friend_id = $userId;
                        $model->save();
                    }
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
        else if ( isset($_POST['otherdepartment-rechoose']) )
        {
            $this->redirect(array('friends/otherdepartment'));
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

    public function actionMyGroups()
    {
        $userID = Yii::app()->user->id;
        $imgUrl = Yii::app()->baseUrl . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'avatars';   
        $this->setPageTitle(Yii::app()->name . ' - 我的群組');
        if ( isset($_POST['friends'] ) && isset ( $_GET['id'] ) )
        {   
            foreach ( $_POST['friends'] as $friend )
            {
                $_exist=false;
                $group = new UserGroup();
                foreach ( $group->getMemberId($_GET['id']) as $member )
                {
                    if (  $member->user_id === $friend )
                    {
                        $_exist=true;
                    }
                }
                if ( !$_exist )
                {
                        $group->user_id = $friend;
                        $group->group_id = $_GET['id'];
                        $group->save();
                }
            } 
            if ( $group->save() )
            {
                $this->redirect(Yii::app()->createUrl('friends/mygroups', array('id'=>$_GET['id'])));
            } 
        } 
        else if ( isset($_GET['id']) )
        {
            $this->render('mygroups', array(
                'user'          => User::model()->findByPk($userID),
                'members'         => UserGroup::model()->getMemberId($_GET['id']), //得到社團ID
                'mygroup'       =>Group::model()->findByPK($_GET['id']),
                'target'        => $imgUrl
            ));
        }
        else
        {
            $this->redirect(array('friends/friends'));
        }
    }

    public function actionDeleteGroupFriends()
    {
        if ( isset($_POST['mygroups-cancel']) && isset($_POST['members']) )
        {
            foreach ( $_POST['members'] as $cancelmember )
            {   
                $data1 = UserGroup::model()->find(array(
                    'condition' => 'user_id = :user_id AND group_id = :group_id',
                    'params'    => array(
                        ':user_id'      => $cancelmember,
                        ':group_id'      => $_POST['groupID']
                    )
                ));
                UserGroup::model()->deleteByPk($data1->id);  
            } 
            $this->redirect(Yii::app()->createUrl('friends/mygroups', array('id'=>$_POST['groupID'])));
        }
        else
        {
            $this->redirect(array('friends/friends'));
        }
    }
}
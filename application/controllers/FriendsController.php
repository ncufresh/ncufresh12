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
        $this->setPageTitle(Yii::app()->name . ' - 好友專區');
        $this->render('friends', array(
            'profileFir'    => Profile::model()->getSameDepartmentSameGrade($departmentId, $grade, $userID),
            'profileSec'    => Profile::model()->getSameDepartmentDiffGrade($departmentId, $grade),
            'profileThir'   => Profile::model()->getOtherDepartment($departmentId, $grade),    
            'profiles'      => Profile::model()->getAllMember(), 
            'user'          => User::model()->findByPk($userID),
            'groups'         => Group::model()->FindGroup($userID),
            'amonut'        => Group::model()->getGroupAmount($userID),
            'friend_amount'        => Friend::model()->getAmount($userID)
        ));
    }

    public function actionSameDepartmentSameGrade() 
    {
        $userID = Yii::app()->user->id;
        $departmentId = Profile::model()->findByPK($userID)->department_id;
        $grade = Profile::model()->findByPK($userID)->grade;
        $this->setPageTitle(Yii::app()->name . ' - 同系同屆');
        $this->render('samedepartmentsamegrade', array(
            'profiles'      => Profile::model()->getSameDepartmentSameGrade($departmentId, $grade, $userID),
        ));
    }

    public function actionSameDepartmentDiffGrade() 
    {
        $userID = Yii::app()->user->id;
        $departmentId = Profile::model()->findByPK($userID)->department_id;
        $grade = Profile::model()->findByPK($userID)->grade;
        $this->setPageTitle(Yii::app()->name . ' - 同系不同屆');
        $this->render('samedepartmentdiffgrade', array(
            'profiles'      => Profile::model()->getSameDepartmentDiffGrade($departmentId, $grade)
        ));
    }

    public function actionOtherDepartment() 
    {
        $userID = Yii::app()->user->id;
        $departmentId  = Profile::model()->findByPK($userID)->department_id;
        $this->setPageTitle(Yii::app()->name . ' - 其他科系');
        $this->render('otherdepartment', array(
            'profiles'      => Profile::model()->getOtherDepartment($departmentId)
        ));
    }

    public function actionMyFriends()
    {
        $userID = Yii::app()->user->id;
        $this->setPageTitle(Yii::app()->name . ' - 我的好友');
        $this->render('myfriends', array(                
            'user'          => User::model()->findByPk($userID)
        ));
    }

    public function actionMakeFriends() 
    {
        $userId = Yii::app()->user->id;
        if ( isset($_POST['friends']) )
        {
            foreach ( $_POST['friends'] as $friendid )
            {   
                $friend = new Friend();
                $exist = $friend->isExist($userId,$friendid);
                if ( $userId <> $friendid && !$exist )
                {
                    $friend->addFriend($userId, $friendid);
                    $friend->makeFriend($userId, $friendid);
                }
            }
            $this->redirect(array('friends/myfriends'));
        }
        else if( isset($_GET['friend_id']) )
        {
            $friend = new Friend();
            $exist = $friend->isExist($userId, $_GET['friend_id']);
            if ( $userId <> $_GET['friend_id']&& !$exist )
            {
                $friend->addFriend($userId, $_GET['friend_id']);
                $friend->makeFriend($userId, $_GET['friend_id']);
            }
        }
        $this->redirect(array('friends/friends'));
    }

    public function actionDeleteFriends()
    {
        $userID = Yii::app()->user->id;
        if ( isset($_POST['friends']) )
        {
            foreach ( $_POST['friends'] as $cancelfriend )
            {
                Friend::model()->deleteFriend($userID, $cancelfriend);
            }
            $this->redirect(array('friends/myfriends'));            
        }
        $this->redirect(array('friends/myfriends'));
    }

    public function actionMyGroups()
    {
        $userID = Yii::app()->user->id;   
        $this->setPageTitle(Yii::app()->name . ' - 我的群組');
        if ( isset($_GET['id']) )
        {
            $this->render('mygroups', array(
                'user'          => User::model()->findByPk($userID),
                'members'         => UserGroup::model()->getMembers($_GET['id']), 
                'mygroup'       =>Group::model()->findByPK($_GET['id'])
            ));
        }
        else
        {
            $this->redirect(array('friends/friends'));
        }
    }

    public function actionAddNewMembers()
    {
        $userID = Yii::app()->user->id;
        $this->setPageTitle(Yii::app()->name . ' - 新增成員');
        if ( isset($_POST['friends'] ) && isset( $_GET['id'] ) )
        {
            foreach ( $_POST['friends'] as $friendid )
            {   
                $usergroup = new UserGroup();
                $exist = $usergroup->isExist($friendid,$_GET['id']);
                if ( $exist && $usergroup->openMember($friendid, $_GET['id']) )
                {
                }
                else if ( !$exist && $usergroup->AddNewMember($friendid, $_GET['id']) )
                {
                }
                else
                {
                    echo '新增成員失敗了';
                }
            }
            $this->redirect(Yii::app()->createUrl('friends/mygroups', array('id'=>$_GET['id'])));
        }
        else
        {
            $this->redirect(Yii::app()->createUrl('friends/newmembers', array('id'=>$_GET['id'])));
        }
    }

    public function actionDeleteMembers()
    {
        if ( isset($_POST['members']) && isset($_GET['id']))
        {
            foreach ( $_POST['members'] as $cancelmember )
            {   
                $close = UserGroup::model()->closeMember($cancelmember,$_GET['id']);
                if ( !$close )
                {
                    echo '沒有兩筆資料存在喔';
                }
            } 
            $this->redirect(Yii::app()->createUrl('friends/mygroups', array('id'=>$_GET['id'])));
        }
        else
        {
            $this->redirect(Yii::app()->createUrl('friends/mygroups', array('id'=>$_GET['id'])));
        }
    }

    public function actionNewGroup()
    {
        $userID = Yii::app()->user->id;
        $departmentId = Profile::model()->findByPK($userID)->department_id;
        $grade = Profile::model()->findByPK($userID)->grade;
        if ( isset($_POST['friends']) )
        {
            if ( !Group::model()->addNewGroup($userID, $_POST['group-name'], $_POST['group-description'], $_POST['friends']) )
            {
                echo '群組沒有存成功喔';
            }
            $this->redirect(array('friends/friends'));
        }
        else
        {
            $this->render('newgroup', array(
                'user'          => User::model()->findByPk($userID)
            ));
        }
    }

    public function actionDeleteGroup()
    {
        if ( isset ( $_GET['id'] ) )
        {
            $close = Group::model()->deleteGroup($_GET['id']);
            if ( $close )
            {
                foreach ( UserGroup::model()->getMembers($_GET['id']) as $cancelmember )
                {   
                    $close = UserGroup::model()->closeMember($cancelmember->user_id,$_GET['id']);
                    if ( !$close )
                    {
                        echo '沒有刪除所有成員耶';
                    }
                } 
                $this->redirect(array('friends/allgroups'));
            }
            else
            {
                echo '沒有兩筆資料存在喔';
            }
            $this->redirect(array('friends/friends'));
        }
        else
        {
            $this->redirect(array('friends/myfriends'));
        }
    }

   public function actionNewMembers() //新增成員的頁面
   {
        $userID = Yii::app()->user->id;
        $this->setPageTitle(Yii::app()->name . ' - 我的好友');
        $user = User::model()->findByPk($userID);
        if( isset($_GET['id']) ) 
        {
            $this->render('newmembers', array(                
                'user'          => User::model()->findByPk($userID),
                'id'            => $_GET['id']
            ));
        }
        else
        {
             $this->redirect(array('friends/myfriends'));
        }
   }

   public function actionAllGroups()
   {
        $userID = Yii::app()->user->id;
        $this->render('allgroups', array(
            'groups'         => Group::model()->FindGroup($userID)
        ));
   }

   public function actionRequest() //確認好友關係
   {
        $userID = Yii::app()->user->id;
        if ( isset($_POST['friends']) && isset($_POST['agree']) )
        {
            foreach ( $_POST['friends'] as $friendid )
            {   
                $friend = new Friend();
                $exist = $friend->isExist($userID,$friendid);
                if ( $userID <> $friendid && !$exist )
                {
                    $friend->addFriend($userID, $friendid);
                    $friend->makeFriend($userID, $friendid);
                }
            }
            $this->redirect(array('friends/myfriends'));
        }
        else if ( isset($_POST['friends']) && isset($_POST['cancel']) )
        {
            foreach ( $_POST['friends'] as $cancelfriend )
            {
                Friend::model()->deleteFriend($userID, $cancelfriend);
            }
            $this->redirect(array('friends/myfriends'));      
        }
        $this->render('request', array(
            'friends'         => Friend::model()->getRequests($userID)
        ));
   }
}
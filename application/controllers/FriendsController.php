<?php

class FriendsController extends Controller
{
    public $userid;

    public function init()
    {
        parent::init();
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

    public function actionFriends() 
    {
        $departmentId = Profile::model()->findByPK($this->userid)->department_id;
        $grade = Profile::model()->findByPK($this->userid)->grade;
        $this->setPageTitle(Yii::app()->name . ' - 好友專區');
        $this->render('friends', array(
            'profileFir'    => Profile::model()->getSameDepartmentSameGrade($departmentId, $grade, $this->userid),
            'profileSec'    => Profile::model()->getSameDepartmentDiffGrade($departmentId, $grade),
            'profileThir'   => Profile::model()->getOtherDepartment($departmentId, $grade),    
            'profiles'      => Profile::model()->getAllMember(), 
            'user'          => User::model()->findByPk($this->userid),
            'groups'         => Group::model()->FindGroup($this->userid),
            'amonut'        => Group::model()->getGroupAmount($this->userid),
            'friend_amount'        => Friend::model()->getAmount($this->userid)
        ));
    }

    public function actionSameDepartmentSameGrade() 
    {
        $departmentId = Profile::model()->findByPK($this->userid)->department_id;
        $grade = Profile::model()->findByPK($this->userid)->grade;
        $this->setPageTitle(Yii::app()->name . ' - 同系同屆');
        $this->render('samedepartmentsamegrade', array(
            'profiles'      => Profile::model()->getSameDepartmentSameGrade($departmentId, $grade, $this->userid),
        ));
    }

    public function actionSameDepartmentDiffGrade() 
    {
        $departmentId = Profile::model()->findByPK($this->userid)->department_id;
        $grade = Profile::model()->findByPK($this->userid)->grade;
        $this->setPageTitle(Yii::app()->name . ' - 同系不同屆');
        $this->render('samedepartmentdiffgrade', array(
            'profiles'      => Profile::model()->getSameDepartmentDiffGrade($departmentId, $grade)
        ));
    }

    public function actionOtherDepartment() 
    {
        $departmentId  = Profile::model()->findByPK($this->userid)->department_id;
        $this->setPageTitle(Yii::app()->name . ' - 其他科系');
        $this->render('otherdepartment', array(
            'profiles'      => Profile::model()->getOtherDepartment($departmentId)
        ));
    }

    public function actionMyFriends()
    {
        $this->setPageTitle(Yii::app()->name . ' - 我的好友');
        $this->render('myfriends', array(                
            'user'          => User::model()->findByPk($this->userid)
        ));
    }

    public function actionMakeFriends() 
    {
        if ( isset($_POST['friends']) )
        {
            foreach ( $_POST['friends'] as $friendid )
            {   
                $friend = new Friend();
                $exist = $friend->isExist($this->userid,$friendid);
                if ( $this->userid <> $friendid && !$exist )
                {
                    $friend->addFriend($this->userid, $friendid);
                    $friend->makeFriend($this->userid, $friendid);
                }
            }
            $this->redirect(array('friends/myfriends'));
        }
        else if( isset($_GET['friend_id']) )
        {
            $friend = new Friend();
            $exist = $friend->isExist($this->userid, $_GET['friend_id']);
            if ( $this->userid <> $_GET['friend_id']&& !$exist )
            {
                $friend->addFriend($this->userid, $_GET['friend_id']);
                $friend->makeFriend($this->userid, $_GET['friend_id']);
            }
        }
        $this->redirect(array('friends/friends'));
    }

    public function actionDeleteFriends()
    {
        if ( isset($_POST['friends']) )
        {
            foreach ( $_POST['friends'] as $cancelfriend )
            {
                Friend::model()->deleteFriend($this->userid, $cancelfriend);
            }
            $this->redirect(array('friends/myfriends'));            
        }
        $this->redirect(array('friends/myfriends'));
    }

    public function actionMyGroups()
    {   
        $this->setPageTitle(Yii::app()->name . ' - 我的群組');
        if ( isset($_GET['id']) )
        {
            $this->render('mygroups', array(
                'user'          => User::model()->findByPk($this->userid),
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
        $departmentId = Profile::model()->findByPK($this->userid)->department_id;
        $grade = Profile::model()->findByPK($this->userid)->grade;
        if ( isset($_POST['friends']) )
        {
            if ( !Group::model()->addNewGroup($this->userid, $_POST['group-name'], $_POST['group-description'], $_POST['friends']) )
            {
                echo '群組沒有存成功喔';
            }
            $this->redirect(array('friends/friends'));
        }
        else
        {
            $this->render('newgroup', array(
                'user'          => User::model()->findByPk($this->userid)
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
        $this->setPageTitle(Yii::app()->name . ' - 我的好友');
        $user = User::model()->findByPk($this->userid);
        if( isset($_GET['id']) ) 
        {
            $this->render('newmembers', array(                
                'user'          => User::model()->findByPk($this->userid),
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
        $this->render('allgroups', array(
            'groups'         => Group::model()->FindGroup($this->userid)
        ));
   }

   public function actionRequest() //確認好友關係
   {
        if ( isset($_POST['friends']) && isset($_POST['agree']) )
        {
            foreach ( $_POST['friends'] as $friendid )
            {   
                $friend = new Friend();
                $exist = $friend->isExist($this->userid, $friendid);
                if ( $this->userid <> $friendid && !$exist )
                {
                    $friend->addFriend($this->userid, $friendid);
                    $friend->makeFriend($this->userid, $friendid);
                }
            }
            $this->redirect(array('friends/myfriends'));
        }
        else if ( isset($_POST['friends']) && isset($_POST['cancel']) )
        {
            foreach ( $_POST['friends'] as $cancelfriend )
            {
                Friend::model()->deleteFriend($this->userid, $cancelfriend);
            }
            $this->redirect(array('friends/myfriends'));      
        }
        $this->render('request', array(
            'friends'         => Friend::model()->getRequests($this->userid)
        ));
   }
}
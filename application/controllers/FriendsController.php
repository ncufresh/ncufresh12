<?php

class FriendsController extends Controller
{
    public $userId;

    public $user;

    public $departmentId;

    public function init()
    {
        parent::init();
        $this->userId = Yii::app()->user->getId();
        $this->user = User::model()->findByPk($this->userId);
        $this->departmentId = Profile::model()->findByPK($this->userId);
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
        $grade = Profile::model()->findByPK($this->userId)->grade;
        $this->setPageTitle(Yii::app()->name . ' - 好友專區');
        $this->render('friends', array(
            'profileFir'    => Profile::model()->getSameDepartmentSameGrade($this->departmentId->department_id, $grade),
            'profileSec'    => Profile::model()->getSameDepartmentDiffGrade($this->departmentId->department_id, $grade),
            'profileThir'   => Profile::model()->getOtherDepartment($this->departmentId->department_id, $grade),    
            'profiles'      => Profile::model()->getAllMember(), 
            'user'          => User::model()->findByPk($this->userId),
            'groups'        => Group::model()->FindGroup($this->userId),
            'amonut'        => Group::model()->getGroupAmount($this->userId),
            'friend_amount' => Friend::model()->getAmount()
        ));
    }

    public function actionSameDepartmentSameGrade() 
    {
        $grade = Profile::model()->findByPK($this->userId)->grade;
        $this->setPageTitle(Yii::app()->name . ' - 同系同屆');
        $this->render('samedepartmentsamegrade', array(
            'profiles'      => Profile::model()->getSameDepartmentSameGrade($this->departmentId->department_id, $grade),
        ));
    }

    public function actionSameDepartmentDiffGrade() 
    {
        $grade = Profile::model()->findByPK($this->userId)->grade;
        $this->setPageTitle(Yii::app()->name . ' - 同系不同屆');
        $this->render('samedepartmentdiffgrade', array(
            'profiles'      => Profile::model()->getSameDepartmentDiffGrade($this->departmentId->department_id, $grade)
        ));
    }

    public function actionOtherDepartment() 
    {
        $this->setPageTitle(Yii::app()->name . ' - 其他科系');
        $this->render('otherdepartment', array(
            'profiles'      => Profile::model()->getOtherDepartment($this->departmentId->department_id)
        ));
    }

    public function actionMyFriends()
    {
        $this->setPageTitle(Yii::app()->name . ' - 我的好友');
        $this->render('myfriends', array(                
            'user'          => $this->user
        ));
    }

    public function actionMakeFriends() 
    {
        if ( isset($_POST['friends']) )
        {
            foreach ( $_POST['friends'] as $friendid )
            {   
                $friend = new Friend();
                $exist = $friend->isExist($friendid);
                if ( $this->userId !== $friendid && ! $exist )
                {
                    $friend->addFriend($friendid);
                    $friend->makeFriend($friendid);
                }
            }
            $this->redirect(array('friends/myfriends'));
        }
        $this->redirect(array('friends/friends'));
    }

    public function actionDeleteFriends()
    {
        if ( isset($_POST['friends']) )
        {
            foreach ( $_POST['friends'] as $cancelfriend )
            {
                Friend::model()->deleteFriend($cancelfriend);
            }         
        }
        $this->redirect(array('friends/myfriends'));
    }

    public function actionMyGroups($id)
    {   
        $this->setPageTitle(Yii::app()->name . ' - 我的群組');
        $this->render('mygroups', array(
            'user'          => $this->user,
            'members'       => UserGroup::model()->getMembers($id), 
            'mygroup'       => Group::model()->findByPK($id)
        ));
    }

    public function actionAddNewMembers($id)
    {
        $this->setPageTitle(Yii::app()->name . ' - 新增成員');
        if ( isset($_POST['friends']) )
        {
            foreach ( $_POST['friends'] as $friendid )
            {   
                $usergroup = new UserGroup();
                $exist = $usergroup->isExist($friendid, $id);
                if ( $exist && $usergroup->openMember($friendid, $id) )
                {
                }
                else if ( ! $exist && $usergroup->AddNewMember($friendid, $id) )
                {
                }
            }
            $this->redirect(array('friends/mygroups', 'id' => $id));
        }
        $this->redirect(array('friends/newmembers', 'id' => $id));
    }

    public function actionDeleteMembers($id)
    {
        if ( isset($_POST['group-members']) )
        {
            foreach ( $_POST['group-members'] as $cancelmember )
            {   
                $close = UserGroup::model()->closeMember($cancelmember, $id);
                if ( ! $close )
                {
                }
            } 
            $this->redirect(array('friends/mygroups', 'id'=> $id));
        }
        $this->redirect(array('friends/mygroups', 'id'=> $id));
    }

    public function actionNewGroup()
    {
        $grade = Profile::model()->findByPK($this->userId)->grade;
        if ( isset($_POST['friends']) )
        {
            if ( ! Group::model()->addNewGroup($this->userId, $_POST['group-name'], $_POST['group-description'], $_POST['friends']) )
            {
            }
            $this->redirect(array('friends/friends'));
        }
        $this->render('newgroup', array(
            'user'          => $this->user
        ));
    }

    public function actionDeleteGroup($id)
    {
        $close = Group::model()->deleteGroup($id);
        if ( $close )
        {
            foreach ( UserGroup::model()->getMembers($id) as $cancelmember )
            {   
                $close = UserGroup::model()->closeMember($cancelmember->user_id, $id);
                if ( ! $close )
                {
                }
            } 
            $this->redirect(array('friends/allgroups'));
        }
        $this->redirect(array('friends/friends'));
    }

   public function actionNewMembers($id) //新增成員的頁面
   {
        $this->setPageTitle(Yii::app()->name . ' - 我的好友');
        $this->render('newmembers', array(                
            'friends'       => Friend::model()->getFriendsNotInGroup($id),
            'id'            => $id
        ));
   }

   public function actionAllGroups()
   {
        $this->render('allgroups', array(
            'groups'         => Group::model()->FindGroup($this->userId)
        ));
   }

   public function actionRequest() //確認好友關係
   {
        if ( isset($_POST['friends']) && isset($_POST['agree']) )
        {
            foreach ( $_POST['friends'] as $friendid )
            {   
                $friend = new Friend();
                $exist = $friend->isExist($friendid);
                if ( $this->userId !== $friendid && ! $exist )
                {
                    $friend->addFriend($friendid);
                    $friend->makeFriend($friendid);
                }
            }
            $this->redirect(array('friends/myfriends'));
        }
        else if ( isset($_POST['friends']) && isset($_POST['cancel']) )
        {
            foreach ( $_POST['friends'] as $cancelfriend )
            {
                Friend::model()->deleteFriend($cancelfriend);
            }
            $this->redirect(array('friends/myfriends'));      
        }
        $this->render('request', array(
            'friends'         => Friend::model()->getRequests()
        ));
   }

}
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
        $this->setPageTitle(Yii::app()->name . ' - 好友專區');
        $this->render('friends', array(
            'profileFir'    => Profile::model()->getSameDepartmentSameGrade($departmentId, $grade),
            'profileSec'    => Profile::model()->getSameDepartmentDiffGrade($departmentId, $grade),
            'profileThir'   => Profile::model()->getOtherDepartment($departmentId, $grade),    'profiles'      => Profile::model()->getAllMember(), 
            'user'          => User::model()->findByPk($userID),
            'groups'         => Group::model()->FindGroup($userID),
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
        $userId = Yii::app()->user->id;
        if ( isset($_POST['friends']) )
        {
            
            foreach ( $_POST['friends'] as $friendid )
            {   
                $friend = new Friend();
                $exist = $friend->isExist($userId, $friendid);
                if ( $exist && $friend->openFriend($userId, $friendid) )
                {
                }
                else if ( !$exist && $friend->addFriend($userId, $friendid) )
                {
                }
                else
                {
                    echo '交友失敗了= =';
                }
            }
            $this->redirect(array('friends/myfriends'));
        }
        else
        {
            $this->redirect(array('friends/friends'));
        }
    }

    public function actionDeleteFriends()
    {
        $userID = Yii::app()->user->id;
        if ( isset($_POST['friends']) )
        {
            foreach ( $_POST['friends'] as $cancelfriend )
            {   
                $close = Friend::model()->closeFriend($userID,$cancelfriend);
                if ( !$close )
                {
                    echo '沒有兩筆資料存在喔';
                    break;
                }
             }
            $this->redirect(array('friends/myfriends'));            
        }
        else
        {
            $this->redirect(array('friends/myfriends'));
        }
    }

    public function actionMyGroups()
    {
        $userID = Yii::app()->user->id;
        $imgUrl = Yii::app()->baseUrl . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'avatars';   
        $this->setPageTitle(Yii::app()->name . ' - 我的群組');
        if ( isset($_GET['id']) )
        {
            $this->render('mygroups', array(
                'user'          => User::model()->findByPk($userID),
                'members'         => UserGroup::model()->getMembers($_GET['id']), //得到社團ID
                'mygroup'       =>Group::model()->findByPK($_GET['id']),
                'target'        => $imgUrl
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
        $imgUrl = Yii::app()->baseUrl . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'avatars';   
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
        $imgUrl = Yii::app()->baseUrl . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'avatars';
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
                'user'          => User::model()->findByPk($userID),
                'target'        => $imgUrl
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

   public function actionNewMembers()
   {
        $userID = Yii::app()->user->id;
        $imgUrl = Yii::app()->baseUrl . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'avatars';
        $this->setPageTitle(Yii::app()->name . ' - 我的好友');
        $user = User::model()->findByPk($userID);
        $this->_data['token'] = Yii::app()->security->getToken();
        if( isset($_GET['id']) ) 
        {
            $this->render('newmembers', array(                
                'user'          => User::model()->findByPk($userID),
                'id'            => $_GET['id'],
                'target'        => $imgUrl
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
}
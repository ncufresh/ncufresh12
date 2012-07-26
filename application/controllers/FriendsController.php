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
        // Friend::model()->getMyFriend(1)
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
                   echo '又是朋友咯';
                }
                else if ( !$exist && $friend->addFriend($userId, $friendid) )
                {
                    echo '存成功兩筆資料';
                }
                else
                {
                    break;
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
                   echo '又是朋友咯';
                }
                else if ( !$exist && $usergroup->AddNewMember($friendid, $_GET['id']) )
                {
                    echo '存成功兩筆資料';
                }
                else
                {
                    break;
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
                    break;
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
            $group = new Group();
            $group->user_id = $userID;
            $group->name = $_POST['group-name'];
            $group->description = $_POST['group-description'];
            $save = $group->save(); 
            if ( isset($save) ) 
            {
                foreach ( $_POST['friends'] as $friend )
                {
                    $self_group = new UserGroup();
                    $self_group->user_id = $friend;
                    $self_group->group_id = $group->id;
                    $save = $self_group->save();
                }
                if ( isset($save) )
                {
                    $this->render('newgroup', array(
                        'user'          => User::model()->findByPk($userID),
                        'target'        => $imgUrl
                    ));
                }
            }
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
            Group::model()->deleteByPk($_GET['id']);
            UserGroup::model()->deleteAll(array(
                'condition' => 'group_id = :id',
                'params'    => array(
                    ':id' => $_GET['id'] 
                )
            ));
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
}
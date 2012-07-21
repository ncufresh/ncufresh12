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
            ),
        );
    }

    public function actionFriends() 
    {
        $userID = Yii::app()->user->id;
        $departmentId  = Profile::model()->findByPK($userID)->department_id;
        $grade = Profile::model()->findByPK($userID)->grade;
        $img_url = Yii::app()->baseUrl . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'avatars';
        $this->setPageTitle(Yii::app()->name . ' - 好友專區');
        $this->render('friends', array(
            'profileFir'=>Profile::model()->getSameDepartmentSameGrade($departmentId, $grade),
            'profileSec'=>Profile::model()->getSameDepartmentDiffGrade($departmentId, $grade),
            'profileThir'=>Profile::model()->getOtherDepartment($departmentId, $grade),
            'profileFor'=>User::model()->findByPk($userID),           
            'target'=>$img_url
        ));
    }

    public function actionSameDepartmentSameGrade() 
    {
        $userID = Yii::app()->user->id;
        $departmentId  = Profile::model()->findByPK($userID)->department_id;
        $grade = Profile::model()->findByPK($userID)->grade;
        $img_url = Yii::app()->baseUrl . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'avatars';
        $this->setPageTitle(Yii::app()->name . ' - 同系同屆');
        $this->_data['token'] = Yii::app()->security->getToken();
        $this->render('samedepartmentsamegrade', array(
            'profiles'=>Profile::model()->getSameDepartmentSameGrade($departmentId, $grade),/*自己的department_id*/
            'target'=>$img_url
        ));
    }

    public function actionSameDepartmentDiffGrade() 
    {
        $userID = Yii::app()->user->id;
        $departmentId  = Profile::model()->findByPK($userID)->department_id;
        $grade = Profile::model()->findByPK($userID)->grade;
        $img_url = Yii::app()->baseUrl . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'avatars';
        $this->setPageTitle(Yii::app()->name . ' - 同系不同屆');
        $this->render('samedepartmentdiffgrade', array(
            'profiles'=>Profile::model()->getSameDepartmentDiffGrade($departmentId, $grade),/*自己的department_id*/
            'target'=>$img_url
        ));
    }

    public function actionOtherDepartment() 
    {
        $userID = Yii::app()->user->id;
        $departmentId  = Profile::model()->findByPK($userID)->department_id;
        $img_url = Yii::app()->baseUrl . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'avatars';
        $this->setPageTitle(Yii::app()->name . ' - 其他科系');
        $this->render('otherdepartment', array(
            'profiles'=>Profile::model()->getOtherDepartment($departmentId),/*自己的department_id*/
            'target'=>$img_url
        ));
    }

    public function actionMyFriends()
    {
        $userID = Yii::app()->user->id;
        $img_url = Yii::app()->baseUrl . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'avatars';
        $this->setPageTitle(Yii::app()->name . ' - 我的好友');
        $this->_data['token'] = Yii::app()->security->getToken();
        $this->render('myfriends', array(                
            'user'=>User::model()->findByPk($userID),
            'target'=>$img_url
        ));
    }

    public function actionMakeFriends()
    {
        if ( isset($_POST['samedepartmentsamegrade-ensure']) || isset($_POST['samedepartmentdiffgrade-ensure'] ) || isset($_POST['otherdepartment-ensure']) )
        {
            foreach($_POST['friends'] as $friend)
            {   
                $model = new Friend();
                $model->user_id = Yii::app()->user->id;
                echo $friend;
                echo '<br />';
                $model->friend_id = $friend;
                $model->save();
                $model = new Friend();
                $model->user_id = $friend;
                $model->friend_id = Yii::app()->user->id;
                $model->save();
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
        if ( isset($_POST['myfriends-cancel']) &&  isset($_POST['friends']) )
        {
            foreach($_POST['friends'] as $Cancelfriend)
            {   
                $data1 = Friend::model()->find(array(
                    'condition' => 'user_id = :user_id AND friend_id = :friend_id',
                    'params'    => array(
                        ':user_id' => Yii::app()->user->id,
                        ':friend_id' => $Cancelfriend 
                    )
                ));
                Friend::model()->deleteByPk($data1->id);
                $data2 = Friend::model()->find(array(
                    'condition' => 'user_id = :user_id AND friend_id = :friend_id',
                    'params'    => array(
                        ':user_id' => $Cancelfriend,
                        ':friend_id' => Yii::app()->user->id 
                    )
                ));
                Friend::model()->deleteByPk($data2->id); 
            }   
        }
        $this->redirect(array('friends/friends'));
    }
}
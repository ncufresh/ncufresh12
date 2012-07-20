<?php

class FriendsController extends Controller
{
    public function actionFriends() 
    {
         $this->setPageTitle(Yii::app()->name . ' - 好友專區');
        $this->render('friends');
    }

    public function actionSameDepartmentSameGrade() 
    {
         $this->setPageTitle(Yii::app()->name . ' - 同系同屆');
         $this->render('samedepartmentsamegrade');
    }

    public function actionSameDepartmentDiffGrade() 
    {
        $this->setPageTitle(Yii::app()->name . ' - 同系不同屆');
        $this->render('samedepartmentdiffgrade');
    }

    public function actionOtherDepartment() 
    {
         $this->setPageTitle(Yii::app()->name . ' - 其他科系');
         $this->render('otherdepartment');
    }

    public function actionMyFriends()
    {
        $this->setPageTitle(Yii::app()->name . ' - 我的好友');
        $this->_data['token'] = Yii::app()->security->getToken();
        $this->render('myfriends', array(                
            // 'myfriendsId'  => Friend::model()->getFriendsId(/*要填入登入者的ID...先假設user_id=3*/3),
            /*'myfriendData'  => Friend::model()->findByFriendId(2),*/
            'user'=>User::model()->findByPk(3),
        ));
    }
}
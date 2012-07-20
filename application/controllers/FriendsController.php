<?php

class FriendsController extends Controller
{
    public function actionFriends() // 好友專區
    {
         $this->setPageTitle(Yii::app()->name . ' - 好友專區');
        $this->render('friends');
    }

    public function actionSameDepartmentSameGrade() // 好友專區
    {
         $this->setPageTitle(Yii::app()->name . ' - 同系同屆');
         $this->render('samedepartmentsamegrade');
    }

    public function actionSameDepartmentDiffGrade() // 好友專區
    {
        $this->setPageTitle(Yii::app()->name . ' - 同系不同屆');
        $this->render('samedepartmentdiffgrade');
    }

    public function actionOtherDepartment() // 好友專區
    {
         $this->setPageTitle(Yii::app()->name . ' - 其他科系');
         $this->render('otherdepartment');
    }

    public function acctionMyFriends()
    {
        
        $this->setPageTitle(Yii::app()->name . ' - 我的好友');
        $this->_data['token'] = Yii::app()->security->getToken();
        /*$this->render('myfriends', array(                
            'myfriendId'  => Friend::model()->getFriendsId(/*要填入登入者的ID...先假設user_id=3*//*3),
            'myfriendData'  => Friend::model()->findByFriendId(3),
        ));*/
    }
}
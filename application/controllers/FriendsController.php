<?php

class FriendsController extends Controller
{

    public function actionFriends() // 好友專區
    {
        echo "齁齁齁";
        if ( isset($_GET['id']) )
        {
            echo "進來了^^";
            $id = (integer)$_GET['id'];
            if ( $id === 1 ) // 同系同屆 
            {
                $this->redirect(array('friends/samedepartmentsamegrade'));
            }
            else if ( $id === 2 ) // 同系不同屆
            {
                $this->redirect(array('friends/samedepartmentdiffgrade'));
            }
            else if ($id === 3 ) // 其它科系
            {
                $this->redirect(array('friends/otherdepartment'));
            }
        }
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
}
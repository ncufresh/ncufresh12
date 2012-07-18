<?php

class DepartmentController extends Controller
{
    public function actionIndex()
    {
        $this->setPageTitle(Yii::app()->name);
        $this->render('friends');
    }

    public function actionSameDepartmentSameGrade() // 同系同屆
    {
    }

    public function actionSameDepartmentDiffGrade() // 同系不同屆
    {
    }

    public function actionOtherDepartment() // 其他科系
    {
    }
}
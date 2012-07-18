<?php

class DepartmentController extends Controller
{
	public function actionIndex()
    {
		$this->setPageTitle(Yii::app()->name);
        $this->render('friends');
	}public function actionSameDepartment_SameGrade() //同系同屆
    {
        
        
    }
    public function actionSameDepartment_DiffGrade() //同系不同屆
    {
        
    }
    public function actionOtherDepartment() //其他科系
    {
    
        
    }

}
?>
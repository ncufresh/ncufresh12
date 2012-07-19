<?php

  class  StreetController extends Controller
  {
  
    public function actionIndex()//main page
    {   
        $this->render('index');
	}
    
	public function actionPicture()//dialog building information page
    {
        $model = new Street;
        if(isset($_GET['id']))
        {
            $getId=$_GET['id'];  
        }
        else
        {
            $getId=1;
        }
        $data=$model->getBuildingInfo($getId);
        $this->render('index', array('data'=>$data));
    }

    public function actionStreet() // µó´ºªA°È­¶
    {
    
    }
}

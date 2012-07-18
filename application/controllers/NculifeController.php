<?php
	
class NculifeController extends Controller
{
	public function actionIndex()
	{
         $this->render('index');
        /* $this->renderPartial('index'); */
	}
	
	public function actionLive()
	{
		$this->render('live');
	}
	
	public function actionFood()
	{
		$this->render('food');
	}
	
	public function actionHouse()
	{
		$this->render('house');
	}
	
	public function actionCar()
	{
		 $this->render('car');
		/* $this->renderPartial('car'); */
	}
	
	public function actionOutside()
	{
		$this->render('outside');
	}
	
	public function actionSport()
	{
		$this->render('sport');
	}
	
	public function actionHealth()
	{
		$this->render('health');
	}

}
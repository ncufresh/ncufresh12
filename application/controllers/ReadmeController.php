<?php
	
class ReadmeController extends Controller
{
	public function actionIndex()
	{
        $this->render('index');
	}
	
	public function actionSchedule()
	{
		$this->render('schedule');
	}
	public function actionFreshman()
	{
		$this->render('freshman');
	}
	public function actionReschool()
	{
		$this->render('reschool');
	}
	public function actionNotice()
	{
		$this->render('notice');
	}
	public function actionDownload()
	{
		$this->render('download');
	}






}
<?php
    
class ReadmeController extends Controller
{
    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionSchedule()
    {
        $schedule = new Schedule();
        $data = $schedule->getId(2);
        $this->render('schedule',array(
            'model'=>$data,
            ));
    }
    public function actionUpdate()
    {
        $schedule = $this;
        if(isset$_POST['Post'])
        {
            $model->attributes=$_POST['Post']['Status'];
            if($schedule->save())
                $this->redirect(array('schedule'),id=>$schedule->id);
           
            
        }
    
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
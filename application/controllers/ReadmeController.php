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
        $data = $schedule->getId(1);
        $this->render('schedule', array(
            'model'     => $data
        ));
    }

    public function actionUpdate()
    {
        if ( Yii::app()->request->getIsPostRequest() )
        {
            $model = Schedule::model()->findByPk(1);
            $model->status = ! $model->status;

            if ( $model->validate() && $model->save() )
            {
                $this->redirect(array('readme/schedule'));
            }
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
<?php

class MultimediaController extends Controller
{
    public function accessRules()
    {
        return array(
            array(
                'allow',
                'users'     => array('*'),
            )
        );
    }

    /**
     * This is a static page
     */
    public function actionIndex()
    {
        $this->setPageTitle(Yii::app()->name . ' - 影音專區');
        $this->render('index');
    }

    public function actionYoutube()
    {
        if ( isset($_GET['video_id']) )
        {
            $this->renderPartial('youtube', array(
                'video_id' => $_GET['video_id']
            ));
        }
        else
        {
            throw new CHttpException(404);
        }
    }
}
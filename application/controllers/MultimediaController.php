<?php

class MultimediaController extends Controller
{
    /**
     * This is a static page
     */
    public function actionIndex()
    {
        $this->setPageTitle(Yii::app()->name . ' - 影音專區');
        $this->render('index');
    }
}
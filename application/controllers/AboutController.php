<?php

class AboutController extends Controller
{
    /**
     * Displays about us, this just a static page.
     */
    public function actionIndex()
    {
        $this->setPageTitle(Yii::app()->name . ' - 關於我們');
        $this->render('index');
    }
}
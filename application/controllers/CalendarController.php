<?php

class CalendarController extends Controller
{
    public function init()
    {
        parent::init();
        return true;
    }

    public function filters()
    {
        return array(
            'accessControl'
        );
    }

    public function accessRules()
    {
        return array();
    }

    public function actionView()
    {
        $this->render('view');
    }

    public function actionClub()
    {
    }

    public function actionRecycle()
    {
    }

    public function actionEventHide()
    {
    }

    public function actionEventDelete()
    {
    }

    public function actionEventShow()
    {
    }

    public function actionSubscript()
    {
    }

    public function actionUnsubsciprt()
    {
    }
}
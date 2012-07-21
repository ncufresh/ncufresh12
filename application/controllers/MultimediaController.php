<?php

class MultimediaController extends Controller
{
    public function accessRules()
    {
        return array(
            array(
                'allow',
                'users'     => array('*')
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

    public function actionWatch($v)
    {
        $this->renderPartial('watch', array(
            'v'         => $v
        ));
    }
}
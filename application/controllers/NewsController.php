<?php

class NewsController extends Controller
{
    
    public function actionView()
    {
        $this->render('view');
    }
    
    public function actionIndex()
    {
        $model = new News();
        $this->render('index', array(
            'news' => $model->getRecentNews(),
        ));
    }
    
    public function actionAdmin()
    {
        $this->render('admin');
    }
    
    public function actionCreate()
    {
    }
    
    public function actionUpdate()
    {
    }
    
    public function actionDelete()
    {
    }
}
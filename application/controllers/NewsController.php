<?php

class NewsController extends Controller
{
    const NEWS_PER_PAGE = 5;
    public function actionView($id)
    {   
        $news = News::model()->findByPk($id);
        if($news===null)
            throw new CHttpException(404);
        $this->render('view', array(
            'news' => $news,
            'currentPage' => $news->getCurrentPage(self::NEWS_PER_PAGE),
        ));
    }
    
    public function actionIndex($page=1)
    {
        $model = new News();
        $this->render('index', array(
            'news' => $model->getPage($page),
            'pageStatus' => $model->getPageStatus($page, self::NEWS_PER_PAGE),
        ));
    }
    
    public function actionAdmin($page=1)
    {
        $model = new News();
        $this->render('admin', array(
            'news' => $model->getPage($page),
            'pageStatus' => $model->getPageStatus($page, self::NEWS_PER_PAGE),
        ));
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
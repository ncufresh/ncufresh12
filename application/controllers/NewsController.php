<?php

class NewsController extends Controller
{
    const NEWS_PER_PAGE = 5;
    public function actionView($id)
    {
        $this->setPageTitle(Yii::app()->name . ' - 最新消息');
        $news = News::model()->findByPk($id);
        if($news===null)
            throw new CHttpException(404);
        $this->render('view', array(
            'news' => $news,
            'currentPage' => $news->getCurrentPage(self::NEWS_PER_PAGE, true),
			'dir' => is_dir( 'files/'. $news->id )?dir('files/'. $news->id):null,
        ));
    }
    
    public function actionIndex($page=1)
    {
        $this->setPageTitle(Yii::app()->name . ' - 最新消息');
        $model = new News();
        $this->render('index', array(
            'news' => $model->getPage($page),
            'pageStatus' => $model->getPageStatus($page, self::NEWS_PER_PAGE),
        ));
    }
    
    public function actionAdmin($page=1)
    {
        $model = new News();
		$this->setPageTitle(Yii::app()->name . ' - 最新消息');
        $this->render('admin', array(
            'news' => $model->getPage($page),
            'pageStatus' => $model->getPageStatus($page, self::NEWS_PER_PAGE),
        ));
    }
    
    public function actionCreate()
    {
        if( isset( $_POST['news'] ) )
        {
			$model = new News();
            $model->title = $_POST['news']['title'];
            $model->content = $_POST['news']['content'];
            $model->author_id = 0;
            $model->save();
			
			$files = CUploadedFile::getInstancesByName('news_files');
			if( $model->id != 0 && isset($files) && count($files) > 0 )
			{		
				$dir = Yii::getPathOfAlias('webroot').'/files/'. $model->id;
				if(!is_dir($dir)) 
				{
				   mkdir($dir);
				   chmod($dir, 0755); 
				}
				foreach( $files as $key => $file )
				{	
					$file->saveAs( $dir . '/' . iconv("UTF-8","big5",$file->name) );
					echo $dir . '/' . $file->name;
				}
			}
            
            $this->redirect(array('news/admin'));
        }
        $this->render('create');
    }
    
    public function actionUpdate()
    {
        $this->render('update');
    }
    
    public function actionDelete()
    {
    }
    
}
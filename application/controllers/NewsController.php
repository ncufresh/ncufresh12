<?php

class NewsController extends Controller
{
	/**
	 * Configuration: 
	 * the number how many pieces of news will be listed.
	 */
    const NEWS_PER_PAGE = 10;

	/**
	 * Configuration: 
	 * The path of the files will be placed.
	 */
    const NEWS_FILE_DIR = 'files';

	/**
	 * Initialize
	 */
	public function init()
    {
        parent::init();
        Yii::import('application.models.News.*');
        return true;
    }

	/**
	 * Filters
	 */
    public function filters()
    {
        return array(
            'accessControl'
        );
    }

	/**
	 * Access rules
	 */
    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions'   => array('admin', 'create', 'update', 'delete'),
                'roles'     => array('admin')
            ),
            array(
                'allow',
                'actions'   => array('index', 'view'),
                'users'     => array('*')
            ),
            array(
                'deny',
                'users'     => array('*')
            )
        );
    }

	/**
	 * Display the content of the news with an id
	 */
    public function actionView($id)
    {
        $news = $this->loadModel($id);
        if ( $news === null ) throw new CHttpException(404);
        $this->setPageTitle(Yii::app()->name . ' - 最新消息');
        $this->render('view', array(
            'news'          => $news,
            'current_page'  => $news->getCurrentPage(self::NEWS_PER_PAGE, true),
            'files'         => $this->loadFiles(self::NEWS_FILE_DIR . DIRECTORY_SEPARATOR . $news->id)
        ));
    }

	/**
	 * List all news with pagination.
	 */
    public function actionIndex($page = 1)
    {
        $this->setPageTitle(Yii::app()->name . ' - 最新消息');
        $model = new News();
        $this->render('index', array(
            'news'          => $model->getPage($page, self::NEWS_PER_PAGE, true),
            'page_status'   => $model->getPageStatus($page, self::NEWS_PER_PAGE)
        ));
    }

	/**
	 * List all news and manipulations with pagination.
	 */
    public function actionAdmin($page = 1)
    {
        $model = News::model();
        $this->setPageTitle(Yii::app()->name . ' - 最新消息');
        $this->render('admin', array(
            'news'          => $model->getPage($page, self::NEWS_PER_PAGE, true),
            'page_status'   => $model->getPageStatus($page, self::NEWS_PER_PAGE)
        ));
    }

	/**
	 * Display a form of news. It is allowed to add urls
	 * and upload files.
	 */
    public function actionCreate()
    {
        if ( isset( $_POST['news'] ) )
        {
            // saving one record of news
            $news = new News();
            $news->title = $_POST['news']['title'];
            $news->content = $_POST['news']['content'];
            $news->author_id = 0;
            if ( ! $news->save() )
            { 
                $this->render('create', array(
                    'errors'    => $news->errors ?: array()
                ));
                exit;
            }
            // saving urls
            if (
                isset($_POST['news']['news_urls_alias'])
             && isset($_POST['news']['news_urls'])
            )
            {
                foreach ( $_POST['news']['news_urls'] as $key => $url )
                {
                    $url_model = new Link();
                    $url_model->name = $_POST['news']['news_urls_alias'][$key];
                    $url_model->link = $_POST['news']['news_urls'][$key];
                    $url_model->news_id = $news->id;
                    $url_model->save();
                }
            }
            // saving files
            $files = CUploadedFile::getInstancesByName('news_files');
            if ( $news->id != 0 && isset($files) && count($files) > 0 )
            {
                $dir = Yii::getPathOfAlias('webroot') . DIRECTORY_SEPARATOR . self::NEWS_FILE_DIR . DIRECTORY_SEPARATOR . $news->id;
                if ( ! is_dir($dir) )
                {
                   mkdir($dir);
                   chmod($dir, 0755);
                }

                foreach ( $files as $key => $file )
                {
                    $filename = $this->isWindows() ? iconv('UTF-8', 'big5', $file->name) : $file->name;
                    $file->saveAs($dir . DIRECTORY_SEPARATOR . $filename);
                }
            }
            $this->redirect($news->url);
        }
        $this->render('create', array(
			'errors'    =>  array()
		));
    }

	/**
	 * The page that administrator can modify news.
	 */
    public function actionUpdate($id)
    {
        $news = $this->loadModel($id);
        if ( isset($_POST['news']) )
        {
            $news->attributes = $_POST['news'];
            if ( $news->save() ) $this->redirect($news->url);
        }
        $this->render('update', array(
            'news'          => $news,
            'files'         => $this->loadFiles(self::NEWS_FILE_DIR . DIRECTORY_SEPARATOR . $news->id)
        ));
    }

	/**
	 * Hide a piece of news with id and redirector to admin page.
	 */
    public function actionDelete($id)
    {
        $news = $this->loadModel($id);
        $news->hide();
        $this->redirect(array('news/admin'));
    }

	/**
	 * Load a piece of news and validate if exists
	 */
    private function loadModel($id)
    {
        $news = News::model()->findByPk($id);
        if ( $news === null ) throw new CHttpException(404);
        return $news;
    }

	/**
	 * Return the boolean if the user is using Windows OS
	 */
    private function isWindows()
    {
        return strtoupper(substr(PHP_OS, 0, 3)) == 'WIN';
    }

	/**
	 * Return all files under a directory.
	 */
    private function loadFiles($directory)
    {
        $files = array();
        if ( is_dir( $directory ) )
        {
            $dir = dir($directory);
            while ( $entry = $dir->read() )
            {
                if ( $entry != '.' && $entry != '..' )
                {
                    $entry = $this->isWindows() ? iconv('big5', 'UTF-8', $entry) : $entry;
                    $files[$entry] = Yii::app()->baseUrl . DIRECTORY_SEPARATOR . $dir->path . DIRECTORY_SEPARATOR . $entry;
                }
            }
        }
        return $files;
    }
}
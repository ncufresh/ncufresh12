<?php

class ForumController extends Controller
{
    public function init()
    {
        parent::init();
        Yii::import('application.models.Forum.*');
        return true;
    }

    public function actionIndex()
    {
        // index page, list the three categories of forum
        $category = new ArticleCategory();
        $this->render('index');
    }

    public function actionForumList()
    {
        // list of departments
        $model = new Category();
        //$list = ForumCategory::model()->findAllBySql("SELECT * FROM  `forum_category` ", ' ');
        $this->render('forumlist', array(
            'list'      => $model->findAll('id != 1 AND id != 2')
        ));
    }

    public function actionForum($fid, $sort = 0, $category = 0)
    {
        //content of each forum
        $this->render('forum', array(
            'fid'       => $fid,
            'model'     => new Article()
        ));
    }

    public function actionAdmin()
    {
    }

    public function actionCreate($fid)
    {
        // add new article
        $article = new Article();
        // $category = new ForumArticleCategory();

        // $forum = ForumCategory::model()->find('id=1');
        // foreach($forum->article_categories as $each)
        // {
            // echo $each->name;
        // }

        if ( isset($_POST['forum']) )
        {
            $article->title = $_POST['forum']['title'];
            $article->content = $_POST['forum']['content'];
            $article->forum_id = $_POST['forum']['fid'];
            $article->category = $_POST['forum']['category'];
            $article->save();
            $this->redirect($article->url);
        }

        $this->render('create',array(
            'fid'       => $fid,
            'category'  => ForumCategory::model()->find('id=' . $fid)
        ));
    }

    public function actionView($fid, $id, $title)
    {
        $this->render('view');
    }

    public function actionUpdate() // update article
    {
    }

    public function actionDelete() // delete article
    {
    }
}
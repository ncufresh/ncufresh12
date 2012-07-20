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
        $article = new Article();
        //content of each forum
        $this->render('forum', array(
            'fid'       => $fid,
            'model'     => $article->findAll('forum_id='.$fid)
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
            'category'  => Category::model()->find('id=' . $fid)
        ));
    }

    public function actionView($fid, $id)
    {
        $article = Article::model()->findByPk($id);
        $comment = new Comment();
        
        $this->render('view', array('article'=>$article,'comments'=>$comment));
        
    }
    
    public function actionComment(){
        $comment = new Comment();
        if ( isset($_POST['comment']) )
        {
            $comment->content = $_POST['comment']['content'];
            $comment->article_id = $_POST['comment']['aid'];
            $comment->save();
        }
        $this->redirect(Yii::app()->createUrl('forum/view', array(
                    'fid'   => $comment->article->forum->id,
                    'id'    => $comment->article_id
        )));
    }
    
    public function actionUpdate() // update article
    {
    }

    public function actionDelete() // delete article
    {
    }
}
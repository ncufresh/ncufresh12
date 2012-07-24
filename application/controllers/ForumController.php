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
        // $list = ForumCategory::model()->findAllBySql("SELECT * FROM  `forum_category` ", ' ');
        $this->render('forumlist', array(
            'list'      => $model->findAll('id != 1 AND id != 2')
        ));
    }

    public function actionForum($fid, $sort = 'create', $category = 0)
    {
        $article = new Article();
        // content of each forum
        // [not yet] 傳入是否為admin 用於判斷是否顯示置頂checkbox及刪除文章選項
        $this->render('forum', array(
            'fid'       => $fid,
            'sort'      => $sort,
            //'model'     => $article->findAll('forum_id='.$fid)
            'model'     => Article::model()->getArticlesSort($fid, $sort)
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
            $article->is_top = $_POST['forum']['is_top'];
            $article->save();
            $this->redirect($article->url);
        }
        // [not yet] 傳入是否為admin 用於判斷是否顯示置頂checkbox選項
        $this->render('create',array(
            'fid'       => $fid,
            'category'  => Category::model()->findByPk($fid)
        ));
        
    }

    // public function actionTop(){
    // }

    public function actionView($fid, $id)
    {
        $article = Article::model()->findByPk($id);
        $comment = new Comment();
        $reply = new Reply();

        $this->render('view', array(
            'article'   => $article,
            'comments'  => $comment,
            'reply'     => $reply
        ));        
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
            'fid'       => $comment->article->forum->id,
            'id'        => $comment->article_id
        )));
    }

    public function actionReply($aid)
    {
        $reply = new Reply();
        $article = Article::model()->findByPk($aid);
        if ( isset($_POST['reply']) )
        {
            $reply->content = $_POST['reply']['content'];
            $reply->article_id = $aid;
            if($reply->save()){
                $article->replies_count++;
                $article->save();
                $this->redirect(Yii::app()->createUrl('forum/view', array(
                    'fid'   => $reply->article->forum->id,
                    'id'    => $reply->article_id
                )));
            }
        }
        $this->render('reply');
    }

    public function actionUpdate() // update article
    {
    }

    public function actionDelete() // delete article
    {
        $article = new Article();

        // [not yet]判斷傳過來的fid
        if ( isset($_POST['delete']) )
        {
            $aid = $_POST['delete'];
            $article_to_be_del = $article->findByPk('id = ' . $aid);
            $article_to_be_del->visibility = 0;
            $article_to_be_del->save();
        }
        
        $this->redirect(Yii::app()->createUrl('forum/forum', array(
            'fid'       => $article_to_be_del->forum->id
        )));
    }
}
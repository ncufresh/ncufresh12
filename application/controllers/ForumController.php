<?php
//title:<20字
//發文:>20字
//回文:>20字
//推文:<24字

//ckeditor
//next page . previous page
class ForumController extends Controller
{
    const ARTICLES_PER_PAGE = 10;

    public function init()
    {
        parent::init();
        Yii::import('application.models.Forum.*');
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
        return array(
            array(
                'allow',
                'actions'   => array('create', 'comment', 'reply', 'delete', 'comment'),
                'roles'     => array('member')
            ),
            array(
                'allow',
                'actions'   => array('index', 'view', 'forumlist', 'forum'),
                'users'     => array('*')
            ),
            array(
                'deny',
                'users'     => array('*')
            )
        );
    }

    public function actionIndex()
    {
        // index page, list the three categories of forum
        // to be delete $category = new ArticleCategory();
        $this->render('index');
    }

    public function actionForumList()
    {
        // list of departments
        // to be delete $model = new Category();
        // $list = ForumCategory::model()->findAllBySql("SELECT * FROM  `forum_category` ", ' ');
        $this->render('forumlist', array(
            'list'      => Category::Model()->getForumLists(),
        ));
    }

    public function actionForum($fid, $sort = 'create', $category = 0, $page = 1)
    {
        $forum = Category::model()->findByPk($fid);
        // content of each forum
        $this->render('forum', array(
            'fid'               => $fid,
            'sort'              => $sort,
            'current_category'  => $category,
            'model'             => Article::getArticlesSort($fid, $sort, $category, $page, self::ARTICLES_PER_PAGE),
            'category'          => $forum,
            'page_status'       => Article::getPageStatus($page, self::ARTICLES_PER_PAGE, $fid, $category)
        ));
    }

    public function actionCreate($fid)
    {
        // add new article
        if ( isset($_POST['forum']) )
        {
            $article = new Article();
            $article->attributes = $_POST['forum'];
            if ( Category::model()->findByPk($fid)->getIsMaster() )
            {
                $article->sticky = $_POST['forum']['sticky'];
            }
            if ( $article->validate() && $article->save() )
            {
                $this->redirect($article->url);
            }
        }

        if ( Category::model()->findByPk($fid) )
        {
            $forum = Category::model()->findByPk($fid);
            $this->render('create',array(
                'fid'       => $fid,
                'category'  => $forum
            ));
        }
        else
        {
            throw new Exception('The forum is not exist.');
        }
    }

    public function actionView($fid, $id)
    {
        $article = Article::model()->findByPk($id);
        $article->viewed++;
        $article->save();
        $this->render('view', array(
            'article'   => $article,
        ));
    }

    public function actionComment(){
        
        if ( isset($_POST['comment']) )
        {
            $comment = new Comment();
            $comment->attributes = $_POST['comment'];
            if ( $comment->validate() && $comment->save() )
            {
                $this->redirect(Yii::app()->createUrl('forum/view', array(
                    'fid'       => $comment->article->forum->id,
                    'id'        => $comment->article_id
                )));
            }
        }
        throw new CHttpException(404);
    }

    public function actionReply($aid)
    {
        if ( isset($_POST['reply']) )
        {
            $reply = new Reply();
            $reply->attributes = $_POST['reply'];
            $reply->article_id = $aid;
            if( $reply->validate() && $reply->save() )
            {
                $article = Article::model()->findByPk($aid);
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

    public function actionDelete() // delete article
    {
        // [not yet]判斷傳過來的fid
        if ( isset($_POST['delete']) )
        {
            $aid = $_POST['delete'];
            $article_to_be_del = Article::Model()->findByPk($aid);
            if ( ! empty($article_to_be_del) )
            {
                $article_to_be_del->invisible = 1;
                $article_to_be_del->save();
            }
            else
            {
                throw new Exception('The article is not exist.');
            }
        }

        $this->redirect(Yii::app()->createUrl('forum/forum', array(
            'fid'       => $article_to_be_del->forum->id
        )));
    }
}
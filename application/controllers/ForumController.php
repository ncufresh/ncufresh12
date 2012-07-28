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

    public function actionForum($fid, $sort = 'create', $category = 0, $page = 1)
    {
        $article = new Article();
        
        // content of each forum
        // [not yet] 傳入是否為admin 用於判斷是否顯示置頂checkbox及刪除文章選項
        // if ( ! Yii::app()->request->getIsAjaxRequest() )
        // {
            $this->render('forum', array(
                'fid'       => $fid,
                'sort'      => $sort,
                'current_category'  => $category,
                //'model'     => $article->findAll('forum_id='.$fid)
                'model'     => Article::model()->getArticlesSort($fid, $sort, $category, $page, self::ARTICLES_PER_PAGE),
                'category'  => Category::model()->findByPk($fid),
                'page_status'   => $article->getPageStatus($page, self::ARTICLES_PER_PAGE, $fid, $category),
                'is_master' =>  Category::model()->getIsMaster($fid),
            ));
        // }
        // else
        // {
            // $this->_data['content'] = array();
            // foreach ( Article::model()->getArticlesSort($fid, $sort) as $article )
            // {
                // $this->_data['content'][$article->id] = $article->title;
            // }
        // }
    }
    
    //[not yet]限制欄位填寫完整. 字數判斷
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
            if(Category::model()->getIsMaster($fid))
                $article->is_top = $_POST['forum']['is_top'];
            $article->save();
            $this->redirect($article->url);
        }
        $this->render('create',array(
            'fid'       => $fid,
            'category'  => Category::model()->findByPk($fid),
            'is_master' =>  Category::model()->getIsMaster($fid),
        ));
    }

    public function actionView($fid, $id)
    {
        $article = Article::model()->findByPk($id);
        $comment = new Comment();
        $reply = new Reply();
        $article->viewed_times++;
        $article->save();
        $this->render('view', array(
            'article'   => $article,
            'comments'  => $comment,
            'reply'     => $reply
        ));
    }

    public function actionComment(){
        
        if ( isset($_POST['comment']) )
        {
            $comment = new Comment();
            $comment->content = $_POST['comment']['content'];
            $comment->article_id = $_POST['comment']['aid'];
            $comment->save();
            
            $this->redirect(Yii::app()->createUrl('forum/view', array(
                'fid'       => $comment->article->forum->id,
                'id'        => $comment->article_id
            )));
        }
        throw new CHttpException(404);
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

    public function actionDelete() // delete article
    {
        $article = new Article();

        // [not yet]判斷傳過來的fid
        if ( isset($_POST['delete']) )
        {
            $aid = $_POST['delete'];
            $article_to_be_del = $article->findByPk($aid);
            if(!empty($article_to_be_del)){
                $article_to_be_del->visibility = 0;
                $article_to_be_del->save();
            }
            else
                throw new Exception('The article is not exist.');
        }

        $this->redirect(Yii::app()->createUrl('forum/forum', array(
            'fid'       => $article_to_be_del->forum->id
        )));
    }
}
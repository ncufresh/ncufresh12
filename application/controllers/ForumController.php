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
    const NEW_ARTICLE_VALUE = 15000;
    const NEW_ARTICLE_EXP = 500;
    const NEW_REPLY_VALUE = 3000;
    const NEW_REPLY_EXP = 250;
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
        $this->setPageTitle(Yii::app()->name . ' - 論壇專區');
        $this->render('index');
    }

    public function actionForumList()
    {
        $this->setPageTitle(Yii::app()->name . ' - 系所列表');
        $this->render('forumlist', array(
            'list'      => Category::model()->getForumLists()
        ));
    }

    public function actionForum($fid, $sort = 'create', $category = 0, $page = 1)
    {
        if ( $forum = Category::model()->findByPk($fid) )
        {
            $forum = Category::model()->findByPk($fid);
            $this->setPageTitle(Yii::app()->name . ' - ' . $forum->name);
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
        else 
        {
            throw new CHttpException(404);
        }
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
                Character::model()->findByPk(Yii::app()->user->getId())->addExp(self::NEW_ARTICLE_EXP);
                Character::model()->findByPk(Yii::app()->user->getId())->addMoney(self::NEW_ARTICLE_VALUE);
                $this->redirect($article->url);
            }
        }

        if ( Category::model()->findByPk($fid) )
        {
            $forum = Category::model()->findByPk($fid);
            $this->setPageTitle(Yii::app()->name . ' - 發表文章');
            $this->render('create',array(
                'fid'       => $fid,
                'category'  => $forum
            ));
        }
        else 
        {
            throw new CHttpException(404);
        }
    }

    public function actionView($fid, $id, $page=1)
    {
        $article = Article::model()->findByPk($id);
        if ( $article )
        {
            $article->viewed++;
            
            if ( $article->save())
            {
                $this->setPageTitle(Yii::app()->name . ' - ' . $article->title);
                $this->render('view', array(
                'fid'           => $article->forum_id,
                'article'       => $article,
                'replies'       => Reply::getReplies($id, $page, self::ARTICLES_PER_PAGE),
                'page_status'   => Reply::getPageStatus($page, self::ARTICLES_PER_PAGE, $article->id)
                ));
            }
            
        }
        else 
        {
            throw new CHttpException(404);
        }
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
            else
            {
                $this->redirect(Yii::app()->createUrl('forum/view', array(
                    'fid'       => $comment->article->forum->id,
                    'id'        => $comment->article_id
                )));
            }
        }
        else 
        {
            throw new CHttpException(404);
        }
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
                if( $article->save() )
                {
                    $article = Article::model()->findByPk($aid);
                    Character::model()->findByPk(Yii::app()->user->getId())->addExp(self::NEW_REPLY_EXP);
                    Character::model()->findByPk(Yii::app()->user->getId())->addMoney(self::NEW_REPLY_VALUE);
                    $this->setPageTitle(Yii::app()->name . ' - 回覆文章');
                    $this->redirect(Yii::app()->createUrl('forum/view', array(
                    'fid'           => $reply->article->forum->id,
                    'id'            => $reply->article_id,
                    )));
                }
                else
                {
                    throw new Exception('some error happening');
                }
            }
        }
        if ( Article::model()->findByPk($aid) )
        {
            $this->render('reply');
        }
        else 
        {
            throw new CHttpException(404);
        }
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
            $this->redirect(Yii::app()->createUrl('forum/forum', array(
                'fid'       => $article_to_be_del->forum->id
            )));
        }
        else 
        {
            throw new CHttpException(404);
        }
    }
}
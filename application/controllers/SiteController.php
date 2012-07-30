<?php

class SiteController extends Controller
{
    public function init()
    {
        parent::init();
        Yii::import('application.models.News.*');
        Yii::import('application.models.Game.*');
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
                'actions'   => array(
                    'index',
                    'error',
                    'search',
                    'pull',
                    'register',
                    'login',
                    'channel',
                    'profile',
                    'editor',
                    'sitemap'
                ),
                'users'     => array('*')
            ),
            array(
                'allow',
                'actions'   => array('logout'),
                'users'     => array('@')
            ),
            array(
                'allow',
                'actions'   => array('marquee'),
                'roles'     => array('admin')
            ),
            array(
                'deny',
                'users'     => array('*')
            )
        );
    }

    public function actionIndex()
    {
        $this->setPageTitle(Yii::app()->name);
        $this->render('index', array(
            'latests'   => News::model()->getPopularNews(10),
            'articles'  => array(),
            'marquees'  => Marquee::model()->getMarquees()
        ));
    }

    public function actionMarquee()
    {
        $id = 0;
        if ( isset($_POST['marquee']) )
        {
            $delete = false;
            if ( isset($_POST['marquee']['id']) )
            {
                $id = (integer)$_POST['marquee']['id'];
                if ( $id < 0 )
                {
                    $id *= -1;
                    $delete = true;
                }
            }

            if ( isset($_POST['marquee']['message']) || $delete )
            {
                if ( $id )
                {
                    $model = Marquee::model()->findByPk($id);
                }
                else
                {
                    $model = new Marquee();
                }
                
                if ( $delete && $id )
                {
                    $model->deleteMarquee();
                }
                else
                {
                    $model->attributes = $_POST['marquee'];
                    if ( $model->validate() && $model->save() )
                    {
                        $this->_data['message'] = $model->message;
                    }
                    else
                    {
                        $this->_data['error'] = true;
                    }
                }
            }
            else
            {
                $this->_data['error'] = true;
            }

            if ( Yii::app()->request->getIsAjaxRequest() ) return true;
            $this->redirect(Yii::app()->user->returnUrl);
        }

        $this->setPageTitle(Yii::app()->name . ' - 跑馬燈管理');
        $this->render('marquee', array(
            'marquees'  => Marquee::model()->getMarquees()
        ));
    }

    public function actionPull($lasttime = 0)
    {
        $this->_data['counter'] = array(
            'online'    => Activity::getOnlineCount(),
            'browsered' => Activity::getTotalCount()
        );
        if ( $lasttime == 0 ) // Debug only
        {
            $this->_data['friends'] = array(
                array(
                    'id'        => 1,
                    'name'      => 'Test 1',
                    'active'    => false
                ),
                array(
                    'id'        => 2,
                    'name'      => 'Demodemo',
                    'active'    => true
                ),
                array(
                    'id'        => 3,
                    'name'      => 'Adminadmin',
                    'active'    => true
                ),
                array(
                    'id'        => 4,
                    'name'      => 'WhoAmI',
                    'active'    => false
                )
            );
        }
        if ( Yii::app()->user->getIsMember() )
        {
            $this->_data['messages'] = Chat::getMessages($lasttime);
        }
        $this->_data['lasttime'] = TIMESTAMP;
    }

    public function actionSearch($query)
    {
        $this->setPageTitle(Yii::app()->name . ' - 搜尋結果');
        $this->render('search', array(
            'query'     => $query
        ));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ( $error = Yii::app()->errorHandler->error )
        {
            if ( Yii::app()->request->getIsAjaxRequest() )
            {
                echo $error['message'];
            }
            else
            {
                $this->setPageTitle(Yii::app()->name . ' - 發生錯誤');
                switch ( $error['code'] )
                {
                    case 403 :
                        Yii::app()->user->loginRequired();
                        break;
                    case 404 :
                        $this->render('notfound', $error);
                        break;
                    default :
                        $this->render('error', $error);
                        break;
                }
            }
        }
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        if ( isset($_POST['login']) )
        {
            $model = new User();
            $model->attributes = $_POST['login'];
            if ( $model->login() )
            {
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }
        $this->setPageTitle(Yii::app()->name . ' - 登入');
        $this->render('login');
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout(false);
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionChannel()
    {
        $expire = 60 * 60 * 24 * 365;
        header('Pragma: public');
        header('Cache-Control: max-age=' . $expire);
        header('Expires: ' . gmdate('D, d M Y H:i:s', TIMESTAMP + $expire) . ' GMT');
        echo '<script src="http://connect.facebook.net/zh_TW/all.js"></script>';
        $this->layout = false;
    }

    public function actionRegister()
    {
        $path = dirname(Yii::app()->basePath) . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'avatars';
        if ( isset($_POST['register']) && isset($_POST['profile']) )
        {
            if ( $_POST['register']['password'] === $_POST['confirm'] ) 
            {
                $user = new User();
                $user->attributes = $_POST['register'];
                if ( $user->validate() )
                {
                    $profile = new Profile();
                    $profile->attributes = $_POST['profile'];
                    $profile->department_id = $_POST['profile']['department'];
                    $profile->grade = $_POST['profile']['grade'];
                    $profile->sex = $_POST['sex'];
                    if ( $profile->validate() )
                    {
                        if ( $user->save() )
                        {
                            $character = new Character(); //Character Model
                            $character->id = $user->id;//同步寫入user的id至遊戲資料列表
                            $character->exp = 1; //一開始使用者經驗設為1
                            $character->money = 25000; //一開始使用者金錢設為25000
                            $character->total_money = 35000; //一開始使用者總金錢設為25000
                            if($_POST['sex'] == 0)
                            {
                                $character->skin_id = 81; //男生 皮膚預設id=81
                            }
                            else
                            {
                                $character->skin_id = 85; //女生 皮膚預設id=85
                            }
                            $item = new ItemBag(); //ItemBag Model
                            $item->user_id = $user->id; //同步寫入user的id至道具列表
                            $item->items_id = $character->skin_id; //寫入獲得道具的id
                            $item->equip = 1; //寫入裝備狀態
                            $item->acquire_time = TIMESTAMP; //寫入獲得時間
                            
                            $profile->id = $user->id;
                            if ( $profile->save() && $character->save() && $item->save())
                            {
                                $this->redirect(array('profile/profile'));
                            }
                        }
                    }
                }
            }
        }
        $this->render('register', array(
            'departments'   => Department::model()->getDepartment()
        ));
    }

    public function actionSitemap()
    {
        $path = Yii::app()->basePath . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'sitemap.xml';
        $pages = array(
            array(
                'level'         => 1,
                'name'          => '首頁',
                'location'      => $this->createAbsoluteUrl('site/index'),
                'modified'      => date('Y-m-d\TH:i:s+08:00'),
                'frequency'     => 'always',
                'priority'      => 1
            ),
            array(
                'level'         => 1,
                'name'          => '首頁2',
                'location'      => $this->createAbsoluteUrl('site/index')
            ),
            array(
                'level'         => 2,
                'name'          => '首頁2-1',
                'location'      => $this->createAbsoluteUrl('site/index')
            ),
            array(
                'level'         => 2,
                'name'          => '首頁2-2',
                'location'      => $this->createAbsoluteUrl('site/index')
            ),
            array(
                'level'         => 1,
                'name'          => '首頁3',
                'location'      => $this->createAbsoluteUrl('site/index')
            )
        );

        if ( ! file_exists($path) )
        {
            $sitemap = new DOMDocument('1.0', 'UTF-8');
            $urlset = $sitemap->createElement('urlset');
            $urlset->setAttribute(
                'xmlns',
                'http://www.sitemaps.org/schemas/sitemap/0.9'
            );
            $urlset->setAttribute(
                'xmlns:image',
                'http://www.sitemaps.org/schemas/sitemap-image/1.1'
            );
            $urlset->setAttribute(
                'xmlns:video',
                'http://www.sitemaps.org/schemas/sitemap-video/1.1'
            );
            foreach ( $pages as $page )
            {
                $url = $sitemap->createElement('url');

                $loc = $sitemap->createElement('loc');
                $loc->appendChild($sitemap->createTextNode($page['location']));
                $url->appendChild($loc);

                if ( isset($page['modified']) )
                {
                    $lastmod = $sitemap->createElement('lastmod');
                    $lastmod->appendChild(
                        $sitemap->createTextNode($page['modified'])
                    );
                    $url->appendChild($lastmod);
                }

                if ( isset($page['frequency']) )
                {
                    $changefreq = $sitemap->createElement('changefreq');
                    $changefreq->appendChild(
                        $sitemap->createTextNode($page['frequency'])
                    );
                    $url->appendChild($changefreq);
                }

                if ( isset($page['priority']) )
                {
                    $priority = $sitemap->createElement('priority');
                    $priority->appendChild(
                        $sitemap->createTextNode($page['priority'])
                    );
                    $url->appendChild($priority);
                }

                $urlset->appendChild($url);
            }
            $sitemap->appendChild($urlset);
            $sitemap->save($path);
        }

        $this->render('sitemap', array(
            'pages'         => $pages
        ));
    }
}
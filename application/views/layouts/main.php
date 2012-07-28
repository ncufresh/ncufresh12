<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="description" content="「2012 大一生活知訊網」提供中大新鮮人所需要的訊息，包括註冊、選課、宿舍、科系、社團等各方面實用的資訊，還有其它的生活小密技，讓新生提早了解校園生活的各種面貌。" />
    <meta name="keywords" content="國立中央大學, 中央大學, 中大, 央大, 大一生活知訊網, 生活知訊網, 知訊網, NCU, NCUFreshWeb, NCUFresh, 2012" />
    <meta name="author" content="National Central University FreshWeb Team." />
    <meta name="revised" content="<?php echo date('Y/m/d'); ?>" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/styles/style.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/styles/print.css" media="print" />
    <style type="text/css"><?php echo $this->clips['style']; ?></style>

    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/styles/ie.css" media="screen, projection" />
    <![endif]-->

    <link href="<?php echo Yii::app()->request->baseUrl; ?>/statics/favicon.ico" rel="shortcut icon">

    <title><?php echo $this->getPageTitle(); ?></title>
</head>

<body>

<div id="header">
    <h1 id="moon">
        <a id="logo" href="<?php echo Yii::app()->createUrl('site/index'); ?>" title="<?php echo Yii::app()->name; ?>"><?php echo Yii::app()->name; ?></a>
    </h1>
    <div class="statics">
        <p class="online">0</p>
        <p class="browsered">0</p>
    </div>
    <form id="search" action="<?php echo Yii::app()->createUrl('site/search'); ?>" method="GET">
        <dl>
            <dt>
                <label for="form-search-query">搜尋</label>
            </dt>
            <dd>
                <input id="form-search-query" name="query" autocomplete="off" type="text" />
            </dd>
        </dl>
        <div>
            <button id="form-search-button" type="submit">搜尋</button>
        </div>
    </form>
    <ul id="menu">
        <li>
            <a href="<?php echo Yii::app()->createUrl('site/index'); ?>" title="回首頁">回首頁</a>
        </li>
        <li>
            <a href="<?php echo Yii::app()->createUrl('site/sitemap'); ?>" title="網站地圖">網站地圖</a>
        </li>
        <li>
            <a href="<?php echo Yii::app()->createUrl('site/contact'); ?>" title="聯絡我們">聯絡我們</a>
        </li>
    </ul>
    <ul id="navigation">
<?php if ( $this->getId() == 'readme' ) : ?>
        <li class="active">
<?php else : ?>
        <li>
<?php endif; ?>
            <a href="<?php echo Yii::app()->createUrl('readme/index'); ?>" title="大一必讀">大一必讀</a>
            <ul>
                <li>
                    <a href="#" title="行事曆">行事曆</a>
                </li>
                <li>
                    <a href="#" title="新生區">新生區</a>
                </li>
                <li>
                    <a href="#" title="復學區">復學區</a>
                </li>
                <li>
                    <a href="#" title="相關須知">相關須知</a>
                </li>
                <li>
                    <a href="#" title="文件下載">文件下載</a>
                </li>
            </ul>
        </li>
<?php if ( $this->getId() == 'nculife' ) : ?>
        <li class="active">
<?php else : ?>
        <li>
<?php endif; ?>
            <a href="<?php echo Yii::app()->createUrl('nculife/index'); ?>" title="中大生活">中大生活</a>
            <ul>
                <li>
                    <a href="#" title="住在中大">住在中大</a>
                </li>
                <li>
                    <a href="#" title="健康中大">健康中大</a>
                </li>
                <li>
                    <a href="#" title="行在中大">行在中大</a>
                </li>
                <li>
                    <a href="#" title="玩在中大">玩在中大</a>
                </li>
                <li>
                    <a href="#" title="活在中大">活在中大</a>
                </li>
            </ul>
        </li>
<?php if ( $this->getId() == 'street' ) : ?>
        <li class="active">
<?php else : ?>
        <li>
<?php endif; ?>
            <a href="<?php echo Yii::app()->createUrl('street/index'); ?>" title="校園導覽">校園導覽</a>
        </li>
<?php if ( $this->getId() == 'forum' ) : ?>
        <li class="active">
<?php else : ?>
        <li>
<?php endif; ?>
            <a href="<?php echo Yii::app()->createUrl('forum/index'); ?>" title="論壇專區">論壇專區</a>
            <ul>
                <li>
                    <a href="#" title="綜合論壇">綜合論壇</a>
                </li>
                <li>
                    <a href="#" title="系所論壇">系所論壇</a>
                </li>
                <li>
                    <a href="#" title="社團論壇">社團論壇</a>
                </li>
            </ul>
        </li>
<?php if ( $this->getId() == 'club' ) : ?>
        <li class="active">
<?php else : ?>
        <li>
<?php endif; ?>
            <a href="<?php echo Yii::app()->createUrl('club/index'); ?>" title="系所社團">系所社團</a>
            <ul>
                <li>
                    <a href="#" title="學生組織">學生組織</a>
                </li>
                <li>
                    <a href="#" title="系學會">系學會</a>
                </li>
                <li>
                    <a href="#" title="社團">社團</a>
                </li>
            </ul>
        </li>
<?php if ( $this->getId() == 'multimedia' ) : ?>
        <li class="active">
<?php else : ?>
        <li>
<?php endif; ?>
            <a href="<?php echo Yii::app()->createUrl('multimedia/index'); ?>" title="影音專區">影音專區</a>
        </li>
<?php if ( $this->getId() == 'about' ) : ?>
        <li class="active">
<?php else : ?>
        <li>
<?php endif; ?>
            <a href="<?php echo Yii::app()->createUrl('about/index'); ?>" title="關於我們">關於我們</a>
        </li>
    </ul>
</div>
<div id="content"><?php echo $content; ?></div>
<div id="sidebar">
<?php if ( Yii::app()->user->getIsGuest() ) : ?>
    <a id="fb-login-button" href="<?php echo Yii::app()->createUrl('site/login', array('facebook' => true)); ?>" title="使用Facebook帳號登入">使用Facebook帳號登入</a>
    <form class="profile" action="<?php echo Yii::app()->createUrl('site/login'); ?>" method="POST">
        <dl>
            <dt>
                <label for="form-sidebar-username">帳號</label>
            </dt>
            <dd>
                <input id="form-sidebar-username" name="login[username]" type="text" />
            </dd>
        </dl>
        <dl>
            <dt>
                <label for="form-sidebar-password">密碼</label>
            </dt>
            <dd>
                <input id="form-sidebar-password" name="login[password]" type="password" />
            </dd>
        </dl>
        <div>
            <input name="token" value="<?php echo Yii::app()->security->getToken(); ?>" type="hidden" />
            <button id="form-sidebar-login" type="submit">[登入]</button>
            <button id="form-sidebar-register">[註冊]</button>
        </div>
    </form>
<?php else : ?>
    <div class="profile">
<?php $this->widget('Avatar', array(
    'id'        => Yii::app()->user->getId()
)); ?>
        <p><?php echo Yii::app()->user->getName(); ?></p>
        <a id="sidebar-personal-toggle" href="#" title="點此打開或關閉個人功能"></a>
    </div>
    <div id="sidebar-personal">
        <ul>
            <li>
                <a href="#" title="個人行事曆">個人行事曆</a>
            </li>
            <li>
                <a href="#" title="最新更新">最新更新</a>
            </li>
            <li>
                <a href="#" title="個人資料">個人資料</a>
            </li>
            <li>
                <a href="<?php echo Yii::app()->createUrl('game/index'); ?>" title="遊戲介面">遊戲介面</a>
            </li>
        </ul>
        <a id="sidebar-personal-button" href="#" title="個人專區">個人專區</a>
        <a id="sidebar-logout-button" href="<?php echo Yii::app()->createUrl('site/logout'); ?>" title="登出">登出</a>
    </div>
<?php endif; ?>
    <div class="links sidebar-box">
        <h4>連結區</h4>
        <ul>
            <li>
                <a href="http://www.ncu.edu.tw" title="中大首頁">中大首頁</a>
            </li>
            <li>
                <a href="http://portal.ncu.edu.tw" title="Portal入口">Portal入口</a>
            </li>
            <li>
                <a href="http://www.cc.ncu.edu.tw" title="電算中心">電算中心</a>
            </li>
        </ul>
    </div>
</div>
<div id="footer">
    <div id="footer-content">
        <p>
            主辦單位：國立中央大學學務處　承辦單位：諮商中心　執行單位：2012大一生活知訊網工作團隊
        </p>
        <p>
            地址：32001桃園縣中壢市五權里2鄰中大路300號 | 電話：(03)422-7151#57261 | 版權所有：2012大一生活知訊網工作團隊
        </p>
    </div>
</div>

<div id="chat">
    <p class="online-friends">
        線上好友<span class="friendcounts"><?php echo 999; // $this->getOnlineFriendsCount(); ?></span>人
    </p>
</div>
<div id="fb-root"></div>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
    jQuery.extend({
        configures: {
            pullUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('site/pull'); ?>'),
            facebookAppId: '<?php echo Yii::app()->facebook->getAppId(); ?>',
            facebookChannelUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('site/channel'); ?>'),
            chatSendMessageUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('chat/send'); ?>'),
            ncuLifeUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('nculife/content', array('tab' => ':tab', 'page' => ':page'));?>'),
            multimediaYoutubeUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('multimedia/watch', array('v' => ':v')); ?>'),
            newsIndexUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('news/index'); ?>'),
            staticsUrl: decodeURIComponent('<?php echo Yii::app()->request->baseUrl; ?>/statics'),
            registerUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('site/register'); ?>'),
            facebookEnable: <?php echo Yii::app()->facebook->enable ? 'true' : 'false'; ?>,
            buildingContentUrl:decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('street/building',array('id'=>':id'));?>'),            
            googleSearchAppId: '011017124764723419863:mdibrr3n-py',
            token: '<?php echo Yii::app()->security->getToken(); ?>'
        }
    });
</script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/statics/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/statics/ckeditor/adapters/jquery.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/statics/scripts/script.js"></script>
<?php if ( file_exists(dirname(Yii::app()->basePath) . DIRECTORY_SEPARATOR . 'statics' . DIRECTORY_SEPARATOR . 'scripts' . DIRECTORY_SEPARATOR . $this->getId() . '.js') ) : ?>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/statics/scripts/<?php echo $this->getId(); ?>.js"></script>
<?php endif; ?>
<!--[if lt IE 8]>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/statics/scripts/ie.js"></script>
<![endif]-->
<?php echo $this->clips['script']; ?>
</body>
</html>
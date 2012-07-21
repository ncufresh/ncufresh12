<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/styles/style.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/styles/print.css" media="print" />
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/styles/ie.css" media="screen, projection" />
    <![endif]-->

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js"></script>
    <script type="text/javascript">
        jQuery.extend({
            configures: {
                pullUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('site/pull'); ?>'),
                facebookAppId: '<?php echo Yii::app()->facebook->getAppId(); ?>',
                facebookChannelUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('site/channel'); ?>'),
                chatSendMessageUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('chat/send'); ?>'),
                ncuLifeUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('nculife',array('tab_id'=> ':id'));?>'),
                ncuLifeUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('nculife/carcontent',array('tab_id'=> ':id'));?>'),
                ncuLifeUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('nculife/healthcontent',array('tab_id'=> ':id'));?>'),
                ncuLifeUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('nculife/livecontent',array('tab_id'=> ':id'));?>'),
                ncuLifeUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('nculife/housecontent',array('tab_id'=> ':id'));?>'),
                ncuLifeUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('nculife/outsidecontent',array('tab_id'=> ':id'));?>'),
                ncuLifeUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('nculife/sportcontent',array('tab_id'=> ':id'));?>'),
                multimediaYoutubeUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('multimedia/watch', array('v' => ':v')); ?>'),
                newsIndexUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('news/index'); ?>'),
                staticsUrl: decodeURIComponent('<?php echo Yii::app()->request->baseUrl; ?>/statics'),
                registerUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('site/register'); ?>'),
                facebookEnable: <?php echo Yii::app()->facebook->enable ? 'true' : 'false'; ?>,
                contentUrl:decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('street/building',array('id'=>':id'));?>'),
                googleSearchAppId: '011017124764723419863:mdibrr3n-py',
                token: '<?php echo Yii::app()->security->getToken(); ?>'
            }
        });
    </script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/statics/scripts/script.js"></script>
<?php if ( file_exists(dirname(Yii::app()->basePath) . DIRECTORY_SEPARATOR . 'statics' . DIRECTORY_SEPARATOR . 'scripts' . DIRECTORY_SEPARATOR . $this->getId() . '.js') ) : ?>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/statics/scripts/<?php echo $this->getId(); ?>.js"></script>
<?php endif; ?>
    <!--[if lt IE 8]>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/statics/scripts/ie.js"></script>
    <![endif]-->

    <title><?php echo $this->getPageTitle(); ?></title>
</head>

<body>

<div id="header">
    <a id="logo" href="<?php echo Yii::app()->createUrl('site/index'); ?>" title="<?php echo Yii::app()->name; ?>"></a>
    <div class="statics">
        <p class="online">0</p>
        <p class="browsered">0</p>
    </div>
    <form id="search" action="<?php echo Yii::app()->createUrl('site/search'); ?>" method="GET" autocomplete="off">
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
    <ul id="tab">
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
        <li>
            <a href="<?php echo Yii::app()->createUrl('readme/index'); ?>" title="大一必讀">大一必讀</a>
        </li>
        <li>
            <a href="<?php echo Yii::app()->createUrl('nculife/index'); ?>" title="中大生活">中大生活</a>
        </li>
        <li>
            <a href="<?php echo Yii::app()->createUrl('street/index'); ?>" title="校園導覽">校園導覽</a>
        </li>
        <li>
            <a href="<?php echo Yii::app()->createUrl('forum/index'); ?>" title="論壇專區">論壇專區</a>
        </li>
        <li>
            <a href="<?php echo Yii::app()->createUrl('club/index'); ?>" title="系所社團">系所社團</a>
        </li>
        <li>
            <a href="<?php echo Yii::app()->createUrl('multimedia/index'); ?>" title="影音專區">影音專區</a>
        </li>
        <li>
            <a href="<?php echo Yii::app()->createUrl('about/index'); ?>" title="關於我們">關於我們</a>
        </li>
    </ul>
</div>
<div id="content"><?php echo $content; ?></div>
<div id="sidebar">
<?php if ( Yii::app()->user->getIsGuest() ) : ?>
    <a href="<?php echo Yii::app()->createUrl('site/login', array('facebook' => true)); ?>" title="使用Facebook帳號登入">使用Facebook帳號登入</a>
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
        <p>帳號：<?php echo Yii::app()->user->getName(); ?></p>
        <a href="<?php echo Yii::app()->createUrl('site/logout'); ?>" title="登出">登出</a>
    </div>
<?php endif; ?>
    <div class="links sidebar-box">
        <h4>連結區</h4>
    </div>
    <div class="recommendands sidebar-box">
        <h4>連結區</h4>
    </div>
</div>
<div id="footer">
    <p>
        主辦單位：國立中央大學學務處　承辦單位：諮商中心　執行單位：2012大一生活知訊網工作團隊
    </p>
    <p>
        地址：32001桃園縣中壢市五權里2鄰中大路300號 | 電話：(03)422-7151#57261 | 版權所有：2012大一生活知訊網工作團隊
    </p>
</div>

<div id="chat">
    <p class="online-friends">
        線上好友<span class="friendcounts"><?php echo 999; // $this->getOnlineFriendsCount(); ?></span>人
    </p>
</div>
<div id="fb-root"></div>
</body>
</html>

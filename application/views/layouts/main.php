<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/style.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/print.css" media="print" />
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/ie.css" media="screen, projection" />
    <![endif]-->

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <title><?php echo $this->getPageTitle(); ?></title>
</head>

<body>

<div id="header">
    <a id="logo" href="<?php echo Yii::app()->createUrl('site/index'); ?>"></a>
    <div class="statics">
        <p class="online"><?php echo $this->getOnlineCount(); ?></p>
        <p class="browsered"><?php echo $this->getTotalCount(); ?></p>
    </div>
    <form id="search" action="<?php echo Yii::app()->createUrl('site/search'); ?>" method="POST">
        <dl>
            <dt>
                <label for="form-search-keywords">搜尋</label>
            </dt>
            <dd>
                <input id="form-search-keywords" name="search[keywords]" type="text" />
            </dd>
        </dl>
        <div>
            <input name="token" value="<?php echo Yii::app()->security->getToekn(); ?>" type="hidden" />
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
            <a href="<?php echo Yii::app()->createUrl('site/index'); ?>" title="大一必讀">大一必讀</a>
        </li>
        <li>
            <a href="<?php echo Yii::app()->createUrl('site/page', array('view' => 'about')); ?>" title="中大生活">中大生活</a>
        </li>
        <li>
            <a href="<?php echo Yii::app()->createUrl('site/contact'); ?>" title="校園導覽">校園導覽</a>
        </li>
        <li>
            <a href="<?php echo Yii::app()->createUrl('site/contact'); ?>" title="論壇專區">論壇專區</a>
        </li>
        <li>
            <a href="<?php echo Yii::app()->createUrl('site/contact'); ?>" title="系所社團">系所社團</a>
        </li>
        <li>
            <a href="<?php echo Yii::app()->createUrl('site/contact'); ?>" title="影音專區">影音專區</a>
        </li>
        <li>
            <a href="<?php echo Yii::app()->createUrl('site/contact'); ?>" title="關於我們">關於我們</a>
        </li>
    </ul>
</div>
<div id="content"><?php echo $content; ?></div>
<div id="sidebar">
<?php if ( Yii::app()->user->getIsGuest() ) : ?>
    <form class="profile" action="<?php echo Yii::app()->createUrl('site/login'); ?>" method="POST">
        <dl>
            <dt>
                <label for="form-login-username">帳號</label>
            </dt>
            <dd>
                <input id="form-login-username" name="login[username]" type="text" />
            </dd>
        </dl>
        <dl>
            <dt>
                <label for="form-login-password">密碼</label>
            </dt>
            <dd>
                <input id="form-login-password" name="login[password]" type="password" />
            </dd>
        </dl>
        <div>
            <input name="token" value="<?php echo Yii::app()->security->getToekn(); ?>" type="hidden" />
            <button id="form-login-button" type="submit">[登入]</button>
            <button id="form-register-button">[註冊]</button>
        </div>
    </form>
<?php else : ?>
    <div class="profile">
        <p>帳號：<?php echo Yii::app()->user->getName(); ?></p>
        <a href="<?php echo Yii::app()->createUrl('site/logout'); ?>" title="登出">登出</a>
    </div>
<?php endif; ?>
    <div class="links sidebar_box">
        <h4>連結區</h4>
    </div>
    <div class="recommendands sidebar_box">
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
</div>

<script type="text/javascript">
(function($)
{
    var keep = function()
    {
        $.get('<?php echo Yii::app()->createUrl('site/keep'); ?>');
        setTimeout(arguments.callee, <?php echo Activity::STATE_UPDATE_TIMEOUT; ?> * 1000);
    };
    keep();
})(jQuery);
</script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/statics/script.js"></script>
</body>
</html>

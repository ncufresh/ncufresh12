<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="description" content="「2012 大一生活知訊網」提供中大新鮮人所需要的訊息，包括註冊、選課、宿舍、科系、社團等各方面實用的資訊，還有其它的生活小密技，讓新生提早了解校園生活的各種面貌。" />
    <meta name="keywords" content="國立中央大學, 中央大學, 中大, 央大, 大一生活知訊網, 生活知訊網, 知訊網, NCU, NCUFreshWeb, NCUFresh, 2012" />
    <meta name="author" content="National Central University FreshWeb Team." />
    <meta name="revised" content="<?php echo date('Y/m/d'); ?>" />
    <meta name="google-site-verification" content="bV-6NsNHeY88_KDBt4G6B0xyJgsIot-eKruL-TZfUkg" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/styles/style.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/styles/print.css" media="print" />
    <?php echo $this->clips['style']; ?>

    <!--[if lt IE 9]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/styles/ie.css" media="screen, projection" />
    <![endif]-->

    <link href="<?php echo Yii::app()->request->baseUrl; ?>/statics/favicon.ico" rel="shortcut icon">

    <title><?php echo $this->getPageTitle(); ?></title>

    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-33883883-1']);
        _gaq.push(['_trackPageview']);

        (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>
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
<?php if ( $this->getId() === 'readme' ) : ?>
        <li class="active">
<?php else : ?>
        <li>
<?php endif; ?>
            <a href="<?php echo Yii::app()->createUrl('readme/index'); ?>" title="大一必讀">大一必讀</a>
            <ul>
                <li>
                    <a href="<?php echo Yii::app()->createUrl('readme/index'); ?>#freshman" title="新生區">新生區</a>
                </li>
                <li>
                    <a href="<?php echo Yii::app()->createUrl('readme/index'); ?>#reschool" title="復學區">復學區</a>
                </li>
                <li>
                    <a href="<?php echo Yii::app()->createUrl('readme/notice', array('id' =>  1)); ?>" title="相關須知">相關須知</a>
                </li>
                <li>
                    <a href="<?php echo Yii::app()->createUrl('readme/download'); ?>" title="文件下載">文件下載</a>
                </li>
            </ul>
        </li>
<?php if ( $this->getId() === 'nculife' ) : ?>
        <li class="active">
<?php else : ?>
        <li>
<?php endif; ?>
            <a href="<?php echo Yii::app()->createUrl('nculife/index'); ?>" title="中大生活">中大生活</a>
            <ul>
                <li>
                    <a href="<?php echo Yii::app()->createUrl('nculife/index'); ?>#play" title="玩在中大">玩在中大</a>
                </li>
                <li>
                    <a href="<?php echo Yii::app()->createUrl('nculife/index'); ?>#traffic" title="行在中大">行在中大</a>
                </li>
                <li>
                    <a href="<?php echo Yii::app()->createUrl('nculife/index'); ?>#school" title="活在中大">活在中大</a>
                </li>
                <li>
                    <a href="<?php echo Yii::app()->createUrl('nculife/index'); ?>#live" title="住在中大">住在中大</a>
                </li>
                <li>
                    <a href="<?php echo Yii::app()->createUrl('nculife/index'); ?>#health" title="健康中大">健康中大</a>
                </li>
            </ul>
        </li>
<?php if ( $this->getId() === 'street' ) : ?>
        <li class="active">
<?php else : ?>
        <li>
<?php endif; ?>
            <a href="<?php echo Yii::app()->createUrl('street/index'); ?>" title="校園導覽">校園導覽</a>
        </li>
<?php if ( $this->getId() === 'forum' ) : ?>
        <li class="active">
<?php else : ?>
        <li>
<?php endif; ?>
            <a href="<?php echo Yii::app()->createUrl('forum/index'); ?>" title="論壇專區">論壇專區</a>
            <ul>
                <li>
                    <a href="<?php echo Yii::app()->createUrl('forum/forum', array('fid' => 1));?>" title="綜合論壇">綜合論壇</a>
                </li>
                <li>
                    <a href="<?php echo Yii::app()->createUrl('forum/forumlist');?>" title="系所論壇">系所論壇</a>
                </li>
                <li>
                    <a href="<?php echo Yii::app()->createUrl('forum/forum', array('fid' => 2));?>" title="社團論壇">社團論壇</a>
                </li>
            </ul>
        </li>
<?php if ( $this->getId() === 'club' ) : ?>
        <li class="active">
<?php else : ?>
        <li>
<?php endif; ?>
            <a href="<?php echo Yii::app()->createUrl('club/index'); ?>" title="系所社團">系所社團</a>
            <ul>
                <li>
                    <a href="<?php echo Yii::app()->createUrl('club/department'); ?>" title="系所">系所</a>
                </li>
                <li>
                    <a href="<?php echo Yii::app()->createUrl('club/student'); ?>" title="學生組織">學生組織</a>
                </li>
                <li>
                    <a href="<?php echo Yii::app()->createUrl('club/club'); ?>" title="社團">社團</a>
                </li>
            </ul>
        </li>
<?php if ( $this->getId() === 'multimedia' ) : ?>
        <li class="active">
<?php else : ?>
        <li>
<?php endif; ?>
            <a href="<?php echo Yii::app()->createUrl('multimedia/index'); ?>" title="影音專區">影音專區</a>
        </li>
<?php if ( $this->getId() === 'about' ) : ?>
        <li class="active">
<?php else : ?>
        <li>
<?php endif; ?>
            <a href="<?php echo Yii::app()->createUrl('about/index'); ?>" title="關於我們">關於我們</a>
        </li>
    </ul>
</div>
<div id="content">
    <div id="<?php echo $this->getId(); ?>"><?php echo $content; ?></div>
</div>
<div id="sidebar">
<?php if ( Yii::app()->user->getIsGuest() ) : ?>
<?php if ( $this->getId() !== 'site' || $this->getAction()->getId() !== 'login' && $this->getAction()->getId() !== 'register' ) : ?>
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
<?php endif; ?>
<?php else : ?>
    <div class="profile">
<?php $this->widget('Avatar', array(
    'id'        => Yii::app()->user->getId(),
    'link'      => true
)); ?>
        <p><?php echo Yii::app()->user->getName(); ?></p>
        <a id="sidebar-personal-toggle" href="#" title="點此打開或關閉個人功能"></a>
    </div>
    <div id="sidebar-personal">
        <ul>
            <li>
                <a href="<?php echo Yii::app()->createUrl('calendar/view'); ?>" title="個人行事曆">個人行事曆</a>
            </li>
            <li>
                <a href="<?php echo Yii::app()->createUrl('profile/message'); ?>" title="最新更新">最新更新</a>
            </li>
            <li>
                <a href="<?php echo Yii::app()->createUrl('profile/profile'); ?>" title="個人資料">個人資料</a>
            </li>
            <li>
                <a href="<?php echo Yii::app()->createUrl('game/index'); ?>" title="遊戲介面">遊戲介面</a>
            </li>
        </ul>
        <a id="sidebar-personal-button" href="<?php echo Yii::app()->createUrl('friends/friends'); ?>" title="好友專區">好友專區</a>
        <a id="sidebar-logout-button" href="<?php echo Yii::app()->createUrl('site/logout'); ?>" title="登出">登出</a>
    </div>
<?php endif; ?>
    <div class="links sidebar-box">
        <h4>常用連結</h4>
        <ul>
            <li>
                <a href="http://www.ncu.edu.tw" title="中大首頁">中大首頁</a>
            </li>
            <li>
                <a href="http://portal.ncu.edu.tw" title="Portal入口">Portal入口</a>
            </li>
            <li>
                <a href="http://course.ncu.edu.tw" title="選課系統">選課系統</a>
            </li>
            <li>
                <a href="http://bb.ncu.edu.tw" title="BlackBoard">BlackBoard</a>
            </li>
            <li>
                <a href="https://uncia.cc.ncu.edu.tw/dormnet/" title="宿網系統">宿網系統</a>
            </li>
            <li>
                <a href="http://volley.cc.ncu.edu.tw:8080/RepairSystem" title="宿舍修繕">宿舍修繕</a>
            </li>
            <li>
                <a href="http://www.lib.ncu.edu.tw" title="圖書館首頁">圖書館首頁</a>
            </li>
            <li>
                <a href="http://passport.ncu.edu.tw/" title="服務學習網">服務學習網</a>
            </li>
            <li>
                <a href="http://www.cc.ncu.edu.tw/~ncu7221/Learning/Learning_index.php" title="大一週會報名">大一週會報名</a>
            </li>
            <li>
                <a href="http://www.oaa.ncu.edu.tw/ep/" title="數位學習歷程平台">數位學習歷程平台</a>
            </li>
            <li>
                <a href="http://140.115.184.185/OSA-3I/" title="學生跨領域3I交流活">學生跨領域3I交流活</a>
            </li>
        </ul>
    </div>
    <div class="links sidebar-box">
        <h4>推薦連結</h4>
        <ul>
            <li>
                <a href="http://radio.pinewave.tw" title="松濤電台">松濤電台</a>
            </li>
            <li>
                <a href="http://www4.is.ncu.edu.tw/register/check/stdno_check.php" title="學號查詢">學號查詢</a>
            </li>
            <li>
                <a href="http://www.uac.edu.tw" title="線上查榜">線上查榜</a>
            </li>
            <li>
                <a href="http://ncugrad.pixnet.net/blog" title="研究生部落">研究生部落</a>
            </li>
            <li>
                <a href="http://www.facebook.com/groups/282591371819838" title="什麼！">什麼！</a>
            </li>
            <li>
                <a href="http://ncufresh.ncu.edu.tw/101-fresh-postgraduate-forum/" title="研究所新生座談">研究所新生座談</a>
            </li>
            <li>
                <a href="http://ncutv.ncu.edu.tw/" title="小中大電視台">小中大電視台</a>
            </li>
            <li>
                <a href="http://www.facebook.com/NCU.Seed.Volunteer" title="服務學習種子志工">服務學習種子志工</a>
            </li>
        </ul>
    </div>
</div>
<div id="footer">
    <div id="footer-background">
        <div id="footer-content">
            <p>
                主辦單位：國立中央大學學務處　承辦單位：<a href="http://love.adm.ncu.edu.tw" title="國立中央大學 諮商中心">諮商中心</a>　執行單位：2012大一生活知訊網工作團隊
            </p>
            <p>
                地址：32001桃園縣中壢市五權里2鄰中大路300號 | 電話：(03)422-7151#57261 | 版權所有：2012大一生活知訊網工作團隊
            </p>
        </div>
    </div>
</div>

<?php if ( Yii::app()->user->getIsMember() ) : ?>
<div id="chat" notify="<?php echo Yii::app()->request->baseUrl; ?>/statics/notify">
    <p class="online-friends">
        線上好友<span class="friendcounts">0</span>人
    </p>
</div>
<?php endif; ?>
<div id="fb-root"></div>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
    jQuery.extend({
        configures: {
            ncuFreshWebUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('site/index'); ?>'),
            pullUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('site/pull'); ?>'),
            chatOpenUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('chat/open', array('id' => ':id')); ?>'),
            chatSendUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('chat/send'); ?>'),
            chatCloseUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('chat/close'); ?>'),
            chatAvatarUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('chat/avatar'); ?>'),
            ncuLifeUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('nculife/content', array('tab' => ':tab', 'page' => ':page'));?>'),
            readMeUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('readme/content', array('tab' => ':tab', 'page' => ':page'));?>'),
            multimediaYoutubeUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('multimedia/watch', array('v' => ':v')); ?>'),
            multimediaIntroductionUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('multimedia/introduction', array('v' => ':v')); ?>'),
            newsIndexUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('news/index'); ?>'),
            registerUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('site/register'); ?>'),
            calendarViewUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('calendar/view'); ?>'),
            calendarClubUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('calendar/club', array('id' => ':id')); ?>'),
            calendarEventUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('calendar/event', array('id'=> ':id')); ?>'),
            calendarEventsUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('calendar/ajaxEvents'); ?>'),
            calendarShowEventsUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('calendar/showevent'); ?>'),
            calendarClubEventsUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('calendar/ajaxclubevents', array('id' => ':id')); ?>'),
            calendarClubRecycleUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('calendar/clubrecycle', array('id'=> ':id'));?>'),
            calendarHideEventUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('calendar/hideEvent'); ?>'),
            buildingContentUrl:decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('street/building', array('id' => ':id'));?>'),
            forumSortUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('forum/forum', array('fid' => Yii::app()->request->getQuery('fid', 0), 'sort' => ':sort', 'category' => Yii::app()->request->getQuery('category', 0)));?>'),
            forumCancelUrl: decodeURIComponent('<?php echo Yii::app()->createUrl('forum/forum', array('fid' => Yii::app()->request->getQuery('fid', 0), 'sort' => 'create'));?>'),
            forumDeleteUrl: decodeURIComponent('<?php echo Yii::app()->createUrl('forum/delete');?>'),
            makeFriendUrl: decodeURIComponent('<?php echo Yii::app()->createUrl('friends/makefriends');?>'),
            gameMissionUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('game/problem', array('id' => ':id'));?>'),
            gameSolveUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('game/solve', array('id' => ':id'));?>'),
            facebookChannelUrl: decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('site/channel'); ?>'),
            facebookAppId: '<?php global $ncufreshfb; echo $ncufreshfb['appId']; ?>',
            googleSearchAppId: '011017124764723419863:mdibrr3n-py',
            token: '<?php echo Yii::app()->security->getToken(); ?>'
        }
    });
</script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/statics/scripts/script.js"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/statics/scripts/ie.js"></script>
<![endif]-->
<?php echo $this->clips['script']; ?>
</body>
</html>
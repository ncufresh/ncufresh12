<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/style.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/print.css" media="print" />
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/ie.css" media="screen, projection" />
    <![endif]-->

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div id="container">
    <div id="header">
        <div class="logo"></div>
        <div class="statics"></div>
        <div class="searchbox"></div>
<?php
    $this->widget('zii.widgets.CMenu', array(
        'id'    => 'navigation',
        'items' => array(
            array('label' => 'Home', 'url' => array('/site/index')),
            array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
            array('label' => 'Contact', 'url' => array('/site/contact')),
            array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
            array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => ! Yii::app()->user->isGuest)
        )
    ));
?>
    </div>
    <div id="content"><?php echo $content; ?></div>
    <div id="sidebar">
        <div class="profile">
        </div>
        <div class="links">
        </div>
        <div class="recommendands">
        </div>
    </div>
    <div id="footer">
    </div>
    <div id="chat">
    </div>
</div>

</body>
</html>
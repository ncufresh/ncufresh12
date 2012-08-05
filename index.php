<?php

defined('NCUFRESH2012') or define('NCUFRESH2012', true);

defined('YII_DEBUG') or define('YII_DEBUG', false);

defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

require_once(require_once('ncufresh2012.php'));

Yii::createWebApplication('config.php')->run();
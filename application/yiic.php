<?php

defined('NCUFRESH2012') or define('NCUFRESH2012', true);

defined('YII_DEBUG') or define('YII_DEBUG', true);

defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

$yii = require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'ncufresh2012.php');

$yiic = dirname($yii) . DIRECTORY_SEPARATOR . 'yiic.php';

$config = array(
    'basePath'  => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'application',
    'import'    => array(
        'application.models.*',
        'application.components.*'
    ),
	'components'=> array(
        'db'            => array(
            'connectionString'  => 'mysql:host=' . $ncufreshdb['host'] . ';dbname=' . $ncufreshdb['database'],
            'emulatePrepare'    => true,
            'username'          => $ncufreshdb['username'],
            'password'          => $ncufreshdb['password'],
            'charset'           => 'utf8',
            'tablePrefix'       => ''
        )
	)
);

require_once($yiic);
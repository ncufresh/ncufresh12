<?php

defined('NCUFRESH2012') or die();

$ncufreshdb = array(
    'host'      => 'localhost',
    'port'      => 3306,
    'database'  => 'ncufresh2012',
    'username'  => 'root',
    'password'  => ''
);

$ncufreshfb = array(
    'appId'     => '299021976861868',
    'secret'    => 'da3b004c79c3122de3a702a90a8a6dbf'
);

return dirname(__FILE__) . '/yii/yii.php';

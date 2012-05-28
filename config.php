<?php

global $ncufreshdb;

return array(
    'basePath'  => dirname(__FILE__) . DIRECTORY_SEPARATOR . 'application',
    'preload'   => array('log'),
    'import'    => array(
        'application.models.*',
        'application.components.*'
    ),
    'modules'   => array(
    ),
    'components'=> array(
        'user'          => array(
            'allowAutoLogin'    => true,
        ),
        'urlManager'    => array(
            'urlFormat'         => 'path',
            'rules'             => array(
                '<controller:\w+>/<id:\d+>'                 =>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'    =>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'             =>'<controller>/<action>',
            ),
        ),
        'db'            => array(
            'connectionString'  => 'mysql:host=' . $ncufreshdb['host']. ';dbname=' . $ncufreshdb['database'],
            'emulatePrepare'    => true,
            'username'          => $ncufreshdb['username'],
            'password'          => $ncufreshdb['password'],
            'charset'           => 'utf8',
        ),
        'errorHandler'  => array(
            'errorAction'       => 'site/error',
        ),
        'log'           => array(
            'class'             => 'CLogRouter',
            'routes'            => array(
                array(
                    'class'     => 'CFileLogRoute',
                    'levels'    => 'error, warning',
                )
            )
        )
    ),
    'params'            => array(
    )
);
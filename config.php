<?php

define('TIMESTAMP', time());

global $ncufreshdb;

return array(
    'name'      => '2012 大一生活知訊網',
    'basePath'  => dirname(__FILE__) . DIRECTORY_SEPARATOR . 'application',
    'preload'   => array('log', 'security'),
    'import'    => array(
        'application.models.*',
        'application.components.*'
    ),
    'modules'   => array(
    ),
    'components'=> array(
        'user'          => array(
            'class'             => 'WebUser',
            'allowAutoLogin'    => true
        ),
        'session'       => array(
            'autoStart'         => true,
            'sessionName'       => 'NcuFresh2012'
        ),
		'assetManager'	=> array(
			'basePath'			=> dirname(__FILE__) . DIRECTORY_SEPARATOR . 'statics' . DIRECTORY_SEPARATOR . 'assets'
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
        'security'      => array(
            'class'             => 'Security'
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
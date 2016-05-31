<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'MUA HANG CHINH HANG',
    'language'=>'vi',
    'sourceLanguage'=>'vi',
    
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),
    
	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
        'admin'=>array(
            'defaultController' => 'site',
        ),
	),

	// application components
	'components'=>array(
		'db'=>array(
			'connectionString'=>'mysql:host=localhost;dbname=muahangtaikho',
			'emulatePrepare'=>true,
			'username'=>'root',
			'password'=>'123456',
			'charset'=>'utf8',
            'tablePrefix'=>'',
		),
        
        'session' => array (
            'autoStart' => true,
        ),
	
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
            'showScriptName'=>false,
            'urlSuffix'=>'.html',
			'rules'=>array(
                '' => 'site/index',
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<id:\d+>'=>'<module>/<controller>/view',
				'<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<module>/<controller>/<action>',
				'<module:\w+>/<controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>',
			),
		),
        
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
        
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
                // uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				
				array(
					'class'=>'CWebLogRoute',
				),*/
			),
		),
        'cache'  => array(
            'class'=>'system.caching.CFileCache',
        ),
		
        'authManager'=>array(
        	'class'=>'CDbAuthManager',
        	'connectionID'=>'db',
        	'itemTable'=>'authitem',
        	'itemChildTable'=>'authitemchild',
        	'assignmentTable'=>'authassignment',
        ),
        
		'mail' => array(
            'class' => 'ext.yiimail.YiiMail',
             'transportType'=>'smtp',
             'transportOptions'=>array(
               'host'=>'smtp.gmail.com',
               'username'=>'hson91.it@gmail.com',
               'password'=>'son91123456789',
               'port'=>'465',
               'encryption'=>'ssl',
             ),
            'logging' => true,
            'dryRun' => false,
        ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require('params.php'),
);
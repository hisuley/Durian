<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
$currentDomain = $_SERVER['SERVER_NAME'];

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'金米旅游',
    'language' => 'zh_cn',
	'theme' => 'frontv1',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.extensions.*',
		'application.extensions.EAjaxUpload.*',
        'application.modules.nfy.components.*',
        'application.modules.nfy.models.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'jinmi',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'admin',
		'portal',
        'panel',
        'yutong',
        'nfy'
	),

	// application components
	'components'=>array(
        'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
            'autoRenewCookie' => true,
		),
        'session' => array(
            'class' => 'CDbHttpSession',
            'cookieParams' => array('domain' => $currentDomain),
            'timeout' => 3600,
            'connectionID' => 'db',
            'sessionName' => 'session',
        ),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName' => false,
			'rules'=>array(
                'http://panel.jmlvyou.com' => 'panel/default/index',
                'http://panel.jmlvyou.com/nfy/<controller:\w+>/<action:\w+>' => 'nfy/<controller>/<action>',
                'http://panel.jmlvyou.com/<controller:\w+>/<action:\w+>' => 'panel/<controller>/<action>',
                'http://panel.jmlvyou.com/<controller:\w+>/<action:\w+>/<id:\d+>' => 'panel/<controller>/<action>',
                'http://www.yutongvisa.com/' => 'yutong/default/index',
                'http://www.yutongvisa.com/<controller:\w+>/<action:\w+>' => 'yutong/<controller>/<action>',
                //'http://yutongvisa.com/<controller:\w+>/<action:\w+>' => 'yutong/<controller>/<action>',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				//'http://<module:\w+>.jmlvyou.com/'=>'<module>/default/index',
                //'http://<module:\w+>.jmlvyou.com/<controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>',
			),
		),
		
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=jinmi',
			'emulatePrepare' => true,
			'username' => 'jinmi',
			'password' => 'yanslwangss',
			'charset' => 'utf8',
            'enableParamLogging'=>true
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'trace, profile, info, error, warning',
				),
				//uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
				/*
                array(
                    'class' => 'CWebLogRoute',
                    'levels' => 'trace', //级别为trace
                    'categories' => 'system.db.*' //只显示关于数据库信息,包括数据库连接,数据库执行语句
                ),*/
			),
		),
		'simpleImage'=>array(
                        'class' => 'application.extensions.simpleImage.CSimpleImage',
        ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'dearsuley@gmail.com',
	),
);
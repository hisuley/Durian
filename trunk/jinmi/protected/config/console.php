<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',
    // autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.components.*',
        'application.extensions.*',
        'application.extensions.EAjaxUpload.*',
        'application.modules.nfy.components.Nfy',
        'application.modules.nfy.models.*',
    ),
	// preloading 'log' component
	'preload'=>array('log'),
    'modules'=>array(
      'nfy'
    ),
	// application components
	'components'=>array(
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=jinmi',
            'emulatePrepare' => true,
            'username' => 'jinmi',
            'password' => 'yanslwangss',
            'charset' => 'utf8',
            'tablePrefix'=>'jm_'
        ),
		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),
);
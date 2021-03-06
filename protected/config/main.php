<?php
Yii::setPathOfAlias('chartjs', dirname(__FILE__).'/../extensions/yii-chartjs');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=>array(
		'log',
		'chartjs',
	),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'bootstrap.helpers.TbHtml',
		'bootstrap.helpers.TbArray',
		'bootstrap.behaviors.TbWidget',
                'application.modules.users.models.*',
                'application.modules.sales.models.*',
                'application.modules.uploadfiles.models.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'root',
			'generatorPaths' => array('bootstrap.gii'),
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
//			'ipFilters'=>array('127.0.0.1','::1'),
		),
                'users',
                'sales',
                'uploadfiles',
	),

	// application components
	'components'=>array(

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),

		#'bootstrap' => array('class' => 'bootstrap.components.TbApi.php'),
		'bootstrap' => array(
			'class' => 'bootstrap.components.TbApi',
			'cdnUrl'=>"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.6/",
		),

		##'chartjs' => array(
		##	'class' => "yii-chartjs.components.ChartJs",
		##	'cdnUrl'=>"https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.js",
		##),
		

		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>YII_DEBUG ? null : 'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);

<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
$conf = array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',

	// preloading 'log' component
	'preload'=>array('log'),

    'import'=>array(
        'application.models.*',
        'application.components.*',
    ),

	// application components
	'components'=>array(
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
        'poll' => array(
            'class'=>'PollComponent',
        ),
        'email'=>array(
            'class'=>'application.extensions.email.Email',
            'delivery'=>'php', //Will use the php mailing function.
            //May also be set to 'debug' to instead dump the contents of the email into the view
        ),
		// uncomment the following to use a MySQL database

        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=gympoll',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
        ),
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
    'params' => array(
        'host' => 'gympoll.local',
        'adminEmail'=>'igor.vavrjin@gmail.com',
    )
);

if (file_exists(dirname(__FILE__).'/console.local.php')) {
    $confLocal = include dirname(__FILE__).'/console.local.php';
    $conf = array_replace_recursive($conf, $confLocal);
}

return $conf;
<?php

$conf = CMap::mergeArray(
	require(dirname(__FILE__).'/main.php'),
	array(
		'components'=>array(
			'fixture'=>array(
				'class'=>'system.test.CDbFixtureManager',
			),
			/* uncomment the following to provide test database connection
			'db'=>array(
				'connectionString'=>'DSN for test database',
			),
			*/
		),
	)
);

if (file_exists(dirname(__FILE__).'/test.local.php')) {
    $confLocal = include dirname(__FILE__).'/test.local.php';
    $conf = array_replace_recursive($conf, $confLocal);
}

return $conf;
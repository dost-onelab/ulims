<?php

return array(
	'db'=>array(
		'connectionString' => 'mysql:host=localhost;dbname=ulimsportal',
		'emulatePrepare' => true,
		'username' => '',
		'password' => '',
		'charset' => 'utf8',
		//'tablePrefix' => '',
	),
	
	'ulimsDb'=>array(
		'connectionString'=>'mysql:host=localhost;dbname=ulimslab',
		'username' => '',
		'password' => '',
		'class'=>'CDbConnection',
		'charset' => 'utf8',
		//'tablePrefix' => '',
	),
	
	'referralDb'=>array(
		'connectionString'=>'mysql:host=localhost;dbname=onelabdb',
		'username' => '',
		'password' => '',
		'class'=>'CDbConnection',
		'charset' => 'utf8',
		//'tablePrefix' => '',
	),
	
	'cashierDb'=>array(
		'connectionString'=>'mysql:host=localhost;dbname=ulimscashiering',
		'username' => '',
		'password' => '',
		'class'=>'CDbConnection',
		'charset' => 'utf8',
		//'tablePrefix' => '',
	),
	
	'accountingDb'=>array(
		'connectionString'=>'mysql:host=localhost;dbname=ulimsaccounting',
		'username' => '',
		'password' => '',
		'class'=>'CDbConnection',
		'charset' => 'utf8',
		//'tablePrefix' => '',
	),
	
	'phAddressDb'=>array(
		'connectionString'=>'mysql:host=localhost;dbname=phaddress',
		'username' => '',
		'password' => '',
		'class'=>'CDbConnection',
		'charset' => 'utf8',
		//'tablePrefix' => '',
	),
	
	'information_schema'=>array(
		'connectionString'=>'mysql:host=localhost;dbname=information_schema',
		'username' => '',
		'password' => '',
		'class'=>'CDbConnection',
		'charset' => 'utf8'
	)
);

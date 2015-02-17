DOST Unified Laboratory Information Management System
=====

RELEASE NOTES

This document provides the release notes for the Unified Laboratory Information System. It describes installation     instructions, configuration changes compared to the previous releases of ULIMS, additional features and etc ...

SYSTEM REQUIREMENTS



INSTALLATION

    1.  Download or clone ulims from this repository.
    2.  Extract the release file to a Web-accessible directory:
            
            X:/xampp/htdocs for xampp on windows environment
            /var/www or /var/www/html for linux
            
    3.  Modify database configurations:
            Database credentials has been moved to /ulims/protected/config/db.php which resides on the same 
        directory as the main.php file. In this way we will always have the same main.php file. 

        /ulims/protected/config/db.php
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

FILE PERMISSIONS

    Grant read/write permissions by running the following commands:

        sudo chmod -R 777 ulims/assets
        sudo chmod -R 777 ulims/protected/runtime
        sudo chmod -R 777 ulims/config/site-settings.ini
        sudo chmod -R 777 ulims/config/form-settings.ini


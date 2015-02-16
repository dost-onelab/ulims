<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
Yii::setPathOfAlias('editable', dirname(__FILE__).'/../extensions/x-editable');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

$dbConfig = require(__DIR__ . '/db.php');

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Unified Laboratory Information Management System',

	'theme'=>'abound',

	// preloading 'log' component
	'preload'=>array('log'),

	//'defaultController'=>'user/login',
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',

		//Start: code from http://www.yiiframework.com/wiki/423/installing-yii-users-and-rights-to-newly-created-yii-app/
		'application.modules.user.*',
		'application.modules.user.models.*',
        'application.modules.user.components.*',
        'application.modules.rights.*',
		'application.modules.rights.models.*',
        'application.modules.rights.components.*',
		//End

		//'bootstrap-editable.*',

		'ext.giix-components.*', // giix components

		'editable.*'
	),

	'aliases' => array(
	    //If you used composer your path should be
	    'xupload' => 'ext.vendor.asgaroth.xupload',
	    //If you manually installed it
	    'xupload' => 'ext.xupload'
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'generatorPaths' => array('ext.giix-core'), // giix generators),
		 	//'generatorPaths' =>array('ext.mpgii'),//this line does the trick
			'password'=>'Einhander',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','192.168.1.3','::1'),
		),

		'cashier' => array(
			'defaultController' => 'receipt/admin',
		),

		'accounting' => array(
			'defaultController' => 'orderofpayment/admin',
		),

		'lab' => array(
			'defaultController' => 'request/admin',
		),

		'ref' => array(
			'defaultController' => 'referral/admin',
		),

		'leis' => array(
			'defaultController' => 'equipment/admin',
		),

		'phAddress' => array(
			'defaultController' => 'region/admin',
		),

		//Start: code from http://www.yiiframework.com/wiki/423/installing-yii-users-and-rights-to-newly-created-yii-app/
			//Start: Install Code
			/*'user'=>array(
	                'tableUsers' => 'users',
	                'tableProfiles' => 'profiles',
	                'tableProfileFields' => 'profiles_fields',
	        ),
	        'rights'=>array(
	                'install'=>true,
	        ),*/
			//End: Install Code
		'user'=>array(
                'tableUsers' => 'users',
                'tableProfiles' => 'profiles',
                'tableProfileFields' => 'profiles_fields',
                     # encrypting method (php hash function)
                'hash' => 'md5',

                # send activation email
                'sendActivationMail' => true,

                # allow access for non-activated users
                'loginNotActiv' => false,

                # activate user on registration (only sendActivationMail = false)
                'activeAfterRegister' => false,

                # automatically login from registration
                'autoLogin' => true,

                # registration path
                'registrationUrl' => array('/user/registration'),

                # recovery password path
                'recoveryUrl' => array('/user/recovery'),

                # login form path
                'loginUrl' => array('/user/login'),

                # page after login
                //'returnUrl' => array('/request/admin'),

                # page after logout
                'returnLogoutUrl' => array('/user/login'),
        ),

        //Modules Rights
  		 'rights'=>array(

               'superuserName'=>'Admin', // Name of the role with super user privileges.
               'authenticatedName'=>'Authenticated',  // Name of the authenticated user role.
               'userIdColumn'=>'id', // Name of the user id column in the database.
               'userNameColumn'=>'username',  // Name of the user name column in the database.
               'enableBizRule'=>true,  // Whether to enable authorization item business rules.
               'enableBizRuleData'=>true,   // Whether to enable data for business rules.
               'displayDescription'=>true,  // Whether to use item description instead of name.
               'flashSuccessKey'=>'RightsSuccess', // Key to use for setting success flash messages.
               'flashErrorKey'=>'RightsError', // Key to use for setting error flash messages.

               'baseUrl'=>'/rights', // Base URL for Rights. Change if module is nested.
               'layout'=>'rights.views.layouts.main',  // Layout to use for displaying Rights.
               'appLayout'=>'application.views.layouts.main', // Application layout.
               //'cssFile'=>'rights.css', // Style sheet file to use for Rights.
               'install'=>false,  // Whether to enable installer.
               'debug'=>false,
        ),
        //End

	),

	// application components
	'components'=>array(
		'RestController' => array(
            'class' => 'ext.components.RestController',
        ),

        'curl' => array(
            'class' => 'ext.curl.Curl',
            'options' => array(
        		/*'cookie'=>array(
		            'set'=>'cookie'
		        ),

		        'login'=>array(
		            'username'=>'myuser',
		            'password'=>'mypass'
		        ),

		        'proxy'=>array(
		            'url'=>'someproxy.com',
		            'port'=>80
		        ),

		        'proxylogin'=>array(
		            'username'=>'someuser',
		            'password'=>'somepasswords'
		        ),

		        'setOptions'=>array(
		             CURLOPT_UPLOAD => true,
		             CURLOPT_USERAGENT => Yii::app()->params['agent']
		        ),*/
        	)
        ),

		//Start: Original Code
		//'user'=>array(
			// enable cookie-based authentication
		//	'allowAutoLogin'=>true,
		//),
		//End: Original Code

		'user'=>array(
                'class'=>'RWebUser',
                // enable cookie-based authentication
                'allowAutoLogin'=>true,
                'loginUrl'=>array('/user/login'),
        ),
        
        'authManager'=>array(
                'class'=>'RDbAuthManager',
                'connectionID'=>'db',
                //'defaultRoles'=>array('Authenticated', 'Guest'),
                'defaultRoles'=>array('Encoder'),
        ),

		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),

		'yexcel' => array(
		    'class' => 'ext.yexcel.Yexcel'
		),

		//Number Formatter
		'format'=>array(
        	'class'=>'application.components.Formatter',
    	),

		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=ulimsportal',
			'emulatePrepare' => true,
			'username' => 'adm-0808',
			'password' => 'DostRegion9',
			'charset' => 'utf8',
			//'tablePrefix' => '',
		),

		'ulimsDb'=>array(
			'connectionString'=>'mysql:host=localhost;dbname=ulimslab',
			'username' => 'adm-0808',
			'password' => 'DostRegion9',
			'class'=>'CDbConnection',
			'charset' => 'utf8',
		),

		'referralDb'=>array(
			'connectionString'=>'mysql:host=localhost;dbname=onelabdb',
			'username' => 'adm-0808',
			'password' => 'DostRegion9',
			'class'=>'CDbConnection',
			'charset' => 'utf8',
		),

		'cashierDb'=>array(
			'connectionString'=>'mysql:host=localhost;dbname=ulimscashiering',
			'username' => 'adm-0808',
			'password' => 'DostRegion9',
			'class'=>'CDbConnection',
			'charset' => 'utf8',
		),

		'accountingDb'=>array(
			'connectionString'=>'mysql:host=localhost;dbname=ulimsaccounting',
			'username' => 'adm-0808',
			'password' => 'DostRegion9',
			'class'=>'CDbConnection',
			'charset' => 'utf8',
		),

		'phAddressDb'=>array(
			'connectionString'=>'mysql:host=localhost;dbname=phaddress',
			'username' => 'adm-0808',
			'password' => 'DostRegion9',
			'class'=>'CDbConnection',
			'charset' => 'utf8'
		),

		'information_schema'=>array(
			'connectionString'=>'mysql:host=localhost;dbname=information_schema',
			'username' => 'root',
			'password' => '',
			'class'=>'CDbConnection',
			'charset' => 'utf8'
		),

		'excel'=>array(
                  'class'=>'application.extensions.PhpExcel',
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
		'widgetFactory' => array(
            'widgets' => array(
                'CGridView'=>array(
                        //'cssFile'=>'../css/gridview/styles.css',  // your version of css file
				),
                'CDetailView'=>array(
                        'cssFile'=>'../css/detailview/styles.css',  // your version of css file
				),
                'CListView'=>array(
                        'cssFile'=>'../css/listview/styles.css',  // your version of css file
				),
				'CLinkPager'=>array(
      					//'maxButtonCount'=>5,
      					'cssFile' => '../css/pager/pager.css',
    			),
                'CJuiAutoComplete' => array(
                    'themeUrl' => '/css/jqueryui',
                    'theme' => 'cupertino',
                ),
                'CJuiDialog' => array(
                    'themeUrl' => '/css/jqueryui',
                    'theme' => 'cupertino',
                ),
                'CJuiDatePicker' => array(
                    'themeUrl' => '/css/jqueryui',
                    'theme' => 'cupertino',
                ),
            ),
		),

		'clientScript' => array(
            'scriptMap' => array(
                'jquery-ui.css' => '/ulims/css/jqueryui/cupertino/jquery-ui.css',
            ),
        ),
		'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),
        'editable' => array(
            'class'     => 'editable.EditableConfig',
            'form'      => 'bootstrap',        //form style: 'bootstrap', 'jqueryui', 'plain'
            'mode'      => 'popup',            //mode: 'popup' or 'inline'
            'defaults'  => array(              //default settings for all editable elements
               'emptytext' => 'Click to edit'
            )
        ),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	/*'params'=>array(
		// this is used in contact page
		'adminEmail'=>'red_x88@yahoo.com',
	),*/
	'params'=>require(dirname(__FILE__).'/params.php'),//get params values from params.php
);

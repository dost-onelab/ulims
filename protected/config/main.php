<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
Yii::setPathOfAlias('editable', dirname(__FILE__).'/../extensions/x-editable');
Yii::setPathOfAlias('mailer', dirname(__FILE__).'/../extensions/YiiMailer');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

$params = array_merge(
    require(__DIR__ . '/db.php'),
    require(__DIR__ . '/components.php')
);

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

		'editable.*',
		
		'application.modules.nfy.components.Nfy', 
		'application.modules.nfy.models.*',

		//'ext.mailer.PhpMailer'
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

		'nfy' => array(
			'defaultController' => 'nfy/admin',
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
               //'layout'=>'rights.views.layouts.main',  // Layout to use for displaying Rights.
               'layout'=>'rights.views.layouts.main',  // Layout to use for displaying Rights.
               'appLayout'=>'webroot.themes.abound.views.layouts.main', // Application layout.
               //'appLayout'=>'//layouts/main', // Application layout.
               //'cssFile'=>'/css/rights.css', // Style sheet file to use for Rights.
               'install'=>false,  // Whether to enable installer.
               'debug'=>false,
        ),
        //End

	),

	// application components
	'components'=>$params,

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	/*'params'=>array(
		// this is used in contact page
		'adminEmail'=>'red_x88@yahoo.com',
	),*/
	'params'=>require(dirname(__FILE__).'/params.php'),//get params values from params.php
);

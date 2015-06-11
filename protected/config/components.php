<?php
return array(
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
        
        /*'mailer' => array(
	        // for smtp
	        //'class' => 'ext.mailer.SmtpMailer',
	        //'server' => 'smtp.163.com',
	        //'port' => '25',
	        //'username' => 'your username',
	        //'password' => 'your password',
	
	        // for php mail
	        'class' => 'ext.mailer.PhpMailer',
	    ),*/

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

		'excel'=>array(
                  'class'=>'application.extensions.PhpExcel',
                ),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		
		/* yii-nfy : added 4/14/2015 - Start */
		'queue' => array(
	        'class' => 'nfy.components.NfyDbQueue',
	        'name' => 'Notifications',
	        'timeout' => 30,
	    ),
		/* yii-nfy : added 4/14/2015 - End */
	    
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
        
        'securityManager'=>array(
            //'cryptAlgorithm' => 'rijndael-128',
            'cryptAlgorithm' => 'rijndael-192',
            'encryptionKey' => '"'.file_get_contents(Yii::app()->params['keyPath']).'"',
        ),
);
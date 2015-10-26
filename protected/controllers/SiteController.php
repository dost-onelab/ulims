<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
		
		return array(
			'upload' => array(
				'class' => 'xupload.actions.XUploadAction', 
				'path' => Yii::getPathOfAlias('webroot'). '/uploads', 
				'publicPath' => Yii::getPathOfAlias('webroot').'/uploads' ), 
		);
		
	}
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		Yii::import("xupload.models.XUploadForm");
        $model = new XUploadForm;
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}
	
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	function getAge($dateOfBirth)
	{
		//mm/dd/yyyy
		//explode the date to get month, day and year
         $dateOfBirth = explode("/", $dateOfBirth);
         //get age from date or birthdate
         $age = (date("md", date("U", mktime(0, 0, 0, $dateOfBirth[0], $dateOfBirth[1], $dateOfBirth[2]))) > date("md") ? ((date("Y")-$dateOfBirth[2])-1):(date("Y")-$dateOfBirth[2]));
         return $age;
	}
	
	function actionNotify()
	{
		$fields = array(
			'0'=>array('field'=>'recipient_id', 'value'=>Yii::app()->Controller->getRstlId()),
			'1'=>array('field'=>'read', 'value'=>0), 
			);
		$notifications = RestController::searchResourceMultifields('notifications', $fields);
		
		if (Yii::app()->request->isAjaxRequest)
		{
			$new = count($notifications);
			if($new == 0){
				echo CJSON::encode(array(
					'status'=>'failure', 
					'referralUpdates'=>($notifications['name'] == 'Not Found') ? 0 : count($notifications),
					'systemUpdates'=>0,
				));
			}else{
				echo CJSON::encode(array(
					'status'=>'success',
				 	'referralUpdates'=>($notifications['name'] == 'Not Found') ? 0 : count($notifications), 
					'systemUpdates'=>0,
				));
			}
			exit;               
		}
	}
	
	function actionNotifications()
	{
		$fields = array(
			'0'=>array('field'=>'recipient_id', 'value'=>Yii::app()->Controller->getRstlId()),
			//'1'=>array('field'=>'read', 'value'=>0), 
			);
		$notifications = RestController::searchResourceMultifields('notifications', $fields);
		
		$notifications = new CArrayDataProvider(($notifications['name'] == 'Not Found') ? array() : $notifications, 
				array('pagination'=>$pagination));
	
		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'failure',
                'div'=>$this->renderPartial('notifications', array('notifications'=>$notifications) ,true , true)));
            exit;               
        }else{
            $this->render('notifications',array('model'=>$model,));
        }
	}
}
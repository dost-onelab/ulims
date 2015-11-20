<?php

class ReferralController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		/*return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);*/
		return array('rights');
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	/*public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}*/
	
	public function actionAuthenticate()
	{
		$apiLogin = RestController::verifyAgencyKey(Yii::app()->Controller->RstlId);

		if($apiLogin->code == 200){
			Yii::app()->user->setFlash('apiLogin',$apiLogin->message.'<br/>Connect to Server.');
			$btnClass = 'btn btn-success';
			$alertClass = 'alert alert-success';
		}else{
			Yii::app()->user->setFlash('apiLogin',$apiLogin->message.'<br/>Please contact you ULIMS Administrator.');
			$btnClass = 'btn btn-warning';
			$alertClass = 'alert alert-warning';
		}

		if(isset($_POST['agency_id']))
		{
			$user = User::model()->notsafe()->findByAttributes(array('username'=>Yii::app()->user->name));
			$username = $user->username;
			$password = $user->password;
			
			$id = Yii::app()->Controller->RstlId;
			$apiHost = Yii::app()->Controller->getServer().'/users/accesstoken?id='.$id;
			
			$auth = array(
				//'Authorization: Basic '.base64_encode($username . ':' . $password),
				//'Access-Control-Allow-Credentials: 1',
				//'Authorization: Basic '.base64_encode('testuser:testpassword'),
				'username:'.$username,	
				'password:'.$password,
				'authkey:'.SHA1(rand(1,999999999)),
				'email: '.$user->email
			);
						
			$response = Yii::app()->curl->setOptions(array(CURLOPT_HTTPHEADER => $auth))->get($apiHost);
			Yii::app()->user->setState('accessToken', json_decode($response));
			$this->redirect(array('referral/admin'));
			
		}
		
		$this->render('authenticate',array(
			'model'=>array(), 
			'apiLogin'=>$apiLogin,
			'btnClass'=>$btnClass,
			'alertClass'=>$alertClass,
			'response'=>$response,
		));
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		RestController::checkApiAccess();
		
		$model=$this->loadModel($id);
		
		$referral = RestController::getViewData('referrals', $id);
		
		$agencies = RestController::getCustomData('referrals/agency?id=', $id);
		
		$modelStatus = New Referralstatus;
		$modelStatus->setAttributes($referral['referralstatus'][0], true);
		$modelStatus->id = $referral['referralstatus'][0]['id'];
		
		$logs = RestController::searchResource('notifications', 'resource_id', $id);

		$generateSampleCode = $this->generateSampleCode($referral);
		
		$this->render('view',array(
			'model'=>$model,
			'referral'=>$referral,
			'samples'=>new CArrayDataProvider((count($referral['samples']) == 0 ? array() : $referral['samples']),
						array('pagination'=>$pagination)
					),
				
			'analyses'=>new CArrayDataProvider((count($referral['analyses']) == 0 ? array() : $referral['analyses']), 
						array('pagination'=>$pagination)
					),
			'matchingAgencies'=>new CArrayDataProvider((count($agencies) == 0) ? array() : $agencies, 
						array('pagination'=>$pagination)
					),
			'modelStatus'=>$modelStatus,
			'results'=>new CArrayDataProvider((count($referral['results']) == 0 ? array() : $referral['results']), 
						array('pagination'=>$pagination)
					),
			'acceptingAgencyLookup'=>$agencies,
			'logs'=>$logs,
			'uploadFiles'=>isset($uploadFiles) ? $uploadFiles : array(),
			'generateSampleCode'=>$generateSampleCode
		));
	}

	function generateSampleCode($referral)
	{
		if(Referral::recipient($referral['acceptingAgencyId'])){
			foreach($referral['samples'] as $sample)
			{
				if($sample['sampleCode'] == null)
					return true;
				else
					return false;
			}
		}else{
			return false;
		}
	}

	
	public function actionPreview($id)
	{
		RestController::checkApiAccess();
		
		$referral = RestController::getViewData('referrals', $id);
		
		$logs = RestController::searchResource('notifications', 'resource_id', $id);
		
		$this->render('preview',array(
			'model'=>$model,
			'referral'=>$referral,
			'samples'=>new CArrayDataProvider((count($referral['samples']) == 0 ? array() : $referral['samples']),
						array('pagination'=>$pagination)
					),
			'analyses'=>new CArrayDataProvider((count($referral['analyses']) == 0 ? array() : $referral['analyses']), 
						array('pagination'=>$pagination)
					),
			'matchingAgencies'=>new CArrayDataProvider((count($agencies) == 0) ? array() : $agencies, 
						array('pagination'=>$pagination)
					),
			'modelStatus'=>$modelStatus,
			'results'=>new CArrayDataProvider((count($referral['results']) == 0 ? array() : $referral['results']), 
						array('pagination'=>$pagination)
					),
			'acceptingAgencyLookup'=>$agencies,
			'logs'=>$logs,
		));
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{		
		RestController::checkApiAccess();
		
		$model=new Referral;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Referral']))
		{
			$model->attributes=$_POST['Referral'];
			$model->receivingAgencyId =  Yii::app()->Controller->getRstlId();
			
			if($model->validate())
			{
				/*$postFields = "referralDate=".$_POST['Referral']['referralDate']
					."&receivingAgencyId=".$model->receivingAgencyId
					."&lab_id=".$_POST['Referral']['lab_id']
					."&customer_id=".$_POST['Referral']['customer_id']
					."&paymentType_id=".$_POST['Referral']['paymentType_id']
					."&discount_id=".$_POST['Referral']['discount_id']
					."&reportDue=".$_POST['Referral']['reportDue']
					."&conforme=".$_POST['Referral']['conforme']
					."&receivedBy=".$_POST['Referral']['receivedBy'];*/
				
				$postFields = array(
					'referralDate' => $_POST['Referral']['referralDate'],
					'receivingAgencyId' => $model->receivingAgencyId,
					'lab_id' => $_POST['Referral']['lab_id'],
					'customer_id' => $_POST['Referral']['customer_id'],
					'paymentType_id' => $_POST['Referral']['paymentType_id'],
					'discount_id' => $_POST['Referral']['discount_id'],
					'reportDue' => $_POST['Referral']['reportDue'],
					'conforme' => $_POST['Referral']['conforme'],
					'receivedBy' => $_POST['Referral']['receivedBy'],
					);
				
				$referral = RestController::postData('referrals', $postFields);
				
				if(isset($referral["id"])){
					$this->redirect(array('view','id'=>$referral["id"]));                	
               	}else{
					Yii::app()->user->setFlash('error','The Referral was not successfully saved or updated.');
					Yii::app()->user->setFlash('errormessage', $referral[0]['message']);
					//Yii::app()->user->setFlash('errormessage', print_r($referral));
    				$this->refresh();
               	}
			}
		}

		$model->receivingAgencyId = Yii::app()->Controller->getRstlId();
		$model->paymentType_id = 1;
			
		$this->render('create',array(
			'model'=>$model, 
			'labs' => Lab::listData(), 
			'agencies' => Agency::listData(),
			'discounts'=> Discount::listData()
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		RestController::checkApiAccess();
		
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Referral']))
		{
			$model->attributes=$_POST['Referral'];
			if($model->validate())
			{
				$postFields = array(
					'referralDate' => $_POST['Referral']['referralDate'],
					'receivingAgencyId' => $model->receivingAgencyId,
					'lab_id' => $_POST['Referral']['lab_id'],
					'customer_id' => $_POST['Referral']['customer_id'],
					'paymentType_id' => $_POST['Referral']['paymentType_id'],
					'discount_id' => $_POST['Referral']['discount_id'],
					'reportDue' => $_POST['Referral']['reportDue'],
					'conforme' => $_POST['Referral']['conforme'],
					'receivedBy' => $_POST['Referral']['receivedBy'],
					);
				
				$referral = RestController::putData('referrals', $postFields, $id);
				
				$this->redirect(array('view','id'=>$id));			
			}
		}

		$this->render('update',array(
				'model'=>$model, 
				'labs' => Lab::listData(), 
				'agencies' => Agency::listData(),
				'discounts'=> Discount::listData()
			));
	}
	
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Referral');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		RestController::checkApiAccess();
		
		//$referrals = RestController::getAdminData('consolidatedreferrals');
		$referrals = RestController::getAdminData('referrals?sort=-create_time');
		$results = $this->segregateResults($referrals);
		
		$this->render('admin',array(
			'model'=>$model,
			'referralIn'=>new CArrayDataProvider((count($results['referralIn']) == 0) ? array() : $results['referralIn'], 
				array('pagination'=>$pagination)
			),
			'referralOut'=>new CArrayDataProvider((count($results['referralOut']) == 0) ? array() : $results['referralOut'], 
						array('pagination'=>$pagination)
					),
			'referrals'=>$referrals,
			'newReferrals'=>Referral::countNewReferrals(),
			'res'=>$res
		));
	}

	function segregateResults($referrals)
	{
		$agencyId = Yii::app()->Controller->getRstlId();
		
		$results = array(
			'referralOut' => array(),
			'referralIn' => array(), 
		);
		
		foreach($referrals as $referral)
		{
				if($referral['acceptingAgencyId'] == $agencyId){
					array_push($results['referralIn'], $referral);
				}
				if($referral['receivingAgencyId'] == $agencyId){
					array_push($results['referralOut'], $referral);
				}	
		}
		return $results;
	}
	
	public function actionUpdateStatus()
	{
		RestController::checkApiAccess();
		
		$id = $_GET['id'];
		$recipient_id = $_GET['recipient_id'];
		
		$referral = RestController::getCustomData('referrals/updatestatus?id=', $id);
		
		if($referral['code'] == 200)
		{
			$postFields = array( 
					'type_id' => 2,
					'sender' => Users::model()->findByPk(Yii::app()->user->id)->fullname,
					'recipient_id' => $recipient_id,
					'sender_id' => Yii::app()->Controller->getRstlId(),
					'message' => '',
					'controller' => 'referral',
					'action' => 'view',
					'resource_id' => $id,
					'read' => 0
					);
								
			$notification =  RestController::postData('notifications', $postFields);
		}else{
			return $referral;
		}
	}
	
	public function actionValidateReferral()
	{
		RestController::checkApiAccess();
		
		if(isset($_POST['id'])){
			$referralId = $_POST['id'];
		}
		if(isset($_POST['Referral']['referralId'])){
			$referralId = $_POST['Referral']['referralId'];
		}
		
		$model=$this->loadModel($referralId);
		
		if(isset($_POST['Referral']))
		{
			$authenticateTechnicalManager = Users::validateTechnicalManager($_POST['Referral']['technicalManager'], $_POST['Referral']['managerPassword']);
			
			if($authenticateTechnicalManager){
				$referral = RestController::getCustomData('referrals/validate?id=', $referralId);
				if(isset($referral)){
					echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>'Referral Validated'
                        ));
                	exit;                	
               	}else{
					Yii::app()->user->setFlash('error','Validation error!');
					Yii::app()->user->setFlash('errormessage', $referral);
    				echo CJSON::encode(array(
                        'status'=>'failure', 
                        'div'=>$this->renderPartial('_validateReferral', 
									array(
										'model'=>$model,
										'referralId'=>$_POST['Referral']['referralId'],
										'message'
									), true, true)
					));
	                exit;
               	}
			}else{
				Yii::app()->user->setFlash('error','Authentication unsuccessful!');
				Yii::app()->user->setFlash('errormessage', 'Password does not match with the selected Technical Manager.');
				echo CJSON::encode(array(
                        'status'=>'failure', 
                        'div'=>$this->renderPartial('_validateReferral', 
									array(
										'model'=>$model,
										'referralId'=>$_POST['Referral']['referralId'],
									), true, true)
				));
                exit;
			}
		}
		
		if(Yii::app()->request->isAjaxRequest)
        {
			echo CJSON::encode(array(
                'status'=>'failure',
                'div'=>$this->renderPartial('_validateReferral', 
						array(
							'model'=>$model,
							'referralId'=>$referralId,
				), true, true)));
            exit;               
        }
	}
	
	public function actionSearchAgency()
	{
		RestController::checkApiAccess();
		
		$results = RestController::getCustomData('referrals/agency?id=', $_POST['id']);
				
		return $results;
	}
	
	public function actionNotifyAgency()
	{
		RestController::checkApiAccess();
		
		$postFields = array( 
					'type_id' => 1,
					'sender' => Users::model()->findByPk(Yii::app()->user->id)->fullname,
					'recipient_id' => $_POST['recipient_id'],
					'sender_id' => Yii::app()->Controller->getRstlId(),
					'controller' => 'referral',
					'action' => 'preview',
					'resource_id' => $_POST['resource_id'],
					'read' => 0
					);
								
		$notify = RestController::postData('notifications', $postFields);
		return $notify;		
	}
	
	public function actionMarkread()
	{
		$notification = RestController::getCustomData('notifications/markread?id=', $_POST['resource_id']);
		return $notification;
	}
	
	public function actionSend($id=NULL)
	{
		if(isset($_POST['Referral']['id'])){
			$id = $_POST['Referral']['id'];
		}else{
			if(isset($_POST['referral_id']))
				$id = $_POST['referral_id'];
		}	
			
		$model=$this->loadModel($id);
		
		if(isset($_POST['Referral']))
		{
			
			$ch = curl_init();
			$url = 'http://'.Yii::app()->Controller->getServer().'/referrals/'.$id;
			
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			
			//Update data
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
			curl_setopt($ch, CURLOPT_POSTFIELDS,
				"status=".$_POST['Referral']['status']
				."&acceptingAgencyId=".$_POST['Referral']['acceptingAgencyId']
			);
			
			$data = curl_exec($ch);
			curl_close($ch);
			
			$json = json_decode($data, true);
			
			if (Yii::app()->request->isAjaxRequest)
				{
					echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"Referral successfully sent"
                        ));
                      
                    exit;    
				}
				else
					$this->redirect(array('view','id'=>$model->id));
		}
		if (Yii::app()->request->isAjaxRequest)
        {
			echo CJSON::encode(array(
                'status'=>'failure',
                'div'=>$this->renderPartial('_sendReferral', 
						array(
							'model'=>$model,
							'referralId'=>$referralId,
				), true, true)));
			
            exit;               
        }
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Referral the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$referral = RestController::getViewData('referrals', $id);
		
		$model = New Referral;
		$model->setAttributes($referral, true);
		$model->id = $id;
		
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Referral $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='referral-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionUploadResult()
	{
		$model = New Result;
		
		$model->attributes=$_POST['Result'];
		
		$uploadFile = CUploadedFile::getInstance($model,'uploadFile');

		$cfile = new CURLFile($uploadFile->tempName, $uploadFile->type, $uploadFile->name);
				
		$postFields = array(
					'referral_id' => $_POST['Result']['referral_id'],
					'filename' => $uploadFile->name, 
					'file' => $cfile
		);
					
		$referral = RestController::postData('results', $postFields);
		
		$this->redirect(array('view','id'=>$_POST['Result']['referral_id']));
	}
	
	public function actionPrint($id)
	{
		$referral = RestController::getViewData('referrals', $id);

		$pdf = Yii::createComponent('application.extensions.tcpdf.referralPdf', 
		                            'P', 'cm', 'A4', true, 'UTF-8');

		$pdf = new referralPdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        spl_autoload_register(array('YiiBase','autoload'));
 
 		$pdf->setReferral($referral);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);  
 
        $pdf->SetTitle($referral['referralCode']);               
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Selling Report -2013", "selling report for Jun- 2013");
        //$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        //$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        //$pdf->SetMargins(0, 287.15, 150);
        //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetMargins(0,87.15,0);
        $pdf->SetAutoPageBreak(TRUE, 60);
        
        $pdf->AddPage();
 
        $pdf->printRows();
        
        // reset pointer to the last page
        $pdf->lastPage();
 
        //Close and output PDF document
        $pdf->Output($request->requestRefNum, 'I');
        //Yii::app()->end();
	}
	
	public function actionSendResult($id)
	{
		$model=new Result;
	
			// Uncomment the following line if AJAX validation is needed
			//$this->performAjaxValidation($model);
	
			if(isset($_POST['Result']))
			{
					$uploadFiles = CUploadedFile::getInstancesByName('uploadFile');
					if($uploadFiles){
						 foreach ($uploadFiles as $uploadFile) {
						 	$cfile = new CURLFile($uploadFile->tempName, $uploadFile->type, $uploadFile->name);
						 	
						 	$postFields = array(
								'referral_id' => $_POST['Result']['referral_id'],
								'filename' => str_replace(' ', '', $uploadFile->name), 
								'file' => $cfile
							);
							$response = RestController::postData('results', $postFields);
						 }
					}
					$this->redirect(array('referral/view','id'=>$id));
			}
	}
}

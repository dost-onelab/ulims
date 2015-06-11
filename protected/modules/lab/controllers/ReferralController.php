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
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'searchCustomer', 'searchSample'),
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
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		//Resource Address
		$url = 'http://localhost/yii-blog-rest/index.php/api/referrals/'.$id;
			
		//Send Request to Resource
		$client = curl_init();
		
		curl_setopt($client, CURLOPT_HTTPHEADER, array(
		    'X_ASCCPE_USERNAME: demo',
		    'X_ASCCPE_PASSWORD: demo'
	    ));
	    
	    curl_setopt($client, CURLOPT_URL, $url);
	    //curl_setopt($client, CURLOPT_POST, 1);
	    //curl_setopt($client, CURLOPT_POST, count($fields));
	    //curl_setopt($client, CURLOPT_POSTFIELDS, 
	    //	"{'id':'','module':'cashier', 'designation':'IT Staff', 'designationAlias':'IT', 'name':'asdadasda'}");
		
		curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($client, CURLOPT_VERBOSE, 1);
		//curl_setopt($client, CURLOPT_HEADER, 1);
		//curl_setopt($client,CURLOPT_CONNECTTIMEOUT ,3);
		//curl_setopt($client,CURLOPT_TIMEOUT, 20);
		//Get Response from Resource
		$response = curl_exec($client);
		
		//Decode
		//$decodedText = html_entity_decode($response);
		
		$referral = json_decode($response, true);
		//$referral = array($referral);
		$this->render('view',array(
			//'model'=>$model,
			'response'=>$response,
			'referral'=>$referral
			//'referrals'=>new CArrayDataProvider($referrals)
		));
		//$model=$this->loadModel($id);
		/*
		$sampleDataProvider = new CArrayDataProvider($model->samps, 
			array(
				'pagination'=>false,
			)
		);
		
		$analysisDataProvider = new CArrayDataProvider($model->anals, 
			array(
				'pagination'=>false,
			)
		);
		
		$generated = $this->checkIfGeneratedSamples($model);
		
		$this->render('view',array(
			'id'=>$id,
			'model'=>$model,
			'sampleDataProvider'=>$sampleDataProvider,
			'analysisDataProvider'=>$analysisDataProvider,
			'generated'=>$generated
		));
		*/
		
		
	}
	
	/** Previous logic for function "checkIfGeneratedSamples" : Start **/
	/* function checkIfGeneratedSamples($request)
	{
		$lastGenerated = Generatedrequest::model()->find(array(
			'order'=>'id DESC',
			//'limit'=>1, //not needed with find()
    		'condition'=>'rstl_id=:rstl_id AND labId=:labId AND year=:year',
    		'params'=>array(':rstl_id' => Yii::app()->Controller->getRstlId(), ':labId' => $request->labId, ':year' => date('Y', strtotime($request->requestDate)))
		));	
		
		$currentRequest = Requestcode::model()->find(array(
    		'condition'=>'rstl_id=:rstl_id AND requestRefNum=:requestRefNum',
    		'params'=>array(':rstl_id' => Yii::app()->Controller->getRstlId(), ':requestRefNum' => $request->requestRefNum)
		));	
		
		return ($currentRequest->number - $lastGenerated->number);
	} */
	/** Previous logic for function "checkIfGeneratedSamples" : End **/
	
	function checkIfGeneratedSamples($request)
	{
	$generatedThisRequest = Generatedrequest::model()->count(array(
    		'condition'=>'request_id =:request_id',
    		'params'=>array(':request_id'=>$request->id)
		));

	$previousRequest = Request::model()->find(array(
				'order'=>'id DESC',
	    		'condition'=>'id<:id AND rstl_id=:rstl_id AND labId=:labId',
	    		'params'=>array(':id'=>$request->id, ':rstl_id' => Yii::app()->Controller->getRstlId(), ':labId' => $request->labId)
			));	
	
	$generatedPreviousRequest = Generatedrequest::model()->count(array(
	    		'condition'=>'request_id =:request_id',
	    		'params'=>array(':request_id'=>$previousRequest->id)
			));
						
	switch ($generatedThisRequest) {
		case (0):
			
			if($generatedPreviousRequest == 1 || !isset($previousRequest)){
				//echo "Generate Sample Code!";
				return 1;
				break;	
			}else{
				//echo '<p style="font-style: italic; font-weight: bold; color: red;">Generate Sample Codes from previous requests and refresh this page!</p>';
				return 2;
				break;
			}
			
		case (1):
			//echo "Print Request";
			return 0;
			break;
			
		break;
	}
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Referral;
		//$model->paymentType = 1;
		//$model->labId = 1;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Request']))
		{
			$model->attributes=$_POST['Request'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Request']))
		{
			$model->attributes=$_POST['Request'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
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

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionCancel($id)
	{
		Request::model()->updateByPk($id, 
			array('cancelled'=>1, 'total'=>0,
			));
		$request = $this->loadModel($id);
		foreach($request->samps as $samples){
			Sample::model()->updateByPk($samples->id, 
				array('cancelled'=>1,
			));
		}
		foreach($request->anals as $analysis){
			Analysis::model()->updateByPk($analysis->id, 
				array('cancelled'=>1, 'fee'=>0,
			));
		}
		
		//$this->loadModel($id);
		//print_r($request->samps);
		//echo $id;
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Request');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		//Resource Address
		$url = 'http://localhost/yii-blog-rest/index.php/api/referrals';
			
		//Send Request to Resource
		$client = curl_init();
		
		curl_setopt($client, CURLOPT_HTTPHEADER, array(
		    'X_ASCCPE_USERNAME: demo',
		    'X_ASCCPE_PASSWORD: demo'
	    ));
	    
	    curl_setopt($client, CURLOPT_URL, $url);
	    //curl_setopt($client, CURLOPT_POST, 1);
	    //curl_setopt($client, CURLOPT_POST, count($fields));
	    //curl_setopt($client, CURLOPT_POSTFIELDS, 
	    //	"{'id':'','module':'cashier', 'designation':'IT Staff', 'designationAlias':'IT', 'name':'asdadasda'}");
		
		curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($client, CURLOPT_VERBOSE, 1);
		//curl_setopt($client, CURLOPT_HEADER, 1);
		//curl_setopt($client,CURLOPT_CONNECTTIMEOUT ,3);
		//curl_setopt($client,CURLOPT_TIMEOUT, 20);
		//Get Response from Resource
		$response = curl_exec($client);
		
		//Decode
		//$decodedText = html_entity_decode($response);
		
		$referrals = json_decode($response, true);
		$this->render('admin',array(
			'model'=>$model,
			'referrals'=>new CArrayDataProvider($referrals//, 
						//array('pagination'=>$pagination)
					)
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Request the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Request::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Request $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='request-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	function actionSearchCustomer(){
		
		if (!empty($_GET['term'])) {
			$sql = 'SELECT id as id, customerName as customerName, address as address, tel as tel, fax as fax, customerName as label';
			$sql .= ' FROM ulimslab.customer WHERE customerName LIKE :qterm OR head LIKE :qterm AND rstl_id = '.Yii::app()->getModule('user')->user()->profile->getAttribute('pstc');
			$sql .= ' GROUP BY customerName ORDER BY customerName ASC';
			$command = Yii::app()->db->createCommand($sql);
			$qterm = $_GET['term'].'%';
			$command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
			$result = $command->queryAll();
			//$_SESSION['test'] = $result; 
			echo CJSON::encode($result); exit;
		  } else {
			return false;
		  }
	}
	
	function actionSearchSample(){
		
		if (!empty($_GET['term'])) {
			//$sql = 'SELECT id as id, name as name, description as description, CONCAT(name,": ",description) as label';
			$sql = 'SELECT id as id, name as name, description as description, name as label';
			$sql .= ' FROM ulimslab.samplename WHERE name LIKE :qterm';
			$sql .= ' ORDER BY name ASC';
			$command = Yii::app()->db->createCommand($sql);
			$qterm = $_GET['term'].'%';
			$command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
			$result = $command->queryAll();
			//$_SESSION['test'] = $result; 
			echo CJSON::encode($result); exit;
		  } else {
			return false;
		  }
	}
	
	public function behaviors()
    {
        return array(
            'eexcelview'=>array(
                'class'=>'ext.eexcelview.PrintRequestBehavior',
            ),
        );
    }
	
	function actionGenRequestExcel($id){
					
	    // Load data (scoped)
	    $request = Request::model()->findByPk($id);
		$samples = $request->samps;
			
	    // Export it
	    $this->toExcel($model,
	        array(
	            'id',
	        ),
	        $request->requestRefNum,
	        array(
	            'creator' => 'RSTL',
	        	'request' => $request,
	        	'samples' => $samples,
	        ),
	        'Excel5'
	    );
	}
	
	public function actionCreateOP(){
			
		$model=new Orderofpayment;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Orderofpayment']))
		{
			$model->attributes=$_POST['Orderofpayment'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		
		$customers = Customer::model()->findAll(
			array(
				'condition'=>'rstl_id = :rstl_id', 
				'params'=>array(':rstl_id'=>Yii::app()->Controller->getRstlId()))
		);
		//$customer_id = 447;
		$requests = Request::model()->findAll(
			array(
				'condition'=>'rstl_id = :rstl_id AND customerId = :customerId', 
				'params'=>array(':rstl_id'=>Yii::app()->Controller->getRstlId(), ':customerId'=>$customer_id))
		);
		
		$gridDataProvider = new CArrayDataProvider($requests, array('pagination'=>false));
		
		$this->render('createOP',array(
				'model'=>$model, 
				'customers'=>CHtml::listData($customers, 'id', 'customerName'),
				'gridDataProvider'=>$gridDataProvider
			));
	}
	
	public function actionSearchRequests()
	{
		$customer_id = $_POST['Orderofpayment']['customer_id'];
		
		$requests = Request::model()->findAll(
			array(	'condition'=>'rstl_id = :rstl_id AND customerId = :customerId ORDER BY id DESC', 
					'params'=>array(':rstl_id'=>Yii::app()->Controller->getRstlId(), ':customerId'=>$customer_id))
		);
		
		/*if($requests){
			foreach ($requests as $request){
				$balance=$request->getBalance2();
				if($balance!=0 OR ($model->request_id==$request->id)){ //$model->request_id==$request->id --> needed on update
					$list[] = array(
					'id'=>$request->id,
					'requestRefNum'=>$request->requestRefNum,
					'labId'=>$request->labId,
					'balance'=>$balance
					);
				}
	    	}
		}*/
		
		/*$data = CHtml::listData($requests,'id','requestRefNum');
		//append blank
		//echo CHtml::tag('option', array('value'=>''),CHtml::encode($name),true);
		
		foreach($data as $value=>$name)
		{
			$requests .= CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
		}
		
		echo CJSON::encode(array('requests'=>$requests));
		exit;*/
		
		$gridDataProvider = new CArrayDataProvider($requests, array('pagination'=>false));
		echo $this->renderPartial('_requests', array('gridDataProvider'=>$gridDataProvider));
	}
	
	public function actionPaymentDetail()
	{
		if(isset($_POST['id']))
			$requestId=$_POST['id'];
		
		$request=$this->loadModel($requestId);
		
		$criteria=new CDbCriteria;
		$criteria->condition='request_id=:requestId AND cancelled=0';
		$criteria->params=array(':requestId'=>$requestId);
		$model=new CActiveDataProvider(Collection, array('criteria'=>$criteria, 'pagination'=>false));
		
		echo CJSON::encode(array(
			'div'=>$this->renderPartial('_paymentDetail', array('model'=>$model, 'request'=>$request),true,true)
		));
	}
}

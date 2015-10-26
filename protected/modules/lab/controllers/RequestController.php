<?php

class RequestController extends Controller
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
		
		$model=$this->loadModel($id);
		
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
		$model=new Request;
		$model->paymentType=1;		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Request']))
		{
			$model->attributes=$_POST['Request'];
			$model->customerName=Customer::model()->findByPk($model->customerId)->customerName;
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
	 
	/*public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}*/

	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel()->delete();
	 
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
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
		/** 
		 * Do not delete
		 *
			$requestCodes = Requestcode::model()->findAll();
			foreach($requestCodes as $requestCode){
				$generatedRequest = New Generatedrequest;
				$generatedRequest->request_id = $requestCode->id;
				$generatedRequest->labId = $requestCode->labId;
				$generatedRequest->year = $requestCode->year;
				$generatedRequest->number = $requestCode->number;
				$generatedRequest->save();
			}
		**/
		/*
		$analysisDeleted = Analysis::model()->findAll(array(
					'condition' => 'cancelled = :cancelled OR deleted = :deleted',
				    'params' => array(':cancelled' => 1,':deleted' => 1),
				));
		
				
		foreach($analysisDeleted as $analysis)
		{
			Analysis::model()->updateByPk($analysis->id, 
			array(
				'fee'=>0,
				'cancelled'=>1,
				'deleted'=>1,
			));
		}
		*/
		$model=new Request('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Request']))
			$model->attributes=$_GET['Request'];
		
		//$requestcodeExist = $this->checkRequestCodes($this->getRstlId());	
		
		//if($requestcodeExist){
			$dataProvider=new CActiveDataProvider($model, array(
			    /*'criteria'=>array(
			        'condition'=>'cancelled=0',
			        //'order'=>'requestRefNum DESC',
			        //'with'=>array('customer'),
			    ),*/
			    'pagination'=>array(
			        'pageSize'=>20,
			    ),
			));
	
			$this->render('admin',array(
				'model'=>$model, 'customers'=>$dataProvider,
				//'requestcodeExist'=>$requestcodeExist
			));
		/*}else{
			$this->redirect($this->createUrl('requestcode/create'),array());
		}*/
	}

	public function actionImportData()
	{
		$dirname = Yii::getPathOfAlias('webroot').'/upload/';
		$file = Yii::getPathOfAlias('webroot').'/upload/import.txt';
		
		// Create $dirname if not exist
		if (!is_dir($dirname)){
			mkdir($dirname, 0755, true);
		}
		
		// Create $file if not exist
		if(!file_exists($file)){  
			fopen($file, 'w+');
			file_put_contents($file, serialize(array()));
		}
		
		$importData = array();
		
		if($_FILES['import_path']['tmp_name'])
		{
			Yii::import('application.vendors.PHPExcel',true);
            $objReader = new PHPExcel_Reader_Excel2007;
            $objPHPExcel = $objReader->load($_FILES['import_path']['tmp_name']);
            //$objPHPExcel = $objReader->load('F:\import.xls');
            $objWorksheet = $objPHPExcel->getActiveSheet();
            $highestRow = $objWorksheet->getHighestRow(); // e.g. 10
            $highestColumn = $objWorksheet->getHighestColumn(); // e.g 'F'
            $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5
			
            // Append Requests to array
            $count = 1;
            for ($row = 8; $row <= $highestRow; ++$row) {
            	$requestCol = $objWorksheet->getCellByColumnAndRow(0, $row)->getValue();
            	$dateCol = $objWorksheet->getCellByColumnAndRow(1, $row)->getValue();
            	$sampleCol = $objWorksheet->getCellByColumnAndRow(12, $row)->getValue();
            	$analysisCol = $objWorksheet->getCellByColumnAndRow(15, $row)->getValue();
            	
            	if($requestCol != ''){
            		$requestRow = $row;
            		$year = date('Y', strtotime($objWorksheet->getCellByColumnAndRow(1, $row)->getValue()));
            		$request = array(
            				'id'=>$count,
            				'year'=>$year,
            				'requestRefNum' => $this->requestLookup($objWorksheet->getCellByColumnAndRow(0, $row)->getValue()),
            				'requestReference' => $objWorksheet->getCellByColumnAndRow(0, $row)->getValue(),
            				'requestDate' => $objWorksheet->getCellByColumnAndRow(1, $row)->getValue(),
            				'customerId' => $this->customerLookup($objWorksheet->getCellByColumnAndRow(9, $row)->getCalculatedValue(), 'id'),
            				'customer' => $this->customerLookup($objWorksheet->getCellByColumnAndRow(9, $row)->getCalculatedValue(), 'customerName'),
            				'rstl_id' => Yii::app()->Controller->getRstlId(),
            				'labId' => $objWorksheet->getCellByColumnAndRow(3, $row)->getCalculatedValue(),
            				'paymentType' => $objWorksheet->getCellByColumnAndRow(5, $row)->getCalculatedValue(),
            				'discount' => $objWorksheet->getCellByColumnAndRow(7, $row)->getCalculatedValue(),
            				'total' => '',
            				'reportDue' => $objWorksheet->getCellByColumnAndRow(21, $row)->getCalculatedValue(),
            				'conforme' => $objWorksheet->getCellByColumnAndRow(22, $row)->getValue(),
            				'receivedBy' => $objWorksheet->getCellByColumnAndRow(23, $row)->getValue(),
            				'samples' => array(),
            			);
            		$sampleRow = $row;
            		$sample = array(
            				'sampleName' => $objWorksheet->getCellByColumnAndRow(12, $row)->getValue(),
            				'sampleCode' => $objWorksheet->getCellByColumnAndRow(14, $row)->getValue(),
            				'description' => $objWorksheet->getCellByColumnAndRow(13, $row)->getCalculatedValue(),
            				'remarks' => '',
            				'sampleMonth' => date('m', strtotime($objWorksheet->getCellByColumnAndRow(1, $row)->getValue())),
            				'sampleYear' => date('Y', strtotime($objWorksheet->getCellByColumnAndRow(1, $row)->getValue())),
            				'analyses'=> array()
            		);
            		$trimText = '(Id: '.$objWorksheet->getCellByColumnAndRow(16, $row)->getCalculatedValue().')';
            		$analysis = array(
            				//'sample_id' => $objWorksheet->getCellByColumnAndRow(10, $row)->getValue(),
            				'sampleCode' => $objWorksheet->getCellByColumnAndRow(14, $row)->getValue(),
							'testId' => $objWorksheet->getCellByColumnAndRow(16, $row)->getCalculatedValue(),
            				'testName' =>rtrim($objWorksheet->getCellByColumnAndRow(15, $row)->getValue(), $trimText),
            				'method' => $objWorksheet->getCellByColumnAndRow(17, $row)->getCalculatedValue(),
            				'references' => $objWorksheet->getCellByColumnAndRow(18, $row)->getCalculatedValue(),
            				'quantitty' => 1,
            				'fee' => $objWorksheet->getCellByColumnAndRow(19, $row)->getCalculatedValue(),
            		);
            		
            		array_push($sample['analyses'], $analysis);
            		array_push($request['samples'], $sample);
            		array_push($importData, $request); 
            		$count += 1;
            	}
            	
				if($requestCol == '' AND $sampleCol != ''){
					$sampleRow = $row; 
            		$sample = array(
            				'sampleName' => $objWorksheet->getCellByColumnAndRow(12, $row)->getValue(),
            				'sampleCode' => $objWorksheet->getCellByColumnAndRow(14, $row)->getValue(),
            				'description' => $objWorksheet->getCellByColumnAndRow(13, $row)->getCalculatedValue(),
            				'remarks' => '',
            				'sampleMonth' => date('m', strtotime($objWorksheet->getCellByColumnAndRow(1, $requestRow)->getValue())),
            				'sampleYear' => date('Y', strtotime($objWorksheet->getCellByColumnAndRow(1, $requestRow)->getValue())),
            				'analyses'=> array()
            		);
            		$requestCount = count($importData) - 1;
            		array_push($importData[$requestCount]['samples'], $sample);
            	}
            	
            	if($requestCol == '' AND $sampleCol == '' AND $analysisCol != ''){
            		$trimText = '(Id: '.$objWorksheet->getCellByColumnAndRow(16, $row)->getCalculatedValue().')';
            		$analysis = array(
            				//'sample_id' => $objWorksheet->getCellByColumnAndRow(10, $row)->getValue(),
            				'sampleCode' => $objWorksheet->getCellByColumnAndRow(14, $sampleRow)->getValue(),
            				'testId' => $objWorksheet->getCellByColumnAndRow(16, $row)->getCalculatedValue(),
            				'testName' =>rtrim($objWorksheet->getCellByColumnAndRow(15, $row)->getValue(), $trimText),
            				'method' => $objWorksheet->getCellByColumnAndRow(17, $row)->getCalculatedValue(),
            				'references' => $objWorksheet->getCellByColumnAndRow(18, $row)->getCalculatedValue(),
            				'quantity' => 1,
            				'fee' => $objWorksheet->getCellByColumnAndRow(19, $row)->getCalculatedValue(),
            		);
            		$requestCount = count($importData) - 1;
            		$sampleCount = count($importData[$requestCount]['samples']) - 1;
            		array_push($importData[$requestCount]['samples'][$sampleCount]['analyses'], $analysis);
            	}
            	
            	if($requestCol == '' AND $sampleCol != '' AND $analysisCol != ''){
            		$trimText = '(Id: '.$objWorksheet->getCellByColumnAndRow(16, $row)->getCalculatedValue().')';
            		$analysis = array(
            				//'sample_id' => $objWorksheet->getCellByColumnAndRow(10, $row)->getValue(),
            				'sampleCode' => $objWorksheet->getCellByColumnAndRow(14, $sampleRow)->getValue(),
            				'testId' => $objWorksheet->getCellByColumnAndRow(16, $row)->getCalculatedValue(),
            				'testName' =>rtrim($objWorksheet->getCellByColumnAndRow(15, $row)->getValue(), $trimText),
            				'method' => $objWorksheet->getCellByColumnAndRow(17, $row)->getCalculatedValue(),
            				'references' => $objWorksheet->getCellByColumnAndRow(18, $row)->getCalculatedValue(),
            				'quantity' => 1,
            				'fee' => $objWorksheet->getCellByColumnAndRow(19, $row)->getCalculatedValue(),
            		);
            		$requestCount = count($importData) - 1;
            		$sampleCount = count($importData[$requestCount]['samples']) - 1;
            		array_push($importData[$requestCount]['samples'][$sampleCount]['analyses'], $analysis);
            	}
            }
            
            //Insert result array to file
			file_put_contents($file, serialize($importData));
		}
		
		$data = file_get_contents($file);
		$arr = unserialize($data);
		$importDataProvider = new CArrayDataProvider($arr);
		//$has_duplicate = true;
		
		$this->render('importData',array(
			'file_path'=>$file_path,
			'importDataProvider'=>$importDataProvider, 
			'importData'=>$arr,
			'data'=>$data,
			'has_duplicate'=>$this->checkExistingRequests($arr)
		));
	}
	
	public function customerLookup($customerId, $field)
	{
		$customer = Customer::model()->findByPk($customerId);
		
		switch($field){
			case 'id':
				return $customer ? $customer->id : '';
				break;
				
			case 'customerName':
				return $customer ? $customer->customerName : '<b>Customer: "<i style="color:red">'.$customerName.'</i>" not found in the database</b>';
				break;
			
			case 'address':
				return $customer ? $customer->address : '';
				break;
		}
	}
	
	public function requestLookup($requestRefNum)
	{
		$request = Request::model()->find(array(
   			'select'=>'requestRefNum', 
    		'condition'=>'requestRefNum = :requestRefNum',
    		'params'=>array(':requestRefNum' => $requestRefNum)
		));
		return $request ? '<b>Request: "<i style="color:red">'.$requestRefNum.'</i>" already exist in the database</b>' : $requestRefNum;
	}
	
	public function checkExistingRequests($requests)
	{
		$has_duplicate = false;
		foreach($requests as $request){
			$data = Request::model()->find(array(
	   			'select'=>'requestRefNum', 
	    		'condition'=>'requestRefNum = :requestRefNum',
	    		'params'=>array(':requestRefNum' => $request['requestReference'])
			));
			$has_duplicate = $data ? true : false;
			if($has_duplicate){
				return true;
			}		
		}
		return false;
	}
	
	public function actionImport()
	{
		$file = Yii::getPathOfAlias('webroot').'/upload/import.txt';
		$data = file_get_contents($file);
		$arr = unserialize($data);
		
		file_put_contents($file, serialize(array()));
		
		$count = 0;
		$html = '';
		foreach($arr as $request){
			
			$requestModel = new Request;
			$requestModel->import = true; 
			$requestModel->requestRefNum = $request['requestRefNum'];
			$requestModel->requestId = $requestModel->requestRefNum;
			$requestModel->requestDate = date('Y-m-d',strtotime($request['requestDate']));
			$requestModel->requestTime = date('g:i A');
			$requestModel->rstl_id = $request['rstl_id'];
			$requestModel->labId = $request['labId'];
			$requestModel->customerId = $request['customerId'];
			
			$requestModel->paymentType = $request['paymentType'];
			$requestModel->discount = $request['discount'];
			$requestModel->orId = 0;
			$requestModel->total = 0;
			$requestModel->reportDue = date('Y-m-d',strtotime($request['reportDue']));
			
			$requestModel->conforme = $request['conforme'];
			$requestModel->receivedBy = $request['receivedBy'];
			$requestModel->create_time = $requestModel->requestDate;
			$requestModel->cancelled = 0;    
			
			if($requestModel->save(false))
			{
				foreach($request['samples'] as $sample){
					$sampleModel = new Sample;
					$sampleModel->rstl_id = $requestModel->rstl_id;
					$sampleModel->requestId = $requestModel->requestRefNum;
					$sampleModel->sampleCode = $sample['sampleCode'];
					$sampleModel->sampleName = $sample['sampleName'];
					$sampleModel->description = $sample['description'];
					$sampleModel->remarks = $sample['remarks'];
					$sampleModel->requestId = $requestModel->requestRefNum;
					$sampleModel->request_id = $requestModel->id;
					$sampleModel->sampleMonth = $sample['sampleMonth'];
					$sampleModel->sampleYear = $sample['sampleYear'];
					$sampleModel->cancelled = $sample['cancelled'];
					if($sampleModel->save(false))
					{
						foreach($sample['analyses'] as $test){
							$analysis = new Analysis;
							$analysis->rstl_id = $request['rstl_id'];
							$analysis->requestId = $requestModel->requestRefNum;
							$analysis->sample_id = $sampleModel->id;
							$analysis->sampleCode = $test['sampleCode'];
							$analysis->testName = $test['testName'];
							$analysis->method = $test['method'];
							$analysis->references = $test['references'];
							$analysis->quantity = 1;
							$analysis->fee = $test['fee'];
							$analysis->testId = $test['testId'];
							$analysis->analysisMonth = $sampleModel->sampleMonth;
							$analysis->analysisYear = $sampleModel->sampleYear;
							$analysis->package = 0;
							$analysis->cancelled = 0;
							$analysis->deleted = 0;
							$analysis->save(false);
						}
					}
				}
			}
			$requestRefNum = explode('-', $requestModel->requestRefNum);
			$generatedrequest = new Generatedrequest;
			$generatedrequest->rstl_id = $requestModel->rstl_id;
			$generatedrequest->request_id = $requestModel->id;
			$generatedrequest->labId = $requestModel->labId;
			$generatedrequest->year = date('Y', strtotime($requestModel->requestDate));
			$generatedrequest->number = $requestRefNum[3];
			$generatedrequest->save();
			
			$count += 1;
		}
		if($count != 0){
			$html = $count;
			echo CJSON::encode(array(
	                  	'status'=>'success', 
	                    'div'=>$html.' Requests Successfully Imported.'
	                    ));
			exit;
		}else{
			echo CJSON::encode(array(
                  	'status'=>'failure', 
                    'div'=>'<div style="text-align:center;" class="alert alert-error"><i class="icon icon-warning-sign"></i><font style="font-size:14px;"> System Warning. </font><br \><br \><div>'.$count.' Requests imported.</div></div>'
                    ));
			exit;
		}
	}

	/*function checkRequestCodes($rstl_id){
		/*$requestcode = Requestcode::model()->count(
			array('condition'=>'rstl_id = :rstl_id', 'params'=>array(':rstl_id'=>$rstl_id))
		);*/
		/*$request = Request::model()->count(
			array('condition'=>'rstl_id = :rstl_id', 'params'=>array(':rstl_id'=>$rstl_id))
		);
		
		return ($requestcode != 0) ? true : false;
	}*/
	
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
		
		$labManager=NULL;
		if(isset($request->laboratory->manager->user))
		$labManager=$request->laboratory->manager->user->getFullname();	
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
		
				'agencyName' => Yii::app()->params['Agency']['name'],
				'fullLabName' => Yii::app()->params['Agency']['labName'],
				'agencyAddress' => Yii::app()->params['Agency']['address'],
				'agencyContact' => Yii::app()->params['Agency']['contacts'],
				'formTitle' => Yii::app()->params['FormRequest']['title'],
				'formNum' => Yii::app()->params['FormRequest']['number'],
				'formRevNum' => Yii::app()->params['FormRequest']['revNum'],
				'formRevDate' => Yii::app()->params['FormRequest']['revDate'],	
				'labManager' => $labManager,
				'logoLeft'=>Yii::app()->params['FormRequest']['logoLeft'],
				'logoRight'=>Yii::app()->params['FormRequest']['logoRight'],
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
	
	public function actionImportRequestDetail()
	{
		if(isset($_POST['id']))
			$requestId=$_POST['id'];
		
		$file = Yii::getPathOfAlias('webroot').'/upload/import.txt';

		$data = file_get_contents($file);
		$arr = unserialize( $data );
		
		$request = $arr[$requestId-1];
		$samples = $request['samples'];
		$analyses = array();
		$analyses_sum = 0;
		foreach($samples as $sample){
			$samp = array(
				'sampleCode'=>$sample['sampleCode'],
				'sampleName'=>$sample['sampleName'],
				'description'=>$sample['description'],
			);
			foreach($sample['analyses'] as $analysis){
				array_push($analyses, array_merge($samp, $analysis));
				$analyses_sum += $analysis['fee'];
			}
		}
		$discount = $analyses_sum * (Discount::model()->findByPk($request['discount'])->rate / 100);
		$samplesDataProvider = new CArrayDataProvider($samples);	
		$analysesDataProvider = new CArrayDataProvider($analyses);
		echo CJSON::encode(array(
			'div'=>$this->renderPartial('_importRequestDetail', 
				array(
					'request'=>$request,
					'samples'=>$samples,
					'analyses'=>$analyses,
					'analyses_sum'=>$analyses_sum,
					'discount'=>$discount,
					'analysesDataProvider'=>$analysesDataProvider
				),true,true)
		));
	}
	
	public function actionCreatedataentryfile(){
		$labDataProvider=new CActiveDataProvider(Lab, array(
				'pagination'=>false,
				'criteria'=>array('condition'=>'status=1')
		));
		
		$labs=Lab::model()->findAll(array('condition'=>'status=1'));
		if($labs){
			$labCount=count($labs);
			$labArray=array();
			foreach($labs as $lab){
				$labArray[]=array('labId'=>$lab->id, 'labName'=>$lab->labCode. " - ".$lab->labName);
			}
		}
		
		$discounts=Discount::model()->findAll(array('condition'=>'status=1'));
		if($discounts){
			$discountCount=count($discounts);
			$discountArray=array();
			foreach($discounts as $discount){
				$discountArray[]=array('discountId'=>$discount->id, 'discountType'=>$discount->rate."% - ".$discount->type);
			}
		}
		
		$paymentTypeArray=array();
		$paymentTypeArray[0]=array('paymentTypeId'=>1, 'paymentType'=>'Paid');
		$paymentTypeArray[1]=array('paymentTypeId'=>2, 'paymentType'=>'Fully Subsidized');
		$paymentTypeCount=2;

		$customers=Customer::model()->findAll(array('order'=>'customerName ASC'));
		if($customers){
			$customerCount=count($customers);
			$customerArray=array();
			foreach($customers as $customer){
				$customerArray[]=array('customerId'=>$customer->id, 'customerName'=>$customer->customerName);
			}
		}
		
		$tests=Test::model()->findAll(array('order'=>'sampleType ASC, testName ASC'));
		if($tests){
			$testCount=count($tests);
			$testArray=array();
			foreach($tests as $test){
				$testArray[]=array('testId'=>$test->id,
					'sampleType_id'=>$test->sampleType, 
					'testName'=>Chtml::encode($test->testName.' (Id: '.$test->id.')'),
					'method'=>Chtml::encode($test->method),
					'references'=>Chtml::encode($test->references),
					'fee'=>$test->fee
					);
			}
		}
		
		$sampleTypes=Sampletype::model()->findAll(array('order'=>'sampleType ASC'));
		if($sampleTypes){
			$sampleTypeCount=count($sampleTypes);
			$sampleTypeArray=array();
			foreach($sampleTypes as $sampleType){
				$sampleTypeArray[]=array(
					'sampleType'=>$sampleType->sampleType.' (Id: ' .$sampleType->id.')' ,
					'sampleTypeId'=>$sampleType->id,					
				);
			}
		}
		
		//using function inside array_map to merge array even when array is NULL
		//http://stackoverflow.com/questions/16891397/php-merge-array-on-nulls
		//answer from ExpertSystem (http://stackoverflow.com/users/2341938/expertsystem)
		//http://ideone.com/an6bH9 
		
		$data = array_map(function ($arr1, $arr2) {
		$new2 = array();
		foreach ($arr2 as $key => $value) {
		if (($value !== NULL) || !isset($arr1[$key])) {
			$new2[$key] = $value;
			}
		}
			if($arr1==NULL){
				return $new2;
			}else{
				return array_merge($arr1, $new2);
			}
		}, $labArray, $customerArray);	
		
		//merge $data with discount array		
		$data1 = array_map(function ($arr1, $arr2) {
		$new2 = array();
		foreach ($arr2 as $key => $value) {
		if (($value !== NULL) || !isset($arr1[$key])) {
			$new2[$key] = $value;
			}
		}
			if($arr1==NULL){
				return $new2;
			}else{
				return array_merge($arr1, $new2);
			}
		}, $data, $discountArray);	
		
		//merge $data1 with paymentType array
		$data2 = array_map(function ($arr1, $arr2) {
		$new2 = array();
		foreach ($arr2 as $key => $value) {
		if (($value !== NULL) || !isset($arr1[$key])) {
			$new2[$key] = $value;
			}
		}
			if($arr1==NULL){
				return $new2;
			}else{
				return array_merge($arr1, $new2);
			}
		}, $data1, $paymentTypeArray);	
		
		//merge $data2 with testArray
		$data3 = array_map(function ($arr1, $arr2) {
		$new2 = array();
		foreach ($arr2 as $key => $value) {
		if (($value !== NULL) || !isset($arr1[$key])) {
			$new2[$key] = $value;
			}
		}
			if($arr1==NULL){
				return $new2;
			}else{
				return array_merge($arr1, $new2);
			}
		}, $data2, $testArray);	
		
		//merge $data3 with sampleTypeArray
		$data4=array_map(function ($arr1, $arr2) {
		$new2 = array();
		foreach ($arr2 as $key => $value) {
		if (($value !== NULL) || !isset($arr1[$key])) {
			$new2[$key] = $value;
			}
		}
			if($arr1==NULL){
				return $new2;
			}else{
				return array_merge($arr1, $new2);
			}
		}, $data3, $sampleTypeArray);	
		
		$dataProvider=new CArrayDataProvider($data4);
		
		$this->widget('ext.eexcelview.EExcelViewCreateDataEntryFile', array(
			'dataProvider'=>$dataProvider,
			'columns'=>array(
				'paymentType',
				'paymentTypeId',
				'discountType',
				'discountId',				
				'labName',
				'labId',				
				'customerName',
				'customerId',				
				'testName',
				'testId',
				'sampleType_id',
				'method',
				'references',
				'fee',
				'sampleType',
				'sampleTypeId'
			),
			'title'=>'Data Entry Form for ULIMS',
			'filename'=>'DataEntryForm',
			'grid_mode'=>'export',
			'exportType' => 'Excel2007',
			'creator' =>'ULIMS',
			'subject'=>'Data entry form for ULIMS',
			'labCount'=>$labCount,
			'discountCount'=>$discountCount,
			'paymentTypeCount'=>$paymentTypeCount,
			'customerCount'=>$customerCount,
			'testCount'=>$testCount,
			'sampleTypeCount'=>$sampleTypeCount,
			)
		);

	}
	
	public function actionPrintPDF($id)
	{
		$request = Request::model()->findByPk($id);

		$pdf = Yii::createComponent('application.extensions.tcpdf.requestPdf', 
		                            'P', 'cm', 'A4', true, 'UTF-8');

		$pdf = new requestPdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        spl_autoload_register(array('YiiBase','autoload'));
 
 		$pdf->setRequest($request);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);  
 
        $pdf->SetTitle($request->requestRefNum);               
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
	
	function actionPrint($id)
	{
		switch(Yii::app()->params['FormRequest']['printFormat']){
			case 1:
				$this->redirect(array('genRequestExcel','id'=>$id));
				break;
			
			case 2:
				$this->redirect(array('printPDF','id'=>$id));
				break;
			
			default:
				$this->redirect(array('genRequestExcel','id'=>$id));
		}
	}
}

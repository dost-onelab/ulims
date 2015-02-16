<?php

class LabserviceController extends Controller
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
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Labservice;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Labservice']))
		{
			$model->attributes=$_POST['Labservice'];
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

		if(isset($_POST['Labservice']))
		{
			$model->attributes=$_POST['Labservice'];
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

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Labservice');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Labservice('search2');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Labservice']))
			$model->attributes=$_GET['Labservice'];
		
		//Resource Address
		//$url = Yii::app()->Controller->getServer().'/labservices';
			
		//Send Request to Resource
		/*$client = curl_init();
	    curl_setopt($client, CURLOPT_URL, $url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($client);
		*/
			
		//$labservices = json_decode($response, true);
		
		$labservices = RestController::getAdminData('labservices');
		
		$processedServices = Labservice::processResult($labservices); 
		
		$this->render('admin',array(
			'model'=>$model,
			'services'=>$newArray,
			'labservices'=>$labservices,
			'labservices'=>new CArrayDataProvider($processedServices, 
						array('pagination'=>$pagination)
					)
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Labservice the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Labservice::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Labservice $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='lab-service-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionActivateService($id)
	{
		$agency_id = Yii::app()->Controller->getRstlId();
		$methodReference_id = $id;
		
		//$ch = curl_init();
		//$url = Yii::app()->Controller->getServer().'/services/search?agency_id='.$agency_id.'&method_ref_id='.$methodReference_id;
		
		/*curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		
		$data = curl_exec($ch);
		curl_close($ch);
		
		$service = json_decode($data, true);*/
		//print_r($service);
		
		//$service = RestController::searchResourceMultifields('services', 'search?agency_id='.$agency_id.'&method_ref_id='.$methodReference_id);
		$service = RestController::searchResourceMultifields('services', array(
				'0'=>array('field'=>'agency_id', 'value'=>$agency_id),
				'1'=>array('field'=>'method_ref_id', 'value'=>$methodReference_id) 
			));
		print_r($service);
		if($service['status'] == 404)
		{
			//print_r($service['status']);
			$ch = curl_init();

			$url = Yii::app()->Controller->getServer().'/services';
			
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			
			//Add data
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,
				"agency_id=".$agency_id
				."&method_ref_id=".$methodReference_id
			);
			
			$data = curl_exec($ch);
			curl_close($ch);
			
			$referral_array = json_decode($data, true);	
		}
	}
	
	public function actionDeactivateService($id)
	{
		$agency_id = Yii::app()->Controller->getRstlId();
		$methodReference_id = $id;
		
		$ch = curl_init();
		$url = Yii::app()->Controller->getServer().'/services/search?agency_id='.$agency_id.'&method_ref_id='.$methodReference_id;
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		
		$data = curl_exec($ch);
		curl_close($ch);
		
		$service = json_decode($data, true);
		
		//print_r($service);
		
		if(isset($service[0]))
		{
			$ch = curl_init();
					
			$url = Yii::app()->Controller->getServer().'/services/'.$service[0]['id'];
			
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			
			$data = curl_exec($ch);
			curl_close($ch);
			
			$json = json_decode($data, true);
			//print_r($json);
			print_r($service);
		}
	}
}

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
	/*public function actionUpdate($id)
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
	}*/
	
	public function actionUpdate($id=NULL)
	{
		/*if(isset($_POST['Analysis']['id'])){
			$id=$_POST['Analysis']['id'];
		}else{
			if(isset($_POST['id']))
			$id=$_POST['id'];
		}
		
		$model=$this->loadModel($id);
		*/
		$model= new Labservice;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Labservice']))
		{
			$model->attributes=$_POST['Labservice'];
			//$model->referral_id = $referralId;
			/*if($model->validate()){
				$postFields = "sample_id=".$_POST['Analysis']['sample_id']
					."&testName_id=".$_POST['Analysis']['testName_id']
					."&methodReference_id=".$_POST['Analysis']['methodReference_id']
					."&fee=".$_POST['Analysis']['fee'];
				
				$analysis = RestController::putData('analyses', $postFields, $id);
				
				if (Yii::app()->request->isAjaxRequest)
				{
					echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"Services updated"
                        ));
                    exit;    
				}
			}*/
		}

		if (Yii::app()->request->isAjaxRequest)
        {
        	$labservices = RestController::getAdminData('labservices');
			echo CJSON::encode(array(
                'status'=>'failure',
				'div'=>$this->renderPartial('_formUpdateServices', 
					array(	'model'=>$model,
							'labs'=>Lab::listData(),
							'types'=>Labsampletype::listData(),
							//'labservices'=>RestController::getAdminData('labservices'),
							'labservices'=>new CArrayDataProvider($labservices, 
								array('pagination'=>$pagination)
							),
							'gridDataProvider'=>new CArrayDataProvider(array(), 
								array('pagination'=>$pagination)
							),
							'referralId'=>1) ,true , true)));
            exit;               
        }else{
			$this->render('update',array('model'=>$model));
        }
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
		
		//$labservices = RestController::searchResource('labservices', 'agency_id', Yii::app()->Controller->getRstlId());
		
		$labservices = RestController::searchResource('services', 'agency_id', Yii::app()->Controller->getRstlId());
		//$processedServices = Labservice::processResult($labservices); 
		
		$this->render('admin',array(
			'model'=> $model,
			//'services'=> $newArray,
			'labs' => Lab::listData(),
			'types' => Labsampletype::listData(),
			//'labservicesAll' => RestController::getAdminData('labservices'),
			'gridDataProvider'=> new CArrayDataProvider($gridDataProvider,
						array('pagination'=>$pagination)
					),
			//'labservices'=>$labservices,
			//'labservices'=>new CArrayDataProvider($processedServices, 
			'labservices'=> new CArrayDataProvider((count($labservices) > 0) ? $labservices : array())
			/*'labservices'=> new CArrayDataProvider($labservices,
						array('pagination'=>$pagination)
					),*/
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

		$service = RestController::searchResourceMultifields('services', array(
				'0'=>array('field'=>'agency_id', 'value'=>$agency_id),
				'1'=>array('field'=>'method_ref_id', 'value'=>$methodReference_id) 
			));
			
		if(count($service) == 0)
		{
			$postFields = array(
				"agency_id" => $agency_id,
				"method_ref_id" => $methodReference_id
			);
			$service_array = RestController::postData('services', $postFields);
		}
		$this->updateServices();
	}
	
	public function actionDeactivateService($id)
	{
		$agency_id = Yii::app()->Controller->getRstlId();
		$methodReference_id = $id;
		
		$service = RestController::searchResourceMultifields('services', array(
				'0'=>array('field'=>'agency_id', 'value'=>$agency_id),
				'1'=>array('field'=>'method_ref_id', 'value'=>$methodReference_id) 
			));
		
		if(isset($service[0]))
		{
			$service_array = RestController::deleteData('services', $service[0]['id']);
		}
		$this->updateServices();
	}
	
	public function actionGetSampleType(){
		$sampletypes = RestController::searchResource('labsampletypes', 'lab_id', $_POST['Labservice']['lab_id']);
		
		// Append Blank
		echo CHtml::tag('option', array('value'=>''),CHtml::encode($name),true);
		
		if(!isset($sampletypes['name'])){
			foreach($sampletypes as $sampletype)
			{
				echo CHtml::tag('option',
						   array('value'=>$sampletype['sampletype']['id']), CHtml::encode($sampletype['sampletype']['type']),true);
			}
		}
	}
	
	public function actionGetTestName(){
		$testnames = RestController::searchResource('sampletypetestnames', 'sampletype_id', $_POST['Labservice']['type']);
		
		// Append Blank
		echo CHtml::tag('option', array('value'=>''),CHtml::encode($name),true);
		
		if(!isset($testnames['name'])){
			foreach($testnames as $testname)
			{
				echo CHtml::tag('option',
						   array('value'=>$testname['testname_id']), CHtml::encode($testname['testName']),true);
			}
		}
	}
	
	public function actionGetMethodReference(){
		$methodrefs = RestController::searchResource('testnamemethods', 'testname_id', $_POST['Labservice']['testName_id']);
		
		$gridDataProvider = new CArrayDataProvider($methodrefs, array('pagination'=>false));
		
		$this->renderPartial('_methodReferences', array('gridDataProvider'=>$gridDataProvider), false, true);
	}
	
	public function actionUpdateAmount()
	{
		$es = new EditableSaver('Methodreference');
		$pk = yii::app()->request->getParam('pk');
		try {
			$es->updateMethodreference();
		} catch(CException $e) {
			echo CJSON::encode(array('success' => false, 'msg' => $e->getMessage()));
			return;
		}
		
		$orderofpaymentId=Paymentitem::model()->findByPk($pk)->orderofpayment_id;
		$total=$this->loadModel($orderofpaymentId)->totalPayment;
		echo CJSON::encode(array('success' => true,'total'=>$total));
	}
	
	function updateServices()
	{
		$methodrefs = RestController::searchResource('testnamemethods', 'testname_id', $_POST['Labservice']['testName_id']);
		$gridDataProvider = new CArrayDataProvider($methodrefs, array('pagination'=>false));
		$this->renderPartial('_methodReferences', array('gridDataProvider'=>$gridDataProvider));
	}
	
	function updateOfferedServices()
	{
		$methodrefs = RestController::searchResource('testnamemethods', 'testname_id', $_POST['Labservice']['testName_id']);
		$gridDataProvider = new CArrayDataProvider($methodrefs, array('pagination'=>false));
		$this->renderPartial('_methodReferences', array('gridDataProvider'=>$gridDataProvider));
	}
}

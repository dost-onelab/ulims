<?php

class PackageController extends Controller
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
		
		$model=$this->loadModel($id);	
		$items = explode(',', $model->tests);
		$selected = array();
		$tests = array();
			
		foreach($items as $item){
			$temp = array($item => array('selected' => 'selected'));
			$selected += $temp;
				
			//switch between tables Test and Testforupdate
			$currentTest = Test::model()->findByPk($item);
				
			$raw = array(
				//'id'=>'',
				'testName'=>$currentTest->testName,
				'method'=>$currentTest->method,
				'references'=>$currentTest->references,
				'fee'=>$currentTest->fee
			);
				
			array_push($tests, $raw);
		}
		$gridDataProviderTest = new CArrayDataProvider($tests, array('pagination'=>false));
		
		$this->render('view',array(
			'model'=>$model,
			'gridDataProviderTest'=>$gridDataProviderTest,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Package;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Package']))
		{
			$model->attributes=$_POST['Package'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$tests = array();
			
		$raw = array(
			'testName'=>'',
			'method'=>'',
			'references'=>'',
			'fee'=>''
		);
				
		array_push($tests, $raw);
		
		$gridDataProviderTest = new CArrayDataProvider($tests, array('pagination'=>false));	
		
		$this->render('create',array(
			'model'=>$model,
			'gridDataProviderTest'=>$gridDataProviderTest
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		
		$modelTests = new Test('Search');
		$modelTests->unsetAttributes();  // clear any default values
		if(isset($_GET['Test']))
			$modelTests->attributes=$_GET['Test'];
		
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Package']))
		{
			$model->attributes=$_POST['Package'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

			$items = explode(',', $model->tests);
			$selected = array();
			$tests = array();
			
			foreach($items as $item){
				$temp = array($item => array('selected' => 'selected'));
				$selected += $temp;
				
				//switch between tables Test and Testforupdate
				$currentTest = Test::model()->findByPk($item);
				
				$raw = array(
					//'id'=>'',
					'testName'=>$currentTest->testName,
					'method'=>$currentTest->method,
					'references'=>$currentTest->references,
					'fee'=>$currentTest->fee
				);
				
				array_push($tests, $raw);
			}
		
		$gridDataProviderTest = new CArrayDataProvider($tests, array('pagination'=>false));	
			
		$this->render('update',array(
			'model'=>$model,
			'gridDataProviderTest'=>$gridDataProviderTest,
			'tests'=>$tests,
			'selected'=>$selected,
			'modelTests'=>$modelTests
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
		$dataProvider=new CActiveDataProvider('Package');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Package('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Package']))
			$model->attributes=$_GET['Package'];
		
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Package the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Package::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Package $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='package-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/*function actionGetCategorytype(){
		$data = Testcategory::model()->findAll('labId=:labId', 
					  array(':labId'=>3));
					  
		$data = CHtml::listData($data,'id','categoryName');
		//append blank
		echo CHtml::tag('option', array('value'=>''),CHtml::encode($name),true);
		
		foreach($data as $value=>$name)
		{
			echo CHtml::tag('option',
					   array('value'=>$value),CHtml::encode($name),true);
		}			  
				 
	}*/
	
	function actionGetSampletype(){
	//please enter current controller name because yii send multi dim array 
		if(isset($_POST['Package']['testcategory_id']))
			$category = $_POST['Package']['testcategory_id'];
		//if(isset($_POST['testCategoryUpdate']))
			//$category = $_POST['testCategoryUpdate'];
			
		$data = Sampletype::model()->findAll('testCategoryId=:testCategoryId ORDER BY sampleType', 
					  array(':testCategoryId'=>$category));
	 
		$data = CHtml::listData($data,'id','sampleType');
		//append blank
		echo CHtml::tag('option', array('value'=>''),CHtml::encode($name),true);
		
		foreach($data as $value=>$name)
		{
			echo CHtml::tag('option',
					   array('value'=>$value),CHtml::encode($name),true);
		}
		//Yii::app()->session['sampleType'] = $data;	
	}
	
	function actionGetTest(){
	//please enter current controller name because yii send multi dim array
		if(isset($_POST['Package']['sampletype_id']))
			$sampleType = $_POST['Package']['sampletype_id'];
		//if(isset($_POST['testCategoryUpdate']))
			//$sampleType = $_POST['sampleTypeUpdate'];
			 
		$data=Test::model()->findAll('sampleType=:sampleType ORDER BY testName', 
					  array(':sampleType'=>$sampleType));
	 
		$data=CHtml::listData($data,'id','testName');
		//append blank
		echo CHtml::tag('option', array('value'=>''),CHtml::encode($name),true);
		
		foreach($data as $value=>$name)
		{
			echo CHtml::tag('option',
					   array('value'=>$value),CHtml::encode($name),true);
		}
		Yii::app()->session['analysis'] = $data;	
	}
	
	public function actionUpdateTestGrid()
	{
		$tests = array();
		
		foreach($_POST['Package']['tests'] as $item){
			
			$currentTest = Test::model()->findByPk($item);
			$raw = array(
				//'id'=>'',
				'testName'=>$currentTest->testName,
				'method'=>$currentTest->method,
				'references'=>$currentTest->references,
				'fee'=>$currentTest->fee
			);
			
			array_push($tests, $raw);
		}
		$gridDataProviderTest = new CArrayDataProvider($tests, array('pagination'=>false));
		
		echo $this->renderPartial('_tests', array('gridDataProviderTest'=>$gridDataProviderTest));
	}
	
	
}

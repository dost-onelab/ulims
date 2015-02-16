<?php

class RequestcodeController extends Controller
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
	
	public function actionTest(){
			$requestCodes = array();
			foreach($_POST['Requestcode']['number'] as $number){
				$code = array('count'=>$number);
				array_push($requestCodes, $code);
			}
			//echo count($_POST['Requestcode']['number']);
			//print_r($requestCodes);
			//echo $_POST['Requestcode']['number'][2] + $_POST['Requestcode']['number'][0];
			print_r($_POST['sampleCode']);
			//echo $_POST['sapleCode']." ";
	} 
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Requestcode;
		$labs = Lab::model()->findAll();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Requestcode']))
		{
			$model->attributes=$_POST['Requestcode'];
			
			//$count = count($_POST['Requestcode']['number']);
			$index = 0;
			$labs = Lab::model()->findAll();
			
			foreach($labs as $lab){
				$requestcode = new Requestcode;
				$requestcode->rstl_id = $this->getRstlId();
				$requestcode->labId = $lab->id;
				$requestcode->number = $_POST['Requestcode']['number'][$index];
				$requestcode->year = $_POST['Requestcode']['year'];
				$requestcode->cancelled = 0;
				$requestcode->save();
				$index += 1;
			}
			
			$index2 = 0;
			foreach($labs as $lab){
				$samplecode = new Samplecode;
				$samplecode->rstl_id = $this->getRstlId();
				$samplecode->labId = $lab->id;
				$samplecode->number = $_POST['sampleCode'][$index2];
				$samplecode->year = $_POST['Requestcode']['year'];
				$samplecode->cancelled = 0;
				$samplecode->save();
				$index2 += 1;
			}
			
			$this->redirect($this->createUrl('request/admin'));
		}

		$this->render('create',array(
			'model'=>$model,
			'labs'=>$labs
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

		if(isset($_POST['Requestcode']))
		{
			$model->attributes=$_POST['Requestcode'];
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
		$dataProvider=new CActiveDataProvider('Requestcode');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Requestcode('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Requestcode']))
			$model->attributes=$_GET['Requestcode'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Requestcode the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Requestcode::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Requestcode $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='requestcode-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

<?php

class SampleController extends Controller
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
				'actions'=>array('admin','delete', '@'),
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
		$model=new Sample;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_GET['referralId']))
		{
			$referralId = $_GET['referralId'];
		}	

		if(isset($_POST['Sample']))
		{
			$model->attributes=$_POST['Sample'];
			
			if($model->validate()){
				
				/*$postFields = "referral_id=".$_POST['Sample']['referral_id']
					."&sampleType_id=".$_POST['Sample']['sampleType_id']
					."&sampleName=".$_POST['Sample']['sampleName']
					."&description=".$_POST['Sample']['description'];*/
				
				$postFields = array(
					'referral_id' => $_POST['Sample']['referral_id'],
					'sampleType_id' => $_POST['Sample']['sampleType_id'],
					'sampleName' => $_POST['Sample']['sampleName'],
					'description' => $_POST['Sample']['description']
					);
					
				$referral = RestController::postData('samples', $postFields);
				
				if (Yii::app()->request->isAjaxRequest)
                {
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>'Sample successfully added'
                        ));
                    exit;               
                }
                else
                    $this->redirect(array('view','id'=>$model->id));
			}
		}
		
		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'failure',
                'div'=>$this->renderPartial('_form', array('model'=>$model, 'referralId'=>$_POST['referralId']) ,true , true)));
            exit;               
        }else{
            $this->render('create',array('model'=>$model));
        }
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id=NULL)
	{
		if(isset($_POST['Sample']['id'])){
			$id=$_POST['Sample']['id'];
		}else{
			if(isset($_POST['id']))
			$id=$_POST['id'];
		}
		
		$model=$this->loadModel($id);

		$referralId=$model->referral_id;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Sample']))
		{
			$model->attributes=$_POST['Sample'];
			$model->referral_id = $referralId;
			if($model->validate()){
				
				$postFields = "referral_id=".$_POST['Sample']['referral_id']
					."&sampleType_id=".$_POST['Sample']['sampleType_id']
					."&sampleName=".$_POST['Sample']['sampleName']
					."&description=".$_POST['Sample']['description'];
				
				$sample = RestController::putData('samples', $postFields, $id);
				
				if (Yii::app()->request->isAjaxRequest)
				{
					echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"Sample updated"
                        ));
                    exit;    
				}
				else
					$this->redirect(array('view','id'=>$model->id));
			}
		}

		if (Yii::app()->request->isAjaxRequest)
        {
			echo CJSON::encode(array(
                'status'=>'failure',
                'div'=>$this->renderPartial('_form', array('model'=>$model,'referralId'=>$referralId,
				), true, true)));
			
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
		$response = RestController::deleteData('samples', $id);
		
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Sample');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Sample('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Sample']))
			$model->attributes=$_GET['Sample'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Sample the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$sample = RestController::getViewData('samples', $id);
		
		$model = New Sample;
		$model->setAttributes($sample);
		$model->id = $id;
		
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Sample $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='sample-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

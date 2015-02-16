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
		$model=new Sample;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_GET['id']))
		{
			$requestId = $_GET['id'];
			$request = Request::model()->findByPk($requestId); 
		}	

		if(isset($_POST['Sample']))
		{
			$model->attributes=$_POST['Sample'];
			
			if(isset($_POST['saveAsTemplate']))
			{
				$sampleName = new Samplename;
				$sampleName->name = $model->sampleName;
				$sampleName->description = $model->description;
				$sampleName->save();
			}
			
			$model->request_id = $requestId;
			$model->rstl_id = Yii::app()->user->rstlId;
			
			if($model->save()){
				//$this->redirect(array('view','id'=>$model->id));
				if (Yii::app()->request->isAjaxRequest)
                {
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"Sample successfully added"
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
                'div'=>$this->renderPartial('_form', array('model'=>$model, 'requestId'=>$requestId, 'request'=>$request) ,true , true)));
            exit;               
        }else{
            $this->render('create',array('model'=>$model,));
        }
        
		//$this->render('create',array('model'=>$model,));
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

		$requestId=$model->request_id;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Sample']))
		{
			$model->attributes=$_POST['Sample'];
			$model->request_id = $requestId;
			if($model->save()){
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
                'div'=>$this->renderPartial('_form', array('model'=>$model,'requestId'=>$requestId,
				), true, true)));
			
            exit;               
        }else{
			$this->render('update',array('model'=>$model,'requestId'=>$requestId));
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

	public function actionCancel($id)
	{
		Sample::model()->updateByPk($id, 
			array('cancelled'=>1,
			));
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
		$model=Sample::model()->findByPk($id);
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
	
	public function actionGenerateSampleCode($id)
	{
		$html = "";
		$modelRequest = Request::model()->findByPk($id);
		if($modelRequest->sampleCount && $modelRequest->anals){
			foreach($modelRequest->samps as $sample)
			{
				$labCode = Lab::model()->findByPk($modelRequest->labId);
				
				$year = date('Y', strtotime($modelRequest->requestDate));
				
				$code=new Samplecode;
				$sampleCode = $code->generateSampleCode($labCode, $year);
				$number = explode('-', $sampleCode);
				$this->appendSampleCode($modelRequest, $number[1]);
				
				Sample::model()->updateByPk($sample->id, array('sampleCode'=>$sampleCode));
				
				
				foreach($sample->analysesForGeneration as $analysis)
				{
					Analysis::model()->updateByPk($analysis->id, array('sampleCode'=>$sampleCode));
				}
				
				$sampleNew = Sample::model()->findByPk($sample->id);
				$html .= '<p>'.$sampleNew->sampleName.' : '.$sampleNew->sampleCode.'</p><br/>';
			}
			$this->updateGeneratedRequest($modelRequest);
			echo CJSON::encode(array(
                  	'status'=>'success', 
                    'div'=>$html.'<br \> Successfully Generated.'
                    ));
			exit; 
		}else{
			echo CJSON::encode(array(
                  	'status'=>'failure', 
                    'div'=>'<div style="text-align:center;" class="alert alert-error"><i class="icon icon-warning-sign"></i><font style="font-size:14px;"> System Warning. </font><br \><br \><div>Cannot generate sample code. <br \>Please add at least one(1) sample and analysis.</div></div>'
                    ));
			exit; 			
		}
		

	}
	
	function appendSampleCode($modelRequest, $count)
	{
		$sampleCode = New Samplecode;
		$sampleCode->rstl_id = $modelRequest->rstl_id;
		$sampleCode->requestId = $modelRequest->requestRefNum;
		$sampleCode->labId = $modelRequest->labId;
		$sampleCode->number = $count;
		$sampleCode->year = date('Y', strtotime($modelRequest->requestDate));
		$sampleCode->cancelled = 0;
		$sampleCode->save();
	}
	
	function updateGeneratedRequest($modelRequest)
	{
		$currentRequest = Requestcode::model()->find(array(
    		'condition'=>'rstl_id = :rstl_id AND requestRefNum = :requestRefNum',
    		'params'=>array(':rstl_id' => Yii::app()->user->rstlId, ':requestRefNum' => $modelRequest->requestRefNum)
		));

		$generatedRequest = New Generatedrequest;
		$generatedRequest->rstl_id = $modelRequest->rstl_id;
		$generatedRequest->request_id = $modelRequest->id;
		$generatedRequest->labId = $modelRequest->labId;
		$generatedRequest->year = date('Y', strtotime($modelRequest->requestDate));
		$generatedRequest->number = $currentRequest->number;
		$generatedRequest->save();

	}

	function addZeros($count){
		if($count < 10)
			return '000'.$count;
		elseif ($count < 100)
			return '00'.$count;
		elseif ($count < 1000)
			return '0'.$count;
		elseif ($count >= 1000)
			return $count;
	}
	
	function actionConfirm()
	{	
		$model=new User;
		
		if(isset($_POST['User']))
		{
			//$model->attributes=$_POST['User'];
			
			//$model->sample_id = $sampleId;
			if(isset($_POST['User']['email'])){
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
                'div'=>$this->renderPartial('_confirm', array('model'=>$model), true)));
            exit;               
        }else{
        		
			$this->render('_confirm',array('model'=>$model));
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
			//echo CJSON::encode($result); exit;
		  } /*else {
			return false;
		  }*/
		  echo CJSON::encode($result);
		  Yii::app()->end();
	}
	
	function actionGetSamplename($id){
		$data = Samplename::model()->findByPk($id);			  
		return $data;
	}
}

<?php

class ResultController extends Controller
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
		$model = new Result;

		/*if(isset($_POST['referralId']))
		{
			$referralId = $_POST['referralId'];
		}else{
			$referralId = $_POST['Result']['referralId'];
			//$_POST['Result']['filename'] = $_POST['Result']['uploadFile'];		
		}*/
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Result']))
		{
			$model->attributes=$_POST['Result'];
			
			
			//if($model->validate()){
				//print_r($_FILES["Result"]);
				$uploadFile = CUploadedFile::getInstance($model,'uploadFile');
				
				//$file = CUploadedFile::getInstance($model,'uploadFile');
				//$uploadFile = CUploadedFile::getInstance($model,'uploadFile');
				//$file = CUploadedFile::getInstanceByName('uploadFile');
				
				$cfile = new CURLFile($uploadFile->tempName, $uploadFile->type, $uploadFile->name);
				//$cfile = new CURLFile($uploadFile->tempName, $uploadFile->type, $uploadFile->name);
				
				
				$postFields = array(
					'referral_id' => $_POST['Result']['referral_id'],
					//'filename' => $uploadFile->name, 
					'filename' => $uploadFile,
					'file' => $cfile
				);
					
				//$response = RestController::postData('results', $postFields);
				$response = RestController::postData('results', $postFields);
				
					
				/*if($response == true)
					echo "File uploaded";
				else 	
					echo "Error: ".curl_error($response); 
				*/
				
				if (Yii::app()->request->isAjaxRequest)
                {
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        //'div'=>"Result successfully added"
                        //'div'=>CJSON::decode($response)
                        'div'=>$uploadFile
                        ));
                    exit;               
                }
                else{
                	//echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
                	//print_r($uploadFile->tempName);
                	//print_r($uploadFile);
                	//print_r($referral);
                    //$this->redirect(array('view','id'=>$model->id));
                }
			//}
		}
		
		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'failure',
                'div'=>$this->renderPartial('_form', array('model'=>$model, 'referralId' => $_POST['referralId']) ,true , true)));
                
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
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Result']))
		{
			$model->attributes=$_POST['Result'];
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
		$dataProvider=new CActiveDataProvider('Result');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Result('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Result']))
			$model->attributes=$_GET['Result'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionDownload($id)
	{
		$result = RestController::getViewData('results', $id);
		if(isset($result)){
			//$tmp_file = explode("\\", $result);
			header("Content-disposition: attachment; filename=".$result["filename"]);
			header("Content-type: application/pdf");
			readfile(Yii::app()->Controller->getServer().'/results/download?id='.$id);
		}else{
			Yii::app()->user->setFlash('error','File not found.');
			Yii::app()->user->setFlash('errormessage', $result);
    		$this->refresh();
		}
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Result the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Result::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Result $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='result-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

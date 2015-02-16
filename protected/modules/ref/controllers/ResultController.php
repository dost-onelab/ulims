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
		$model=new Result;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Result']))
		{
			$model->attributes=$_POST['Result'];
			
			
			if($model->validate()){
				
				
				$uploadFile = CUploadedFile::getInstance($model,'uploadFile');

				//$filePath = base64_encode($uploadFile->tempName);
				$postFields = "referral_id=".$_POST['Result']['referral_id']
					//."&filename=".$uploadFile->tempName
					."&filename=".$uploadFile->tempName
					."&file=@".$uploadFile->tempName;
				
				//$referral = RestController::postData('results', $postFields);
				
				$header = array('Content-Type: multipart/form-data');
				$fields = array('file' => '@' . $_FILES['file']['tmp_name'][0]);
				$token = 'NfxoS9oGjA6MiArPtwg4aR3Cp4ygAbNA2uv6Gg4m';
				
				$ch  = curl_init();
				//$url = 'http://localhost/curl_upload/uploads.php';
				$url = 'http://web-server/curl_upload/uploads.php';
				
				//$cfile = new CURLFile($_FILES['image']['tmp_name'], $_FILES['image']['type'], $_FILES['image']['name']);
				$cfile = new CURLFile($uploadFile->tempName, $uploadFile->type, $uploadFile->name);
				$data = array('myimage' => $cfile);
			
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			
				$response = curl_exec($ch);
				
				/*$resource = curl_init();
				curl_setopt($resource, CURLOPT_URL, $url);
				curl_setopt($resource, CURLOPT_HTTPHEADER, $header);
				curl_setopt($resource, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($resource, CURLOPT_POST, 1);
				curl_setopt($resource, CURLOPT_POSTFIELDS, $postFields);
				//curl_setopt($resource, CURLOPT_COOKIE, 'apiToken=' . $token);
				$result = json_decode(curl_exec($resource));
				curl_close($resource);*/
				
				/*$ch = curl_init();
				
				$url = 'http://localhost/onelab/api/web/v1/results';
				
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($resource, CURLOPT_HTTPHEADER, $header);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				
				//Add data
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS,
					//$postFields
					array(
					  'referral_id' => $_POST['Result']['referral_id'],
					  'filename' => $_POST['Result']['filename'],
				      'file' =>
				          '@'.$_FILES['file']['tmp_name']
				    )
				);
				
				$data = curl_exec($ch);
				curl_close($ch);
				
				$json = json_decode($data, true);*/
				
				/*$ch  = curl_init();
				$url = 'http://localhost/curl_upload/upload.php';
				
				$cfile = new CURLFile($uploadFile->tempName, $uploadFile->type, $uploadFile->name);
				$data = array('uploadFile' => $cfile);
				
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

				$response = curl_exec($ch);
				
				echo $uploadFile->tempName;
				echo '<br/>'.$uploadFile->type;
				echo '<br/>'. $uploadFile->name;
				
				if($response == true)
					echo "File uploaded";
				else 	
					echo "Error: ".curl_error($ch); 
				*/
				
				if (Yii::app()->request->isAjaxRequest)
                {
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"Result successfully added"
                        ));
                    exit;               
                }
                else{
                	//echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
                	//print_r($uploadFile->tempName);
                	//print_r($uploadFile);
                	//print_r($json);
                    $this->redirect(array('view','id'=>$model->id));
                }
			}
		}
		
		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'failure',
                'div'=>$this->renderPartial('_form', array('model'=>$model) ,true , true)));
            exit;               
        }else{
            $this->render('create',array('model'=>$model));
        }
	}
	/*public function actionCreate()
	{
		$model=new Result;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Result']))
		{
			$model->attributes=$_POST['Result'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}*/

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

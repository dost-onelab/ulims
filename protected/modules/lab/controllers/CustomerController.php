<?php

class CustomerController extends Controller
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
		$model = $this->loadModel($id);
		//$wallet = new CArrayDataProvider($model->wallet);
		
		/*$criteria = new CDbCriteria;
		$criteria->with = array('manager');	
		$criteria->compare('status',1);*/
		
		/*$transanctionsDataProvider = new CArrayDataProvider($model->wallet->trans, 
			array('pagination'=>false)
		);*/
		$requests=$model->requests;
		$this->render('view',array(
			'model'=>$model,
			'transanctionsDataProvider'=>$transanctionsDataProvider,
			'requests'=>new CArrayDataProvider($requests),
			//'modelWallet'=>$model->wallet
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Customer;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$rstl_id=Yii::app()->getModule('user')->user()->profile->getAttribute('pstc');	
		$model->region_id=Rstl::model()->findByPk($rstl_id)->region->id;
		
		if(isset($_POST['Customer']))
		{
			$model->attributes=$_POST['Customer'];
			
			/*if (isset($_POST['Customer']['region_id']))
				$model->region_id=$_POST['Customer']['region_id'];
			
			if (isset($_POST['Customer']['province_id']))
				$model->province_id=$_POST['Customer']['province_id'];*/
			
			/*if ($_POST['Customer']['municipalitycity_id']!=""){
				$model->region_id=$model->municipality->regionId;
				$model->province_id=$model->municipality->provinceId;
			}*/
			
			if ($_POST['Customer']['municipalitycity_id']!=""){
				$model->region_id=$model->municipality->regionId;
				$model->province_id=$model->municipality->provinceId;
			}else{
				$model->region_id=NULL;
				$model->province_id=NULL;
			}
			
			if($_POST['Customer']['region_id']!="")
				$model->region_id=$_POST['Customer']['region_id'];

			if($_POST['Customer']['province_id']!="")
				$model->province_id=$_POST['Customer']['province_id'];
			

			if($model->save())
				//$this->redirect(array('view','id'=>$model->id));
				if (Yii::app()->request->isAjaxRequest)
                {
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"Customer successfully added"
                        ));
                    exit;               
                }
                else
                    $this->redirect(array('view','id'=>$model->id));
		}
		
		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'failure',
                'div'=>$this->renderPartial('_form', 
            		array(
            			'model'=>$model,
            			'rstl_id'=>Yii::app()->getModule('user')->user()->profile->getAttribute('pstc')
            		) ,true , true)));
            exit;               
        }else{
            $this->render('create',
            		array(
            			'model'=>$model,
            			'rstl_id'=>Yii::app()->getModule('user')->user()->profile->getAttribute('pstc')
            		));
        }
		//$this->render('create',array('model'=>$model,));
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

		if (isset($model->municipalitycity_id)){
			$model->region_id=$model->municipality->regionId;
			$model->province_id=$model->municipality->provinceId;
		}
		
		if(isset($_POST['Customer']))
		{

			$model->attributes=$_POST['Customer'];		
			if ($_POST['Customer']['municipalitycity_id']!=""){
				$model->region_id=$model->municipality->regionId;
				$model->province_id=$model->municipality->provinceId;
			}else{
				$model->region_id=NULL;
				$model->province_id=NULL;
			}
			
			if($_POST['Customer']['region_id']!="")
				$model->region_id=$_POST['Customer']['region_id'];

			if($_POST['Customer']['province_id']!="")
				$model->province_id=$_POST['Customer']['province_id'];
			
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
			'rstl_id'=>Yii::app()->getModule('user')->user()->profile->getAttribute('pstc')
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
		$dataProvider=new CActiveDataProvider('Customer');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Customer('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Customer']))
			$model->attributes=$_GET['Customer'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Customer the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Customer::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Customer $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='customer-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	function actionGetProvince(){
	//please enter current controller name because yii send multi dim array
		if(isset($_POST['Customer']['region_id']))
			$region_id = $_POST['Customer']['region_id'];
			 
		$province = Province::model()->findAll('regionId = :regionId ORDER BY regionId', 
					  array(':regionId'=>$region_id));
	 
		$province=CHtml::listData($province,'id','name');
		//append blank
		$dropDownProvince = CHtml::tag('option', array('value'=>''),CHtml::encode($name),true);
		
		foreach($province as $value=>$name)
			$dropDownProvince .= CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
		
		echo CJSON::encode(array(
					'dropDownProvince'=>$dropDownProvince, 
					'dropDownMunicipalityCity'=>CHtml::tag('option', array('value'=>''),'',true),
					'dropDownBarangay'=>CHtml::tag('option', array('value'=>''),'',true)
		));
		exit;		
		
	}
	
	function actionGetMunicipalityCity(){
	//please enter current controller name because yii send multi dim array
		if(isset($_POST['Customer']['province_id']))
			$province_id = $_POST['Customer']['province_id'];
			 
		$municipalityCity = MunicipalityCity::model()->findAll(array(
				'condition'=>'provinceId=:provinceId',
				'order'=>'name ASC',
				'params'=>array(':provinceId'=>$province_id),
			));
	 
		$municipalityCity = CHtml::listData($municipalityCity,'id','name');
		//append blank
		$dropDownMunicipalityCity = CHtml::tag('option', array('value'=>''),CHtml::encode($name),true);
		
		foreach($municipalityCity as $value=>$name)
			$dropDownMunicipalityCity .= CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
		
		echo CJSON::encode(array(
					'dropDownMunicipalityCity'=>$dropDownMunicipalityCity,
					'dropDownBarangay'=>CHtml::tag('option', array('value'=>''),'',true)
		));
		exit;
	}
	
	function actionGetBarangay(){
	//please enter current controller name because yii send multi dim array
		if(isset($_POST['Customer']['municipalitycity_id']))
			$municipalitycity_id = $_POST['Customer']['municipalitycity_id'];
			 
		$barangay = Barangay::model()->findAll('municipalityCityId = :municipalityCityId ORDER BY name', 
					  array(':municipalityCityId'=>$municipalitycity_id));
	 
		$barangay = CHtml::listData($barangay,'id','name');
		//append blank
		$dropDownBarangay = CHtml::tag('option', array('value'=>''),CHtml::encode($name),true);
		
		foreach($barangay as $value=>$name)
			$dropDownBarangay .= CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
		
		echo CJSON::encode(array('dropDownBarangay'=>$dropDownBarangay));
		exit;
	}
}

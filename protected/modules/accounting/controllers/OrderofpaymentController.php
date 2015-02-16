<?php

class OrderofpaymentController extends Controller
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
		
		$paymentitemDataProvider = new CArrayDataProvider($model->paymentitems, 
			array(
				'pagination'=>false,
			)
		);
		
		$this->render('view',array(
			'model'=>$model,
			'paymentitemDataProvider'=>$paymentitemDataProvider
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Orderofpayment;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Orderofpayment']))
		{
			$model->attributes=$_POST['Orderofpayment'];
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

		if(isset($_POST['Orderofpayment']))
		{
			$model->attributes=$_POST['Orderofpayment'];
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
		$dataProvider=new CActiveDataProvider('Orderofpayment');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Orderofpayment('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Orderofpayment']))
			$model->attributes=$_GET['Orderofpayment'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

public function actionCreateOPFromRequests()
	{
		$model=new Orderofpayment;

		if(isset($_GET['id']))
		{
			$orderofpaymentId = $_GET['id'];
			$OP = Orderofpayment::model()->findByPk($orderofpaymentId); 
		}
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
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

		if(isset($_POST['Orderofpayment']))
		{
			$model->attributes=$_POST['Orderofpayment'];
			
			if($model->save()){
				if (Yii::app()->request->isAjaxRequest)
                {
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"Order of Payment successfully added"
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
                'div'=>$this->renderPartial('_formOPFromRequests', 
            		array(
            			'model'=>$model, 
            			'customers'=>CHtml::listData($customers, 'id', 'customerName'),
						'gridDataProvider'=>$gridDataProvider
            		), true, true))
            );
            exit;               
        }else{
            $this->render('createOPFromRequests',
            	array(
            		'customers'=>CHtml::listData($customers, 'id', 'customerName'),
					'gridDataProvider'=>$gridDataProvider
            	));
        }
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Orderofpayment the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Orderofpayment::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Orderofpayment $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='orderofpayment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	function actionSearchPayor(){
		
		if($_GET['collectiontype_id'] <= 2){
			$db = "ulimslab.customer";
			$select = 'SELECT id as id, customerName as customerName, address as address, customerName as label';
			$column = 'customerName';
			$groupOrder .= ' GROUP BY customerName ORDER BY customerName ASC';
		}else{
			$db = "ulimscashiering.receipt";
			$select = 'SELECT id as id, payor as payor, payor as label';
			$column = 'payor';
			$groupOrder .= ' GROUP BY payor ORDER BY payor ASC';
		}
		
		if (!empty($_GET['term'])) {
			//$sql = 'SELECT id as id, payor as payor, payor as label';
			$sql = $select;
			$sql .= ' FROM '.$db.' WHERE '.$column.' LIKE :qterm AND rstl_id = '.Yii::app()->Controller->getRstlId();
			$sql .= $groupOrder;
			$command = Yii::app()->db->createCommand($sql);
			$qterm = '%'.$_GET['term'].'%';
			$command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
			$result = $command->queryAll();
			echo CJSON::encode($result); exit;
		  } else {
			return false;
		  }
	}
	
	public function behaviors()
    {
        return array(
            'eexcelview'=>array(
                'class'=>'ext.eexcelview.EExcelOPBehavior',
            ),
        );
    }
    
	function actionPrintExcel($id)
	{
		// Load data (scoped)
	    $orderOfPayment = Orderofpayment::model()->findByPk($id);
	    
		$opDataProvider = new CArrayDataProvider($orderOfPayment, 
			array(
				'pagination'=>false,
			)
		);
		
		$this->widget('ext.eexcelview.EExcelViewPrintOP', array(
				'dataProvider'=>$opDataProvider,
				'columns'=>array('id'),
				'title'=>$orderOfPayment->transactionNum,
				'filename'=>$orderOfPayment->transactionNum,
				//'grid_mode'=>'export',
				//'exportType'=>'PDF',
				'autoWidth'=>false,
				
				'orderOfPayment'=>$orderOfPayment,
				'paymentitems'=>$orderOfPayment->paymentitems,
				'collectiontype'=>$orderOfPayment->collectiontype,
				'totalInWords'=>Yii::app()->Controller->convert_number_to_words($orderOfPayment->totalPayment),
				
				'samples'=>Orderofpayment::getSamples($orderOfPayment),
				'references'=>Orderofpayment::getReferences($orderOfPayment),
				'collectionOfficer'=>Yii::app()->controller->getPersonnel('collectingOfficer'),
				'accountant'=>Yii::app()->controller->getPersonnel('accountant'),
				'bankAccount'=>Yii::app()->controller->getBankAccount(),
				
				),
					'PDF' // This is the default value, so you can omit it. You can export to CSV, PDF or HTML too
				);
	    
	}
	
	public function actionSearchRequests()
	{
		$customer_id = $_POST['Orderofpayment']['customer_id'];
		
		$requests = Request::model()->findAll(
			array(	'condition'=>'rstl_id = :rstl_id AND customerId = :customerId ORDER BY id DESC', 
					'params'=>array(':rstl_id'=>Yii::app()->Controller->getRstlId(), ':customerId'=>$customer_id))
		);
		
		$gridDataProvider = new CArrayDataProvider($requests, array('pagination'=>false));
		echo $this->renderPartial('_requests', array('gridDataProvider'=>$gridDataProvider));
	}
}

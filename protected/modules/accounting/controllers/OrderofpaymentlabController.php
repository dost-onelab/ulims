<?php

class OrderofpaymentlabController extends Controller
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
		$model=new Orderofpaymentlab;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$customers = Customer::model()->findAll(
			array(
				'condition'=>'rstl_id = :rstl_id', 
				'params'=>array(':rstl_id'=>Yii::app()->Controller->getRstlId()))
		);
		
		if(isset($_POST['Orderofpaymentlab']['customer_id']))
			$customer_id=$_POST['Orderofpaymentlab']['customer_id'];
			
		$list=$this->listRequest($customer_id);
		
		$gridDataProvider = new CArrayDataProvider($list, array('pagination'=>false));
		
		//$gridDataProvider = new CArrayDataProvider($requests, array('pagination'=>false));
		
		if(isset($_POST['Orderofpaymentlab']))
		{
			$model->attributes=$_POST['Orderofpaymentlab'];
			//$model->amount = count($_POST['requestIds']);
			if($model->save()){
				foreach($_POST['requestIds'] as $id){
					$request = Request::model()->findByPk($id);
					
					$paymentitem = new Paymentitem;
					$paymentitem->rstl_id = Yii::app()->Controller->getRstlId();
					$paymentitem->request_id = $id;
					$paymentitem->orderofpayment_id = $model->id;
					$paymentitem->details = $request->requestRefNum;
					$paymentitem->amount = $request->getBalance();
					$paymentitem->cancelled = 0;
					$paymentitem->save();
				}
				
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'customers'=>CHtml::listData($customers, 'id', 'customerName'),
			'gridDataProvider'=>$gridDataProvider
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

		if(isset($_POST['Orderofpaymentlab']))
		{
			$model->attributes=$_POST['Orderofpaymentlab'];
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
		$dataProvider=new CActiveDataProvider('Orderofpaymentlab');
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
		if(isset($_GET['Orderofpaymentlab']))
			$model->attributes=$_GET['Orderofpaymentlab'];

		$this->render('admin',array(
			'model'=>$model,
		));
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
				
				'samples'=>$orderOfPayment->getSamples($orderOfPayment),
				'references'=>$orderOfPayment->getReferences($orderOfPayment),
				'collectionOfficer'=>Yii::app()->controller->getPersonnel('collectingOfficer'),
				'accountant'=>Yii::app()->controller->getPersonnel('accountant'),
				'bankAccount'=>Yii::app()->controller->getBankAccount(),
				'formTitle' => 'Order of Payment',
				'formNum' => Yii::app()->params['FormOrderofpayment']['number'],
				'formRevNum' => Yii::app()->params['FormOrderofpayment']['revNum'],
				'formRevDate' => Yii::app()->params['FormOrderofpayment']['revDate'],		
				'logoLeft'=>Yii::app()->params['FormOrderofpayment']['logoLeft'],
				'logoRight'=>Yii::app()->params['FormOrderofpayment']['logoRight'],
				),
					'PDF' // This is the default value, so you can omit it. You can export to CSV, PDF or HTML too
				);
	    
	}
	
	public function actionSearchRequests()
	{
		$customer_id = $_POST['Orderofpaymentlab']['customer_id'];
		$list=$this->listRequest($customer_id);
		$gridDataProvider = new CArrayDataProvider($list, array('pagination'=>false));
		
		echo $this->renderPartial('_requests', array('gridDataProvider'=>$gridDataProvider),true);
	}
	
	public function listRequest($customerId){

		$requests = Request::model()->findAll(
			array(	
				'with'=>'paymentItem',
				'condition'=>'t.rstl_id = :rstl_id AND customerId = :customerId',
				'order'=>'t.id DESC', 
				'params'=>array(':rstl_id'=>Yii::app()->Controller->getRstlId(), ':customerId'=>$customerId))
		);
		$list=array();
		if($requests){
			foreach ($requests as $request){
				//order of payments
				if($request->paymentItem){
					foreach($request->paymentItem as $paymentItem){
						//in case there are many pending
					$orderOfPayment=Orderofpayment::model()->findByPk($paymentItem->orderofpayment_id, 
							array('condition'=>'createdReceipt=0')
							)->transactionNum;
					$orderOfPaymentsLink=CHtml::link($orderOfPayment, 
						$this->createUrl('view',array('id'=>$paymentItem->orderofpayment_id)),
						array('title'=>'Click to view PENDING O.P. for payment.')
						);
					}
				}
				$balance=$request->getBalance();
				if($balance>0 OR ($model->request_id==$request->id)){ //$model->request_id==$request->id --> needed on update
					$list[] = array(
					'id'=>$request->id,
					'requestRefNum'=>$request->requestRefNum,
					'labId'=>$request->labId,
					'requestDate'=>date('Y-m-d', strtotime($request->requestDate)),
					'balance'=>Yii::app()->format->formatNumber($balance),
					'paymentItem'=>$orderOfPayment?"<font color='#B30000' style='font-weight:bold'>PENDING</font> ".$orderOfPaymentsLink : "<font color='#006600' style='font-weight:bold'>FOR ORDER OF PAYMENT</font> ",
					'orderOfPayment'=>$orderOfPayment
					);
				}
	    	}
			if(empty($list))
				$list=array();
		}
		
		return $list;
	}

	public function actionUpdateAmount()
	{
		$es = new EditableSaver('Paymentitem');
		$pk = yii::app()->request->getParam('pk');
		try {
			/*$es->onBeforeUpdate = function($event) {
				$event->sender->setAttribute('amount', Yii::app()->format->unformatNumber($es->amount));
			};*/
			/*$es->onBeforeUpdate = function($event) {
				if(Yii::app()->user->isGuest) {
					$event->sender->error('You are not allowed to update data');
				}
			};*/
			$es->update();
		} catch(CException $e) {
			echo CJSON::encode(array('success' => false, 'msg' => $e->getMessage()));
			return;
		}
		
		$orderofpaymentId=Paymentitem::model()->findByPk($pk)->orderofpayment_id;
		$total=$this->loadModel($orderofpaymentId)->totalPayment;
		//$total=$this->loadModel($pk)->totalPayment;
		echo CJSON::encode(array('success' => true,'total'=>$total));
	}
	
}

<?php

class DepositController extends Controller
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
		$model=new Deposit;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Deposit']))
		{
			$model->attributes=$_POST['Deposit'];
			if($_POST['override'] == 1)
				$model->endOr = $_POST['endOrOverride'];

			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		
		$depositType = 0;
		
		$this->render('create',array(
			'model'=>$model,
			'depositType'=>$depositType
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

		if(isset($_POST['Deposit']))
		{
			$model->attributes=$_POST['Deposit'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		
		$depositType = $model->depositType;
		
		$this->render('update',array(
			'model'=>$model,
			'depositType'=>$depositType
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
		$dataProvider=new CActiveDataProvider('Deposit');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Deposit('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Deposit']))
			$model->attributes=$_GET['Deposit'];

			
		/** update Deposit table to indicate deposits under project: Start **/
		
		/*$receipts = Receipt::model()->findAll(array(
					'condition' => 'project = 1',
				)
		);
		$count = 0;
		foreach($receipts as $receipt){
			$deposit = Deposit::model()->find(array(
					'condition' => 'startOr = :startOr',
				    'params' => array(':startOr' => $receipt->receiptId),
				));
				
			//if($deposit && $receipt->project == 1){
			//if($deposit){
				//Deposit::model()->updateByPk($deposit->id, array('depositType'=>1));
				//echo $deposit->startOr.'<br/>';
				$count += 1;
			//}	
		}*/
		//echo $count;
		/** update Deposit table to indicate deposits under project: End **/
			
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionCashReceiptsRecord()
	{
		$this->layout = '//layouts/column1';
		$model=new Collection;
		
		$model->unsetAttributes();
		
		if(isset($_GET['year']) || isset($_GET['month'])){
			$year = $_GET['year'];
			$month = $_GET['month'];
		}else{
			$year = date('Y');
			$month = date('m');			
		}
		
		$receipt=new Receipt;
		$deposit=new Deposit;
		$minDate = date("Y-m-d", mktime(0, 0, 0, $month, 1, $year));
		$maxDate = date("Y-m-d", mktime(0, 0, 0, $month, $receipt->getDays($month), $year));
		
		$criteria=new CDbCriteria;
		$criteria->order = 'receiptDate ASC, receiptId ASC';
		$criteria->select = array('*');
		$criteria->with = 'deposit';
		$criteria->condition = 'receiptDate >= :minDate AND receiptDate <= :maxDate AND t.rstl_id = :rstl_id';
		$criteria->params = array(':minDate' => $minDate, ':maxDate' => $maxDate, ':rstl_id' => $this->getRstlId());
		
		$receiptDataProvider = new CActiveDataProvider(
		    $receipt,
		    array(
		        'criteria'=>$criteria,
		        'pagination' => false,
		    )
		);
		
		$this->render('cashReceiptsRecord',array(
			'model'=>$model,
			'receipt'=>$receipt,
			'deposit'=>$deposit,
			'receiptDataProvider'=>$receiptDataProvider,
			'year'=>$year,
			'month'=>$month,
			'monthWord' => date('F')
		));
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Deposit the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Deposit::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Deposit $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='deposit-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	function actionOrTotal()
	{
		$total = 0;
		
		if(!isset($_POST['Deposit']['depositType'])){
			$depositType = 0;
		}else{
			$depositType = $_POST['Deposit']['depositType'];
		}
		
		if(!isset($_POST['override'])){
			$override = 0;
		}else{
			$override = $_POST['override'];
		}
		
		$startReceipt = Receipt::model()->findByAttributes(
				array('receiptId'=>$_POST['Deposit']['startOr'])
			);
			
		$endReceipt = Receipt::model()->findByAttributes(
				array('receiptId'=>$override ? $_POST['endOrOverride'] : $_POST['Deposit']['endOr'])
			);
		
		$modelReceipts = Receipt::model()->findAll(array(
					'condition' => 'id >= :id AND project = :project',
					'params' => array(':id' => $startReceipt->id, ':project' => $depositType),
				));
		
		foreach($modelReceipts as $receipt){
			
			if(!$receipt->cancelled){
				$total += $receipt->totalCollection;
			}
			
			if($receipt->receiptId == $endReceipt->receiptId){
				break;
			}
		}		
		if($total==0)
			$total="";
		echo CJSON::encode(array('total'=>$total));
        exit; 
		
	}

	function actionUpdateDropdown(){
		
		
		$deposit=new Deposit;
		if(isset($_POST['Deposit']['depositType'])){
			$depositType = $_POST['Deposit']['depositType'];
			
			//$startOr = $deposit->getFirstOr($depositType);
			//$endOr = $deposit->getLastOrJSON($depositType);
			//findAll receipt where project=depositType and 
			//group by orseries_id to get a list of orseries
			$criteria=new CDbCriteria;
			$criteria->with=array('orseries');
			$criteria->condition='project=:depositType';
			$criteria->group='orseries_id';
			$criteria->params=array(':depositType'=>$depositType);
			$receipts=Receipt::model()->findAll($criteria);
			$receipts = CHtml::listData($receipts, 'orseries_id', 'orseries.name', 'orseries.categoryName');
			$orseries .=  CHtml::tag('option', array('value'=>''), CHtml::encode($name), true);
			foreach($receipts as $value=>$name)
				foreach($name as $key=>$val)
						$option.=CHtml::tag('option', array('value'=>$key), CHtml::encode($val), true);
									
				$orseries .= CHtml::tag('optgroup', array('label'=>$value), $option, true);		

			echo CJSON::encode(array('orseries'=>$orseries));
			exit;
			
		}
		/*
		if(isset($_POST['Deposit']['depositType'])){
			$depositType = $_POST['Deposit']['depositType'];
			
			$startOr = $deposit->getFirstOr($depositType);
			$endOr = $deposit->getLastOrJSON($depositType);
			
			echo CJSON::encode(
						array(
							'startOr'=>$startOr, 
							'lastOr'=>$endOr,
						)
					);
			exit;
		}*/

		if(isset($_POST['Deposit']['orseries_id'])){
			$orseriesId = $_POST['Deposit']['orseries_id'];
			$depositType = $_POST['depositType'];
			
			$startOr = $deposit->getFirstOrBySeries($orseriesId, $depositType);
			$endOr = $deposit->getLastOrJSONBySeries($orseriesId, $depositType);
			
			echo CJSON::encode(
						array(
							'startOr'=>$startOr, 
							'lastOr'=>$endOr,
						)
					);
			exit;
		}
		
		
	}

	
	function actionExportCashReceiptsRecord($year, $month)
	{
		// Load data (scoped)
		$receipt=new Receipt;
	    $minDate = date("Y-m-d", mktime(0, 0, 0, $month, 1, $year));
		$maxDate = date("Y-m-d", mktime(0, 0, 0, $month, $receipt->getDays($month), $year));
		
		$criteria=new CDbCriteria;
		$criteria->order = 'receiptDate ASC, receiptId ASC';
		$criteria->select = array('*');
		$criteria->with = 'deposit';
		$criteria->condition = 'receiptDate >= :minDate AND receiptDate <= :maxDate';
		$criteria->params = array(':minDate' => $minDate, ':maxDate' => $maxDate);
		
		$receiptDataProvider = new CActiveDataProvider('Receipt', 
			array(
				'criteria'=>$criteria,
				'pagination'=>false,
			)
		);
		
		$this->widget('ext.eexcelview.EExcelViewCashReceiptsRecord', array(
				'dataProvider'=>$receiptDataProvider,
				'columns'=>array(
					//'id',
					array(
				        	'name'=>'receiptDate', 
				        	'header'=>'DATE',
							'value'=>'date("d-M",strtotime($data->receiptDate))'
				        ),
					array(
				        	'name'=>'receiptId', 
				        	'header'=>'OR NO',
				        ),
					array(
				        	'name'=>'payor', 
				        	'header'=>'NAME OF PAYOR',
				        ),
					array(
				        	'name'=>'typeOfCollection.natureOfCollection', 
				        	'header'=>'NATURE OF COLLECTION',
				        ),
				    array(
				        	'name'=>'total', 
				        	'header'=>'COLLECTION BTR',
				    		//'type'=>'raw',
				    		'value'=>'($data->project == 0) ? (!$data->cancelled ? $data->totalCollection : "0") : "0"',
				        ),
				    array(
				        	'name'=>'total', 
				        	'header'=>'COLLECTION PROJECT',
				    		'value'=>'($data->project == 1) ? (!$data->cancelled ? $data->totalCollection : "0") : "0"'
				        ),
				    array(
				        	'name'=>'deposit', 
				        	'header'=>'COLLECTION PROJECT',
				    		'value'=>'$data->deposit->amount'
				        ),		
				),
				//'extraRowColumns' => array('category.yearAwarded'),
				'title'=>$month.$year.'CashReceiptsRecord',
				'filename'=>$month.$year.'CashReceiptsRecord',
				'grid_mode'=>'export',
				'autoWidth'=>false,
				
				'minDate'=>$minDate,
				'maxDate'=>$maxDate,
				'year'=>$year,
				//'collectionType'=>$receipt->collectionType,
				//'totalInWords'=>$this->convert_number_to_words($receipt->total),
				//'checks'=>$receipt->checks
				)
					//'Excel2007' // This is the default value, so you can omit it. You can export to CSV, PDF or HTML too
				);
	    
	}
}

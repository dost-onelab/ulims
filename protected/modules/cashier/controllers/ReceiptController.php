<?php

class ReceiptController extends Controller
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
				'actions'=>array('index','view','searchPayor'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','ajaxUpdate'),
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
		
		$collectionDataProvider = new CArrayDataProvider($model->collection, 
			array(
				'pagination'=>false,
			)
		);
		
		$checkDataProvider = new CArrayDataProvider($model->checks, 
			array(
				'pagination'=>false,
			)
		);
		
		//$receipts = Receipt::model()->findAll();
		
		/*foreach($receipts as $receipt){
			if($receipt->paymentModeId == 2){
				$check = New Check;
				$check->receipt_id = $receipt->id;
				$check->bank = strtoupper($receipt->bank);
				$check->checknumber = $receipt->check_money_number;
				$check->checkdate = $receipt->checkdate;
				$check->amount = $receipt->total;
				$check->save();
			}
		}*/
		
		$this->render('view',array(
			'id'=>$id,
			'model'=>$model,
			'collectionDataProvider'=>$collectionDataProvider,
			'checkDataProvider'=>$checkDataProvider
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Receipt;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Receipt']))
		{
			$model->attributes=$_POST['Receipt'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionCreateReceiptFromOP()
	{
		$model=new Receipt;

		if(isset($_GET['id']))
		{
			$orderofpaymentId = $_GET['id'];
			$OP = Orderofpayment::model()->findByPk($orderofpaymentId); 
		}
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Receipt']))
		{
			$model->attributes=$_POST['Receipt'];
			
			if($model->save()){
				
				$items = array();
				foreach($model->collection as $collection){
					$row = array(
						'agency_id' => $collection->rstl_id,
			            'referral_id' => $collection->referral_id,
			            'receipt_id' => $collection->receipt_id,
			            'nature' => $collection->nature,
			            'amount' => $collection->amount,
			            'receiptNumber' => $collection->receiptid,
					);
					array_push($items, $row);
				}
				
				/*$postFields = "agency_id=".Yii::app()->Controller->getRstlId()
					."&receiptNumber=".$model->receiptId
					."&receiptDate=".$model->receiptDate
					."&paymentmode_id=".$model->paymentModeId
					."&payor=".$model->payor
					."&collectiontype_id=".$model->collectionType
					."&orseries_id=".$model->orseries_id
					."&orderofpayment_id=".$model->orderofpayment_id
					."&transactionNum=".Rstl::model()->findByPk(Yii::app()->Controller->getRstlId())->code.'-'.$model->orderofpayment->transactionNum;
				
				$receipt = RestController::postData('receipts', $postFields);*/
				
				if (Yii::app()->request->isAjaxRequest)
                {
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"Receipt successfully added"
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
                'div'=>$this->renderPartial('_formFromOP', array('model'=>$model, 'orderofpaymentId'=>$orderofpaymentId, 'OP'=>$OP), true, true))
            );
            exit;               
        }else{
            $this->render('createFromOP',array('model'=>$model, 'orderofpaymentId'=>$orderofpaymentId, 'OP'=>$OP));
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

		if(isset($_POST['Receipt']))
		{
			$model->attributes=$_POST['Receipt'];
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
		$dataProvider=new CActiveDataProvider('Receipt');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionCancel($id)
	{
		
		$model=new Cancelledor;
		if(isset($_POST['Cancelledor'])){
		
			$model->attributes=$_POST['Cancelledor'];
			
			//$receiptId=$id;
			$model->receiptId=$id;
			$model->cancelDate=date('Y-m-d');
			
			if($model->save()){
				Receipt::model()->updateByPk($id, 
					array('cancelled'=>1
				));
				$receipt = $this->loadModel($id);
				foreach($receipt->collection as $collection){
					Collection::model()->updateByPk($collection->id, 
						array('cancelled'=>1,
					));
				}
				
				if (Yii::app()->request->isAjaxRequest)
                {
					echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"Receipt successfully cancelled",
                        ));
                    exit;               
                }
                else
                    $this->redirect(array('cancelledor/view','id'=>$model->id));
			}
		}

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'failure',
                'div'=>$this->renderPartial('/cancelledor/_form', array('model'=>$model, 'showBtn'=>false),true, true))
            );
            exit;               
        }else{
            $this->render('cancelledor/create',array('model'=>$model));
        }		
	}
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Receipt('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Receipt']))
			$model->attributes=$_GET['Receipt'];
		
		
		/*$lastOrExist = $this->checkLastOr($this->getRstlId());
		
		if($lastOrExist){
			$this->render('admin',array(
				'model'=>$model,
			));
		}else{
			//$dataProvider=new CActiveDataProvider('Receipt');
			
			$this->redirect($this->createUrl('lastor/create'),array());
		}*/
		$this->render('admin',array(
				'model'=>$model,
		));
	
		
	}

	function checkLastOr($rstl_id){
		$lastOr = Lastor::model()->count(
			array('condition'=>'rstl_id = :rstl_id', 'params'=>array(':rstl_id'=>$rstl_id))
		);
		
		return ($lastOr != 0) ? true : false;
	}
	
	public function actionReportOfCollection()
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
		$minDate = date("Y-m-d", mktime(0, 0, 0, $month, 1, $year));
		$maxDate = date("Y-m-d", mktime(0, 0, 0, $month, $receipt->getDays($month), $year));
		
		$criteria=new CDbCriteria;
		$criteria->order = 'receiptDate ASC, receiptId ASC';
		$criteria->select = array('*');
		$criteria->condition = 'receiptDate >= :minDate AND receiptDate <= :maxDate AND rstl_id = :rstl_id';
		$criteria->params = array(':minDate' => $minDate, ':maxDate' => $maxDate, ':rstl_id'=>$this->getRstlId());
		
		$receiptDataProvider = new CActiveDataProvider(
		    $receipt,
		    array(
		        'criteria'=>$criteria,
		        'pagination' => false,
		    )
		);
		
		
		$this->render('reportOfCollection',array(
			'model'=>$model,
			'receipt'=>$receipt,
			'receiptDataProvider'=>$receiptDataProvider,
			'year'=>$year,
			'month'=>$month,
			'monthWord' => date('F')
		));
	}

	public function actionNextOR()
	{
		if(isset($_POST['Receipt']['orseries_id']))
		{
			$orseriesId=$_POST['Receipt']['orseries_id'];
			//check status if open
			
			$orseries=Orseries::model()->findByPk($orseriesId);
			$nextOR=$orseries->nextor;
			if($nextOR){
            	echo CJSON::encode(array('nxtOR'=>"<span class='alert alert-success'>O.R. #: <b>".$nextOR."</b> <i class='icon icon-info-sign' style='cursor:pointer;margin-top:-1px;' title='Next O.R. number on selected series. \nO.R. # displayed herein is for guidance and reference only.'></i></span>"));
			}else{
				echo CJSON::encode(array('nxtOR'=>''));
			}
			exit;
		}
		
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Receipt the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Receipt::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Receipt $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='receipt-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	function actionSearchPayor()
	{		
		if (!empty($_GET['term'])) {
			$sql = 'SELECT id as id, payor as payor, payor as label';
			$sql .= ' FROM ulimscashiering.receipt WHERE payor LIKE :qterm AND rstl_id = '.Yii::app()->Controller->getRstlId();
			$sql .= ' GROUP BY payor ORDER BY payor ASC';
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
                'class'=>'ext.eexcelview.EExcelBehavior',
            ),
        );
    }
    
	function actionPrintExcel($id)
	{
		// Load data (scoped)
	    $receipt = Receipt::model()->findByPk($id);
	    
		$receiptDataProvider = new CArrayDataProvider($receipt, 
			array(
				'pagination'=>false,
			)
		);
		
		$this->widget('ext.eexcelview.EExcelViewPrintReceipt', array(
				'dataProvider'=>$receiptDataProvider,
				'columns'=>array(
					'id',
				),
				//'extraRowColumns' => array('category.yearAwarded'),
				'title'=>$receipt->receiptId,
				'filename'=>$receipt->receiptId,
				//'grid_mode'=>'export',
				'autoWidth'=>false,
				
				'receipt'=>$receipt,
				'collection'=>$receipt->collection,
				'collectionType'=>$receipt->collectionType,
				'totalInWords'=>$this->convert_number_to_words($receipt->totalCollection),
				'checks'=>$receipt->checks,
				'agency'=>Yii::app()->params['Agency']['shortName']?Yii::app()->params['Agency']['shortName']:'DOST',
				)
					//'Excel2007' // This is the default value, so you can omit it. You can export to CSV, PDF or HTML too
				);
	    
	}
	
	/*function actionPrintExcel($id){
		$receipt = Receipt::model()->findByPk($id);
	    
		$receiptDataProvider = new CArrayDataProvider($receipt, 
			array(
				'pagination'=>false,
			)
		);
		
		//include PHPExcel library
		require_once "F:/xampp/htdocs/ulims/protected/extensions/PHPExcel/Classes/PHPExcel/IOFactory.php";
		 
		//load Excel template file
		$objTpl = PHPExcel_IOFactory::load("F:/xampp/htdocs/ulims/protected/extensions/PHPExcel/Classes/PHPExcel/order.xlsx");
		$objTpl->setActiveSheetIndex(0);  //set first sheet as active
		 
		$objTpl->getActiveSheet()->setCellValue('C2', date('Y-m-d'));  //set C1 to current date
		$objTpl->getActiveSheet()->getStyle('C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //C1 is right-justified
		 
		$objTpl->getActiveSheet()->setCellValue('C3', stripslashes($_POST['txtName']));
		$objTpl->getActiveSheet()->setCellValue('C4', stripslashes($_POST['txtMessage']));
		 
		$objTpl->getActiveSheet()->getStyle('C4')->getAlignment()->setWrapText(true);  //set wrapped for some long text message
		 
		$objTpl->getActiveSheet()->getColumnDimension('C')->setWidth(40);  //set column C width
		$objTpl->getActiveSheet()->getRowDimension('4')->setRowHeight(120);  //set row 4 height
		$objTpl->getActiveSheet()->getStyle('A4:C4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP); //A4 until C4 is vertically top-aligned

		//prepare download
		$filename = $receipt->receiptId.'.xls'; //just some random filename
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		
		$objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
		$objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
		//$objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'PDF');
		//$objWriter->save('write.pdf');
		exit; //done.. exiting!
	}*/
	
	function actionExportReportOfCollection($year, $month)
	{
		// Load data (scoped)
		$receipt=new Receipt;
	    $minDate = date("Y-m-d", mktime(0, 0, 0, $month, 1, $year));
		$maxDate = date("Y-m-d", mktime(0, 0, 0, $month, $receipt->getDays($month), $year));
		
		$criteria=new CDbCriteria;
		$criteria->order = 'receiptDate ASC, receiptId ASC';
		$criteria->select='*';
		$criteria->condition = 'receiptDate >= :minDate AND receiptDate <= :maxDate';
		$criteria->params = array(':minDate' => $minDate, ':maxDate' => $maxDate);
		
		$receiptDataProvider = new CActiveDataProvider('Receipt', 
			array(
				'criteria'=>$criteria,
				'pagination'=>false,
			)
		);
		
		$this->widget('ext.eexcelview.EExcelViewReportOfCollection', array(
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
				),
				//'extraRowColumns' => array('category.yearAwarded'),
				'title'=>$month.$year.'ReportOfCollection',
				'filename'=>$month.$year.'ReportOfCollection',
				'grid_mode'=>'export',
				'autoWidth'=>false,
				
				'minDate'=>$minDate,
				'maxDate'=>$maxDate,
				'year'=>$year,
				)
					//'Excel2007' // This is the default value, so you can omit it. You can export to CSV, PDF or HTML too
				);
	    
	}
	
	public function convert_number_to_words($number) {
	    
	    $hyphen      = ' ';
	    $conjunction = ' ';
	    $separator   = ' ';
	    $negative    = 'negative ';
	    $decimal     = ' and ';
	    $dictionary  = array(
	        0                   => 'zero',
	        1                   => 'one',
	        2                   => 'two',
	        3                   => 'three',
	        4                   => 'four',
	        5                   => 'five',
	        6                   => 'six',
	        7                   => 'seven',
	        8                   => 'eight',
	        9                   => 'nine',
	        10                  => 'ten',
	        11                  => 'eleven',
	        12                  => 'twelve',
	        13                  => 'thirteen',
	        14                  => 'fourteen',
	        15                  => 'fifteen',
	        16                  => 'sixteen',
	        17                  => 'seventeen',
	        18                  => 'eighteen',
	        19                  => 'nineteen',
	        20                  => 'twenty',
	        30                  => 'thirty',
	        40                  => 'forty',
	        50                  => 'fifty',
	        60                  => 'sixty',
	        70                  => 'seventy',
	        80                  => 'eighty',
	        90                  => 'ninety',
	        100                 => 'hundred',
	        1000                => 'thousand',
	        1000000             => 'million',
	        1000000000          => 'billion',
	        1000000000000       => 'trillion',
	        1000000000000000    => 'quadrillion',
	        1000000000000000000 => 'quintillion'
	    );
	    
	    if (!is_numeric($number)) {
	        return false;
	    }
	    
	    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
	        // overflow
	        trigger_error(
	            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
	            E_USER_WARNING
	        );
	        return false;
	    }
	
	    if ($number < 0) {
	        return $negative . $this->convert_number_to_words(abs($number));
	    }
	    
	    $string = $fraction = null;
	    
	    if (strpos($number, '.') !== false) {
	        list($number, $fraction) = explode('.', $number);
	    }
	    
	    switch (true) {
	        case $number < 21:
	            $string = $dictionary[$number];
	            break;
	        case $number < 100:
	            $tens   = ((int) ($number / 10)) * 10;
	            $units  = $number % 10;
	            $string = $dictionary[$tens];
	            if ($units) {
	                $string .= $hyphen . $dictionary[$units];
	            }
	            break;
	        case $number < 1000:
	            $hundreds  = $number / 100;
	            $remainder = $number % 100;
	            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
	            if ($remainder) {
	                $string .= $conjunction . $this->convert_number_to_words($remainder);
	            }
	            break;
	        default:
	            $baseUnit = pow(1000, floor(log($number, 1000)));
	            $numBaseUnits = (int) ($number / $baseUnit);
	            $remainder = $number % $baseUnit;
	            $string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
	            if ($remainder) {
	                $string .= $remainder < 100 ? $conjunction : $separator;
	                $string .= $this->convert_number_to_words($remainder);
	            }
	            break;
	    }
	    
	    if (null !== $fraction && is_numeric($fraction)) {
	        $string .= $decimal;
	        $words = array();
	        foreach (str_split((string) $fraction) as $number) {
	            $words[] = $dictionary[$number];
	        }
	        $string .= $fraction.'/100';
	    }
	    return strtoupper($string);
	}
}

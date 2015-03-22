<?php

class AccomplishmentsController extends Controller
{
	public function actionIndex()
	{
		$model=new Accomplishments;
		$model->unsetAttributes();  // clear any default values
		//if(isset($_GET['Accomplishments'])){
		if(isset($_GET['year'])){
			$labId = $_GET['lab'];
			$year = $_GET['year'];
		}else{
			$labId = 1;
			$year = date('Y');		
		}

		$accomplishments = $this->getAccomplishmentDataProvider(Yii::app()->Controller->getRstlId(), $labId, $year);
		
		$gridDataProvider = new CArrayDataProvider($accomplishments, 
			array('pagination'=>false
	    ));
	    
		$this->render('index',array(
			'model'=>$model, 
			'accomps'=>$gridDataProvider,
			'rstl_id'=>Yii::app()->user->rstlId,
			'labId'=>$labId,
			'year'=>$year,
		));
	}
	
	public function getAccomplishmentDataProvider($rstl_id, $labId, $year)
	{
		$accomplishments = array();

		
		$customerSetupSubTotal = 0;
		$customerNSetupSubTotal = 0;
		$sampleSetupSubTotal = 0;
		$sampleNSetupSubTotal = 0;
		$testSetupSubTotal = 0;
		$testNSetupSubTotal = 0;
		$incomeNSetupSubTotal = 0;
		$incomeSetupSubTotal = 0;
		$valueNSetupSubTotal = 0;
		$valueSetupSubTotal = 0;
		$valueNDiscountSubTotal = 0;
		
		for($month=1; $month<=12; $month++)
		{
			if($month == 2){
				if($year%4 == 0)
					$days = 29;
				else
					$days = 28; 	
			}
			
			if($month == 4 || $month == 6 || $month == 9 || $month == 11)
				$days = 30;
			
			if($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12)
				$days = 31;
			
			$minDate = date("Y-m-d", mktime(0, 0, 0, $month, 1, $year));
			$maxDate = date("Y-m-d", mktime(0, 0, 0, $month, $days, $year));
			
			$customerSetup = 0;
			$customerNSetup = 0;
			$sampleSetup = 0;
			$sampleNSetup = 0;
			$testSetup = 0;
			$testNSetup = 0;
			$incomeNSetup = 0;
			$incomeSetup = 0;
			$valueNSetup = 0;
			$valueSetup = 0;
			$valueNDiscount = 0;
			
			$requests = Request::model()->findAll(array(
					'condition' => 'rstl_id = :rstl_id AND labId = :labId AND requestDate >= :minDate AND requestDate <= :maxDate AND cancelled = :cancelled',
				    'params' => array(':rstl_id' =>$rstl_id, ':labId' => $labId, ':minDate' => $minDate, ':maxDate' => $maxDate, ':cancelled' => 0),
				));

			foreach($requests as $request)
			{
				if($request->customer->typeId == 1)
				{	
					$customerSetup += 1;
					$sampleSetup += $request->sampleCount;
					
					if($request->paymentType == 2){
						$valueSetup += $request->total;
					}else{
						$incomeSetup += $request->total;
					}
							
					foreach($request->samps as $sample)	
					{
						//$testSetup += $sample->analysisCount;
						
						foreach($sample->analyses as $analysis)
						{
							if(!$analysis->cancelled || !$analysis->deleted || (!$analysis->package == 2)){
								$testSetup += 1;
							}
						}
					}
				}else{ 
					$customerNSetup += 1;
					$sampleNSetup += $request->sampleCount;	
					
					if($request->paymentType == 2){
						$valueNSetup += $request->total;
					}else{
						$incomeNSetup += $request->total;
					}
							
					foreach($request->samps as $sample)	
					{
						//$testNSetup += $sample->analysisCount;	
						foreach($sample->analyses as $analysis)
						{
							if(!$analysis->cancelled || !$analysis->deleted || ($analysis->package != 2)){
								$testNSetup += 1;
							}
						}
					}
				}
				$valueNDiscount += $request->discount ? (($request->total / 0.75) * 0.25) : 0;
				
				//$analysesSubTotal += $testSetup + $testNSetup;
				//$samplesSubTotal += $sampleSetup + $sampleNSetup;
				//$customersSubTotal += $customerSetup + $customerNSetup; 
			}
			
			$raw = array(
				'id'=>$labId,
				'month'=>CHtml::link(strtoupper(date('M', strtotime('2014-'.$month.'-01'))), $this->createUrl('accomplishments/exportSummary?labId='.$labId.'&month='.$month.'&year='.$year)),
				//'month'=>$month,
				'sampleNSetup'=>$sampleNSetup,
				'sampleSetup'=>$sampleSetup,
				'testNSetup'=>$testNSetup,
				'testSetup'=>$testSetup,
				'customerNSetup'=>$customerNSetup,
				'customerSetup'=>$customerSetup,
				'incomeNSetup'=>($this->action->id == 'index') ? Yii::app()->format->formatNumber($incomeNSetup) : $incomeNSetup,
				'incomeSetup'=>($this->action->id == 'index') ? Yii::app()->format->formatNumber($incomeSetup) : $incomeSetup,
				'valueNSetup'=>($this->action->id == 'index') ? Yii::app()->format->formatNumber($valueNSetup) : $valueNSetup,
				'valueSetup'=>($this->action->id == 'index') ? Yii::app()->format->formatNumber($valueSetup) : $valueSetup,
				'valueNDiscount'=>($this->action->id == 'index') ? Yii::app()->format->formatNumber($valueNDiscount) : $valueNDiscount,
				'gross'=>($this->action->id == 'index') ? Yii::app()->format->formatNumber($incomeNSetup + $incomeSetup + $valueNSetup + $valueSetup + $valueNDiscount) : ($incomeNSetup + $incomeSetup + $valueNSetup + $valueSetup + $valueNDiscount),
				/*'incomeNSetup'=>$incomeNSetup,
				'incomeSetup'=>$incomeSetup,
				'valueNSetup'=>$valueNSetup,
				'valueSetup'=>$valueSetup,
				'valueNDiscount'=>$valueNDiscount,
				'gross'=>$incomeNSetup + $incomeSetup + $valueNSetup + $valueSetup + $valueNDiscount,*/
			);
			array_push($accomplishments, $raw);
			
			$customerSetupSubTotal += $customerSetup;
			$customerNSetupSubTotal += $customerNSetup;
			$sampleSetupSubTotal += $sampleSetup;
			$sampleNSetupSubTotal += $sampleNSetup;
			$testSetupSubTotal += $testSetup;
			$testNSetupSubTotal += $testNSetup;
			$incomeNSetupSubTotal += $incomeNSetup;
			$incomeSetupSubTotal += $incomeSetup;
			$valueNSetupSubTotal += $valueNSetup;
			$valueSetupSubTotal += $valueSetup;
			$valueNDiscountSubTotal += $valueNDiscount;
		}
		
		$subTotal= array(
				'month'=>'Sub-Total',
				'sampleNSetup'=>$sampleNSetupSubTotal,
				'sampleSetup'=>$sampleSetupSubTotal,
				'testNSetup'=>$testNSetupSubTotal,
				'testSetup'=>$testSetupSubTotal,
				'customerNSetup'=>$customerNSetupSubTotal,
				'customerSetup'=>$customerSetupSubTotal,
				'incomeNSetup'=>Yii::app()->format->formatNumber($incomeNSetupSubTotal),
				'incomeSetup'=>Yii::app()->format->formatNumber($incomeSetupSubTotal),
				'valueNSetup'=>Yii::app()->format->formatNumber($valueNSetupSubTotal),
				'valueSetup'=>Yii::app()->format->formatNumber($valueSetupSubTotal),
				'valueNDiscount'=>Yii::app()->format->formatNumber($valueNDiscountSubTotal),
				'gross'=>Yii::app()->format->formatNumber($incomeNSetupSubTotal + $incomeSetupSubTotal + $valueNSetupSubTotal + $valueSetupSubTotal + $valueNDiscountSubTotal),
		);
		array_push($accomplishments, $subTotal);
		//echo '<br/><br/><br/><br/><br/><pre>'.$this->action->id.'</pre>';
		$total= array(
				'month'=>'TOTAL',
				'sampleNSetup'=>$sampleNSetupSubTotal + $sampleSetupSubTotal,
				'sampleSetup'=>'-',
				'testNSetup'=>$testNSetupSubTotal + $testSetupSubTotal,
				'testSetup'=>'-',
				'customerNSetup'=>$customerNSetupSubTotal + $customerSetupSubTotal,
				'customerSetup'=>'-',
				'incomeNSetup'=>Yii::app()->format->formatNumber($incomeNSetupSubTotal + $incomeSetupSubTotal),
				'incomeSetup'=>'-',
				'valueNSetup'=>Yii::app()->format->formatNumber($valueNSetupSubTotal + $valueSetupSubTotal + $valueNDiscountSubTotal),
				'valueSetup'=>'-',
				'valueNDiscount'=>'-',
				'gross'=>Yii::app()->format->formatNumber($incomeNSetupSubTotal + $incomeSetupSubTotal + $valueNSetupSubTotal + $valueSetupSubTotal + $valueNDiscountSubTotal),
		);
		array_push($accomplishments, $total);
		
		return $accomplishments;
	}
	
	function actionExportSummary($labId, $month, $year){
		$_SESSION['labReport'] = 2;
		
		$minDate = $this->getMinDate($month , $year);
		$maxDate = $this->getMaxDate($month , $year);
		
		$requests = Request::model()->findAll(array(
					'condition' => 'labId = :labId AND requestDate >= :minDate AND requestDate <= :maxDate AND cancelled = :cancelled',
				    'params' => array(':labId' => $labId, ':minDate' => $minDate, ':maxDate' => $maxDate, ':cancelled' => 0),
				));
		
		ini_set('max_execution_time', 600);
		$this->toExcel($requests,
	        array(
	            'id',
	        ),
	        Lab::model()->findByPk($labId)->labCode.'-'.date('M',mktime(0, 0, 0, $month, 1, $year)).$year.'-Summary',
	        array(
	            'creator' => 'RSTL',
	        	'requests' => $requests,
	        	//'samples' => $samples,
	        ),
	        'Excel2007'
	    );
	    
	    
	}
	
	public function getMinDate($month, $year)
	{
		if($month == 2){
			if($year%4 == 0)
				$days = 29;
			else
				$days = 28; 	
		}
		
		if($month == 4 || $month == 6 || $month == 9 || $month == 11)
			$days = 30;
		
		if($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12)
			$days = 31;
		
		return date("Y-m-d", mktime(0, 0, 0, $month, 1, $year));
	}
	
	public function getMaxDate($month, $year)
	{
		if($month == 2){
			if($year%4 == 0)
				$days = 29;
			else
				$days = 28; 	
		}
		
		if($month == 4 || $month == 6 || $month == 9 || $month == 11)
			$days = 30;
		
		if($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12)
			$days = 31;
		
		return date("Y-m-d", mktime(0, 0, 0, $month, $days, $year));
	}
	
	
	/*
	public function actionIndexes()
	{	
		$match = '2013-01';
		$match = addcslashes($match, '%_');
		$reqs = Request::model()->count(array(
			//'condition' => 'labId = :labId AND requestDate LIKE :minDate AND cancelled = :cancelled',
			//'params' => array(':labId' => 1, ':minDate' => "%$match%", ':cancelled' => 0),
			'condition' => 'labId = :labId AND cancelled = :cancelled',
			'params' => array(':labId' => 1, ':cancelled' => 0),			
		));
		$this->render('consolidated', array('reqs'=>$reqs));
	}
	*/
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
	
/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */

	public function actionConsolidated(){
		
		//$requests = Request::model()->findAll();
		if($id == 0)
			$labId = 1;
		else
			$labId = $id;
		//
		$month2 = 1;
		$year = date('Y');
		$accomp = array();
		
		if($month2 == 2){
				if($year%4 == 0)
					$days = 29;
				else
					$days = 28; 	
			}
			
			if($month2 == 4 || $month2 == 6 || $month2 == 9 || $month2 == 11)
				$days = 30;
			
			if($month2 == 1 || $month2 == 3 || $month2 == 5 || $month2 == 7 || $month2 == 8 || $month2 == 10 || $month2 == 12)
				$days = 31;
				
			$minDate = date("Y-m-d", mktime(0, 0, 0, $month2, 1, $year));
			$maxDate = date("Y-m-d", mktime(0, 0, 0, $month2, $days, $year));

		$requests2 = Request::model()->findAll(array(
				    //'condition' => 'labId = :labId',
					'condition' => 'labId = :labId AND requestDate >= :minDate AND requestDate <= :maxDate AND cancelled = :cancelled',
				    'params' => array(':labId' => $labId, ':minDate' => $minDate, ':maxDate' => $maxDate, ':cancelled' => 0),
				));	
		
		//Initialize Totals
		$total = array(	'samples_setup'		=>	0,
					'samples_nonsetup'		=>	0,
					'tests_setup'			=>	0,
					'tests_nonsetup'		=>	0,
					'customers_setup'		=>	0,
					'customers_nonsetup'	=>	0,
					'income_setup'			=>	0,
					'income_nonsetup'		=>	0,
					'value_gratis_setup'	=>	0,
					'value_gratis_nonsetup'	=>	0,
					'value_discount'		=>	0,
					'gross'	=>	0			  
		);
		
		for($month = 1; $month <= 12; $month = $month + 1){
			$sampCount = 0;
			if($month == 2){
				if($year%4 == 0)
					$days = 29;
				else
					$days = 28; 	
			}
			
			if($month == 4 || $month == 6 || $month == 9 || $month == 11)
				$days = 30;
			
			if($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12)
				$days = 31;
				
			$minDate = date("Y-m-d", mktime(0, 0, 0, $month, 1, $year));
			$maxDate = date("Y-m-d", mktime(0, 0, 0, $month, $days, $year));
			
			$requests = Request::model()->findAll(array(
				    //'condition' => 'labId = :labId',
					'condition' => 'labId = :labId AND requestDate >= :minDate AND requestDate <= :maxDate AND cancelled = :cancelled',
				    'params' => array(':labId' => $labId, ':minDate' => $minDate, ':maxDate' => $maxDate, ':cancelled' => 0),
				));
	
			$report = array('samples'=>array(
											'setup'		=>	0,
											'nonsetup'	=>	0
											  ),
						  'tests'=>array(
											'setup'		=>	0,
											'nonsetup'	=>	0
											  ),
						  'customers'=>array(
											'setup'		=>	0,
											'nonsetup'	=>	0
											  ),
						  'income'=>array(
											'setup'		=>	0,
											'nonsetup'	=>	0
											  ),
						  'value'=>array(
											'gratis_setup'		=>	0,
											'gratis_nonsetup'	=>	0,
											'discount'	=>	0
											  ),
							'gross'=>0);
											  
			
			
			//$accomp = array();
			for($i=1; $i<=13; $i+=1){
				array_push($accomp, $report);
			}
			
			foreach($requests as $request){
				
				if(date('Y', strtotime($request->requestDate)) == $year){
					
					//month of the request
					//$month = date('n',strtotime($request->requestDate));
					//$month = 1;
					//setup or nonsetup
					$customer = Customer::model()->findByPk($request->customerId);
					
					$samples = Sample::model()->findAll(array(
					    'condition' => 'requestId = :requestId AND sampleMonth = :sampleMonth AND cancelled = :cancelled',
					    'params' => array(':requestId' => $request->requestRefNum, ':sampleMonth' => $month, ':cancelled' => 0),
					));
					
					$sampleCount = Sample::model()->count(array(
					    'condition' => 'requestId = :requestId AND sampleMonth = :sampleMonth AND cancelled = :cancelled',
					    'params' => array(':requestId' => $request->requestRefNum, ':sampleMonth' => $month, ':cancelled' => 0),
					));
					
					
					$analyses = Analysis::model()->findAll(array(
					    'condition' => 'requestId = :requestId AND analysisMonth = :analysisMonth AND cancelled = :cancelled AND deleted = :deleted',
					    'params' => array(':requestId' => $request->requestRefNum, ':analysisMonth' => $month, ':cancelled' => 0, ':deleted' => 0),
					));
					if($customer->typeId == 1){
						//count samples
						foreach($samples as $sample){
							$accomp[$month]['samples']['setup'] += 1;
						}
						
						//count tests
						foreach($analyses as $analysis){
							$accomp[$month]['tests']['setup'] += 1;
						}
						
						//count customers
						$accomp[$month]['customers']['setup'] += 1;
											
						if($request->paymentType == 2)
							$accomp[$month]['value']['gratis_setup'] += $request->total;
						else
							$accomp[$month]['income']['setup'] += $request->total;
					}else{
						//count samples
						foreach($samples as $sample){
							$accomp[$month]['samples']['nonsetup'] += 1;
						}
						
						//count tests
						foreach($analyses as $analysis){
							$accomp[$month]['tests']['nonsetup'] += 1;
						}
						
						//count customers
						$accomp[$month]['customers']['nonsetup'] += 1;
						
						if($request->paymentType == 2)
							$accomp[$month]['value']['gratis_nonsetup'] += $request->total;
						else
							$accomp[$month]['income']['nonsetup'] += $request->total;
					}
					//discount
					if($request->discount)
						$accomp[$month]['value']['discount'] += ($request->total / 0.75) * 0.25;
					
					
				}//end if
				
			}
			//Gross
			$accomp[$month]['gross'] += $accomp[$month]['income']['setup'];
			$accomp[$month]['gross'] += $accomp[$month]['income']['nonsetup'];
			$accomp[$month]['gross'] += $accomp[$month]['value']['gratis_setup'];
			$accomp[$month]['gross'] += $accomp[$month]['value']['gratis_nonsetup'];
			$accomp[$month]['gross'] += $accomp[$month]['value']['discount'];
			
			//Totals
			$total['samples_setup'] += $accomp[$month]['samples']['setup'];
			$total['samples_nonsetup'] += $accomp[$month]['samples']['nonsetup'];
			$total['tests_setup'] += $accomp[$month]['tests']['setup'];
			$total['tests_nonsetup'] += $accomp[$month]['tests']['nonsetup'];
			$total['customers_setup'] += $accomp[$month]['customers']['setup'];
			$total['customers_nonsetup'] += $accomp[$month]['customers']['nonsetup'];
			
			$total['income_setup'] += $accomp[$month]['income']['setup'];
			$total['income_nonsetup'] += $accomp[$month]['income']['nonsetup'];
			$total['value_gratis_setup'] += $accomp[$month]['value']['gratis_setup'];
			$total['value_gratis_nonsetup'] += $accomp[$month]['value']['gratis_nonsetup'];
			$total['value_discount'] += $accomp[$month]['value']['discount'];
			 
			$total['gross'] += $accomp[$month]['gross'];
		}//end for loop
		
		$this->render('consolidated', array('lab'=>Lab::model()->findByPk($labId),
									   'accomp'=>$accomp, 'requests'=>$requests, 
									   'requests2'=>$requests2, 'sampleCount'=>$sampCount,
									   'total'=>$total));
	}

	public function actionUpdateConso(){
		$labId = $_POST['lab'];
		$year = $_POST['year'];
		$_SESSION['lab'] = $labId;
		$_SESSION['year'] = $year;
		$month2 = 1;
		
		$accomp = array();
		
		if($month2 == 2){
				if($year%4 == 0)
					$days = 29;
				else
					$days = 28; 	
			}
			
			if($month2 == 4 || $month2 == 6 || $month2 == 9 || $month2 == 11)
				$days = 30;
			
			if($month2 == 1 || $month2 == 3 || $month2 == 5 || $month2 == 7 || $month2 == 8 || $month2 == 10 || $month2 == 12)
				$days = 31;
				
			$minDate = date("Y-m-d", mktime(0, 0, 0, $month2, 1, $year));
			$maxDate = date("Y-m-d", mktime(0, 0, 0, $month2, $days, $year));

		$requests2 = Request::model()->findAll(array(
				    //'condition' => 'labId = :labId',
					'condition' => 'labId = :labId AND requestDate >= :minDate AND requestDate <= :maxDate AND cancelled = :cancelled',
				    'params' => array(':labId' => $labId, ':minDate' => $minDate, ':maxDate' => $maxDate, ':cancelled' => 0),
				));	
		
		//Initialize Totals
		$total = array(	'samples_setup'		=>	0,
					'samples_nonsetup'		=>	0,
					'tests_setup'			=>	0,
					'tests_nonsetup'		=>	0,
					'customers_setup'		=>	0,
					'customers_nonsetup'	=>	0,
					'income_setup'			=>	0,
					'income_nonsetup'		=>	0,
					'value_gratis_setup'	=>	0,
					'value_gratis_nonsetup'	=>	0,
					'value_discount'		=>	0,
					'gross'	=>	0			  
		);
		
		for($month = 1; $month <= 12; $month = $month + 1){
			$sampCount = 0;
			if($month == 2){
				if($year%4 == 0)
					$days = 29;
				else
					$days = 28; 	
			}
			
			if($month == 4 || $month == 6 || $month == 9 || $month == 11)
				$days = 30;
			
			if($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12)
				$days = 31;
				
			$minDate = date("Y-m-d", mktime(0, 0, 0, $month, 1, $year));
			$maxDate = date("Y-m-d", mktime(0, 0, 0, $month, $days, $year));
			
			$requests = Request::model()->findAll(array(
				    //'condition' => 'labId = :labId',
					'condition' => 'labId = :labId AND requestDate >= :minDate AND requestDate <= :maxDate AND cancelled = :cancelled',
				    'params' => array(':labId' => $labId, ':minDate' => $minDate, ':maxDate' => $maxDate, ':cancelled' => 0),
				));
	
			$report = array('samples'=>array(
											'setup'		=>	0,
											'nonsetup'	=>	0
											  ),
						  'tests'=>array(
											'setup'		=>	0,
											'nonsetup'	=>	0
											  ),
						  'customers'=>array(
											'setup'		=>	0,
											'nonsetup'	=>	0
											  ),
						  'income'=>array(
											'setup'		=>	0,
											'nonsetup'	=>	0
											  ),
						  'value'=>array(
											'gratis_setup'		=>	0,
											'gratis_nonsetup'	=>	0,
											'discount'	=>	0
											  ),
							'gross'=>0);
											  
			
			
			//$accomp = array();
			for($i=1; $i<=13; $i+=1){
				array_push($accomp, $report);
			}
			
			foreach($requests as $request){
				
				if(date('Y', strtotime($request->requestDate)) == $year){
					
					//month of the request
					//$month = date('n',strtotime($request->requestDate));
					//$month = 1;
					//setup or nonsetup
					$customer = Customer::model()->findByPk($request->customerId);
					
					$samples = Sample::model()->findAll(array(
					    'condition' => 'requestId = :requestId AND sampleMonth = :sampleMonth AND cancelled = :cancelled',
					    'params' => array(':requestId' => $request->requestId, ':sampleMonth' => $month, ':cancelled' => 0),
					));
					
					$sampleCount = Sample::model()->count(array(
					    'condition' => 'requestId = :requestId AND sampleMonth = :sampleMonth AND cancelled = :cancelled',
					    'params' => array(':requestId' => $request->requestId, ':sampleMonth' => $month, ':cancelled' => 0),
					));
					
					
					$analyses = Analysis::model()->findAll(array(
					    'condition' => 'requestId = :requestId AND analysisMonth = :analysisMonth AND cancelled = :cancelled AND deleted = :deleted',
					    'params' => array(':requestId' => $request->requestId, ':analysisMonth' => $month, ':cancelled' => 0, ':deleted' => 0),
					));
					if($customer->typeId == 1){
						//count samples
						foreach($samples as $sample){
							$accomp[$month]['samples']['setup'] += 1;
						}
						
						//count tests
						foreach($analyses as $analysis){
							$accomp[$month]['tests']['setup'] += 1;
						}
						
						//count customers
						$accomp[$month]['customers']['setup'] += 1;
											
						if($request->paymentType == 2)
							$accomp[$month]['value']['gratis_setup'] += $request->total;
						else
							$accomp[$month]['income']['setup'] += $request->total;
					}else{
						//count samples
						foreach($samples as $sample){
							$accomp[$month]['samples']['nonsetup'] += 1;
						}
						
						//count tests
						foreach($analyses as $analysis){
							$accomp[$month]['tests']['nonsetup'] += 1;
						}
						
						//count customers
						$accomp[$month]['customers']['nonsetup'] += 1;
						
						if($request->paymentType == 2)
							$accomp[$month]['value']['gratis_nonsetup'] += $request->total;
						else
							$accomp[$month]['income']['nonsetup'] += $request->total;
					}
					//discount
					if($request->discount)
						$accomp[$month]['value']['discount'] += ($request->total / 0.75) * 0.25;
					
					
				}//end if
				
			}
			//Gross
			$accomp[$month]['gross'] += $accomp[$month]['income']['setup'];
			$accomp[$month]['gross'] += $accomp[$month]['income']['nonsetup'];
			$accomp[$month]['gross'] += $accomp[$month]['value']['gratis_setup'];
			$accomp[$month]['gross'] += $accomp[$month]['value']['gratis_nonsetup'];
			$accomp[$month]['gross'] += $accomp[$month]['value']['discount'];
			
			//Totals
			$total['samples_setup'] += $accomp[$month]['samples']['setup'];
			$total['samples_nonsetup'] += $accomp[$month]['samples']['nonsetup'];
			$total['tests_setup'] += $accomp[$month]['tests']['setup'];
			$total['tests_nonsetup'] += $accomp[$month]['tests']['nonsetup'];
			$total['customers_setup'] += $accomp[$month]['customers']['setup'];
			$total['customers_nonsetup'] += $accomp[$month]['customers']['nonsetup'];
			
			$total['income_setup'] += $accomp[$month]['income']['setup'];
			$total['income_nonsetup'] += $accomp[$month]['income']['nonsetup'];
			$total['value_gratis_setup'] += $accomp[$month]['value']['gratis_setup'];
			$total['value_gratis_nonsetup'] += $accomp[$month]['value']['gratis_nonsetup'];
			$total['value_discount'] += $accomp[$month]['value']['discount'];
			 
			$total['gross'] += $accomp[$month]['gross'];
		}//end for loop
		
		$this->renderpartial('_conso', array('lab'=>Lab::model()->findByPk($labId),
									   'accomp'=>$accomp, 'requests'=>$requests, 
									   'requests2'=>$requests2, 'sampleCount'=>$sampCount,
									   'total'=>$total));
		}
	
	/** Generate report for excel : Start **/
			
	function generateReport($labId, $year){
		
		//Initialize Totals
		$total = array(	'samples_setup'		=>	0,
					'samples_nonsetup'		=>	0,
					'tests_setup'			=>	0,
					'tests_nonsetup'		=>	0,
					'customers_setup'		=>	0,
					'customers_nonsetup'	=>	0,
					'income_setup'			=>	0,
					'income_nonsetup'		=>	0,
					'value_gratis_setup'	=>	0,
					'value_gratis_nonsetup'	=>	0,
					'value_discount'		=>	0,
					'gross'	=>	0			  
		);
		$accomplishment = array();
		
		$report = array('samples'=>array(
											'setup'		=>	0,
											'nonsetup'	=>	0
											  ),
						  'tests'=>array(
											'setup'		=>	0,
											'nonsetup'	=>	0
											  ),
						  'customers'=>array(
											'setup'		=>	0,
											'nonsetup'	=>	0
											  ),
						  'income'=>array(
											'setup'		=>	0,
											'nonsetup'	=>	0
											  ),
						  'value'=>array(
											'gratis_setup'		=>	0,
											'gratis_nonsetup'	=>	0,
											'discount'	=>	0
											  ),
							'gross'=>0);	
		
		for($i=1; $i<=13; $i+=1){
			array_push($accomplishment, $report);
		}
		/** Loop through months : Start **/
		for($month = 1; $month <= 12; $month = $month + 1){
			
			
			$sampCount = 0;
			if($month == 2){
				if($year%4 == 0)
					$days = 29;
				else
					$days = 28; 	
			}
			
			if($month == 4 || $month == 6 || $month == 9 || $month == 11)
				$days = 30;
			
			if($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12)
				$days = 31;
				
			$minDate = date("Y-m-d", mktime(0, 0, 0, $month, 1, $year));
			$maxDate = date("Y-m-d", mktime(0, 0, 0, $month, $days, $year));
			
			$requests = Request::model()->findAll(array(
					'condition' => 'labId = :labId AND requestDate >= :minDate AND requestDate <= :maxDate AND cancelled = :cancelled',
				    'params' => array(':labId' => $labId, ':minDate' => $minDate, ':maxDate' => $maxDate, ':cancelled' => 0),
				));
	
			foreach($requests as $request){
				$customer = Customer::model()->findByPk($request->customerId);
				
				$samples = Sample::model()->findAll(array(
					    'condition' => 'requestId = :requestId AND sampleMonth = :sampleMonth AND cancelled = :cancelled',
					    'params' => array(':requestId' => $request->requestId, ':sampleMonth' => $month, ':cancelled' => 0),
					));
					
				$sampleCount = Sample::model()->count(array(
				    'condition' => 'requestId = :requestId AND sampleMonth = :sampleMonth AND cancelled = :cancelled',
				    'params' => array(':requestId' => $request->requestId, ':sampleMonth' => $month, ':cancelled' => 0),
					));
				
				$analyses = Analysis::model()->findAll(array(
				    'condition' => 'requestId = :requestId AND analysisMonth = :analysisMonth AND cancelled = :cancelled AND deleted = :deleted',
				    'params' => array(':requestId' => $request->requestId, ':analysisMonth' => $month, ':cancelled' => 0, ':deleted' => 0),
					));
					
				if($customer->typeId == 1){
						//count samples
						foreach($samples as $sample){
							$accomplishment[$month]['samples']['setup'] += 1;
						}
						
						//count tests
						foreach($analyses as $analysis){
							$accomplishment[$month]['tests']['setup'] += 1;
						}
						
						//count customers
						$accomplishment[$month]['customers']['setup'] += 1;
											
						if($request->paymentType == 2)
							$accomplishment[$month]['value']['gratis_setup'] += $request->total;
						else
							$accomplishment[$month]['income']['setup'] += $request->total;
					}else{
						//count samples
						foreach($samples as $sample){
							$accomplishment[$month]['samples']['nonsetup'] += 1;
						}
						
						//count tests
						foreach($analyses as $analysis){
							$accomplishment[$month]['tests']['nonsetup'] += 1;
						}
						
						//count customers
						$accomplishment[$month]['customers']['nonsetup'] += 1;
						
						if($request->paymentType == 2)
							$accomplishment[$month]['value']['gratis_nonsetup'] += $request->total;
						else
							$accomplishment[$month]['income']['nonsetup'] += $request->total;
					}
					if($request->discount)
						$accomplishment[$month]['value']['discount'] += ($request->total / 0.75) * 0.25;
			}/** Cycle though months : End **/
											  
											  

			
		}/** Loop through months : End **/
		
		return $accomplishment;
	}
	/** Generate report for excel : End **/	
	
	function actionExportConso($year, $rstlId){
		$_SESSION['labReport'] = 1;
	    $labs = Lab::model()->findAll();
	    $reports = array();
	    
	    $report1 = $this->getAccomplishmentDataProvider($rstlId, 1, $year);
	    $report2 = $this->getAccomplishmentDataProvider($rstlId, 2, $year);
	    $report3 = $this->getAccomplishmentDataProvider($rstlId, 3, $year);
	    unset($report1[12]);
	    unset($report1[13]);
	    unset($report2[12]);
	    unset($report2[13]);
	    unset($report3[12]);
	    unset($report3[13]);
	    array_push($reports, $report1);
	    array_push($reports, $report2);
	    array_push($reports, $report3);
		
	    $this->toExcel($labs,
	        array(
	            'id',
	        ),
	        $year.' Consolidated Accomplishments (as of '.date("m-d-Y").')',
	        array(
	            'year' => $year,
	        	'creator' => 'RSTL',
	        	
	        	'reports' => $reports,
	        	'header' => array(
	        					'1' => 'CHEMLAB',
	        					'2' => 'MICROLAB',
	        					'3' => 'METROLAB',
	        					'4' => 'SUMMARY OF DOST-IX RSTL ACCOMPLISHMENT ('.$year.')',
	        				)
	        ),
	        'Excel5'
	    );
	}
	
	function generateSummary($labId, $month){
		$year = $_SESSION['year'];
		if($month == 2){
			if($year%4 == 0)
				$days = 29;
			else
				$days = 28; 	
		}
		
		if($month == 4 || $month == 6 || $month == 9 || $month == 11)
			$days = 30;
		
		if($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12)
			$days = 31;
			
		$minDate = date("Y-m-d", mktime(0, 0, 0, $month, 1, $year));
		$maxDate = date("Y-m-d", mktime(0, 0, 0, $month, $days, $year));
		
		//Initialize Summary array
		$summarys = array();			
		
		
		$requests = Request::model()->findAll(array(
			    //'condition' => 'labId = :labId',
				'condition' => 'labId = :labId AND requestDate >= :minDate AND requestDate <= :maxDate AND cancelled = :cancelled',
			    'params' => array(':labId' => $labId, ':minDate' => $minDate, ':maxDate' => $maxDate, ':cancelled' => 0),
			));
		
		
		foreach ($requests as $request){
			$dataRequest = array('request'	=>	$request->requestRefNum,
								'payment'	=>	array(	'type'	=> $request->paymentType,
														'total' =>	$request->total,
														'discount'	=> $request->discount,
														//'discountTotal' => ($request->total / 0.75) * 0.25,
														
													 ),
								'customer'	=>	array(	'type'	=> Customer::model()->findByPk($request->customerId)->typeId,
														'agency'=> Customer::model()->findByPk($request->customerId)->customerName,
													 	'address'=> Customer::model()->findByPk($request->customerId)->address								
													 ),
								'sample'	=>	array()
							);	
							
					$samples = Sample::model()->findAll(array(
					    'condition' => 'requestId = :requestId AND sampleMonth = :sampleMonth AND cancelled = 0',
					    'params' => array(':requestId' => $request->requestId, ':sampleMonth' => $month),
					));
					
					foreach($samples as $sample){
						$analyses = Analysis::model()->findAll(array(
						    'condition' => 'requestId = :requestId AND analysisMonth = :analysisMonth AND sampleCode = :sampleCode AND cancelled = 0 AND deleted = 0' ,
						    'params' => array(':requestId' => $request->requestId, ':analysisMonth' => $month, ':sampleCode' => $sample->sampleCode),
						));
						
						$dataSample	= array(	'name'	=> $sample->sampleName,
											 	'code'	=> $sample->sampleCode,
												'test'	=> array(	
																//'param' => $analyse->testName,
																//'fee' => $analyse->fee,
																)
										   );
							
						$count = 0;
						foreach($analyses as $analyse){
							$dataAnalyses = array(	'param' => $analyse->testName,
													'fee' => $analyse->fee,
							
							);
							
							array_push($dataSample['test'], $dataAnalyses);
							$count = $count + 1;
						}
						
						array_push($dataRequest['sample'], $dataSample);	
					}
					
									
			
					
			array_push($summarys, $dataRequest);	
			//$count = $count + 1;
		}
		return $summarys;
	}
	
	public function actionSummary($labId, $month, $year){
		//$month = 1;
		//$year = 2013;
		//$labId = $id;
		//$sampCount = 0;
		if($month == 2){
			if($year%4 == 0)
				$days = 29;
			else
				$days = 28; 	
		}
		
		if($month == 4 || $month == 6 || $month == 9 || $month == 11)
			$days = 30;
		
		if($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12)
			$days = 31;
			
		$minDate = date("Y-m-d", mktime(0, 0, 0, $month, 1, $year));
		$maxDate = date("Y-m-d", mktime(0, 0, 0, $month, $days, $year));
		
		//Initialize Summary array
		/*$summary = array(	'request'	=>	'',
							'customer'	=>	array(	'type'	=> '',
													'agency'=> ''
							
		
												 ),
							'sample'	=>	array(	'name'	=> '',
												 	'code'	=> '',
												 	'nonsetup' => '',
													'setup'	=> '',
													'test'	=> array('param'	=> '')
												 ),
						);*/
		$summarys = array();			
		
		
		$requests = Request::model()->findAll(array(
			    //'condition' => 'labId = :labId',
				'condition' => 'labId = :labId AND requestDate >= :minDate AND requestDate <= :maxDate AND cancelled = :cancelled',
			    'params' => array(':labId' => $labId, ':minDate' => $minDate, ':maxDate' => $maxDate, ':cancelled' => 0),
			));
		
		
		foreach ($requests as $request){
			$dataRequest = array('request'	=>	$request->requestRefNum,
								'payment'	=>	array(	'type'	=> $request->paymentType,
														'total' =>	$request->total,
														'discount'	=> $request->discount,
														//'discountTotal' => ($request->total / 0.75) * 0.25,
														
													 ),
								'customer'	=>	array(	'type'	=> Customer::model()->findByPk($request->customerId)->typeId,
														'agency'=> Customer::model()->findByPk($request->customerId)->customerName,
													 	//'address'=> Customer::model()->findByPk($request->customerId)->address								
													 ),
								'sample'	=>	array()
							);	
							
					$samples = Sample::model()->findAll(array(
					    'condition' => 'requestId = :requestId AND sampleMonth = :sampleMonth AND cancelled = :cancelled',
					    'params' => array(':requestId' => $request->requestId, ':sampleMonth' => $month, ':cancelled' => 0),
					));
					
					foreach($samples as $sample){
						$analyses = Analysis::model()->findAll(array(
						    'condition' => 'requestId = :requestId AND analysisMonth = :analysisMonth AND sampleCode = :sampleCode AND cancelled = :cancelled',
						    'params' => array(':requestId' => $request->requestId, ':analysisMonth' => $month, ':sampleCode' => $sample->sampleCode, ':cancelled' => 0),
						));
						
						$dataSample	= array(	'name'	=> $sample->sampleName,
											 	'code'	=> $sample->sampleCode,
												'test'	=> array(	
																//'param' => $analyse->testName,
																//'fee' => $analyse->fee,
																)
										   );
							
						$count = 0;
						foreach($analyses as $analyse){
							$dataAnalyses = array(	'param' => $analyse->testName,
													'fee' => $analyse->fee,
							
							);
							
							array_push($dataSample['test'], $dataAnalyses);
							$count = $count + 1;
						}
						
						array_push($dataRequest['sample'], $dataSample);	
					}
					
									
			
					
			array_push($summarys, $dataRequest);	
			//$count = $count + 1;
		}
		
		$this->render('summary', array(//'lab'=>Lab::model()->findByPk($labId),
									   //'accomp'=>$accomp, 
									   'summarys'=>$summarys, 
									   //'requests2'=>$requests2, 'sampleCount'=>$sampCount,
									   //'total'=>$total
									   ));
	}
	
	public function getYear()
	{
		$request = Request::model()->find(array(
					'select' => '*',
					'order' => 'requestDate ASC',
				));
		
		$listYear = array();
		for ($year = date('Y'); $year >= date('Y', strtotime($request->requestDate)); $year = $year - 1) {
			$y = array("index" => $year , "year" => $year);
			array_push($listYear, $y);
		}

		return $listYear;	
	}
	
	public function behaviors()
    {
        return array(
            'eexcelview'=>array(
                'class'=>'ext.eexcelview.LabReportBehavior',
            ),
        );
    }
    
	public function formatNumber($number) 
	{
        $var = Yii::app()->format->formatNumber($number);
        return $var;
    }
}

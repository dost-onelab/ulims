<?php

class StatisticController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionCustomer()
	{
		$model=new Statistic;
		$model->unsetAttributes();
		
		if(isset($_GET['year'])){
			$labId = $_GET['lab'];
			$year = $_GET['year'];
		}else{
			//$labId = 1;
			$year = date('Y');		
		}
		
		$customers = $this->getCustomers($scope, $year, $month);
		
		$this->render('customer',array(
			'model'=>$model, 
			'customers'=>$customers,
			'year'=>$year,
		));
	}
	
	function getCustomers($scope, $year, $month)
	{
		$minDate = date("Y-m-d", mktime(0, 0, 0, 1, 1, $year));
		$maxDate = date("Y-m-d", mktime(0, 0, 0, 12, 31, $year));
		
		$criteria=new CDbCriteria;
		$criteria->with = array(
			'customer'
		);
		$criteria->order = 'customer.customerName ASC';
		$criteria->select = array(
			'*',
			'count(*) as request_count',
			'sum(total) as total_income'
		);
		$criteria->group = 't.customerId';
		$criteria->condition = 't.cancelled = :cancelled AND requestDate >= :minDate AND requestDate <= :maxDate';
		$criteria->params = array(':cancelled' => 0, ':minDate' => $minDate, ':maxDate' => $maxDate);
		
		$dataProvider=new CActiveDataProvider(
		    'Request',
		    array(
		        'criteria'=>$criteria,
		        'pagination' => false,
		    )
		);
		
		return $dataProvider;
	}
	
	function actionExportCustomer($year){
	    $customers = $this->getCustomers($scope, $year, $month);
		
	    $this->toExcel($customers,
	        array(
	            //'id',
	            array(
	            	'name'=>'customer.customerName',
	            	'header'=>'CUSTOMER / COMPANY / FIRM',
	            ),
	        	'customer.address',
	        	'customer.tel',
	        	'request_count',
	        	'chemSamples',
	        	'microSamples',
	        	'chemTests',
	        	'microTests',
	        	'total_income'
	        ),
	        $year.' Customers Served (as of '.date("m-d-Y").')',
	        array(
	            //'year' => $year,
	        	'creator' => 'RSTL',
	        	'customers' => $customers,
	        ),
	        'Excel5'
	    );
	}
	
	public function getYear()
	{
		$listYear = array();
		for ($year = date('Y'); $year >= 2013; $year = $year - 1) {
			$y = array("index" => $year , "year" => $year);
			array_push($listYear, $y);
		}

		return $listYear;	
	}

	public function behaviors()
    {
        return array(
            'eexcelview'=>array(
                'class'=>'ext.eexcelview.EExcelBehavior',
            ),
        );
    }	
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
}
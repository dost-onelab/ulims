<?php

class DefaultController extends Controller
{
	public $layout='//layouts/column1';
	public function actionIndex()
	{
		
		$yearList=Yii::app()->Controller->yearList(3); //number of years to compute backwards; start current year
		$yearListArray=array();
		$yearListCategories=array();
		if($yearList){
			foreach($yearList as $year){
			$yearListStr.=$year.',';
			$yearListArray[$year]=0;
			$yearListCategories[]=$year;
			}
		}
		$yearListStr=substr_replace($yearListStr,"",-1,1);//remove extra comma at the end of string		
		if($yearListCategories){
			$yearRange=reset($yearListCategories)."-".end($yearListCategories);
		}
			
			/*
			* RSTL
			*
			*/
			//define performance indicators to display chart
			//
			$laboratories=Lab::model()->findAll();
			$rstlPerformanceIndicators=array(
				array('id'=>1, 'code'=>'tests', 'name'=>'Testing/Calibration Services Rendered'), //::Analysis Model not Cancelled
				array('id'=>2, 'code'=>'customers', 'name'=>'Customers Served'), //::Request not Cancelled
				array('id'=>3, 'code'=>'firms', 'name'=>'Firms Assisted'), // ::Request no Cancelled group by customerId
				array('id'=>4, 'code'=>'income', 'name'=>'Income Generated'), // ::Request thru Analysis thru Samps
				array('id'=>5, 'code'=>'gratis', 'name'=>'Value of Assistance Rendered'), //::Request thru Analysis thru Samps paymentType=2  
			);
			$rstlPerformanceData=array();
			foreach($rstlPerformanceIndicators as $rstlPerformanceIndicator){
				$indicatorId=$rstlPerformanceIndicator['id'];
				$rstlPerformanceIndicatorLabBarColumns=array();
				foreach($laboratories as $column){
					$labId=$column->id;
					$arraycount=$this->countRstlPerformanceIndicatorLabByEachYear($labId, $indicatorId, $yearList); //12 for Region IX
					$data=array();
					if(!empty($arraycount)){
						$data=$arraycount+$yearListArray;
					}
					ksort($data);
					$data=array_values($data);
					$rstlPerformanceIndicatorLabBarColumns[]=array(
						'name'=>$column->labName, 
						'data'=>$data?$data:$yearListArray,
						);
				}
			$rstlPerformanceData[$indicatorId]=$rstlPerformanceIndicatorLabBarColumns;
			}
			
			/*echo "<pre>";
			print_r($rstlPerformanceIndicators);
			echo "</pre>";*/
			$threeYear=Yii::app()->Controller->yearList(2,true);
			if($threeYear){
				foreach($threeYear as $year){				
				$topAnalysis=Analysis::model()->with(array(
						/*'anals'=>array(
							//'select'=>array('project.id','project.code'),
							'condition'=>'anals.cancelled=:notCancelled',
							'params'=>array(':notCancelled'=>0)
							),*/
						'sample.request'=>array(
							//'condition'=>'request.labId=:labId AND request.cancelled=0 AND YEAR(requestDate)=:requestYear',
							'condition'=>'request.cancelled=0 AND YEAR(requestDate)=:requestYear',
							//'params'=>array(':requestYear'=>$year, ':labId'=>$labId)
							'params'=>array(':requestYear'=>$year)
						),
						))->findAll(array(
									'condition'=>'t.cancelled=0 AND t.deleted=0',
									'group'=>'testName',
									'select'=>'testId, testName, COUNT(testId) AS countTest',
									'order'=>'countTest DESC',
									'limit'=>5,
									));
					//echo "<pre>";
					//print_r($year);
					//echo "</pre>";
				$topAnalysis3years[$year]=array('year'=>$year, 'topAnalysis'=>new CArrayDataProvider($topAnalysis,array('pagination'=>false)));
				}
			}
			
			$testAnalysisByLabPieColumns=array();
			$labs=Lab::model()->findAll();
			//set year to current year
			$currYear=date('Y');
			foreach($labs as $column){
				$testAnalysisByLabPieColumns[]=array(
					'name'=>$column->labName, 
					'y'=>floatval($this->countTotalTestAnalysisByLab($column->id, $rstlId, $currYear)),
					);
			}			
			//End RSTL
		

		$this->render('index', array(
				'yearListStr'=>$yearListStr, 'yearRange'=>$yearRange, 
				'currYear'=>$currYear,'yearListCategories'=>$yearListCategories,
				//'topAnalysis'=>new CArrayDataProvider($topAnalysis,array('pagination'=>false)),
				'topAnalysis3years'=>$topAnalysis3years,
				'rstlPerformanceIndicators'=>$rstlPerformanceIndicators, 
				'rstlPerformanceData'=>$rstlPerformanceData,
				'testAnalysisByLabPieColumns'=>$testAnalysisByLabPieColumns
		));
	}
	
	public function countRstlPerformanceIndicatorLabByEachYear($labId, $indicatorId, $yearList){
		foreach ($yearList as $year){
			//$provinceId=$province->id;
			$count=$this->countRstlPerformanceIndicatorLabByYear($labId, $indicatorId, $year);
				if($count){
					$count=floatval($count);
				}else{
					$count=floatval(0);
				}
			$grouparr[$year]=$count;
		}
		return $grouparr;		
	}

	public function countRstlPerformanceIndicatorLabByYear($labId, $indicatorId, $year){		
		//use SWITCH CASE for indicatorId
		switch ($indicatorId){
			case 1: //Testing/Calibration Services Rendered
			$count=Analysis::model()->with(array(
					/*'anals'=>array(
						//'select'=>array('project.id','project.code'),
						'condition'=>'anals.cancelled=:notCancelled',
						'params'=>array(':notCancelled'=>0)
						),*/
					'sample.request'=>array(
						'condition'=>'request.labId=:labId AND request.cancelled=0 AND YEAR(requestDate)=:requestYear',
						'params'=>array(':requestYear'=>$year, ':labId'=>$labId)
					),
					))->count(array('condition'=>'t.cancelled=0 AND t.deleted=0'));
					/*))->count(array('condition'=>'YEAR(requestDate)=:requestYear',
									'params'=>array(':requestYear'=>$year)
									));*/
					
			return $count;
			break;
			
			case 2: //Customers Served
			$count=Request::model()->count(array(
									'condition'=>'labId=:labId AND cancelled=0 AND YEAR(requestDate)=:requestYear',
									'params'=>array(':requestYear'=>$year, ':labId'=>$labId),
							));
			return $count;
			break;

			case 3: //Firms Assisted
			$count=Request::model()->count(array(
									'group'=>'customerId',
									'condition'=>'labId=:labId AND cancelled=0 AND YEAR(requestDate)=:requestYear',
									'params'=>array(':requestYear'=>$year, ':labId'=>$labId),
							));
			return $count;
			break;

			case 4: //Income Generated
			$analysis=Analysis::model()->with(array(
					'sample.request'=>array(
						'condition'=>'request.paymentType=1 AND request.labId=:labId AND request.cancelled=0 AND YEAR(requestDate)=:requestYear',
						'params'=>array(':requestYear'=>$year, ':labId'=>$labId)
					),
					))->findAll(array('condition'=>'t.cancelled=0 AND t.deleted=0'));	
			
			if($analysis){
				foreach($analysis as $analyses){
					$fee=$analyses->fee;
					$discount=$analyses->sample->request->discount;
					if($discount)
						$fee=$fee*0.75;// 25% discount, fee=75%
				
					$totalFee+=$fee;
				}
			}
			//Base Total
			/*$requests=LmsRequest::model()->findAll(array(
									//'group'=>'customerId',
									'condition'=>'paymentType=1 AND labId=:labId AND cancelled=0 AND YEAR(requestDate)=:requestYear',
									'params'=>array(':requestYear'=>$year, ':labId'=>$labId),
							));
			if($requests){
				foreach($requests as $request){
					$fee=$request->total;
					$totalFee+=$fee;
				}
			}*/
			return $totalFee;
			break;

			case 5: //Value of Assistance Rendered
			$analysis=Analysis::model()->with(array(
					'sample.request'=>array(
						'condition'=>'request.labId=:labId AND request.cancelled=0 AND YEAR(requestDate)=:requestYear',
						'params'=>array(':requestYear'=>$year, ':labId'=>$labId)
					),
					))->findAll(array('condition'=>'t.cancelled=0 AND t.deleted=0'));
			if($analysis){
				foreach($analysis as $analyses){
					$fee=$analyses->fee;
					$paymentType=$analyses->sample->request->paymentType;
					$discount=$analyses->sample->request->discount;
					if($paymentType==1 && $discount==1){
						$valueFee=$fee*0.25;// 25% discount, will get the 25% discount value
						$totalFee+=$valueFee;
					}
					
					if($paymentType==2){
						$valueFee=$fee;
						$totalFee+=$valueFee;
					}
					
				}
			}
			return $totalFee;
			break;
							
			default:
			return 0;
			
		}
	}	
	
	public function countTotalTestAnalysisByLab($labId, $rstlId=NULL, $year=NULL)
	{
		$count=Analysis::model()->with(array(
			/*'anals'=>array(
			//'select'=>array('project.id','project.code'),
			'condition'=>'anals.cancelled=:notCancelled',
			'params'=>array(':notCancelled'=>0)
			),*/
			'sample.request'=>array(
				'condition'=>'request.labId=:labId AND request.cancelled=0 AND YEAR(requestDate)=:requestYear',
				'params'=>array(':requestYear'=>$year, ':labId'=>$labId)
			),
			))->count(array('condition'=>'t.cancelled=0 AND t.deleted=0'));
			/*))->count(array('condition'=>'YEAR(requestDate)=:requestYear',
							'params'=>array(':requestYear'=>$year)
			));*/
					
		return $count;
	}
}
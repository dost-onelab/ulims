<?php
/* @var $this StatisticController */

$this->breadcrumbs=array(
	'Statistic',
);
?>
<?php 
Yii::app()->clientScript->registerScript('customs', "
	
	$('.customers-form form').submit(function(){
		
		$('#grid-customer').yiiGridView('update', {
			data: $(this).serialize()
		});
		
		return false;
	});
	
");
?>

<div class="customers-form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<?php	
	echo CHtml::dropDownList('year', $select,	
				CHtml::listData($this->getYear(), 'index', 'year'),
				array(
			   		'onchange'=>'js:{
			   					$(".customers-form form").submit()
								var year = $("#year").val();
			   					$("h3.title").text("Customers Served for "+year);
			   					$("a.export").attr("href","exportCustomer/year/"+year);
			   					}',
				)
	);
?>
<?php echo ' '.CHtml::link('Export',$this->createUrl('statistic/exportCustomer/',array('year'=>$year)), array('class'=>'export'));?>
<?php $this->endWidget(); ?>
</div>
<h3 class="title" style="text-align: center; margin-top: -20px; margin-bottom: -20px;"><?php echo 'Customers Served for '.$year;?> </h3>
<?php 
	 $this->widget('zii.widgets.grid.CGridView', array(
	      'id' => 'grid-customer',
	 	  //'htmlOptions' => array('style' => 'width: 80%; align: center;'),
 	      'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
		  'rowHtmlOptionsExpression' => 'array("title" => "Click to update", "class"=>"link-hand")',
	      'dataProvider' => $customers,
		  'summaryText' => '',
	      'columns' => array(
	        /*array(
	        	'name'=>'id', 
	        	'header'=>'ID',
	        	'headerHtmlOptions' => array('rowspan' => 2),
	        	'htmlOptions' => array('style' => 'text-align: left;')
	        ),*/
	        array(
				'name'=>'customer.customerName',
	        	'header'=>'CUSTOMER / COMPANY / FIRM',
	        	'headerHtmlOptions' => array('rowspan' => 2),
	        	'type'=>'html',
	        	'value'=>'$data->customer->customerName.$data->customerRequests',
	        	//'value'=>'$data->customer->customerName',
    			'htmlOptions' => array('style' => 'width: 300px; text-align: left;'),
			),
			array(
				'name'=>'customer.address',
				'header'=>'ADDRESS',
				'headerHtmlOptions' => array('rowspan' => 2),
			),
			array(
				'name'=>'customer.tel',
				'header'=>'CONTACT DETAILS',
				'headerHtmlOptions' => array('rowspan' => 2),
				'htmlOptions' => array('style' => 'text-align: center;'),
				'type'=>'raw',
			),
			array(
				'name'=>'request_count',
				'header'=>'NO. OF REQUESTS<th colspan=2>TOTAL NO. OF SAMPLE</th><th colspan=2>TOTAL NO. OF TESTING SERVICES AVAILED</th><th colspan=2 rowspan=2>TOTAL INCOME<br/>GENERATED (PHP)</th><tr>',
				'headerHtmlOptions' => array('rowspan' => 2),
				'htmlOptions' => array('style' => 'width: 60px; text-align: center;'),
			),
			array(
				'name'=>'chemSamples',
				'header'=>'CHEM',
				'type'=>'raw',
				'htmlOptions' => array('style' => 'width: 60px; text-align: center;'),
			),
			array(
				'name'=>'microSamples',
				'header'=>'MICRO',
				'type'=>'raw',
				'htmlOptions' => array('style' => 'width: 60px; text-align: center;'),
			),
			array(
				'name'=>'chemTests',
				'header'=>'CHEM',
				'type'=>'raw',
				'htmlOptions' => array('style' => 'width: 60px; text-align: center;'),
			),
			array(
				'name'=>'microTests',
				'header'=>'MICRO',
				'type'=>'raw',
				'htmlOptions' => array('style' => 'width: 60px; text-align: center;'),
			),
			array(
				'name'=>'total_income',
				'headerHtmlOptions' => array('style' => 'display: none'),
				'value'=>'Yii::app()->format->formatNumber($data->total_income)',
				'htmlOptions' => array('style' => 'width: 120px; text-align: right; padding-right: 15px;'),
			),  
	      ),
	      //'afterAjaxUpdate' =>'mergeCells',
	      //'selectableRows'=>1,
		  //'selectionChanged'=>'function(id, month){location.href = "'.Yii::app()->createUrl('accomplishments/exportSummary', array('labId'=>$labId, 'month'=>$month)).'"+$.fn.yiiGridView.getSelection(id);}',
	    )); 
?>
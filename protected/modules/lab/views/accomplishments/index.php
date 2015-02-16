<?php
/* @var $this AccomplishmentsController */

$this->breadcrumbs=array(
	'Accomplishments',
);
?>
<?php 
Yii::app()->clientScript->registerScript('accomps', "
	
	$('.accomplishment-form form').submit(function(){
		
		$('#grid-accomplishment').yiiGridView('update', {
			data: $(this).serialize(),
			beforeSend: function(){
				  var overlay = new ItpOverlay('grid-accomplishment');
	        	  overlay.show();
			}
		});
		return false;
	});
	
	mergeCells();
	
	function mergeCells(){
		$('tr.even:nth-child(14) > td:nth-child(2)').attr('colSpan', 2);
		$('tr.even:nth-child(14) > td:nth-child(2)').attr('style', 'text-align:center;');
		$('tr.even:nth-child(14) > td:nth-child(3)').attr('style', 'display:none');
		
		$('tr.even:nth-child(14) > td:nth-child(4)').attr('colSpan', 2);
		$('tr.even:nth-child(14) > td:nth-child(4)').attr('style', 'text-align:center;');
		$('tr.even:nth-child(14) > td:nth-child(5)').attr('style', 'display:none');
		
		$('tr.even:nth-child(14) > td:nth-child(6)').attr('colSpan', 2);
		$('tr.even:nth-child(14) > td:nth-child(6)').attr('style', 'text-align:center;');
		$('tr.even:nth-child(14) > td:nth-child(7)').attr('style', 'display:none');
		
		$('tr.even:nth-child(14) > td:nth-child(8)').attr('colSpan', 2);
		$('tr.even:nth-child(14) > td:nth-child(8)').attr('style', 'text-align:center;');
		$('tr.even:nth-child(14) > td:nth-child(9)').attr('style', 'display:none');
		
		$('tr.even:nth-child(14) > td:nth-child(10)').attr('colSpan', 3);
		$('tr.even:nth-child(14) > td:nth-child(10)').attr('style', 'text-align:center;');
		$('tr.even:nth-child(14) > td:nth-child(11)').attr('style', 'display:none');
		$('tr.even:nth-child(14) > td:nth-child(12)').attr('style', 'display:none');
		
		$('tr.even:nth-child(14)').attr('style', 'font-weight:bold; color:#000080; font-size:125%');
	}
");
?>
<div class="accomplishment-form">
<?php $image=Yii::app()->baseUrl.('/images/ajax-loader.gif');?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<?php	
	echo CHtml::dropDownList('year', $select,	
				CHtml::listData($this->getYear(), 'index', 'year'),
				array(
			   		'onchange'=>'js:{
			   					$(".accomplishment-form form").submit();
								var year = $("#year").val();
								var rstl = '.Yii::app()->Controller->getRstlId().'
			   					$("h3.title").text("RSTL IX "+year+" Summary of Accomplishment");
			   					$("a.export").attr("href","accomplishments/exportConso/year/"+year+"/rstlId/"+rstl);
			   					}',
				)
	);
?>
<?php 
	echo CHtml::dropDownList('lab', $select,	
				Lab::listData(),
				array(
			   		'onchange'=>'js:{
			   					$(".accomplishment-form form").submit()
								var year = $("#year").val();
			   					$("h3.title").text("RSTL IX "+year+" Summary of Accomplishment");
			   					}',
				)
	);
?>
<?php echo ' '.CHtml::link('Export',$this->createUrl('accomplishments/exportConso/',array('year'=>$year, 'rstlId'=>Yii::app()->Controller->getRstlId())), array('class'=>'export'));?>
<?php $this->endWidget(); ?>
</div>		 
<h3 class="title" style="text-align: center; margin-top: -20px; margin-bottom: -20px;"><?php echo 'RSTL IX '.$year.' Summary of Accomplishment';?> </h3>

<?php 
	 $this->widget('zii.widgets.grid.CGridView', array(
	      'id' => 'grid-accomplishment',
	 	  //'htmlOptions' => array('style' => 'width: 80%; align: center;'),
 	      'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
		  'rowHtmlOptionsExpression' => 'array("title" => "Click to update", "class"=>"link-hand")',
	      'dataProvider' => $accomps,
		  'summaryText' => '',
	      'columns' => array(
	        //array('name'=>'month', 'header'=>'Month'),
	        array(
				'name'=>'month',
	        	'headerHtmlOptions' => array('rowspan' => 3),
	        	'header'=>'Month<th colspan="12" class="'.Lab::model()->findByPk($labId)->labCode.'">'.Lab::model()->findByPk($labId)->labName.'</th></tr>',
				'value'=>$data->month,
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'width: 70px; text-align: center;'),
			), 
	        array(
				'name'=>'sampleNSetup',
	        	'headerHtmlOptions' => array('colspan' => 2, 'rowspan' => 2),
	        	'header'=>'Samples<th colspan="2" rowspan="2">Tests</th><th colspan="2" rowspan="2">Customers</th><th colspan="2" rowspan="2" class="income">Income (Actual Fees Collected)</th><th colspan="3" class="value">Value of Assistance</th><th rowspan="3">GROSS</th><tr>',
				'value'=>$data->sampleNSetup,
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'width: 25px; text-align: center;'),
			),
	        //array('name'=>'sampleSetup', 'header'=>'SETUP'),
	        array(
				'name'=>'sampleSetup',
	        	'headerHtmlOptions' => array('colspan' => 2),
	        	'header'=>'GRATIS<th rowspan="2">25%</th></tr>',
				'value'=>$data->sampleSetup,
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'width: 25px; text-align: center;'),
			),
	        //array('name'=>'testNSetup', 'header'=>'NON-SETUP'),
	        array(
				'name'=>'testNSetup',
	        	'header'=>$year.'<th>NON-SETUP</th>',
				'value'=>$data->testNSetup,
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'width: 25px; text-align: center;'),
			),
	        //array('name'=>'testSetup', 'header'=>'SETUP'),
	        array(
				'name'=>'testSetup',
	        	'header'=>'SETUP',
				'value'=>$data->testSetup,
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'width: 25px; text-align: center;'),
			),
	        //array('name'=>'customerNSetup', 'header'=>'NON-SETUP'),
	        array(
				'name'=>'customerNSetup',
	        	'header'=>'NON-SETUP',
				'value'=>$data->customerNSetup,
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'width: 25px; text-align: center;'),
			),
	        //array('name'=>'customerSetup', 'header'=>'SETUP'),
	        array(
				'name'=>'customerSetup',
	        	'header'=>'SETUP',
				'value'=>$data->customerSetup,
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'width: 25px; text-align: center;'),
			),
	        //array('name'=>'incomeNSetup', 'header'=>'NON-SETUP'),
	        array(
				'name'=>'incomeNSetup',
	        	'header'=>'NON-SETUP',
				'value'=>$data[incomeNSetup],
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'width: 75px; text-align: right;'),
			),
	        //array('name'=>'incomeSetup', 'header'=>'SETUP'),
	        array(
				'name'=>'incomeSetup',
	        	'header'=>'SETUP',
				'value'=>$data[incomeSetup],
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'width: 75px; text-align: right;'),
			),
	        //array('name'=>'valueNSetup', 'header'=>'NON-SETUP'),
	        array(
				'name'=>'valueNSetup',
	        	'header'=>'NON-SETUP',
				'value'=>$data[valueNSetup],
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'width: 75px; text-align: right;'),
			),
	        //array('name'=>'valueSetup', 'header'=>'SETUP'),
	        array(
				'name'=>'valueSetup',
	        	'header'=>'SETUP',
				'value'=>$data[valueSetup],
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'width: 75px; text-align: right;'),
			),
	        //array('name'=>'valueNDiscount', 'header'=>'25%'),
	        array(
				'name'=>'valueNDiscount',
	        	'header'=>'NON-SETUP',
				'value'=>$data[valueNDiscount],
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'width: 75px; text-align: right;'),
			),
	        //array('name'=>'gross', 'header'=>'GROSS'),
	        array(
				'name'=>'gross',
	        	'header'=>'SETUP',
				'value'=>$data[gross],
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'width: 80px; text-align: right;'),
			),
	      ),
	      'afterAjaxUpdate' =>'mergeCells',
	      //'selectableRows'=>1,
		  //'selectionChanged'=>'function(id, month){location.href = "'.Yii::app()->createUrl('accomplishments/exportSummary', array('labId'=>$labId, 'month'=>$month)).'"+$.fn.yiiGridView.getSelection(id);}',
	    )); 
?>
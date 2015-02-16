<?php
/*$this->breadcrumbs=array(
	'Receipts'=>array('reportOfCollection'),
	$model->id,
);*/?>
<?php 
Yii::app()->clientScript->registerScript('customs', "
	
	$('.customers-form form').submit(function(){
		
		$('#grid-customer').yiiGridView('update', {
			data: $(this).serialize(),
			beforeSend: function(){
				  var overlay = new ItpOverlay('grid-customer');
	        	  overlay.show();
			}		
		});		
		return false;
	});
	
");
?>

<fieldset class="legend-border" style="margin-bottom:0;">
<legend class="legend-border">Select Year/Month</legend>
<div class="customers-form form wide"> 
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array('style'=>'margin-bottom:0;')
)); ?>
<?php	
	echo CHtml::dropDownList('year', abs($year),	
				CHtml::listData($this->getYear(), 'index', 'year'),
				array(
			   		'onchange'=>'js:{
			   					$(".customers-form form").submit()
			   					var month = $("#month").val();
			   					var monthText = $("#month option:selected").text();
								var year = $("#year").val();
			   					$(".m-y").text(monthText+" "+year);
			   					$("a.btn").attr("href","exportReportOfCollection/year/"+year+"/month/"+month);
			   					}',
				)
	);
?>

<?php	
	echo CHtml::dropDownList('month', abs($month),	
				CHtml::listData($this->getMonth(), 'index', 'month'),
				array(
			   		'onchange'=>'js:{
			   					$(".customers-form form").submit()
			   					var month = $("#month").val();
			   					var monthText = $("#month option:selected").text();
								var year = $("#year").val();
			   					$(".m-y").text(monthText+" "+year);
			   					$("a.btn").attr("href","exportReportOfCollection/year/"+year+"/month/"+month);
			   					}',
				)
	);
?>

<?php echo CHtml::link('<span class="icon-white icon-print export"></span> Print', $this->createUrl('receipt/exportReportOfCollection',array('year'=>$year, 'month'=>$month)), array('class'=>'btn btn-info'));?>
<?php $this->endWidget(); ?>
</div>    
</fieldset>

<div class="cashier-header" style="margin-bottom:-5px;">
<table class="table table-bordered" style="margin-bottom:0;">
<thead style="padding-top:5px;">
	<tr >
    	<th>
			<font size="+3">REPORT OF COLLECTION & DEPOSITS</font><br />
            <font size="+1"><?php echo Yii::app()->params['Office']?Yii::app()->params['Agency']['name']:'Department of Science & Technology';?></font><br />
<?php echo 'For the month of <i class="m-y">'.$monthWord.' '.$year.'</i>';?>
		</th>
	</tr>
</thead>
</table>
</div>
<?php 
	 $this->widget('zii.widgets.grid.CGridView', array(
	      'id' => 'grid-customer',
	 	  'htmlOptions' => array('class'=>'grid-view padding0'),
 	      'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
		  'rowHtmlOptionsExpression' => 'array("title" => "Click to update", "class"=>$data->status["class"])',
	      'dataProvider' => $receiptDataProvider,
		  'summaryText' => '',
	 	  //'rowCssClassExpression'=>'$data->color',
	      'columns' => array(
	        array(
	        	'name'=>'receiptDate', 
	        	'header'=>'DATE',
	        	//'headerHtmlOptions' => array('rowspan' => 2),
	        	'htmlOptions' => array('style' => 'text-align: left; padding-left: 20px;'),
	        	'value'=>'$data->receiptDate',
	        ),
	        array(
	        	'name'=>'receiptId', 
	        	'header'=>'OR NO.',
	        	//'headerHtmlOptions' => array('rowspan' => 2),
	        	'htmlOptions' => array('style' => 'text-align: right; padding-right: 20px;'),
	        	'value'=>'$data->receiptId',
	        ),
	        array(
	        	'name'=>'payor', 
	        	'header'=>'NAME OF PAYOR',
	        	//'headerHtmlOptions' => array('rowspan' => 2),
	        	'htmlOptions' => array('style' => 'text-align: left;'),
	        	'value'=>'$data->payor',
	        ),
	        array(
	        	'name'=>'typeOfCollection', 
	        	'header'=>'NATURE OF COLLECTION',
	        	//'headerHtmlOptions' => array('rowspan' => 2),
	        	'htmlOptions' => array('style' => 'text-align: left;'),
	        	'value'=>'$data->typeOfCollection->natureOfCollection',
	        	'footer'=>'TOTAL',
	        	'footerHtmlOptions' => array('style' => 'text-align: right; font-weight: bold;'),
	        ),
	        array(
	        	'name'=>'treasury', 
	        	'header'=>'COLLECTION<br/>BTR',
	        	//'headerHtmlOptions' => array('rowspan' => 2),
	        	'htmlOptions' => array('style' => 'text-align: right; padding-right: 20px;'),
	        	'value'=>'($data->project == 0) ? Yii::app()->format->formatNumber($data->totalCollection) : "-"',
	        	'footer'=>Yii::app()->format->formatNumber($receipt->getCollectionBtrTotal($year, $month)),
	        	'footerHtmlOptions' => array('style' => 'text-align: right; padding-right: 20px;'),
	        ),
	        array(
	        	'name'=>'project', 
	        	'header'=>'COLLECTION<br/>PROJECT',
	        	//'headerHtmlOptions' => array('rowspan' => 2),
	        	'htmlOptions' => array('style' => 'text-align: right; padding-right: 20px;'),
	        	'value'=>'($data->project == 1) ? Yii::app()->format->formatNumber($data->totalCollection) : "-"',
	        	'footer'=>Yii::app()->format->formatNumber($receipt->getCollectionProjectTotal($year, $month)),
	        	'footerHtmlOptions' => array('style' => 'text-align: right; padding-right: 20px;'),
	        ),
		))); 
?>

<div>Legend: 
<span class="badge badge-danger">Cancelled</span>
<span class="badge">Paid/Collected</span>
</div>
<?php
/* @var $this ReceiptController */
/* @var $model Receipt */
/*
$this->breadcrumbs=array(
	'Receipts'=>array('index'),
	'Manage',
);*/

$this->menu=array(
	array('label'=>'Report of Collection', 'url'=>array('reportOfCollection')),
	array('label'=>'List Receipt', 'url'=>array('index')),
	array('label'=>'Create Receipt', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#receipt-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Receipts</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'receipt-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
	'rowHtmlOptionsExpression' => 'array("title" => "Click to view details", "class"=>$data->status["class"])',
	'selectableRows'=>1,
	'selectionChanged'=>'function(id){location.href = "'.$this->createUrl('receipt/view/id').'/"+$.fn.yiiGridView.getSelection(id);}',
	//'rowCssClassExpression'=>'$data->color',

	'columns'=>array(
		//'id',
		'receiptId',
		'receiptDate',
		array(
			'name'=>'payor',
			'htmlOptions'=>array('style'=>'width:260px;')
			),
		array( 
				'name'=>'total', 
				'value'=>'Yii::app()->format->formatNumber($data->totalCollection)', 
				'htmlOptions' => array('style' => 'text-align: right;'),
		),
		array(
				'name'=>'paymentModeId', 
				'value'=>'$data->paymentMode->mode', 
				'filter'=>Paymentmode::listData(),
		),		
		array(
				'name'=>'collectionType', 
				'value'=>'$data->typeOfCollection->natureOfCollection', 
				'filter'=>Collectiontype::listData(),
		),
		array(
				'name'=>'cancelled', 
				'value'=>'$data->cancelled?"Yes":"No"', 
				'htmlOptions' => array('style' => 'text-align: center;'),
				'filter'=>array('0'=>'No', '1'=>'Yes'),
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{view} {update}',
		),
	),
)); ?>
<div>Legend: 
<span class="badge badge-danger">Cancelled</span>
<span class="badge">Paid/Collected</span>
</div>
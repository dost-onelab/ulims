<?php
/* @var $this OrderofpaymentController */
/* @var $model Orderofpayment */

/*$this->breadcrumbs=array(
	'Orderofpayments'=>array('index'),
	'Manage',
);*/

$this->menu=array(
	array('label'=>'List Orderofpayment', 'url'=>array('index')),
	array('label'=>'Create Orderofpayment', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#orderofpayment-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

?>

<h1>Order of Payments</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
<fieldset class="legend-border">
    <legend class="legend-border">Legend/Status</legend>
    <div style="padding: 0 10px">
    	<span class="icon-check"></span> <font color="#006600">Paid</font>
    </div>
</fieldset>
<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'orderofpayment-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'htmlOptions'=>array('class'=>'grid-view padding0'),
	'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
	'rowHtmlOptionsExpression' => 'array("title" => "Click to view", "class"=>"link-hand")',
	'selectableRows'=>1,
	'selectionChanged'=>'function(id){location.href = "'.$this->createUrl('orderofpayment/view/id').'/"+$.fn.yiiGridView.getSelection(id);}',
	'columns'=>array(
		//'id',
		'transactionNum',
		array(
			'name'=>'natureOfCollection',
			'value'=>'$data->collectiontype->natureOfCollection'
			),
		'date',
		//'customer_id',
		'customerName',
		/*
		'amount',
		'purpose',
		*/
		array(
			//'class'=>'CButtonColumn',
			'header'=>'Status',
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{created}',
			'buttons'=>array(
				'created'=>array(
					'label'=>'<span class="icon-check"></span>',
					'visible'=>'$data->createdReceipt',
					'options'=>array('title'=>''),
				)
			)
		),
	),
)); ?>

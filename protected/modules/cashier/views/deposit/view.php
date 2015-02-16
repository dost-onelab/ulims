<?php
/* @var $this DepositController */
/* @var $model Deposit */

$this->breadcrumbs=array(
	'Deposits'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Cash Receipts Record', 'url'=>array('cashReceiptsRecord')),
	array('label'=>'List Deposit', 'url'=>array('index')),
	array('label'=>'Create Deposit', 'url'=>array('create')),
	array('label'=>'Update Deposit', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Deposit', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Deposit', 'url'=>array('admin')),
);
?>

<h1>View Deposit #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'htmlOptions'=>array('class'=>'detail-view table table-striped table-condensed'),
	'attributes'=>array(
		//'id',
		array(
			'name'=>'depositType',
			'type'=>'raw',
			'value'=>$model->depositType==0?"Bureau of Treasury":"Project",
			),		
		'startOr',
		'endOr',
		'depositDate',
		array(
			'name'=>'amount',
			'type'=>'raw',
			'value'=>Yii::app()->format->formatNumber($model->amount),
		),
	),
)); ?>

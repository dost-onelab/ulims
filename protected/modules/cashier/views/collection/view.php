<?php
/* @var $this CollectionController */
/* @var $model Collection */

$this->menu=array(
	array('label'=>'List Collection', 'url'=>array('index')),
	array('label'=>'Create Collection', 'url'=>array('create')),
	array('label'=>'Update Collection', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Collection', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Collection', 'url'=>array('admin')),
);
?>

<h3>View Collection #<?php echo $model->receipt_id; ?></h3>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'request_id',
		'receipt_id',
		'nature',
		'amount',
		'receiptid',
		'cancelled',
	),
)); ?>

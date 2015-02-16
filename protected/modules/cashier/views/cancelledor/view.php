<?php
/* @var $this CancelledorController */
/* @var $model Cancelledor */

$this->breadcrumbs=array(
	'Cancelledors'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Cancelledor', 'url'=>array('index')),
	array('label'=>'Create Cancelledor', 'url'=>array('create')),
	array('label'=>'Update Cancelledor', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Cancelledor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Cancelledor', 'url'=>array('admin')),
);
?>

<h1>View Cancelledor #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'receiptId',
		'reason',
		'cancelDate',
	),
)); ?>

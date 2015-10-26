<?php
/* @var $this FeeController */
/* @var $model Fee */

$this->breadcrumbs=array(
	'Fees'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Fee', 'url'=>array('index')),
	array('label'=>'Create Fee', 'url'=>array('create')),
	array('label'=>'Update Fee', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Fee', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Fee', 'url'=>array('admin')),
);
?>

<h1>View Fee #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'request_id',
		'details',
		'amount',
	),
)); ?>

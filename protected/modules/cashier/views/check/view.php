<?php
/* @var $this CheckController */
/* @var $model Check */

$this->breadcrumbs=array(
	'Checks'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Check', 'url'=>array('index')),
	array('label'=>'Create Check', 'url'=>array('create')),
	array('label'=>'Update Check', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Check', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Check', 'url'=>array('admin')),
);
?>

<h1>View Check #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'receipt_id',
		'bank',
		'checknumber',
		'checkdate',
		'amount',
	),
)); ?>

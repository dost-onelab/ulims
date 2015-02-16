<?php
/* @var $this RequestcodeController */
/* @var $model Requestcode */

$this->breadcrumbs=array(
	'Requestcodes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Requestcode', 'url'=>array('index')),
	array('label'=>'Create Requestcode', 'url'=>array('create')),
	array('label'=>'Update Requestcode', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Requestcode', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Requestcode', 'url'=>array('admin')),
);
?>

<h1>View Requestcode #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'requestRefNum',
		'rstl_id',
		'labId',
		'number',
		'year',
		'cancelled',
	),
)); ?>

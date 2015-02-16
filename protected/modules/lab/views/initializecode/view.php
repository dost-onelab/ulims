<?php
/* @var $this InitializecodeController */
/* @var $model Initializecode */

$this->breadcrumbs=array(
	'Initializecodes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Initializecode', 'url'=>array('index')),
	array('label'=>'Create Initializecode', 'url'=>array('create')),
	array('label'=>'Update Initializecode', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Initializecode', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Initializecode', 'url'=>array('admin')),
);
?>

<h1>View Initializecode #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'rstl_id',
		'lab_id',
		'codeType',
		'startCode',
		'active',
	),
)); ?>

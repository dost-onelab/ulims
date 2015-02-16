<?php
/* @var $this LastorController */
/* @var $model Lastor */

$this->breadcrumbs=array(
	'Lastors'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Lastor', 'url'=>array('index')),
	array('label'=>'Create Lastor', 'url'=>array('create')),
	array('label'=>'Update Lastor', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Lastor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Lastor', 'url'=>array('admin')),
);
?>

<h1>View Lastor #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'rstl_id',
		'number',
		'display',
	),
)); ?>

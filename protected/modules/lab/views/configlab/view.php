<?php
/* @var $this ConfiglabController */
/* @var $model Configlab */

$this->breadcrumbs=array(
	'Configlabs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Configlab', 'url'=>array('index')),
	array('label'=>'Create Configlab', 'url'=>array('create')),
	array('label'=>'Update Configlab', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Configlab', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Configlab', 'url'=>array('admin')),
);
?>

<h1>View Configlab #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'rstl_id',
		'lab',
	),
)); ?>

<?php
/* @var $this LabmanagerController */
/* @var $model Labmanager */

$this->breadcrumbs=array(
	'Labmanagers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Labmanager', 'url'=>array('index')),
	array('label'=>'Create Labmanager', 'url'=>array('create')),
	array('label'=>'Update Labmanager', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Labmanager', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Labmanager', 'url'=>array('admin')),
);
?>

<h1>View Labmanager #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'lab_id',
		'user_id',
	),
)); ?>

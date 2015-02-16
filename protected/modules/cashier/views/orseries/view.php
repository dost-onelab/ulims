<?php
/* @var $this OrseriesController */
/* @var $model Orseries */

$this->breadcrumbs=array(
	'Orseries'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Orseries', 'url'=>array('index')),
	array('label'=>'Create Orseries', 'url'=>array('create')),
	array('label'=>'Update Orseries', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Orseries', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Orseries', 'url'=>array('admin')),
);
?>

<h1>View Orseries #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'orcategory_id',
		'rstl_id',
		'name',
		'startor',
		'nextor',
		'endor',
		'status',
	),
)); ?>

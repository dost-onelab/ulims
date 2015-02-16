<?php
/* @var $this SampletypeController */
/* @var $model Sampletype */

$this->breadcrumbs=array(
	'Sampletypes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Sampletype', 'url'=>array('index')),
	array('label'=>'Create Sampletype', 'url'=>array('create')),
	array('label'=>'Update Sampletype', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Sampletype', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Sampletype', 'url'=>array('admin')),
);
?>

<h1>View Sampletype #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'sampleType',
		'testCategoryId',
	),
)); ?>

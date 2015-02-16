<?php
/* @var $this OrcategoryController */
/* @var $model Orcategory */

$this->breadcrumbs=array(
	'Orcategories'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Orcategory', 'url'=>array('index')),
	array('label'=>'Create Orcategory', 'url'=>array('create')),
	array('label'=>'Update Orcategory', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Orcategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Orcategory', 'url'=>array('admin')),
);
?>

<h1>View Orcategory #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'code',
	),
)); ?>

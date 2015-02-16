<?php
/* @var $this TestcategoryController */
/* @var $model Testcategory */

$this->breadcrumbs=array(
	'Testcategories'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Testcategory', 'url'=>array('index')),
	array('label'=>'Create Testcategory', 'url'=>array('create')),
	array('label'=>'Update Testcategory', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Testcategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Testcategory', 'url'=>array('admin')),
);
?>

<h1>View Testcategory #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'categoryName',
		'labId',
	),
)); ?>

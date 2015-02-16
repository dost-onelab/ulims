<?php
/* @var $this TestcategoryController */
/* @var $model Testcategory */

$this->breadcrumbs=array(
	'Testcategories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Testcategory', 'url'=>array('index')),
	array('label'=>'Create Testcategory', 'url'=>array('create')),
	array('label'=>'View Testcategory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Testcategory', 'url'=>array('admin')),
);
?>

<h1>Update Testcategory <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
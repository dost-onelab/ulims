<?php
/* @var $this TestcategoryController */
/* @var $model Testcategory */

$this->breadcrumbs=array(
	'Testcategories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Testcategory', 'url'=>array('index')),
	array('label'=>'Manage Testcategory', 'url'=>array('admin')),
);
?>

<h1>Create Testcategory</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
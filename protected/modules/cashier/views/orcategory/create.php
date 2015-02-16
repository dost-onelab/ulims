<?php
/* @var $this OrcategoryController */
/* @var $model Orcategory */

$this->breadcrumbs=array(
	'Orcategories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Orcategory', 'url'=>array('index')),
	array('label'=>'Manage Orcategory', 'url'=>array('admin')),
);
?>

<h1>Create Orcategory</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
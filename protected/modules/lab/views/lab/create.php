<?php
/* @var $this LabController */
/* @var $model Lab */

$this->breadcrumbs=array(
	'Labs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Lab', 'url'=>array('index')),
	array('label'=>'Manage Lab', 'url'=>array('admin')),
);
?>

<h1>Create Lab</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
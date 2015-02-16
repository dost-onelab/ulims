<?php
/* @var $this ConfiglabController */
/* @var $model Configlab */

$this->breadcrumbs=array(
	'Configlabs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Configlab', 'url'=>array('index')),
	array('label'=>'Manage Configlab', 'url'=>array('admin')),
);
?>

<h1>Create Configlab</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
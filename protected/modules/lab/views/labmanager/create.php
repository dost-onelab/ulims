<?php
/* @var $this LabmanagerController */
/* @var $model Labmanager */

$this->breadcrumbs=array(
	'Labmanagers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Labmanager', 'url'=>array('index')),
	array('label'=>'Manage Labmanager', 'url'=>array('admin')),
);
?>

<h1>Create Labmanager</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
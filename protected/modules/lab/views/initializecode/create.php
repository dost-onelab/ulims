<?php
/* @var $this InitializecodeController */
/* @var $model Initializecode */

$this->breadcrumbs=array(
	'Initializecodes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Initializecode', 'url'=>array('index')),
	array('label'=>'Manage Initializecode', 'url'=>array('admin')),
);
?>

<h1>Create Initializecode</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
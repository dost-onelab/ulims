<?php
/* @var $this RequestcodeController */
/* @var $model Requestcode */

$this->breadcrumbs=array(
	'Requestcodes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Requestcode', 'url'=>array('index')),
	array('label'=>'Manage Requestcode', 'url'=>array('admin')),
);
?>

<h1>Initialize Request and Sample Codes</h1>

<?php 
	$this->renderPartial('_form', 
	array(
		'model'=>$model,
		'labs'=>$labs
	)); 
?>
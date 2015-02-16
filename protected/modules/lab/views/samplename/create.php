<?php
/* @var $this SamplenameController */
/* @var $model Samplename */

$this->breadcrumbs=array(
	'Samplenames'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Samplename', 'url'=>array('index')),
	array('label'=>'Manage Sample Templates', 'url'=>array('admin')),
);
?>

<h1>Create Sample Template</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
/* @var $this SampletypeController */
/* @var $model Sampletype */

$this->breadcrumbs=array(
	'Sampletypes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Sampletype', 'url'=>array('index')),
	array('label'=>'Manage Sampletype', 'url'=>array('admin')),
);
?>

<h1>Create Sampletype</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
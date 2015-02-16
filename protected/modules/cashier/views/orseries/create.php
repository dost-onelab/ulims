<?php
/* @var $this OrseriesController */
/* @var $model Orseries */

$this->breadcrumbs=array(
	'Orseries'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Orseries', 'url'=>array('index')),
	array('label'=>'Manage Orseries', 'url'=>array('admin')),
);
?>

<h1>Create Orseries</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
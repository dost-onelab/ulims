<?php
/* @var $this FeeController */
/* @var $model Fee */

$this->breadcrumbs=array(
	'Fees'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Fee', 'url'=>array('index')),
	array('label'=>'Manage Fee', 'url'=>array('admin')),
);
?>

<h1>Create Fee</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
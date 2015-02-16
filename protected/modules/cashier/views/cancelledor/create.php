<?php
/* @var $this CancelledorController */
/* @var $model Cancelledor */

$this->breadcrumbs=array(
	'Cancelledors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Cancelledor', 'url'=>array('index')),
	array('label'=>'Manage Cancelledor', 'url'=>array('admin')),
);
?>

<h1>Create Cancelledor</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
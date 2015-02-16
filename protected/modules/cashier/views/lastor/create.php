<?php
/* @var $this LastorController */
/* @var $model Lastor */

$this->breadcrumbs=array(
	'Lastors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Lastor', 'url'=>array('index')),
	array('label'=>'Manage Lastor', 'url'=>array('admin')),
);
?>

<h1>Initialize Receipt</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
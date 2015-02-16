<?php
/* @var $this PaymentitemController */
/* @var $model Paymentitem */

$this->breadcrumbs=array(
	'Paymentitems'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Paymentitem', 'url'=>array('index')),
	array('label'=>'Manage Paymentitem', 'url'=>array('admin')),
);
?>

<h1>Create Paymentitem</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
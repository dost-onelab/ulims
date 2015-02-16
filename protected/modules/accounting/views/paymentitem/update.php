<?php
/* @var $this PaymentitemController */
/* @var $model Paymentitem */

$this->breadcrumbs=array(
	'Paymentitems'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Paymentitem', 'url'=>array('index')),
	array('label'=>'Create Paymentitem', 'url'=>array('create')),
	array('label'=>'View Paymentitem', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Paymentitem', 'url'=>array('admin')),
);
?>

<h1>Update Paymentitem <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
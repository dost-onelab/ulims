<?php
/* @var $this PaymentitemController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Paymentitems',
);

$this->menu=array(
	array('label'=>'Create Paymentitem', 'url'=>array('create')),
	array('label'=>'Manage Paymentitem', 'url'=>array('admin')),
);
?>

<h1>Paymentitems</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

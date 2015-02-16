<?php
/* @var $this OrderofpaymentController */
/* @var $model Orderofpayment */

$this->breadcrumbs=array(
	'Orderofpayments'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Orderofpayment', 'url'=>array('index')),
	array('label'=>'Manage Orderofpayment', 'url'=>array('admin')),
);
?>

<h1>Create Order of Payment</h1>

<?php $this->renderPartial('_form', array(
		'model'=>$model,
		'customertypes'=>$customertypes,
		'customers'=>$customers,
		'gridDataProvider'=>$gridDataProvider
)); 
?>
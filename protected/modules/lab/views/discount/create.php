<?php
/* @var $this DiscountController */
/* @var $model Discount */

$this->breadcrumbs=array(
	'Discounts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Discount', 'url'=>array('index')),
	array('label'=>'Manage Discount', 'url'=>array('admin')),
);
?>

<h1>Create Discount</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
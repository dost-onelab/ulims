<?php
/* @var $this DiscountController */
/* @var $model Discount */

$this->breadcrumbs=array(
	'Discounts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Discount', 'url'=>array('index')),
	array('label'=>'Create Discount', 'url'=>array('create')),
	array('label'=>'View Discount', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Discount', 'url'=>array('admin')),
);
?>

<h1>Update Discount <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
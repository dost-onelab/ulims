<?php
/* @var $this DiscountController */
/* @var $model Discount */

$this->breadcrumbs=array(
	'Discounts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Discount', 'url'=>array('index')),
	array('label'=>'Create Discount', 'url'=>array('create')),
	array('label'=>'Update Discount', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Discount', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Discount', 'url'=>array('admin')),
);
?>

<h1>View Discount #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'type',
		'rate',
		'status',
	),
)); ?>

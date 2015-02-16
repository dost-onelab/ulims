<?php
/* @var $this OrderofpaymentController */
/* @var $model Orderofpayment */

$this->breadcrumbs=array(
	'Orderofpayments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Orderofpayment', 'url'=>array('index')),
	array('label'=>'Create Orderofpayment', 'url'=>array('create')),
	array('label'=>'View Orderofpayment', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Orderofpayment', 'url'=>array('admin')),
);
?>

<h1>Update Orderofpayment <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
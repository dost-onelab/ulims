<?php
/* @var $this BankaccountController */
/* @var $model Bankaccount */

$this->breadcrumbs=array(
	'Bankaccounts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Bankaccount', 'url'=>array('index')),
	array('label'=>'Create Bankaccount', 'url'=>array('create')),
	array('label'=>'View Bankaccount', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Bankaccount', 'url'=>array('admin')),
);
?>

<h1>Update Bankaccount <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
/* @var $this BankaccountController */
/* @var $model Bankaccount */

$this->breadcrumbs=array(
	'Bankaccounts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Bankaccount', 'url'=>array('index')),
	array('label'=>'Create Bankaccount', 'url'=>array('create')),
	array('label'=>'Update Bankaccount', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Bankaccount', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Bankaccount', 'url'=>array('admin')),
);
?>

<h1>View Bankaccount #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'bankName',
		'accountNumber',
	),
)); ?>

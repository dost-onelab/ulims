<?php
/* @var $this DepositController */
/* @var $model Deposit */

$this->breadcrumbs=array(
	'Deposits'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Cash Receipts Record', 'url'=>array('cashReceiptsRecord')),
	array('label'=>'List Deposit', 'url'=>array('index')),
	array('label'=>'Manage Deposit', 'url'=>array('admin')),
);
?>

<h1>Create Deposit</h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'depositType'=>$depositType)); ?>
<?php
/* @var $this BankaccountController */
/* @var $model Bankaccount */

$this->breadcrumbs=array(
	'Bankaccounts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Bankaccount', 'url'=>array('index')),
	array('label'=>'Manage Bankaccount', 'url'=>array('admin')),
);
?>

<h1>Create Bankaccount</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
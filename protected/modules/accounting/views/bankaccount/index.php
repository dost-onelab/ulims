<?php
/* @var $this BankaccountController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Bankaccounts',
);

$this->menu=array(
	array('label'=>'Create Bankaccount', 'url'=>array('create')),
	array('label'=>'Manage Bankaccount', 'url'=>array('admin')),
);
?>

<h1>Bankaccounts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

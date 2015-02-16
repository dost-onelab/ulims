<?php
/* @var $this OrderofpaymentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Orderofpayments',
);

$this->menu=array(
	//array('label'=>'Create Orderofpayment', 'url'=>array('create')),
	array('label'=>'Manage Orderofpayment', 'url'=>array('admin')),
);
?>

<h1>Orderofpayments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

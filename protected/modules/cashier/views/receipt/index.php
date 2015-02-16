<?php
/* @var $this ReceiptController */
/* @var $dataProvider CActiveDataProvider */
/*
$this->breadcrumbs=array(
	'Receipts',
);*/

$this->menu=array(
	array('label'=>'Report of Collection', 'url'=>array('reportOfCollection')),
	array('label'=>'Create Receipt', 'url'=>array('create')),
	array('label'=>'Manage Receipt', 'url'=>array('admin')),
);
?>

<h1>Receipts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php
/* @var $this FeeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Fees',
);

$this->menu=array(
	array('label'=>'Create Fee', 'url'=>array('create')),
	array('label'=>'Manage Fee', 'url'=>array('admin')),
);
?>

<h1>Fees</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

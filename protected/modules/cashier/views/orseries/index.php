<?php
/* @var $this OrseriesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Orseries',
);

$this->menu=array(
	array('label'=>'Create Orseries', 'url'=>array('create')),
	array('label'=>'Manage Orseries', 'url'=>array('admin')),
);
?>

<h1>Orseries</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

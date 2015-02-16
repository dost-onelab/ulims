<?php
/* @var $this ReportcashierController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Reportcashiers',
);

$this->menu=array(
	array('label'=>'Create Reportcashier', 'url'=>array('create')),
	array('label'=>'Manage Reportcashier', 'url'=>array('admin')),
);
?>

<h1>Reportcashiers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

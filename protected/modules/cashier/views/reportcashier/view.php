<?php
/* @var $this ReportcashierController */
/* @var $model Reportcashier */

$this->breadcrumbs=array(
	'Reportcashiers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Reportcashier', 'url'=>array('index')),
	array('label'=>'Create Reportcashier', 'url'=>array('create')),
	array('label'=>'Update Reportcashier', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Reportcashier', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Reportcashier', 'url'=>array('admin')),
);
?>

<h1>View Reportcashier #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'date',
		'receiptId',
		'payor',
		'collectionType',
		'collectionBtr',
		'collectionProject',
		'cancelled',
	),
)); ?>

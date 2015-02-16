<?php
/* @var $this CancelledrequestController */
/* @var $model Cancelledrequest */

$this->breadcrumbs=array(
	'Cancelledrequests'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Cancelledrequest', 'url'=>array('index')),
	array('label'=>'Create Cancelledrequest', 'url'=>array('create')),
	array('label'=>'Update Cancelledrequest', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Cancelledrequest', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Cancelledrequest', 'url'=>array('admin')),
);
?>

<h1>View Cancelledrequest #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'request_id',
		'requestRefNum',
		'reason',
		'cancelDate',
		'cancelledBy',
	),
)); ?>

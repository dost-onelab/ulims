<?php
/* @var $this LabServiceController */
/* @var $model LabService */

$this->breadcrumbs=array(
	'Lab Services'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List LabService', 'url'=>array('index')),
	array('label'=>'Create LabService', 'url'=>array('create')),
	array('label'=>'Update LabService', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete LabService', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage LabService', 'url'=>array('admin')),
);
?>

<h1>View LabService #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'lab_id',
		'labName',
		'sampleType_id',
		'type',
		'testName_id',
		'testName',
		'methodreference_id',
		'method',
		'reference',
		'fee',
		'agency_id',
	),
)); ?>

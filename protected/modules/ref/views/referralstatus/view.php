<?php
/* @var $this ReferralstatusController */
/* @var $model Referralstatus */

$this->breadcrumbs=array(
	'Referralstatuses'=>array('index'),
	$model->referral_id,
);

$this->menu=array(
	array('label'=>'List Referralstatus', 'url'=>array('index')),
	array('label'=>'Create Referralstatus', 'url'=>array('create')),
	array('label'=>'Update Referralstatus', 'url'=>array('update', 'id'=>$model->referral_id)),
	array('label'=>'Delete Referralstatus', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->referral_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Referralstatus', 'url'=>array('admin')),
);
?>

<h1>View Referralstatus #<?php echo $model->referral_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'referral_id',
		'sampleArrivalDate',
		'shipmentDetails',
		'status_id',
	),
)); ?>

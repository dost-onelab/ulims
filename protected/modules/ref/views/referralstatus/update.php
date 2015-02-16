<?php
/* @var $this ReferralstatusController */
/* @var $model Referralstatus */

$this->breadcrumbs=array(
	'Referralstatuses'=>array('index'),
	$model->referral_id=>array('view','id'=>$model->referral_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Referralstatus', 'url'=>array('index')),
	array('label'=>'Create Referralstatus', 'url'=>array('create')),
	array('label'=>'View Referralstatus', 'url'=>array('view', 'id'=>$model->referral_id)),
	array('label'=>'Manage Referralstatus', 'url'=>array('admin')),
);
?>

<h1>Update Referralstatus <?php echo $model->referral_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
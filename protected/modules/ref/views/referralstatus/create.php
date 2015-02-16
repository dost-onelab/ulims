<?php
/* @var $this ReferralstatusController */
/* @var $model Referralstatus */

$this->breadcrumbs=array(
	'Referralstatuses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Referralstatus', 'url'=>array('index')),
	array('label'=>'Manage Referralstatus', 'url'=>array('admin')),
);
?>

<h1>Create Referralstatus</h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'referral_id'=>$referral_id, 'acceptingAgencyId'=>$acceptingAgencyId)); ?>
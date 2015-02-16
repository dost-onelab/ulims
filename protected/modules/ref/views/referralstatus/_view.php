<?php
/* @var $this ReferralstatusController */
/* @var $data Referralstatus */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('referral_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->referral_id), array('view', 'id'=>$data->referral_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sampleArrivalDate')); ?>:</b>
	<?php echo CHtml::encode($data->sampleArrivalDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shipmentDetails')); ?>:</b>
	<?php echo CHtml::encode($data->shipmentDetails); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_id')); ?>:</b>
	<?php echo CHtml::encode($data->status_id); ?>
	<br />


</div>
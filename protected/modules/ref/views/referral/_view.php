<?php
/* @var $this ReferralController */
/* @var $data Referral */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('referralCode')); ?>:</b>
	<?php echo CHtml::encode($data->referralCode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('referralDate')); ?>:</b>
	<?php echo CHtml::encode($data->referralDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('receivingAgencyId')); ?>:</b>
	<?php echo CHtml::encode($data->receivingAgencyId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('acceptingAgencyId')); ?>:</b>
	<?php echo CHtml::encode($data->acceptingAgencyId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lab_id')); ?>:</b>
	<?php echo CHtml::encode($data->lab_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customer_id')); ?>:</b>
	<?php echo CHtml::encode($data->customer_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('paymentType_id')); ?>:</b>
	<?php echo CHtml::encode($data->paymentType_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('discount_id')); ?>:</b>
	<?php echo CHtml::encode($data->discount_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reportDue')); ?>:</b>
	<?php echo CHtml::encode($data->reportDue); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('conforme')); ?>:</b>
	<?php echo CHtml::encode($data->conforme); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('receivedBy')); ?>:</b>
	<?php echo CHtml::encode($data->receivedBy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cancelled')); ?>:</b>
	<?php echo CHtml::encode($data->cancelled); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
	<?php echo CHtml::encode($data->update_time); ?>
	<br />

	*/ ?>

</div>
<?php
/* @var $this SampleController */
/* @var $data Sample */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('referral_id')); ?>:</b>
	<?php echo CHtml::encode($data->referral_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sampleType_id')); ?>:</b>
	<?php echo CHtml::encode($data->sampleType_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('barcode')); ?>:</b>
	<?php echo CHtml::encode($data->barcode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sampleName')); ?>:</b>
	<?php echo CHtml::encode($data->sampleName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sampleCode')); ?>:</b>
	<?php echo CHtml::encode($data->sampleCode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('status_id')); ?>:</b>
	<?php echo CHtml::encode($data->status_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
	<?php echo CHtml::encode($data->update_time); ?>
	<br />

	*/ ?>

</div>
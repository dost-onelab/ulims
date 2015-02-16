<?php
/* @var $this LabServiceController */
/* @var $data LabService */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lab_id')); ?>:</b>
	<?php echo CHtml::encode($data->lab_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('labName')); ?>:</b>
	<?php echo CHtml::encode($data->labName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sampleType_id')); ?>:</b>
	<?php echo CHtml::encode($data->sampleType_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('testName_id')); ?>:</b>
	<?php echo CHtml::encode($data->testName_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('testName')); ?>:</b>
	<?php echo CHtml::encode($data->testName); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('methodreference_id')); ?>:</b>
	<?php echo CHtml::encode($data->methodreference_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('method')); ?>:</b>
	<?php echo CHtml::encode($data->method); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reference')); ?>:</b>
	<?php echo CHtml::encode($data->reference); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fee')); ?>:</b>
	<?php echo CHtml::encode($data->fee); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agency_id')); ?>:</b>
	<?php echo CHtml::encode($data->agency_id); ?>
	<br />

	*/ ?>

</div>
<?php
/* @var $this SampleController */
/* @var $data Sample */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sampleCode')); ?>:</b>
	<?php echo CHtml::encode($data->sampleCode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sampleName')); ?>:</b>
	<?php echo CHtml::encode($data->sampleName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remarks')); ?>:</b>
	<?php echo CHtml::encode($data->remarks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('requestId')); ?>:</b>
	<?php echo CHtml::encode($data->requestId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('request_id')); ?>:</b>
	<?php echo CHtml::encode($data->request_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('sampleMonth')); ?>:</b>
	<?php echo CHtml::encode($data->sampleMonth); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sampleYear')); ?>:</b>
	<?php echo CHtml::encode($data->sampleYear); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cancelled')); ?>:</b>
	<?php echo CHtml::encode($data->cancelled); ?>
	<br />

	*/ ?>

</div>
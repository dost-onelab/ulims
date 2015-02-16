<?php
/* @var $this AnalysisController */
/* @var $data Analysis */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('requestId')); ?>:</b>
	<?php echo CHtml::encode($data->requestId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sample_id')); ?>:</b>
	<?php echo CHtml::encode($data->sample_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sampleCode')); ?>:</b>
	<?php echo CHtml::encode($data->sampleCode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('testName')); ?>:</b>
	<?php echo CHtml::encode($data->testName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('method')); ?>:</b>
	<?php echo CHtml::encode($data->method); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('references')); ?>:</b>
	<?php echo CHtml::encode($data->references); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('quantity')); ?>:</b>
	<?php echo CHtml::encode($data->quantity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fee')); ?>:</b>
	<?php echo CHtml::encode($data->fee); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('testId')); ?>:</b>
	<?php echo CHtml::encode($data->testId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('analysisMonth')); ?>:</b>
	<?php echo CHtml::encode($data->analysisMonth); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('analysisYear')); ?>:</b>
	<?php echo CHtml::encode($data->analysisYear); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cancelled')); ?>:</b>
	<?php echo CHtml::encode($data->cancelled); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deleted')); ?>:</b>
	<?php echo CHtml::encode($data->deleted); ?>
	<br />

	*/ ?>

</div>
<?php
/* @var $this RequestcodeController */
/* @var $data Requestcode */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('requestRefNum')); ?>:</b>
	<?php echo CHtml::encode($data->requestRefNum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rstl_id')); ?>:</b>
	<?php echo CHtml::encode($data->rstl_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('labId')); ?>:</b>
	<?php echo CHtml::encode($data->labId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('number')); ?>:</b>
	<?php echo CHtml::encode($data->number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('year')); ?>:</b>
	<?php echo CHtml::encode($data->year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cancelled')); ?>:</b>
	<?php echo CHtml::encode($data->cancelled); ?>
	<br />


</div>
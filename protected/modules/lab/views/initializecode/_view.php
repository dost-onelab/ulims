<?php
/* @var $this InitializecodeController */
/* @var $data Initializecode */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rstl_id')); ?>:</b>
	<?php echo CHtml::encode($data->rstl_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lab_id')); ?>:</b>
	<?php echo CHtml::encode($data->lab_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codeType')); ?>:</b>
	<?php echo CHtml::encode($data->codeType); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('startCode')); ?>:</b>
	<?php echo CHtml::encode($data->startCode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />


</div>
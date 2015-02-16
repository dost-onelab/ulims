<?php
/* @var $this LabController */
/* @var $data Lab */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('labName')); ?>:</b>
	<?php echo CHtml::encode($data->labName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('labCode')); ?>:</b>
	<?php echo CHtml::encode($data->labCode); ?>
	<br />


</div>
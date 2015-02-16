<?php
/* @var $this OrseriesController */
/* @var $data Orseries */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('orcategory_id')); ?>:</b>
	<?php echo CHtml::encode($data->orcategory_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rstl_id')); ?>:</b>
	<?php echo CHtml::encode($data->rstl_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />
    
	<b><?php echo CHtml::encode($data->getAttributeLabel('startor')); ?>:</b>
	<?php echo CHtml::encode($data->startor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nextor')); ?>:</b>
	<?php echo CHtml::encode($data->nextor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('endor')); ?>:</b>
	<?php echo CHtml::encode($data->endor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>
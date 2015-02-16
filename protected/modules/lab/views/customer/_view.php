<?php
/* @var $this CustomerController */
/* @var $data Customer */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customerName')); ?>:</b>
	<?php echo CHtml::encode($data->customerName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('head')); ?>:</b>
	<?php echo CHtml::encode($data->head); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tel')); ?>:</b>
	<?php echo CHtml::encode($data->tel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fax')); ?>:</b>
	<?php echo CHtml::encode($data->fax); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('typeId')); ?>:</b>
	<?php echo CHtml::encode($data->typeId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('natureId')); ?>:</b>
	<?php echo CHtml::encode($data->natureId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('industryId')); ?>:</b>
	<?php echo CHtml::encode($data->industryId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	*/ ?>

</div>
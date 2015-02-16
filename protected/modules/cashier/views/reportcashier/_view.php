<?php
/* @var $this ReportcashierController */
/* @var $data Reportcashier */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('receiptId')); ?>:</b>
	<?php echo CHtml::encode($data->receiptId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payor')); ?>:</b>
	<?php echo CHtml::encode($data->payor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('collectionType')); ?>:</b>
	<?php echo CHtml::encode($data->collectionType); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('collectionBtr')); ?>:</b>
	<?php echo CHtml::encode($data->collectionBtr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('collectionProject')); ?>:</b>
	<?php echo CHtml::encode($data->collectionProject); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('cancelled')); ?>:</b>
	<?php echo CHtml::encode($data->cancelled); ?>
	<br />

	*/ ?>

</div>
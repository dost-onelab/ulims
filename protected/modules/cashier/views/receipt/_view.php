<?php
/* @var $this ReceiptController */
/* @var $data Receipt */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('receiptId')); ?>:</b>
	<?php echo CHtml::encode($data->receiptId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('receiptDate')); ?>:</b>
	<?php echo CHtml::encode($data->receiptDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paymentModeId')); ?>:</b>
	<?php echo CHtml::encode($data->paymentModeId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payor')); ?>:</b>
	<?php echo CHtml::encode($data->payor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('collectionType')); ?>:</b>
	<?php echo CHtml::encode($data->collectionType); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bank')); ?>:</b>
	<?php echo CHtml::encode($data->bank); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('check_money_number')); ?>:</b>
	<?php echo CHtml::encode($data->check_money_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('checkdate')); ?>:</b>
	<?php echo CHtml::encode($data->checkdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total')); ?>:</b>
	<?php echo CHtml::encode($data->total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project')); ?>:</b>
	<?php echo CHtml::encode($data->project); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cancelled')); ?>:</b>
	<?php echo CHtml::encode($data->cancelled); ?>
	<br />

	*/ ?>

</div>
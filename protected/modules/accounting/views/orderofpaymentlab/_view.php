<?php
/* @var $this OrderofpaymentController */
/* @var $data Orderofpayment */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rstl_id')); ?>:</b>
	<?php echo CHtml::encode($data->rstl_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transactionNum')); ?>:</b>
	<?php echo CHtml::encode($data->transactionNum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('collectiontype_id')); ?>:</b>
	<?php echo CHtml::encode($data->collectiontype_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customer_id')); ?>:</b>
	<?php echo CHtml::encode($data->customer_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customerName')); ?>:</b>
	<?php echo CHtml::encode($data->customerName); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('purpose')); ?>:</b>
	<?php echo CHtml::encode($data->purpose); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createdReceipt')); ?>:</b>
	<?php echo CHtml::encode($data->createdReceipt); ?>
	<br />

	*/ ?>

</div>
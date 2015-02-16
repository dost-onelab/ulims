<?php
/* @var $this RequestController */
/* @var $data Request */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('requestRefNum')); ?>:</b>
	<?php echo CHtml::encode($data->requestRefNum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('requestId')); ?>:</b>
	<?php echo CHtml::encode($data->requestId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('requestDate')); ?>:</b>
	<?php echo CHtml::encode($data->requestDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('requestTime')); ?>:</b>
	<?php echo CHtml::encode($data->requestTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('labId')); ?>:</b>
	<?php echo CHtml::encode($data->labId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customerId')); ?>:</b>
	<?php echo CHtml::encode($data->customerId); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('paymentType')); ?>:</b>
	<?php echo CHtml::encode($data->paymentType); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('discount')); ?>:</b>
	<?php echo CHtml::encode($data->discount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('orId')); ?>:</b>
	<?php echo CHtml::encode($data->orId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total')); ?>:</b>
	<?php echo CHtml::encode($data->total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reportDue')); ?>:</b>
	<?php echo CHtml::encode($data->reportDue); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('conforme')); ?>:</b>
	<?php echo CHtml::encode($data->conforme); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('receivedBy')); ?>:</b>
	<?php echo CHtml::encode($data->receivedBy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cancelled')); ?>:</b>
	<?php echo CHtml::encode($data->cancelled); ?>
	<br />

	*/ ?>

</div>
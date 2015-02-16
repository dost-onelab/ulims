<?php
/* @var $this CancelledorController */
/* @var $data Cancelledor */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('receiptId')); ?>:</b>
	<?php echo CHtml::encode($data->receiptId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reason')); ?>:</b>
	<?php echo CHtml::encode($data->reason); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cancelDate')); ?>:</b>
	<?php echo CHtml::encode($data->cancelDate); ?>
	<br />


</div>
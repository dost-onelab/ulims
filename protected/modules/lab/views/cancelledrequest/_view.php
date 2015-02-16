<?php
/* @var $this CancelledrequestController */
/* @var $data Cancelledrequest */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('request_id')); ?>:</b>
	<?php echo CHtml::encode($data->request_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('requestRefNum')); ?>:</b>
	<?php echo CHtml::encode($data->requestRefNum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reason')); ?>:</b>
	<?php echo CHtml::encode($data->reason); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cancelDate')); ?>:</b>
	<?php echo CHtml::encode($data->cancelDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cancelledBy')); ?>:</b>
	<?php echo CHtml::encode($data->cancelledBy); ?>
	<br />


</div>
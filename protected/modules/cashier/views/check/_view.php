<?php
/* @var $this CheckController */
/* @var $data Check */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('receipt_id')); ?>:</b>
	<?php echo CHtml::encode($data->receipt_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bank')); ?>:</b>
	<?php echo CHtml::encode($data->bank); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('checknumber')); ?>:</b>
	<?php echo CHtml::encode($data->checknumber); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('checkdate')); ?>:</b>
	<?php echo CHtml::encode($data->checkdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />


</div>
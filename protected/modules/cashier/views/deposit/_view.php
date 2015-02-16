<?php
/* @var $this DepositController */
/* @var $data Deposit */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('startOr')); ?>:</b>
	<?php echo CHtml::encode($data->startOr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('endOr')); ?>:</b>
	<?php echo CHtml::encode($data->endOr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('depositDate')); ?>:</b>
	<?php echo CHtml::encode($data->depositDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('depositType')); ?>:</b>
	<?php echo CHtml::encode($data->depositType); ?>
	<br />


</div>
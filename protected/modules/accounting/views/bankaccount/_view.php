<?php
/* @var $this BankaccountController */
/* @var $data Bankaccount */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bankName')); ?>:</b>
	<?php echo CHtml::encode($data->bankName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('accountNumber')); ?>:</b>
	<?php echo CHtml::encode($data->accountNumber); ?>
	<br />


</div>
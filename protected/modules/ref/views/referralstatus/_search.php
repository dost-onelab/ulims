<?php
/* @var $this ReferralstatusController */
/* @var $model Referralstatus */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'referral_id'); ?>
		<?php echo $form->textField($model,'referral_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sampleArrivalDate'); ?>
		<?php echo $form->textField($model,'sampleArrivalDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'shipmentDetails'); ?>
		<?php echo $form->textArea($model,'shipmentDetails',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status_id'); ?>
		<?php echo $form->textField($model,'status_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
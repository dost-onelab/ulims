<?php
/* @var $this ReferralController */
/* @var $model Referral */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'referralCode'); ?>
		<?php echo $form->textField($model,'referralCode',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'referralDate'); ?>
		<?php echo $form->textField($model,'referralDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'receivingAgencyId'); ?>
		<?php echo $form->textField($model,'receivingAgencyId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'acceptingAgencyId'); ?>
		<?php echo $form->textField($model,'acceptingAgencyId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lab_id'); ?>
		<?php echo $form->textField($model,'lab_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'customer_id'); ?>
		<?php echo $form->textField($model,'customer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'paymentType_id'); ?>
		<?php echo $form->textField($model,'paymentType_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'discount_id'); ?>
		<?php echo $form->textField($model,'discount_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reportDue'); ?>
		<?php echo $form->textField($model,'reportDue'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'conforme'); ?>
		<?php echo $form->textField($model,'conforme',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'receivedBy'); ?>
		<?php echo $form->textField($model,'receivedBy',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cancelled'); ?>
		<?php echo $form->textField($model,'cancelled'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_time'); ?>
		<?php echo $form->textField($model,'create_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'update_time'); ?>
		<?php echo $form->textField($model,'update_time'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
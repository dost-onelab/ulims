<?php
/* @var $this BankaccountController */
/* @var $model Bankaccount */
/* @var $form CActiveForm */
Yii::app()->clientscript->scriptMap['jquery.js'] = false;
Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bankaccount-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->hiddenField($model,'id')?>
	<div class="row">
		<?php echo $form->labelEx($model,'bankName'); ?>
		<?php echo $form->textField($model,'bankName',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'bankName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'accountNumber'); ?>
		<?php echo $form->textField($model,'accountNumber',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'accountNumber'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-info')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
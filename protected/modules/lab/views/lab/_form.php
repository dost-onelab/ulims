<?php
/* @var $this LabController */
/* @var $model Lab */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lab-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'labName'); ?>
		<?php echo $form->textField($model,'labName',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'labName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'labCode'); ?>
		<?php echo $form->textField($model,'labCode',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'labCode'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
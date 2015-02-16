<?php
/* @var $this InitializecodeController */
/* @var $model Initializecode */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'initializecode-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'rstl_id'); ?>
		<?php echo $form->textField($model,'rstl_id'); ?>
		<?php echo $form->error($model,'rstl_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lab_id'); ?>
		<?php echo $form->textField($model,'lab_id'); ?>
		<?php echo $form->error($model,'lab_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'codeType'); ?>
		<?php echo $form->textField($model,'codeType'); ?>
		<?php echo $form->error($model,'codeType'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'startCode'); ?>
		<?php echo $form->textField($model,'startCode'); ?>
		<?php echo $form->error($model,'startCode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->textField($model,'active'); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php
/* @var $this ReportcashierController */
/* @var $model Reportcashier */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reportcashier-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'receiptId'); ?>
		<?php echo $form->textField($model,'receiptId'); ?>
		<?php echo $form->error($model,'receiptId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'payor'); ?>
		<?php echo $form->textField($model,'payor',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'payor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'collectionType'); ?>
		<?php echo $form->textField($model,'collectionType'); ?>
		<?php echo $form->error($model,'collectionType'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'collectionBtr'); ?>
		<?php echo $form->textField($model,'collectionBtr'); ?>
		<?php echo $form->error($model,'collectionBtr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'collectionProject'); ?>
		<?php echo $form->textField($model,'collectionProject'); ?>
		<?php echo $form->error($model,'collectionProject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cancelled'); ?>
		<?php echo $form->textField($model,'cancelled'); ?>
		<?php echo $form->error($model,'cancelled'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
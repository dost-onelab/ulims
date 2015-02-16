<?php
/* @var $this LabServiceController */
/* @var $model LabService */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lab-service-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'lab_id'); ?>
		<?php echo $form->textField($model,'lab_id'); ?>
		<?php echo $form->error($model,'lab_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'labName'); ?>
		<?php echo $form->textField($model,'labName',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'labName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sampleType_id'); ?>
		<?php echo $form->textField($model,'sampleType_id'); ?>
		<?php echo $form->error($model,'sampleType_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'testName_id'); ?>
		<?php echo $form->textField($model,'testName_id'); ?>
		<?php echo $form->error($model,'testName_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'testName'); ?>
		<?php echo $form->textField($model,'testName',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'testName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'methodreference_id'); ?>
		<?php echo $form->textField($model,'methodreference_id'); ?>
		<?php echo $form->error($model,'methodreference_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'method'); ?>
		<?php echo $form->textField($model,'method',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'method'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reference'); ?>
		<?php echo $form->textField($model,'reference',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'reference'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fee'); ?>
		<?php echo $form->textField($model,'fee'); ?>
		<?php echo $form->error($model,'fee'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'agency_id'); ?>
		<?php echo $form->textField($model,'agency_id'); ?>
		<?php echo $form->error($model,'agency_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
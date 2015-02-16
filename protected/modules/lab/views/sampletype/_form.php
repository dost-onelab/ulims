<?php
/* @var $this SampletypeController */
/* @var $model Sampletype */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sampletype-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'testCategoryId'); ?>
		<?php echo $form->dropDownList($model,'testCategoryId', Testcategory::listData()); ?>
		<?php echo $form->error($model,'testCategoryId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sampleType'); ?>
		<?php echo $form->textField($model,'sampleType',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'sampleType'); ?>
	</div>



	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
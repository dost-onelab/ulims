<?php
/* @var $this TestcategoryController */
/* @var $model Testcategory */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'testcategory-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'labId'); ?>
		<?php echo $form->dropDownList($model,'labId', Initializecode::listLabName()); ?>
		<?php echo $form->error($model,'labId'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'categoryName'); ?>
		<?php echo $form->textField($model,'categoryName',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'categoryName'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-info')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
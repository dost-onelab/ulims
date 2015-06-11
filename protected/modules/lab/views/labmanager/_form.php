<?php
/* @var $this LabmanagerController */
/* @var $model Labmanager */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'labmanager-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->hiddenField($model,'id'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'lab_id'); ?>
		<?php //echo $form->textField($model,'lab_id'); ?>
		<?php echo $form->dropDownList($model,'lab_id', Initializecode::listLabName(), array('style'=>'width: 300px;', 'readonly'=>true)); ?>
		<?php echo $form->error($model,'lab_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->dropDownList($model,'user_id', Users::listData(), array('style'=>'width: 300px;')); ?>
		<?php //echo $form->dropDownList($model,'lab_id', CHtml::listData(Profile::model()->active()->findAll(), 'user_id', 'fullName'), array('style'=>'width: 300px;')); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
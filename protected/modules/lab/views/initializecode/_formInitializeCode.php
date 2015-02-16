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
		<?php //echo $form->labelEx($model,'rstl_id'); ?>
		<?php echo $form->hiddenField($model,'rstl_id', array('value'=>Yii::app()->Controller->getRstlId())); ?>
		<?php //echo $form->error($model,'rstl_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'codeType'); ?>
		<?php //echo $form->dropDownList($model,'codeType', Initializecode::listCodeType(), array('disabled'=>true)); ?>
		<?php //echo $form->error($model,'codeType'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lab_id'); ?>
		<?php echo $form->dropDownList($model,'lab_id', Lab::listData(), array('readonly'=>true)); ?>
		<?php echo $form->error($model,'lab_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'startCodeRequest'); ?>
		<?php echo $form->textField($model,'startCode[]'); ?>
		<?php echo $form->error($model,'startCodeRequest'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'startCodeSample'); ?>
		<?php echo $form->textField($model,'startCode[]'); ?>
		<?php echo $form->error($model,'startCodeSample'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'active'); ?>
		<?php //echo $form->textField($model,'active', array('value'=>1, 'disabled'=>true)); ?>
		<?php //echo $form->error($model,'active'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
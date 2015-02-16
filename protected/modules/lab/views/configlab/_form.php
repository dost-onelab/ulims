<?php
/* @var $this ConfiglabController */
/* @var $model Configlab */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'configlab-form',
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
		<?php echo $form->hiddenField($model,'rstl_id'); ?>
		<?php //echo $form->error($model,'rstl_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lab'); ?>
		<?php //echo $form->textField($model,'lab',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->checkBoxList($model,'lab',Lab::listdata()
				,array(
					'template'=>'{input} {label}<br/>',
					'separator'=>'',
					//'classname'=>'technicalAssistance'
					)
			); ?>
		<?php echo $form->error($model,'lab'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
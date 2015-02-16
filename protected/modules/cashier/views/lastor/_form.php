<?php
/* @var $this LastorController */
/* @var $model Lastor */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerScript('getDisplay', "
$('.search-button').keyUp(function(){
	//$('.search-form').toggle();
	//return false;
});
");
?>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lastor-form',
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
		<?php echo $form->hiddenField($model,'rstl_id', array('value'=>$this->getRstlId())); ?>
		<?php //echo $form->error($model,'rstl_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'number'); ?>
		<?php echo $form->textField($model,'number'); ?>
		<?php echo $form->error($model,'number'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'display'); ?>
		<?php echo $form->hiddenField($model,'display',array('size'=>11,'maxlength'=>11)); ?>
		<?php //echo $form->error($model,'display'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Initialize' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php
/* @var $this SampleController */
/* @var $model Sample */
/* @var $form CActiveForm */
Yii::app()->clientscript->scriptMap['jquery.js'] = false;
Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
?>
<div class="form">
	
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sample-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Please confirm action by providing your <span class="required">email</span>.</p>

	<?php //echo $form->errorSummary($model); ?>
	<div class="row">
		<?php //echo $form->labelEx($model,'sampleCode'); ?>
		<?php echo $_POST['User']['email']; ?>
		<?php //echo CHtml::textField('confirm', '', array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->textField($model, 'email', array('size'=>20,'maxlength'=>20)); ?>
		<?php //echo $form->error($model,'sampleCode'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Proceed', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
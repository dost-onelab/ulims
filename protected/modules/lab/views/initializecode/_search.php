<?php
/* @var $this InitializecodeController */
/* @var $model Initializecode */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rstl_id'); ?>
		<?php echo $form->textField($model,'rstl_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lab_id'); ?>
		<?php echo $form->textField($model,'lab_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'codeType'); ?>
		<?php echo $form->textField($model,'codeType'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'startCode'); ?>
		<?php echo $form->textField($model,'startCode'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'active'); ?>
		<?php echo $form->textField($model,'active'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
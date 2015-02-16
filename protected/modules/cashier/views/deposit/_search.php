<?php
/* @var $this DepositController */
/* @var $model Deposit */
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
		<?php echo $form->label($model,'startOr'); ?>
		<?php echo $form->textField($model,'startOr'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'endOr'); ?>
		<?php echo $form->textField($model,'endOr'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'depositDate'); ?>
		<?php echo $form->textField($model,'depositDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'amount'); ?>
		<?php echo $form->textField($model,'amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'depositType'); ?>
		<?php echo $form->textField($model,'depositType'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
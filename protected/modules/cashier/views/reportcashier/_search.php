<?php
/* @var $this ReportcashierController */
/* @var $model Reportcashier */
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
		<?php echo $form->label($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'receiptId'); ?>
		<?php echo $form->textField($model,'receiptId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'payor'); ?>
		<?php echo $form->textField($model,'payor',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'collectionType'); ?>
		<?php echo $form->textField($model,'collectionType'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'collectionBtr'); ?>
		<?php echo $form->textField($model,'collectionBtr'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'collectionProject'); ?>
		<?php echo $form->textField($model,'collectionProject'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cancelled'); ?>
		<?php echo $form->textField($model,'cancelled'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
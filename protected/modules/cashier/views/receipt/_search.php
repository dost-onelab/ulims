<?php
/* @var $this ReceiptController */
/* @var $model Receipt */
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
		<?php echo $form->label($model,'receiptId'); ?>
		<?php echo $form->textField($model,'receiptId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'receiptDate'); ?>
		<?php echo $form->textField($model,'receiptDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'paymentModeId'); ?>
		<?php echo $form->textField($model,'paymentModeId'); ?>
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
		<?php echo $form->label($model,'bank'); ?>
		<?php echo $form->textField($model,'bank',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'check_money_number'); ?>
		<?php echo $form->textField($model,'check_money_number',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'checkdate'); ?>
		<?php echo $form->textField($model,'checkdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total'); ?>
		<?php echo $form->textField($model,'total'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'project'); ?>
		<?php echo $form->textField($model,'project'); ?>
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
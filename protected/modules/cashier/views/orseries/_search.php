<?php
/* @var $this OrseriesController */
/* @var $model Orseries */
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
		<?php echo $form->label($model,'orcategory_id'); ?>
		<?php echo $form->textField($model,'orcategory_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rstl_id'); ?>
		<?php echo $form->textField($model,'rstl_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->label($model,'startor'); ?>
		<?php echo $form->textField($model,'startor',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nextor'); ?>
		<?php echo $form->textField($model,'nextor',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'endor'); ?>
		<?php echo $form->textField($model,'endor',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
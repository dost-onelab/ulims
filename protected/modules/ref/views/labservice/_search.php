<?php
/* @var $this LabServiceController */
/* @var $model LabService */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'lab_id'); ?>
		<?php echo $form->textField($model,'lab_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'labName'); ?>
		<?php echo $form->textField($model,'labName',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sampleType_id'); ?>
		<?php echo $form->textField($model,'sampleType_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>60,'maxlength'=>75)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'testName_id'); ?>
		<?php echo $form->textField($model,'testName_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'testName'); ?>
		<?php echo $form->textField($model,'testName',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'methodreference_id'); ?>
		<?php echo $form->textField($model,'methodreference_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'method'); ?>
		<?php echo $form->textField($model,'method',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reference'); ?>
		<?php echo $form->textField($model,'reference',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fee'); ?>
		<?php echo $form->textField($model,'fee'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'agency_id'); ?>
		<?php echo $form->textField($model,'agency_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
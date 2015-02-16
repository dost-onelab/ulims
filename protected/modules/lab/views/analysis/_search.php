<?php
/* @var $this AnalysisController */
/* @var $model Analysis */
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
		<?php echo $form->label($model,'requestId'); ?>
		<?php echo $form->textField($model,'requestId',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sample_id'); ?>
		<?php echo $form->textField($model,'sample_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sampleCode'); ?>
		<?php echo $form->textField($model,'sampleCode',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'testName'); ?>
		<?php echo $form->textField($model,'testName',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'method'); ?>
		<?php echo $form->textField($model,'method',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'references'); ?>
		<?php echo $form->textField($model,'references',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'quantity'); ?>
		<?php echo $form->textField($model,'quantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fee'); ?>
		<?php echo $form->textField($model,'fee'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'testId'); ?>
		<?php echo $form->textField($model,'testId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'analysisMonth'); ?>
		<?php echo $form->textField($model,'analysisMonth'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'analysisYear'); ?>
		<?php echo $form->textField($model,'analysisYear'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cancelled'); ?>
		<?php echo $form->textField($model,'cancelled'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'deleted'); ?>
		<?php echo $form->textField($model,'deleted'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
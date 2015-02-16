<?php
/* @var $this CancelledrequestController */
/* @var $model Cancelledrequest */
/* @var $form CActiveForm */
Yii::app()->clientscript->scriptMap['jquery.js'] = false;
Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
?>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cancelledrequest-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->hiddenField($model,'id')?>
	<div class="row">
		<?php //echo $form->labelEx($model,'request_id'); ?>
		<?php echo $form->hiddenField($model,'request_id', array('value'=>$request->id, 'readonly'=>true)); ?>
		<?php //echo $form->error($model,'request_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'requestRefNum'); ?>
		<?php echo $form->textField($model,'requestRefNum',array('size'=>50,'maxlength'=>50, 'value'=>$request->requestRefNum, 'readonly'=>true)); ?>
		<?php echo $form->error($model,'requestRefNum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reason'); ?>
		<?php echo $form->textArea($model,'reason',array('size'=>50,'maxlength'=>50, 'readonly'=>$model->isNewRecord ? false : true)); ?>
		<?php echo $form->error($model,'reason'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cancelDate'); ?>
		<?php echo $form->textField($model,'cancelDate', array('value'=>$model->isNewRecord ? date('Y-m-d') : date('Y-m-d', strtotime($model->cancelDate)), 'readonly'=>true)); ?>
		<?php echo $form->error($model,'cancelDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cancelledBy'); ?>
		<?php echo $form->textField($model,'cancelledBy', array('value'=>Users::model()->findByPk($model->isNewRecord ? Yii::app()->getModule('user')->user()->id : $model->cancelledBy)->getFullname(), 'readonly'=>true)); ?>
		<?php echo $form->error($model,'cancelledBy'); ?>
	</div>

	<div class="row buttons">
		<?php echo $model->isNewRecord ? CHtml::submitButton($model->isNewRecord ? 'Cancel Request' : 'Update', array('class'=>'btn btn-primary')) : ''; ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
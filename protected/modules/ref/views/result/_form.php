<?php
/* @var $this ResultController */
/* @var $model Result */
/* @var $form CActiveForm */
//Yii::app()->clientscript->scriptMap['jquery.js'] = false;
//Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'result-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php //echo $form->labelEx($model,'referral_id'); ?>
		<?php echo $form->textField($model,'referral_id', array('value'=>1234)); ?>
		<?php //echo $form->error($model,'referral_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'filename'); ?>
		<?php //echo $form->textField($model,'filename',array('size'=>25,'maxlength'=>25)); ?>
		<?php //echo $form->error($model,'filename'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'uploadFile'); ?>
		<?php //echo CHtml::activeFileField($model, 'uploadFile'); ?>
		<?php echo $form->fileField($model,'uploadFile'); ?>
		<?php
                  /*$this->widget('CMultiFileUpload', array(
                     'model'=>$model,
                     'name'=>'uploadFile',
                     'accept'=>'jpg|gif|png|pdf|txt',
                  ));*/
                ?>
		<?php echo $form->error($model,'uploadFile'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'test'); ?>
		<?php //echo $form->fileField($model,'test'); ?>
		<?php
                  /*$this->widget('CFileUpload', array(
                     'model'=>$model,
                     'name'=>'test',
                     'accept'=>'jpg|gif|png|pdf|txt',
                  ));*/
		?>
		<?php //echo $form->error($model,'test'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(!isset($model->id) ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
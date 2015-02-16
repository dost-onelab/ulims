<?php
/* @var $this CheckController */
/* @var $model Check */
/* @var $form CActiveForm */
Yii::app()->clientscript->scriptMap['jquery.js'] = false;
Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'check-form',
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
		<?php //echo $form->labelEx($model,'receipt_id'); ?>
		<?php echo $form->hiddenField($model,'receipt_id'); ?>
		<?php //echo $form->error($model,'receipt_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bank'); ?>
		<?php echo $form->textField($model,'bank',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'bank'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'checknumber'); ?>
		<?php echo $form->textField($model,'checknumber',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'checknumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'checkdate'); ?>
		<?php //echo $form->textField($model,'checkdate'); ?>
				<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'name'=>'Check[checkdate]',
						'value'=>$model->checkdate ? date('Y-m-d',strtotime($model->checkdate)) : date('Y-m-d'),
						//'value'=>$model->requestDate ? date('m/d/Y',strtotime($model->requestDate)) : date('m/d/Y'),
						// additional javascript options for the date picker plugin
						
						'options'=>array(
							'showAnim'=>'fold',
							'dateFormat'=>'yy-mm-dd'
							),
						'htmlOptions'=>array(
							//'style'=>'height:8px; margin: 0px;'
							)
					));
				?>	
		<?php echo $form->error($model,'checkdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount'); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-info')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
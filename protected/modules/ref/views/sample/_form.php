<?php
/* @var $this SampleController */
/* @var $model Sample */
/* @var $form CActiveForm */
Yii::app()->clientscript->scriptMap['jquery.js'] = false;
Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
?>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sample-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->hiddenField($model,'id');?>
	<div class="row">
		<?php //echo $form->labelEx($model,'referral_id'); ?>
		<?php echo $form->hiddenField($model,'referral_id', array('value'=>$referralId)); ?>
		<?php //echo $form->error($model,'referral_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'sampleType_id'); ?>
		<?php echo $form->dropDownList($model, 'sampleType_id',
						Labsampletype::listDataByLab($_POST['lab_id']),
						array('style'=>'width: 269px;'));?>
		<?php echo $form->error($model,'sampleType_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'sampleTemplate'); ?>
		<?php 
		$this->widget('ext.select2.ESelect2',array(
          //'model'=>$model,
          'name'=>'sampleTemplate',
          'data'=>Sampletemplate::listData(),
          'options'=>array(
                'width'=>'268px',
                'allowClear'=>true,
				'minimumInputLength'=>2,
                'placeholder'=>'Search sample template here...',
            ),
          'events' =>array('change'=>'js:function(e) 
                    { 
                       data = $(this).select2("data");
                       $("#Sample_sampleName").val(data.text);
                       $("#Sample_description").val($(this).select2("val"));
                    }
                    '
            ),
        ));
		?>
		<?php echo $form->error($model,'sampleTemplate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sampleName'); ?>
		<?php echo $form->textField($model,'sampleName',array('size'=>50,'maxlength'=>50, 'style'=>'width: 255px;')); ?>
		<?php echo $form->error($model,'sampleName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50, 'style'=>'width: 255px;')); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(!isset($model->id) ? 'Create' : 'Save', array('class'=>'btn btn-info')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
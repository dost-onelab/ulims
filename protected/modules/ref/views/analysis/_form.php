<?php
/* @var $this AnalysisController */
/* @var $model Analysis */
/* @var $form CActiveForm */
Yii::app()->clientscript->scriptMap['jquery.js'] = false;
Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
//print_r($model);
?>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'analysis-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php //echo $form->labelEx($model,'id'); ?>
		<?php echo $form->hiddenField($model,'id'); ?>
		<?php //echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sample_id'); ?>
		<?php //echo $form->dropDownList($model,'sample_id', Referral::getSamples($referralId), array('style'=>'width: 350px;')); ?>
		<?php echo $form->dropDownList($model, 'sample_id',
						Referral::getSamples($referralId), 
						array('ajax'=>array( 
										'type'=>'POST',
								 		'url'=>$this->createUrl('analysis/getTestName'),
								 		'update'=>'#Analysis_testName_id',
								    ),
						'empty'=>''
								    ));?>
		<?php echo $form->error($model,'sample_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'testName_id'); ?>
		<?php echo $form->dropDownList($model, 'testName_id', 
						Sampletypetestname::listDataBySampleType(), 
						array('ajax'=>array( 
										'type'=>'POST',
								 		'url'=>$this->createUrl('analysis/getMethodReference'),
								 		'update'=>'#Analysis_methodReference_id',
								    ),
						'empty'=>''
								    ));?>
		<?php echo $form->error($model,'testName_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'methodReference_id'); ?>
		<?php echo $form->dropDownList($model, 'methodReference_id',
						Testnamemethod::listDataByTestName(0), 
						array('ajax'=>array( 
									 	'type'=>'POST',
										'dataType'=>'JSON',
									 	'url'=>$this->createUrl('analysis/getAnalysisDetails'),
									 	'success'=>'js:function(data){
									 			  $("#reference").val(data.reference);
									 			  $("#Analysis_fee").val(data.fee);
									 			  }',
							    	),
						'empty'=>''
								    ));?>
		<?php echo $form->error($model,'methodReference_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reference'); ?>
		<?php echo CHtml::textField('reference','', array('readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'reference'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'fee'); ?>
		<?php echo $form->textField($model,'fee', array('readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'fee'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'create_time'); ?>
		<?php //echo $form->textField($model,'create_time'); ?>
		<?php //echo $form->error($model,'create_time'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'update_time'); ?>
		<?php //echo $form->textField($model,'update_time'); ?>
		<?php //echo $form->error($model,'update_time'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-info')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
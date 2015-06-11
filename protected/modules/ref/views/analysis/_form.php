<?php
/* @var $this AnalysisController */
/* @var $model Analysis */
/* @var $form CActiveForm */
Yii::app()->clientscript->scriptMap['jquery.js'] = false;
Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
$iconLoading = '<img src=\"/ulims/images/loading.gif\"/>';
$iconOk = '<i class=\"icon icon-ok\"></i>';
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
	<div id="hahaha"></div>
	<div class="row">
		<?php echo $form->labelEx($model,'sample_id'); ?>
		<?php //echo $form->dropDownList($model,'sample_id', Referral::getSamples($referralId), array('style'=>'width: 350px;')); ?>
		<?php echo $form->dropDownList($model, 'sample_id',
						Referral::getSamples($referralId), 
						array(
							'style'=>'width: 350px;',
							'ajax'=>array( 
										'type'=>'POST',
								 		'url'=>$this->createUrl('analysis/getTestName'),
								 		//'update'=>'#Analysis_testName_id',
								 		'beforeSend'=>'function(){
								 				$("#testName").html("'.$iconLoading.'");
								 				
								 				$("#methodReference").html("");
								 				$("#ref").html("");
								 				$("#fee").html("");
        									}', 
										'success'=>'function(response){
												$("#Analysis_testName_id").html(response);
												$("#Analysis_methodReference_id").html("");
												$("#reference").val("");
									 			$("#Analysis_fee").val("");
									 			
												$("#testName").html("'.$iconOk.'");
											}'
								    ),
						'empty'=>''
								    ));?>
		<?php echo $form->error($model,'sample_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'testName_id'); ?>
		<?php echo $form->dropDownList($model, 'testName_id', 
						Sampletypetestname::listDataBySampleType(), 
						array(
							'style'=>'width: 350px;',
							'ajax'=>array( 
										'type'=>'POST',
								 		'url'=>$this->createUrl('analysis/getMethodReference'),
								 		//'update'=>'#Analysis_methodReference_id',
								 		'beforeSend'=>'function(){
								 				$("#methodReference").html("'.$iconLoading.'");
								 				
								 				$("#ref").html("");
								 				$("#fee").html("");
        									}', 
										'success'=>'function(response){
												$("#Analysis_methodReference_id").html(response);
												$("#reference").val("");
									 			$("#Analysis_fee").val("");
									 			
												$("#methodReference").html("'.$iconOk.'");
											}'
								    ),
						'empty'=>''
								    ));?>
		<span id="testName"></span>
		<?php echo $form->error($model,'testName_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'methodReference_id'); ?>
		<?php echo $form->dropDownList($model, 'methodReference_id',
						Testnamemethod::listDataByTestName(0), 
						array(
							'style'=>'width: 350px;',
							'ajax'=>array( 
									 	'type'=>'POST',
										'dataType'=>'JSON',
									 	'url'=>$this->createUrl('analysis/getAnalysisDetails'),
									 	/*'success'=>'js:function(data){
									 			  $("#reference").val(data.reference);
									 			  $("#Analysis_fee").val(data.fee);
									 			  }',*/
										'beforeSend'=>'function(){
								 				$("#ref").html("'.$iconLoading.'");
								 				$("#fee").html("'.$iconLoading.'");
        									}', 
										'success'=>'function(data){
												$("#reference").val(data.reference);
									 			$("#Analysis_fee").val(data.fee);
									 			
												$("#ref").html("'.$iconOk.'");
								 				$("#fee").html("'.$iconOk.'");
											}'
							    	),
						'empty'=>''
								    ));?>
		<span id="methodReference"></span>
		<?php echo $form->error($model,'methodReference_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reference'); ?>
		<?php echo CHtml::textField('reference','', array('readonly'=>'readonly', 'style'=>'width: 335px;')); ?>
		<span id="ref"></span>
		<?php echo $form->error($model,'reference'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'fee'); ?>
		<?php echo $form->textField($model,'fee', array('readonly'=>'readonly', 'style'=>'width: 335px;')); ?>
		<span id="fee"></span>
		<?php echo $form->error($model,'fee'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(!isset($model->id) ? 'Create' : 'Update', array('class'=>'btn btn-info')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
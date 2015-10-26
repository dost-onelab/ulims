<?php
/* @var $this LabServiceController */
/* @var $model LabService */
/* @var $form CActiveForm */
Yii::app()->clientscript->scriptMap['jquery.js'] = false;
Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
$iconLoading = '<img src=\"/ulims/images/loading.gif\"/>';
$iconOk = '<i class=\"icon icon-ok\"></i>';
?>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lab-service-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'lab_id'); ?>
		<?php echo $form->dropDownList($model, 'lab_id',
						$labs, 
						array(
							'style'=>'width: 350px;',
							'ajax'=>array( 
										'type'=>'POST',
								 		'url'=>$this->createUrl('labservice/getSampleType'),
								 		//'update'=>'#Analysis_testName_id',
								 		'beforeSend'=>'function(){
								 				$("#type").html("'.$iconLoading.'");
								 				
								 				//$("#methodReference").html("");
								 				//$("#ref").html("");
								 				//$("#fee").html("");
        									}', 
										'success'=>'function(response){
												$("#Labservice_type").html(response);
												//$("#Analysis_methodReference_id").html("");
												//$("#reference").val("");
									 			//$("#Analysis_fee").val("");
									 			
												$("#type").html("'.$iconOk.'");
											}'
								    ),
						'empty'=>''
								    ));?>
		<?php echo $form->error($model,'lab_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model, 'type',
						$types, 
						array(
							'style'=>'width: 350px;',
							'ajax'=>array( 
										'type'=>'POST',
								 		'url'=>$this->createUrl('labservice/getTestName'),
								 		//'update'=>'#Analysis_testName_id',
								 		'beforeSend'=>'function(){
								 				$("#testname").html("'.$iconLoading.'");
        									}', 
										'success'=>'function(response){
												$("#Labservice_testName_id").html(response);
												$("#testname").html("'.$iconOk.'");
											}'
								    ),
						'empty'=>''
								    ));?>
		<span id="type"></span>
		<?php echo $form->error($model,'type'); ?>
	</div>
	
		<div class="row">
		<?php echo $form->labelEx($model,'testName_id'); ?>
		<?php echo $form->dropDownList($model, 'testName_id',
						$types, 
						array(
							'style'=>'width: 350px;',
							'ajax'=>array( 
										'type'=>'POST',
								 		'url'=>$this->createUrl('labservice/getMethodReference'),
								 		'update'=>'#methodReferences',
								    ),
						'empty'=>''
								    ));?>
		<span id="testname"></span>
		<?php echo $form->error($model,'testName_id'); ?>
	</div>
	
	<div id="methodReferences">    	
		<?php $this->renderPartial('_methodReferences', array('gridDataProvider'=>$gridDataProvider), true, true); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
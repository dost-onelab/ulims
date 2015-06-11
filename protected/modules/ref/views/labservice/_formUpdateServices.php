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

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'lab_id'); ?>
		<?php //echo $form->textField($model,'lab_id'); ?>
		<?php //echo $form->dropDownList($model,'lab_id', $labs, array('style'=>'width: 350px;')) ?>
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
		<?php //echo $form->textField($model,'type',array('size'=>60,'maxlength'=>75)); ?>
		<?php //echo $form->dropDownList($model,'type', $types, array('style'=>'width: 350px;')) ?>
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
		<?php //echo $form->textField($model,'testName_id'); ?>
		<?php //echo $form->dropDownList($model,'testName_id', $types, array('style'=>'width: 350px;')) ?>
		<?php echo $form->dropDownList($model, 'testName_id',
						$types, 
						array(
							'style'=>'width: 350px;',
							'ajax'=>array( 
										'type'=>'POST',
								 		'url'=>$this->createUrl('labservice/getMethodReference'),
								 		'update'=>'#methodReferences',
								 		/*'beforeSend'=>'function(){
								 				//$("#testname").html("'.$iconLoading.'");
        									}', 
										'success'=>'function(response){
												//$("#Labservice_type").html(response);
												//$("#testname").html("'.$iconOk.'");
												$.fn.yiiGridView.update("lab-service-grid");
											}'*/
								    ),
						'empty'=>''
								    ));?>
		<span id="testname"></span>
		<?php echo $form->error($model,'testName_id'); ?>
	</div>
	
	<div class="row buttons" id="methodReferences">    	
		<?php $this->renderPartial('_methodReferences', array('gridDataProvider'=>$gridDataProvider)); ?>
	</div>
	
	<div class="row buttons">
		<?php //echo CHtml::submitButton(!isset($model->id) ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

<?php /*$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'lab-service-grid',
	'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
	'dataProvider'=>$labservices,
	'filter'=>$model,
	'columns'=>array(
		//'lab_id',
		//'labName',
		//'sampleType_id',
		//'type',
		//'testName_id',
		//'testName',
		//'methodreference_id',
		'method',
		'reference',
		'fee',
		array(
			'name'=>'offered',
			'header'=>'Offered by',
		)
	),
));*/ ?>

</div><!-- form -->


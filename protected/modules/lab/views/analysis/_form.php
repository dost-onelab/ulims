<?php
/* @var $this AnalysisController */
/* @var $model Analysis */
/* @var $form CActiveForm */
Yii::app()->clientscript->scriptMap['jquery.js'] = false;
Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
?>

<div class="form">
<?php
	if (isset($modelSample->request_id)){ 
		//$id=$modelSample->request_id;
	}else{
		$id=$sampleId;
	}
?>

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
	<?php echo $form->hiddenField($model,'id')?>
	<div class="row">
		<?php //echo $form->labelEx($model,'requestId'); ?>
		<?php echo $form->hiddenField($model,'requestId',array('value'=>$model->isNewRecord ? $request->requestRefNum : $model->requestId, 'size'=>50,'maxlength'=>50, 'readonly'=>true)); ?>
		<?php //echo $form->error($model,'requestId'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'sample_id'); ?>
		<?php //echo $form->textField($model,'sample_id'); ?>
		<?php /*echo $form->dropDownList($model, 'sample_id', CHtml::listdata(
					$model->isNewRecord ?
					Sample::model()->findAll(array('condition'=>'request_id = :request_id', 'params'=>array(':request_id'=>$request->id))) :
					Sample::model()->findAll(array('condition'=>'id = :sample_id', 'params'=>array(':sample_id'=>$model->sample_id)))
					,'id','sampleName'));*/?>
		<?php 
			$codes = CHtml::listdata($model->isNewRecord ?
					Sample::model()->findAll(array('condition'=>'request_id = :request_id', 'params'=>array(':request_id'=>$request->id))) :
					Sample::model()->findAll(array('condition'=>'id = :sample_id', 'params'=>array(':sample_id'=>$model->sample_id)))
					,'id','sampleName');
		?>			
		<?php echo $form->checkBoxList($model,'sample_id',
					$codes 
					,array(
						'template'=>'{input} {label}',
						'separator'=>'',
						'style' =>"",
						'classname'=>'samples',
						'checkAll' => 'All',
						//'checkAllLast'=>true
						)
			); ?>
		<?php echo $form->error($model,'sample_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'sampleCode'); ?>
		<?php //echo $form->textField($model,'sampleCode',array('size'=>20,'maxlength'=>20)); ?>
		<?php //echo $form->error($model,'sampleCode'); ?>
	</div>
	
	<table>
		<tr>
			<td width="100"><?php echo $form->labelEx($model,'testCategory');?></td>
			<td><?php echo CHtml::dropDownList('testCategory', '' ,
						Testcategory::listData(), 
						array('ajax'=>array( 
										'type'=>'POST',
								 		'url'=>$this->createUrl('analysis/getSampletype'),
								 		'update'=>'#sampleType',
								    ),
						'empty'=>''
								    ));?></td>
		</tr>
		<tr>
			<td><?php echo $form->labelEx($model,'sampleType');?></td>
			<?php 
				if(isset(Yii::app()->session['testId']))
				{
					
					
				}
			
			?>
			<td><?php echo CHtml::dropDownList('sampleType', '' ,
						isset(Yii::app()->session['sampleType']) ? Yii::app()->session['sampleType'] : Sampletype::listData(),
						//Sampletype::listData(), 
						array('ajax'=>array( 
									 	'type'=>'POST',
									 	'url'=>$this->createUrl('analysis/getAnalysis'),
									 	'update'=>'#Analysis_testName',
							    	),
						'empty'=>''
							    	));?></td>
		</tr>
		<tr>
			<td><?php echo $form->labelEx($model,'testName');?></td>
			<td><?php echo $form->dropDownList($model,'testName', 
				isset(Yii::app()->session['analysis']) ? Yii::app()->session['analysis'] : CHtml::listData(Test::model()->findAllByAttributes(array('sampleType'=>1)), 'id', 'testName'),
				//CHtml::listData(Test::model()->findAllByAttributes(array('sampleType'=>1)), 'id', 'testName'),
				array('ajax'=>array( 
									 	'type'=>'POST',
										'dataType'=>'JSON',
									 	'url'=>$this->createUrl('analysis/getAnalysisdetails'),
									 	'success'=>'js:function(data){
									 			  $("#analysis").val(data.testName);
									 			  $("#Analysis_method").val(data.method);
									 			  $("#Analysis_references").val(data.references);
									 			  $("#Analysis_fee").val(data.fee);
									 			  $("#Analysis_testId").val(data.testId);
									 			  }',
							    	),
							  		
					 'empty'=>''
							    	));?></td>
		</tr>		
		<tr>
			<td><?php echo $form->labelEx($model,'method');?></td>
			<td>
				<?php echo $form->textField($model,'method',array('size'=>60,'maxlength'=>150, 'readonly'=>true));?>
				<?php echo $form->error($model,'method');?>
			</td>
		</tr>
		<tr>
			<td><?php echo $form->labelEx($model,'references');?></td>
			<td>
				<?php echo $form->textField($model,'references',array('size'=>60,'maxlength'=>100, 'readonly'=>true));?>
				<?php echo $form->error($model,'references'); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $form->labelEx($model,'quantity');?></td>
			<td>
				<?php echo $form->textField($model,'quantity', array('value'=>1, 'readonly'=>true, 'readonly'=>true));?>
				<?php echo $form->error($model,'quantity'); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $form->labelEx($model,'fee');?></td>
			<td>
				<?php echo $form->textField($model,'fee', array('readonly'=>true));?>
				<?php echo $form->error($model,'fee'); ?>
			</td>
		</tr>
		<tr>
			<td><?php //echo $form->labelEx($model,'testId'); ?></td>
			<td>
				<?php echo $form->hiddenField($model,'testId', array('readonly'=>true)); ?>
				<?php echo $form->error($model,'testId'); ?>
			</td>
		</tr>		
	</table>

	<div class="row">
		<?php //echo $form->labelEx($model,'analysisMonth'); ?>
		<?php echo $form->hiddenField($model,'analysisMonth', array('value'=>$model->isNewRecord ? date('m', strtotime($request->requestDate)) : $model->analysisMonth, 'readonly'=>true)); ?>
		<?php //echo $form->error($model,'analysisMonth'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'analysisYear'); ?>
		<?php echo $form->hiddenField($model,'analysisYear', array('value'=>$model->isNewRecord ? date('Y', strtotime($request->requestDate)) : $model->analysisYear, 'readonly'=>true)); ?>
		<?php //echo $form->error($model,'analysisYear'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'cancelled'); ?>
		<?php //echo $form->textField($model,'cancelled'); ?>
		<?php //echo $form->error($model,'cancelled'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'deleted'); ?>
		<?php //echo $form->textField($model,'deleted'); ?>
		<?php //echo $form->error($model,'deleted'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php 
/*Yii::app()->clientScript->registerScript('textfield-disabled', "
$('#Analysis_sample_id').click(function(){
  if ($(this).is(':checked'))   
    //$('#textfield').attr('disabled', true);
    alert('hahaha');             
  else
    //$('#textfield').attr('disabled', false);
    alert($(this).text());
});
");*/
?>
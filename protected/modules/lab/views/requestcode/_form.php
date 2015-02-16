<?php
/* @var $this RequestcodeController */
/* @var $model Requestcode */
/* @var $form CActiveForm */
?>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'requestcode-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
	<p class="note">The system must initialize codes before creating Requests. The <span class="required">last entries for the previous month</span> should be indicated here.</p>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php //echo $form->labelEx($model,'requestRefNum'); ?>
		<?php //echo $form->textField($model,'requestRefNum',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'requestRefNum'); ?>
	</div>
	<div class="row">
		<?php //echo $form->labelEx($model,'rstl_id'); ?>
		<?php //echo $form->textField($model,'rstl_id'); ?>
		<?php //echo $form->error($model,'rstl_id'); ?>
	</div>
	
	<?php foreach($labs as $lab):?>
	
		<div class="row">
			<?php //echo $form->labelEx($model,'labId'); ?>
			<?php //echo $form->dropDownList($model,'labId', Lab::listdata(), array()); ?>
			<?php //echo CHtml::dropDownList(labId, $lab->id, Lab::listdata());?>
			<?php //echo $form->error($model,'labId'); ?>
		</div>
		
		<div class="row">
			<?php echo $form->labelEx($model, $lab->labName); ?>
			<?php echo $form->textField($model,'number[]'); ?>
			<?php echo $form->error($model,'number'); ?>
		</div>
		
		<div class="row">	
			<?php echo $form->labelEx($model, 'sampleCode'); ?>
			<?php echo CHtml::textField('sampleCode[]'); ?>
		</div>
		<br/>
	<?php endforeach;?>

	<div class="row">
		<?php echo $form->labelEx($model,'year'); ?>
		<?php echo $form->dropDownList($model,'year',  CHtml::listData($this->getYear(), 'index', 'year')); ?>
		<?php echo $form->error($model,'year'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'cancelled'); ?>
		<?php //echo $form->textField($model,'cancelled'); ?>
		<?php //echo $form->error($model,'cancelled'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'/*,
				array(
						'ajax'=>array(
							'type'=>'POST',
							'url'=>$this->createUrl('requestcode/test'),
							'success'=>'function(){return false;}',
						 ))*/
				);
		 ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
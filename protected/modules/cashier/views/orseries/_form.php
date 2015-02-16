<?php
/* @var $this OrseriesController */
/* @var $model Orseries */
/* @var $form CActiveForm */
?>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'orseries-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'orcategory_id'); ?>
		<?php //echo $form->textField($model,'orcategory_id'); ?>
        <?php $orcategories=CHtml::listData(Orcategory::model()->findAll(),'id','name');?>
        <?php echo $form->dropDownList($model,'orcategory_id',$orcategories); ?>
		<?php echo $form->error($model,'orcategory_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>250,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'startor'); ?>
		<?php echo $form->textField($model,'startor',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'startor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'endor'); ?>
		<?php echo $form->textField($model,'endor',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'endor'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-info')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
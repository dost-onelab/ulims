<?php
/* @var $this TestController */
/* @var $model Test */
/* @var $form CActiveForm */
?>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'test-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'testName'); ?>
		<?php echo $form->textField($model,'testName',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'testName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'method'); ?>
		<?php echo $form->textField($model,'method',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'method'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'references'); ?>
		<?php echo $form->textField($model,'references',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'references'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fee'); ?>
		<?php echo $form->textField($model,'fee'); ?>
		<?php echo $form->error($model,'fee'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'duration'); ?>
		<?php echo $form->textField($model,'duration'); ?>
		<?php echo $form->error($model,'duration'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'categoryId'); ?>
		<?php //echo $form->textField($model,'categoryId'); ?>
		<?php echo $form->dropDownList($model,'categoryId',
								 CHtml::listData(Testcategory::model()->findAll(), 'id', 'categoryName'),
								 array('ajax'=>array(
													 'type'=>'POST',
													 'url'=>$this->createUrl('test/sampletype'),
													 'update'=>'#Test_sampleType',
													 )
									   )
								 ); 
		?>
		<?php echo $form->error($model,'categoryId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sampleType'); ?>
		<?php //echo $form->textField($model,'sampleType'); ?>
		<?php 
		echo $model->isNewRecord ? 
			$form->dropDownList($model,'sampleType',CHtml::listData(
								Sampletype::model()->findAllByAttributes(array('testCategoryId'=>1)),
								'id', 'sampleType')) //for default create new record*/
		:
			$form->dropDownList($model,'sampleType',CHtml::listData(
								Sampletype::model()->findAllByAttributes(array('testCategoryId'=>$model->categoryId)),
								'id', 'sampleType'));
		
		
		?>
		<?php echo $form->error($model,'sampleType'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'labId'); ?>
		<?php //echo $form->textField($model,'labId'); ?>
		<?php echo $form->dropDownList($model,'labId',Initializecode::listLabName());?>
		<?php echo $form->error($model,'labId'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-info')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

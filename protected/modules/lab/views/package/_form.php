<?php
/* @var $this PackageController */
/* @var $model Package */
/* @var $form CActiveForm */
?>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'package-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name', array('value'=>$model->isNewRecord ? 'Package ' : $model->name)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rate'); ?>
		<?php echo $form->textField($model,'rate', array('value'=>$model->rate ? $model->rate : '', 'readonly'=>false)); ?>
		<?php echo $form->error($model,'rate'); ?>
	</div>	
	
	<div class="row">
		<?php echo $form->labelEx($model,'testcategory_id'); ?>
		<?php //echo $form->dropDownList($model,'testcategory_id', Testcategory::listData()); ?>
		<?php echo $form->dropDownList($model, 'testcategory_id',
						Testcategory::listData(), 
						array('ajax'=>array( 
										'type'=>'POST',
								 		'url'=>$this->createUrl('package/getSampletype'),
								 		'update'=>'#Package_sampletype_id',
								    ),
						'empty'=>''
								    ));?>
		<?php echo $form->error($model,'testcategory_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'sampletype_id'); ?>
		<?php echo $form->dropDownList($model, 'sampletype_id',
						//isset(Yii::app()->session['sampleType']) ? Yii::app()->session['sampleType'] : Sampletype::listData(),
						$model->isNewRecord ? array() : Sampletype::listData3($model->testcategory_id),
						array('ajax'=>array( 
									 	'type'=>'POST',
									 	'url'=>$this->createUrl('package/getTest'),
									 	'update'=>'#Package_tests',
							    	),
						'empty'=>''
							    	));?>
		<?php echo $form->error($model,'sampletype_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tests');?>
		<?php echo $form->listBox($model, 'tests', 
					$model->isNewRecord ? array() : Test::listData2($model->sampletype_id),
					 
					array('multiple' => 'multiple', 
						  'size' => '10', 
						  'options'=>$selected,
						  'ajax'=>array(
								'type' => 'post',
						        'url' => $this->createUrl('package/updateTestGrid'),
								'update'=> '#tests-grid',
							)
					)
					);
		?>
		<?php echo $form->error($model,'tests'); ?>        
	</div>
    <div class="row">
    	<label>Tests Details </label>
        <div id="tests-grid" class="span7" style="margin-left:0;">    
        <?php $this->renderPartial('_tests', array('model'=>$model, 'gridDataProviderTest'=>$gridDataProviderTest)); ?>
        <?php //$this->renderPartial('_tests', array('model'=>$model, 'gridDataProviderTest'=>$gridDataProviderTest), false, true); ?>
        </div>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-info')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
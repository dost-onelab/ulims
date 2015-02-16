<?php
/* @var $this OrderofpaymentController */
/* @var $model Orderofpayment */
/* @var $form CActiveForm */
?>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'orderofpayment-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php //echo $form->labelEx($model,'rstl_id'); ?>
		<?php echo $form->hiddenField($model,'rstl_id'); ?>
		<?php //echo $form->error($model,'rstl_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'transactionNum'); ?>
		<?php echo $form->hiddenField($model,'transactionNum',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'transactionNum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'collectiontype_id'); ?>
		<?php echo $form->dropDownList($model,'collectiontype_id', 
					Collectiontype::listData()
					); ?>
		<?php echo $form->error($model,'collectiontype_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'name'=>'Orderofpayment[date]',
						'value'=>$model->date ? date('m/d/Y',strtotime($model->date)) : date('m/d/Y'),						
						//'value'=>$model->requestDate ? date('m/d/Y',strtotime($model->requestDate)) : date('m/d/Y'),
						
						// additional javascript options for the date picker plugin						
						'options'=>array(
							'showAnim'=>'fold',
							
							),
						'htmlOptions'=>array(
							//'style'=>'height:8px; margin: 0px;'
							
							)
					));
				?>	
		<?php echo $form->error($model,'date'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'customer_id'); ?>
		<?php //echo $form->textField($model,'customer_id'); ?>
		<?php $this->widget('ext.select2.ESelect2',array(
					'model'=>$model,
					'attribute'=>'customer_id',
					'data'=>$customers,
					'options'=>array(
						'width'=>'400px',
						'placeholder'=>'Select customer...',
					),					
					'htmlOptions'=>array(
						'ajax'=>array( 
									'type'=>'POST',
							 		'url'=>$this->createUrl('orderofpayment/searchRequests'),
									'update'=>'#requests',
							    ),
					  ),
				));
			?>
		<?php echo $form->error($model,'customer_id'); ?>
	</div>

	<div class="row buttons" id="requests">    	
		<?php $this->renderPartial('_requests', array('gridDataProvider'=>$gridDataProvider)); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'address'); ?>
		<?php //echo $form->textField($model,'address',array('size'=>60,'maxlength'=>200)); ?>
		<?php //echo $form->error($model,'address'); ?>
	</div>

	<!--div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount'); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div-->

	<div class="row">
		<?php echo $form->labelEx($model,'purpose'); ?>
		<?php //echo $form->textArea($model,'purpose',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->textArea($model,'purpose',array('placeholder'=>'Enter purpose here...','style'=>'width:400px;height:100px')); ?>
		<?php echo $form->error($model,'purpose'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'createdReceipt'); ?>
		<?php //echo $form->textField($model,'createdReceipt'); ?>
		<?php //echo $form->error($model,'createdReceipt'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
				'class'=>'btn btn-info',
				'id'=>'createOP'
				)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php
Yii::app()->clientScript->registerScript('orderofpayment-script','

$("#createOP").click(function(){
	var checked=$("#requests-grid").yiiGridView("getChecked","requestIds");
	var count=checked.length;
	//if(count==1 && confirm("Are you sure you want to delete this item?")){fnAjax(checked);}
	//if(count>1 && confirm("Are you sure you want to delete these "+count+" items")){fnAjax(checked);}
	if(count<1){alert("Please select request.");return false;}
});

');
?>
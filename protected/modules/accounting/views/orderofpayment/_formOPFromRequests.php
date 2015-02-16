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
					'htmlOptions'=>array(
					  	'style'=>'width:400px',
						'ajax'=>array( 
									'type'=>'POST',
							 		'url'=>$this->createUrl('orderofpayment/searchRequests'),
									'update'=>'#requests',
							 		/*'dataType'=>'json',
									'data'=>'js:$(this).serialize()',
									'success'=>'js:function(data){
											if(data){
												$("#requests").html(data.requests);
											}
										}
									'*/
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
		<?php echo $form->labelEx($model,'customerName'); ?>
		<?php echo $form->textField($model,'customerName',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'customerName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount'); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'purpose'); ?>
		<?php echo $form->textArea($model,'purpose',array('rows'=>3, 'cols'=>50)); ?>
		<?php echo $form->error($model,'purpose'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', 
			array(
				'class'=>'btn btn-primary',
				//'onclick' => 'alert($.fn.yiiGridView.getChecked("requests-grid","example-check-boxes").toString())',
				)); 
		?>
	</div>

<?php $this->endWidget(); ?>

<?php 
Yii::app()->clientScript->registerScript('accountsgrid', "
$('#requests-grid table tbody tr').live('click',function()
{
	    //var selectedRequests = $.fn.yiiGridView.getChecked(('requests-grid','requestId').toString());
    	
		//alert(selectedRequests);
});
");
?>

</div><!-- form -->
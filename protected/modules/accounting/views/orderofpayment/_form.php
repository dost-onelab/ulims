<?php
/* @var $this OrderofpaymentController */
/* @var $model Orderofpayment */
/* @var $form CActiveForm */
?>

<div class="form">

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
		<?php //echo $form->labelEx($model,'customer_id'); ?>
		<?php //echo $form->textField($model,'request_id'); ?>
		<?php //echo $form->error($model,'customer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'customerName'); ?>
		<?php echo $form->hiddenField($model,'customer_id'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				//'id'=>'customerName',
			    'name'=>'Orderofpayment[customerName]',
				'value'=>$model->customerName ? $model->customerName : '',
			    //'source'=>$this->createUrl('orderofpayment/searchPayor'),
			    'source'=>'js: function(request, response) {
				    $.ajax({
				        url: "'.$this->createUrl('orderofpayment/searchPayor').'",
				        dataType: "json",
				        data: {
				            term: request.term,
				            collectiontype_id: $("#Orderofpayment_collectiontype_id").val()
				        },
				        success: function (data) {
				                response(data);
				        }
				    })
				 }',
			    'options'=>array(
			        'minLength'=>3,
			        'showAnim'=>'fold',
					'select'=>'js:function(event, ui) 
						{ 
							$("#Orderofpayment_customer_id").val(ui.item.id); // assign customerId to hidden field
							$("#Orderofpayment_address").val(ui.item.address);
						}'
			    ),
			    'htmlOptions'=>array(
			    	'placeholder'=>'search keywords here...',
			    	'style'=>'width:400px;',
			    ),
			   
			));
		?>
		<?php echo $form->error($model,'customerName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textArea($model,'address',array('rows'=>2, 'cols'=>50, 'style'=>'width: 400px;')); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'purpose'); ?>
		<?php echo $form->textArea($model,'purpose',array('rows'=>4, 'cols'=>50, 'style'=>'width: 400px;')); ?>
		<?php echo $form->error($model,'purpose'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-info')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php
/* @var $this PaymentitemController */
/* @var $model Paymentitem */
/* @var $form CActiveForm */
Yii::app()->clientscript->scriptMap['jquery.js'] = false;
Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'paymentitem-form',
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
		<?php //echo $form->labelEx($model,'rstl_id'); ?>
		<?php echo $form->hiddenField($model,'request_id'); ?>
		<?php //echo $form->error($model,'rstl_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'orderofpayment_id'); ?>
		<?php echo $form->hiddenField($model,'orderofpayment_id'); ?>
		<?php //echo $form->error($model,'orderofpayment_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, ($orderOfPayment->collectiontype_id == 1 || $model->orderofpayment->collectiontype_id == 1) ? 'requestRefNum' : 'details'); ?>
		<?php if($orderOfPayment->collectiontype_id == 1):?>
		<?php /*$this->widget('ext.select2.ESelect2', array(
	            'selector' => '#Paymentitem_details',
	            //'model'=>$model,
				//'attribute'=>'details',
				//'data'=>Request::listDataUnpaid($model),
	            'options'  => array(
						'width'=>'268px',
	                    'allowClear'=>true,
	                    'placeholder'=>'Search Request Reference here...',
	                    'minimumInputLength' => 5,
	                    'ajax' => array(
	                            'url' => $this->createUrl('paymentitem/searchRequest'),
	                            'dataType' => 'json',
	                            'quietMillis'=> 100,
	                            'data' => 'js: function(text,page) {
	                                            return {
	                                                q: text,
	                                                page_limit: 10,
	                                                page: page,
	                                            };
	                                        }',
	                            'results'=>'js:function(data,page) { var more = (page * 10) < data.total; return {results: data, more:more }; }',
	                    ),
	            ),
	            'events' =>array('change'=>'js:function(e) 
			                    { 
			                       data = $(this).select2("data");
			                       $("#Collection_request_id").val(data.id);
			                       $("#Paymentitem_details").val(data.text);
			                       $("#Paymentitem_amount").val(data.total);
			                    }
			                    '
			            ),
	          ));*/
	    		$requests=Request::listDataUnpaid($model, $orderOfPayment->customer_id);
	    		
				$this->widget('ext.select2.ESelect2',array(
			  	'model'=>$model,
			  	'attribute'=>'details',
			  	'data'=>$requests,
			  	'options'=>array(
					'width'=>'265px',
					'allowClear'=>true,
					'placeholder'=>'Enter/Search Request Reference...',
				),
				'htmlOptions'=>array(
					'onChange'=>CHtml::ajax(array(
						'type'=>'POST',
						'url'=>$this->createUrl('searchRequest'),
						'dataType'=>'json',
						'data'=>'js:$(this).serialize()',
						'success'=>"js:function(data){
							$('#Paymentitem_amount').removeClass('loader-img gray-text');
							if(data){
								$('#Paymentitem_amount').val(data.balance);
								$('#Paymentitem_request_id').val(data.id);
							}else{
								$('#Paymentitem_amount').val('0.00');
							}
						}",
						'beforeSend'=>'function(jqXHR, settings){
							$("#Paymentitem_amount").val("Computing...");
							$("#Paymentitem_amount").addClass("loader-img gray-text");
					 	}',

					)),
				),

			));			
		?>
		<?php else:?>
			<?php echo $form->textField($model,'details',array(
					'value'=>($model->isNewRecord ? $orderOfPayment->collectiontype->natureOfCollection : $model->details),
					'size'=>50,
					'maxlength'=>50
				));
			?>
		<?php endif;?>
		
		
		<?php echo $form->error($model,'details'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount'); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'cancelled'); ?>
		<?php //echo $form->textField($model,'cancelled'); ?>
		<?php //echo $form->error($model,'cancelled'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-info')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
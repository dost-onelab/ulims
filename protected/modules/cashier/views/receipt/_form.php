<?php
/* @var $this ReceiptController */
/* @var $model Receipt */
/* @var $form CActiveForm */
//Yii::app()->clientscript->scriptMap['jquery.js'] = false;
//Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
?>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'receipt-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'project'); ?>
		<?php echo $form->dropDownList($model,'project', array('0'=>'Bureau of Treasury', '1'=>'Project')); ?>
		<?php echo $form->error($model,'project'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'receiptDate'); ?>
		<?php //echo $form->textField($model,'receiptDate'); ?>
		<?php //echo $form->textField($model,'receiptDate', array('value'=>$model->receiptDate ? date('m/d/Y',strtotime($model->receiptDate)) : date('m/d/Y')));?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'name'=>'Receipt[receiptDate]',
						'value'=>$model->receiptDate ? date('m/d/Y',strtotime($model->receiptDate)) : date('m/d/Y'),
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
		<?php echo $form->error($model,'receiptDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'paymentModeId'); ?>
		<?php echo $form->dropDownList($model,'paymentModeId', Paymentmode::listData()); ?>
		<?php echo $form->error($model,'paymentModeId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'collectionType'); ?>
		<?php echo $form->dropDownList($model,'collectionType', Collectiontype::listData()); ?>
		<?php echo $form->error($model,'collectionType'); ?>
	</div>
	<?php if($model->isNewRecord){ ?>
	<div class="row">
    	<?php $loaderImg = CHtml::image(Yii::app()->request->baseUrl . '/images/loading.gif');?>
		<?php echo $form->labelEx($model,'orseries_id'); ?>
		<?php echo $form->dropDownList($model,'orseries_id', Orseries::listData(), 
					array(
						'empty'=>'',
						'ajax'=>array(
								'type'=>'POST',
								'url'=>$this->createUrl('nextOR'),
								'dataType'=>'json',
								'data'=>'js:$(this).serialize()',
								'success'=>'js:function(data){
									if(data){
										$(".nxt_or").html(data.nxtOR);
									}
								}',
								'beforeSend'=>'function(jqXHR, settings){
									$(".nxt_or").html(\'<span>'.$loaderImg.'</span>\');
								}',
							),
					)); ?> <span class="nxt_or"></span>
		<?php echo $form->error($model,'orseries_id'); ?>
	</div>
    <?php }?>
    
	<div class="row">
		<?php echo $form->labelEx($model,'payor'); ?>
		<?php //echo $form->textField($model,'payor',array('size'=>60,'maxlength'=>100)); ?>
		<?php //echo $form->textField($model,'payor',array('size'=>20,'maxlength'=>20));

			$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'id'=>'receiptPayor',
			    'name'=>'Receipt[payor]',
				'value'=>$model->payor ? $model->payor : ($OP ? $OP->customerName : ''),
			    'source'=>$this->createUrl('receipt/searchPayor'),
			    'options'=>array(
			        //'delay'=>300,
			        'minLength'=>1,
			        'showAnim'=>'fold',
					'select'=>'js:function(event, ui) 
						{ 
					
						}'
			    ),
			    'htmlOptions'=>array(
			    	'placeholder'=>"Enter payor's name...",
			    	'style'=>'width:400px;',
			    ),
			   
			));
		?>
		<?php echo $form->error($model,'payor'); ?>
	</div>
	
	<div class="row">
		<?php //echo $form->labelEx($model,'orderofpayment_id'); ?>
		<?php echo $form->hiddenField($model,'orderofpayment_id', array('value'=>$orderofpaymentId)); ?>
		<?php //echo $form->error($model,'orderofpayment_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-info')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
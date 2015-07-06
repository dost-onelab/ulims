<?php
/* @var $this ReferralController */
/* @var $model Referral */
/* @var $form CActiveForm */
//Yii::app()->clientscript->scriptMap['jquery.js'] = false;
//Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
?>

<div class="form wide">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'referral-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
));	
?>
	
	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
	<?php echo $form->errorSummary($model);?>
	<?php echo $form->hiddenField($model,'id');?>
	
	<div class="row">
		<?php echo isset($model->id) ? '' :$form->labelEx($model,'lab_id'); ?>
		<?php $display = isset($model->id) ? 'none' : '';?>
		<?php echo $form->dropDownList($model,'lab_id', $labs, array('style'=>'width: 350px; display:'.$display)) ?>
		<?php echo $form->error($model,'lab_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'customer_id'); ?>
		<?php //echo $form->textField($model,'customer_id',array('size'=>50,'maxlength'=>50)); ?>
		<?php 
			$this->widget('ext.select2.ESelect2',array(
          'model'=>$model,
		  'attribute'=>'customer_id',
          'data'=>Customer::listData(),
          'options'=>array(
                'width'=>'350px',
                'allowClear'=>true,
				'minimumInputLength'=>3,
                'placeholder'=>'Search customer here...',
            ),
          'events' =>array('change'=>'js:function(e) 
                    { 
                       data = $(this).select2("data");
                       $("#Referral_customer_id").val(data.id);
                    }
                    '
            ),
        ));
		?>
		<?php
			$imageCustomer = CHtml::image(Yii::app()->request->baseUrl . '/images/customer_add.png');
			$linkCustomer = Chtml::link($imageCustomer, '', array( 
				'style'=>'cursor:pointer;',
				'onClick'=>'js:{addCustomer(); $("#dialogCustomer").dialog("open");}',
			)); 
			echo '&nbsp;'.$linkCustomer;
		?>
		<?php echo $form->error($model,'customer_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'referralDate'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'name'=>'Referral[referralDate]',
						'value'=>$model->referralDate ? date('Y-m-d',strtotime($model->referralDate)) : date('Y-m-d'),
						// additional javascript options for the date picker plugin
						
						'options'=>array(
							'showAnim'=>'fold',
							'dateFormat'=>'yy-mm-dd',
							),
						'htmlOptions'=>array(
							//'style'=>'height:8px; margin: 0px;'
							)
					));
				?>
		<?php echo $form->error($model,'referralDate'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'referralTime'); ?>
		<?php echo $form->textField($model,'referralTime',array('value'=>$model->referralTime ? date('g:i A', $model->referralTime) : date('g:i A', time()), 'size'=>50, 'maxlength'=>50)); ?>
		<?php echo $form->error($model,'referralTime'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'paymentType_id'); ?>
		<div class="compactRadioGroup">
		<?php echo $form->radioButtonList($model, 'paymentType_id', array(1=>'PAID',2=>'FULLY SUBSIDIZED'),
						array( 'separator' => "  "));
		?>  
		</div>
		<?php echo $form->error($model,'paymentType_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'discount_id'); ?>
		<?php echo $form->dropDownList($model,'discount_id', $discounts, array('style'=>'width: 220px;')); ?>
		<?php echo $form->error($model,'discount_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'reportDue'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'name'=>'Referral[reportDue]',
						'value'=>$model->reportDue ? date('Y-m-d',strtotime($model->reportDue)) : date('Y-m-d'),
						// additional javascript options for the date picker plugin
						
						'options'=>array(
							'showAnim'=>'fold',
							'dateFormat'=>'yy-mm-dd',
							),
						'htmlOptions'=>array(
							//'style'=>'height:8px; margin: 0px;'
							)
					));
				?>
		<?php echo $form->error($model,'reportDue'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'conforme'); ?>
		<?php echo $form->textField($model,'conforme',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'conforme'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'receivedBy'); ?>
		<?php echo $form->textField($model,'receivedBy',array('size'=>50,'maxlength'=>50, 'value'=>Yii::app()->getModule('user')->user()->getFullName())); ?>
		<?php echo $form->error($model,'receivedBy'); ?>
	</div>
	
	<?php if(Yii::app()->user->hasFlash('error')): ?>
	    <div class="alert alert-warning" style="width:375px; margin: 10px 5px 10px 65px">
        
        <strong> <?php echo Yii::app()->user->getFlash('error'); ?> </strong> <br/>
        Error Message: <strong> <?php echo Yii::app()->user->getFlash('errormessage'); ?></strong> 
		</div>
	<?php endif; ?>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton(!isset($model->id) ? 'Create' : 'Update', array('class'=>'btn btn-info')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
	
<!-- Customer Dialog : Start -->
<?php
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		    'id'=>'dialogCustomer',
		    // additional javascript options for the dialog plugin
		    'options'=>array(
		        'title'=>'Add Customer',
				'show'=>'scale',
				'hide'=>'scale',				
				'width'=>'840',
				'modal'=>true,
				'resizable'=>false,
				'autoOpen'=>false,
			    ),
		));

	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<!-- Customer Dialog : End -->

<script type="text/javascript">
function addCustomer()
{
    <?php echo CHtml::ajax(array(
			'url'=>$this->createUrl('customer/create',array('id'=>$model->id)),
			'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#dialogCustomer').html(data.div);
                    // Here is the trick: on submit-> once again this function!
                    $('#dialogCustomer form').submit(addCustomer);
                }
                else
                {
					$('#dialogCustomer').html(data.div);
                    setTimeout(\"$('#dialogCustomer').dialog('close') \",1000);
                }
 
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogCustomer").html(
						\'<div class="loader"><br\><br\>Generating form.<br\> Please wait...</div>\'
					);
             }',
			 'error'=>"function(referral, status, error){
				 	$('#dialogCustomer').html(status+'('+error+')'+': '+ referral.responseText );
					}",
			
            ))?>;
    return false; 
 
}
</script>
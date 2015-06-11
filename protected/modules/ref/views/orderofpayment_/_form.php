<?php
/* @var $this OrderofpaymentController */
/* @var $model Orderofpayment */
/* @var $form CActiveForm */
//echo '<br/><br/><br/><br/><br/><br/><br/><br/>';
//print_r(json_decode(["7","8"]));
//$text = ["7","8"];
//$test = explode(',', '["7","8"]');
//print_r($text);
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
		<?php //echo $form->hiddenField($model,'rstl_id'); ?>
		<?php //echo $form->error($model,'rstl_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'transactionNum'); ?>
		<?php //echo $form->hiddenField($model,'transactionNum',array('size'=>50,'maxlength'=>50)); ?>
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
		<?php echo $form->labelEx($model,'transactionDate'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'name'=>'Orderofpayment[transactionDate]',
						'value'=>$model->transactionDate ? date('Y-m-d',strtotime($model->transactionDate)) : date('Y-m-d'),						
						
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
		<?php echo $form->error($model,'transactionDate'); ?>
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
							 		'url'=>$this->createUrl('orderofpayment/searchReferrals'),
									'update'=>'#referrals',
							    ),
					  ),
				));
			?>
		<?php echo $form->error($model,'customer_id'); ?>
	</div>

	<div class="row buttons" id="referrals">    	
		<?php $this->renderPartial('_referrals', array('gridDataProvider'=>$gridDataProvider)); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'address'); ?>
		<?php //echo $form->textField($model,'address',array('size'=>60,'maxlength'=>200)); ?>
		<?php //echo $form->error($model,'address'); ?>
	</div>

	<!--div class="row">
		<?php //echo $form->labelEx($model,'amount'); ?>
		<?php //echo $form->textField($model,'amount'); ?>
		<?php //echo $form->error($model,'amount'); ?>
	</div-->

	<div class="row">
		<?php echo $form->labelEx($model,'purpose'); ?>
		<?php //echo $form->textArea($model,'purpose',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->textArea($model,'purpose',array('placeholder'=>'Enter purpose here...','style'=>'width:400px;height:100px')); ?>
		<?php echo $form->error($model,'purpose'); ?>
	</div>

	<?php if(Yii::app()->user->hasFlash('error')): ?>
	    <div class="alert alert-warning" style="width:375px; margin: 10px 5px 10px 65px">
        
        <strong> <?php echo Yii::app()->user->getFlash('error'); ?> </strong> <br/>
        Error Message: <strong> <?php echo Yii::app()->user->getFlash('errormessage'); ?></strong> 
		</div>
	<?php endif; ?>

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
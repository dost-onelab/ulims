<?php
/* @var $this ReferralstatusController */
/* @var $model Referralstatus */
/* @var $form CActiveForm */
?>

<div class="alert alert-info" style="margin: 10px 5px 10px 5px">
        <!-- a href="#" class="close" data-dismiss="alert">&times;</a-->
        Send Referral : <strong> <?php echo isset($_POST['Referralstatus']) ? $_POST['Referralstatus']['referralCode'] : $_POST['referralCode'];?> </strong> to <strong><?php echo isset($_POST['Referralstatus']) ? $_POST['Referralstatus']['agencyName'] : $_POST['agencyName'];?></strong>?<br/><br/>
        <strong>Note!</strong> Samples and Analyses cannot be added after submission. 
</div>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'referralstatus-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->hiddenField($model,'id');?>
	
	<div class="row">
		<?php echo $form->hiddenField($model,'referralCode', array('value' => isset($_POST['Referralstatus']) ? $_POST['Referralstatus']['referralCode'] : $_POST['referralCode'])); ?>
		<?php echo $form->hiddenField($model,'agencyName', array('value' => isset($_POST['Referralstatus']) ? $_POST['Referralstatus']['agencyName'] : $_POST['agencyName'])); ?>
		<?php //echo $form->labelEx($model,'referral_id'); ?>
		<?php echo $form->hiddenField($model,'referral_id', array('value' => isset($_POST['Referralstatus']) ? $_POST['Referralstatus']['referral_id'] : $_POST['referral_id'])); ?>
		<?php //echo $form->error($model,'referral_id'); ?>
	</div>
	
	<div class="row">
		<?php //echo $form->labelEx($model,'acceptingAgencyId'); ?>
		<?php echo $form->hiddenField($model,'acceptingAgencyId', array('value' => isset($_POST['Referralstatus']) ? $_POST['Referralstatus']['acceptingAgencyId'] : $_POST['agency_id'])); ?>
		<?php //echo $form->error($model,'acceptingAgencyId'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'sampleArrivalDate'); ?>
		<?php //echo $form->textField($model,'sampleArrivalDate'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'name'=>'Referralstatus[sampleArrivalDate]',
						//'value'=>$model->referralDate ? date('Y-m-d',strtotime($model->referralDate)) : date('Y-m-d'),
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
		<?php echo $form->error($model,'sampleArrivalDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'shipmentDetails'); ?>
		<?php echo $form->textArea($model,'shipmentDetails',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'shipmentDetails'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status_id'); ?>
		<?php //echo $form->textField($model,'status_id'); ?>
		<?php echo $form->dropDownList($model,'status_id',Referral::itemAlias('StatusReceivingSend')); ?>
		<?php echo $form->error($model,'status_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Send' : 'Save', array('class'=>'btn btn-info')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
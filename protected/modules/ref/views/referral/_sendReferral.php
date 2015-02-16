<?php //echo $_POST['agency_id'].'<br/>';?>
<?php //print_r($referral);//echo $_POST['referral_id'];?>


<div class="alert alert-info" style="margin: 10px 5px 10px 5px">
        <!-- a href="#" class="close" data-dismiss="alert">&times;</a-->
        Send Referral : <strong> <?php echo $_POST['referralCode'];?> </strong> to <strong><?php echo $_POST['agencyName'];?></strong>?<br/><br/>
        <strong>Note!</strong> Samples and Analyses cannot be added after submission. 
</div>

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
	
	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
		<?php //echo $form->error($model,'id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status', array('value'=>Referral::STATUS_RECEIVED)); ?>
		<?php //echo $form->error($model,'status'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'acceptingAgencyId'); ?>
		<?php echo $form->textField($model,'acceptingAgencyId', array('value'=>$_POST['agency_id'])); ?>
		<?php //echo $form->error($model,'acceptingAgencyId'); ?>
	</div>	
	<div class="row">
		<?php //echo $form->labelEx($model,'acceptingAgencyId'); ?>
		<?php /*$this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'name'=>'Referral[sampleArrivalDate]',
						//'value'=>$model->referralDate ? date('Y-m-d',strtotime($model->referralDate)) : date('Y-m-d'),
						// additional javascript options for the date picker plugin
						
						'options'=>array(
							'showAnim'=>'fold',
							'dateFormat'=>'yy-mm-dd',
							),
						'htmlOptions'=>array(
							//'style'=>'height:8px; margin: 0px;'
							)
					));*/
				?>
		<?php //echo $form->error($model,'acceptingAgencyId'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Send Referral', array('class'=>'btn btn-info')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
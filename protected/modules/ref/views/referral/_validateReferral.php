<?php
Yii::app()->clientscript->scriptMap['jquery.js'] = false;
Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
?>

<div class="alert alert-info" style="margin: 10px 5px 10px 5px">
        <!-- a href="#" class="close" data-dismiss="alert">&times;</a-->
        <p align="justify">This <strong>Referral</strong> should be reviewed and validated by a 
        <strong>Technical Manager</strong> before notifying another laboratory for acceptance.
        <br/><br/><strong>The Technical Manager</strong> is required to supply a validation password.
        </p>
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
		<?php //echo $form->labelEx($model,'referralId'); ?>
		<?php echo $form->hiddenField($model,'referralId', array('style'=>'width: 205px;', 'value'=>$referralId)); ?>
		<?php //echo $form->error($model,'referralId'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'technicalManager'); ?>
		<?php echo $form->dropDownList($model,'technicalManager', Users::listData(), array('style'=>'width: 220px;')); ?>
		<?php echo $form->error($model,'technicalManager'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'managerPassword'); ?>
		<?php echo $form->passwordField($model,'managerPassword', array('style'=>'width: 205px;')); ?>
		<?php echo $form->error($model,'managerPassword'); ?>
	</div>
	
	<?php if(Yii::app()->user->hasFlash('error')): ?>
	    <div class="alert alert-warning" style="width:310px; margin: 10px 5px 10px 5px">
        
        <strong> <?php echo Yii::app()->user->getFlash('error'); ?> </strong> <br/>
        Error Message: <br/><strong> <?php echo Yii::app()->user->getFlash('errormessage'); ?></strong> 
		</div>
	<?php endif; ?>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Validate', array('class'=>'btn btn-info')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
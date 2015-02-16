<?php
/* @var $this DepositController */
/* @var $model Deposit */
/* @var $form CActiveForm */
?>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'deposit-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	//'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model);?>
	<div class="row">
		<?php echo $form->labelEx($model,'depositType'); ?>
		<?php //echo $form->textField($model,'depositType'); ?>
		<?php echo $form->dropDownList($model,'depositType', 
			array('0'=>'Bureau of Treasury', '1'=>'Project'),
			array(
				'empty'=>'',
						'ajax'=>array(
							'type'=>'POST',
							'url'=>$this->createUrl('deposit/updateDropdown'),
							'dataType'=>'json',
							'data'=>'js:$(this).serialize()',
							'success'=>'js:function(data){
										$("#Deposit_orseries_id").html(data.orseries);
										$("#Deposit_startOr").val("");
										$("#Deposit_endOr").val("");
										$("#Deposit_amount").val("");
									}'
									  )
					)
			);
		?>
		<?php echo $form->error($model,'depositType'); ?>
	</div>
	<div class="row">
    	<?php $loaderImg = CHtml::image(Yii::app()->request->baseUrl . '/images/loading.gif');?>
		<?php echo $form->labelEx($model,'orseries_id'); //echo $model->depositType;?>
        <?php $orseries=Orseries::listData($model->depositType, true);?>
		<?php echo $form->dropDownList($model,'orseries_id', $orseries,//Orseries::listData(), 
					array(
						'empty'=>'',
						'ajax'=>array(
									'type'=>'POST',
									'url'=>$this->createUrl('deposit/updateDropdown'),
									'dataType'=>'json',
									'data'=>"js:$(this).serialize()+'&depositType='+ $('#Deposit_depositType').val()",
									'success'=>'js:function(data){
										if(data){
											$("#Deposit_startOr").val(data.startOr);	
											$("#Deposit_endOr").html(data.lastOr);
											$(".loader-img").html("");
										}
									}',
									'beforeSend'=>'function(jqXHR, settings){
										$(".loader-img").html(\'<span>'.$loaderImg.'</span>\');
								 	}',

								),
					)); ?> <span class="loader-img"></span>
		<?php echo $form->error($model,'orseries_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'startOr'); ?>        
		<?php echo $form->textField($model,'startOr', 
				array(	
						'readonly'=>true,
						'onblur'=>'{orTotal();}',
						//'value'=>$model->startOr ? $model->startOr : $model->getFirstOr($depositType)
				)); 
		?>
		<?php echo CHtml::checkBox('override');?>
		<?php echo $form->error($model,'startOr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'endOr'); ?>
		<?php echo CHtml::textField('endOrOverride', $model->endOr, array('onblur'=>'{orTotal();}')); ?>
        <?php //echo $form->textField($model,'endOr', array('onblur'=>'{orTotal();}')); ?>
		<?php /*echo CHtml::dropDownList('endOr', $select,
				   CHtml::listData($model->getLastOr($depositType), 'index', 'receipt'),
				   array(
						'ajax'=>array(
							'type'=>'POST',
				   			'dataType'=>'json',
							'url'=>$this->createUrl('deposit/orTotal'),
							'success'=>'js:function(data){
									$("#Deposit_amount").val(data.total);
								}'
						)
						)
				   );*/
				if($model->orseries_id){
					$receipt = Receipt::model()->findByAttributes(array('receiptId'=>$model->startOr));
					$modelReceipts = Receipt::model()->findAll(array(
					'condition' => 'id >= :id AND orseries_id = :orseriesId AND rstl_id = :rstl_id',
					'params' => array(':id' => $receipt->id, ':orseriesId' => $model->orseries_id, 
										':rstl_id'=> Yii::app()->Controller->getRstlId()),
					));
					$endOr = CHtml::listdata($modelReceipts, 'receiptId', 'receiptId');
				}else{
					$endOr = array($model->endOr=>$model->endOr);
				}
					
				echo $form->dropDownList($model, 'endOr',
				   $endOr, //data empty
				   array(
						'ajax'=>array(
							'type'=>'POST',
				   			'dataType'=>'json',
							'url'=>$this->createUrl('deposit/orTotal'),
							'success'=>'js:function(data){
									$("#Deposit_amount").val(data.total);
								}'
						)
						)
				   );				   
		?>
		<?php echo $form->error($model,'endOr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'depositDate'); ?>
		<?php //echo $form->textField($model,'depositDate'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'name'=>'Deposit[depositDate]',
						'value'=>$model->depositDate ? date('m/d/Y',strtotime($model->depositDate)) : date('m/d/Y'),
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
		<?php echo $form->error($model,'depositDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount',array('readonly'=>true)); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-info')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
	$("#endOrOverride").hide();

	$("#override").click(function(){
		//alert($(this).attr('checked'));
		if($(this).attr('checked') == 'checked'){
			$("#Deposit_startOr").removeAttr('readonly');
			$("#endOrOverride").toggle();
			$("#Deposit_endOr").toggle();
		}else{
			$("#Deposit_startOr").attr('readonly','readonly');
			$("#endOrOverride").toggle();
			$("#Deposit_endOr").toggle();
		}
	});

	function orTotal(){
		<?php 
				echo CHtml::ajax(array(
						'url'=>$this->createUrl('deposit/orTotal'),
						'data'=> "js:$('#deposit-form').serialize()",
			            'type'=>'post',
			            'dataType'=>'json',
			            'success'=>"function(data)
			            {
			                $('#Deposit_amount').val(data.total);
			            }",
			            ))?>;
			    return false;
	}
</script>
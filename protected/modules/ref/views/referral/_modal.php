<?php //echo uniqid(strtolower(php_uname('n'))).date('mdy'); ?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'result-form',
	//'action'=>$this->createUrl('incomingAction/send',array('id'=>$id,'code'=>$doccode)),
	'action'=>$this->createUrl('referral/sendResult',array('id'=>$_GET['id'])),
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		/*
		'afterValidate'=>'js:function($form,data,hasError){
			if(!hasError){
				$("#IncomingTodoFiles_filename").uploadifyUpload();
				return true;
				}
				
			}'*/
		),
)); ?>

	<!--p class="note">Fields with <span class="required">*</span> are required.</p-->

	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->hiddenField($model,'referral_id', array('value'=>$_GET['id']))?>

<div class="uiButton">
<div class="MultiFile-wrapper">
	<table class="uiGrid">
	<tr class="overlay"> 
        <?php
		  $this->widget('CMultiFileUpload', array(
		  	 'id'=>'upload-actions',
			 'model'=>$model,
			 'name'=>'uploadFile',
			 //'attribute'=>'files',
			 'max'=>'10',
			 //'remove'=>Yii::t('ui',CHtml::image(Yii::app()->request->baseUrl.'/images/cancel.png','Remove')),
			 'remove'=>Yii::t('ui',CHtml::image(Yii::app()->request->baseUrl.'/images/cancel.png','Remove', array('class'=>'remove-upload'))),
			 //'accept'=>'pdf|doc|docx|xls|xlsx|ppt|pptx|txt|jpg|gif|png',
			 'accept'=>'pdf|jpg|png',
			 'denied'=>'File type is not allowed.',
			 'duplicate'=>'File already on queue.',
			 'options'=>array(
			 	'class'=>'button-blue',
				//'onFileSelect'=>'function(e, v, m){ alert("onFileSelect - "+v) }',
				//'afterFileSelect'=>'function(e, v, m){ alert("afterFileSelect - "+v) }',
				//'onFileAppend'=>'function(e, v, m){ alert("onFileAppend - "+v) }',
				//'afterFileAppend'=>'function(e, v, m){ alert("afterFileAppend - "+v) }',
				//'onFileRemove'=>'function(e, v, m){ alert("onFileRemove - "+v) }',
				//'afterFileRemove'=>'function(e, v, m){ alert("afterFileRemove - "+v) }',
			 ),
		  ));
		?>
        <td class="overlayLink">
        <div class="attach-border">
			<div class="attach"><a>Attach File</a></div>
        </div>
        </td>
		<td class="overlayButtons">
		<?php echo CHtml::submitButton($model->id ? 'Send' : 'Save', 
					array('class'=>'btn btn-primary'));
        ?>
		<?php echo CHtml::ajaxSubmitButton("Cancel",'#',array('method' => 'POST'),
							  array('class'=>'btn btn-grey',
							  		'onClick'=>'{$("#dialogAddResult").dialog("close"); return false;}',						
							  )
							  );?>
        <!--/div-->
		</td>
	</tr>
    </table>
</div>
</div>
	
<?php $this->endWidget(); ?>

</div><!-- form -->
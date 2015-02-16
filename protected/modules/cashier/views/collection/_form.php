<?php
/* @var $this CollectionController */
/* @var $model Collection */
/* @var $form CActiveForm */
Yii::app()->clientscript->scriptMap['jquery.js'] = false;
Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'collection-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->hiddenField($model,'id')?>
	<?php echo $form->hiddenField($model,'request_id'); ?>

	<div class="row">
		<?php if($receipt->collectionType == 1 || $receipt->collectionType == 2 || $receipt->collectionType == 11):?>
			<?php /*$this->widget('ext.select2.ESelect2', array(
	            'selector' => '#Collection_nature',
	            //'model'=>$model,
				//'attribute'=>'nature',
	            'options'  => array(
						'width'=>'268px',
	                    'allowClear'=>true,
	                    'placeholder'=>'Enter/Search Request Reference...',
	                    //'minimumInputLength' => 4,
	                    'ajax' => array(
	                            'url' => $this->createUrl('collection/searchRequest'),
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
						'initSelection'=>'js:function(element,callback){
											var data={id:"'.$model->id.'",text:"'.$model->nature.'"};
											callback(data);
										}',
	            ),
	            'events' =>array('change'=>'js:function(e) 
			                    { 
			                       data = $(this).select2("data");
			                       $("#Collection_request_id").val(data.id);
			                       $("#Collection_nature").val(data.text);
			                       $("#Collection_amount").val(data.total);
			                    }
			                    '
			            ),
	          ));*/?>
              
        <?php
		
		?>
		<?php endif;?>
		        
		<?php echo $form->labelEx($model,'nature'); ?>
        <?php $loaderImg = CHtml::image(Yii::app()->request->baseUrl . '/images/loading.gif');?>
        <?php if($receipt->collectionType == 1 || $receipt->collectionType == 2 || $receipt->collectionType == 11){
			$requests=Request::listDataUnpaid($model);
			$this->widget('ext.select2.ESelect2',array(
			  	'model'=>$model,
			  	'attribute'=>'nature',
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
							$('#Collection_amount').removeClass('loader-img gray-text');
							if(data){
								$('#Collection_amount').val(data.balance);
								$('#Collection_request_id').val(data.id);
							}else{
								$('#Collection_amount').val('0.00');
							}
						}",
						'beforeSend'=>'function(jqXHR, settings){
							$("#Collection_amount").val("Computing...");
							$("#Collection_amount").addClass("loader-img gray-text");
					 	}',

					)),
				),

			));			
		?>
		<?php }else{
			echo $form->textField($model,'nature',array(
						'value'=>$model->isNewRecord ? $receipt->typeOfCollection->natureOfCollection : $model->nature,
						'size'=>50,
						'maxlength'=>50
					)); 
			
			}?>
		<?php echo $form->error($model,'nature'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount'); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-info')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
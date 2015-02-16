<?php
/* @var $this SampleController */
/* @var $model Sample */
/* @var $form CActiveForm */
Yii::app()->clientscript->scriptMap['jquery.js'] = false;
Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
?>

<div class="form">
<?php
	if (isset($modelSample->request_id)){ 
		//$id=$modelSample->request_id;
	}else{
		$id=$requestId;
	}
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sample-form',
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
		<?php //echo $form->labelEx($model,'sampleCode'); ?>
		<?php //echo $form->textField($model,'sampleCode',array('size'=>20,'maxlength'=>20)); ?>
		<?php //echo $form->error($model,'sampleCode'); ?>
	</div>

	<div class="row">
		<?php 
		$this->widget('ext.select2.ESelect2',array(
          //'model'=>$model,
          'name'=>'sampleName',
          'data'=>Samplename::listData(),
          'options'=>array(
                'width'=>'268px',
                'allowClear'=>true,
				'minimumInputLength'=>2,
                'placeholder'=>'Search sample template here...',
            ),
          'events' =>array('change'=>'js:function(e) 
                    { 
                       data = $(this).select2("data");
                       $("#Sample_sampleName").val(data.text);
                       $("#Sample_description").val($(this).select2("val"));
                    }
                    '
            ),
        ));
		/*
        $this->widget('ext.select2.ESelect2',
                      array(
                           //'selector' => "#" . $id,
                           'name'=>'aris',
                      		'data'=>Samplename::listData(),
                           'options'  => array(
                               'width'              => '100%',
                               'height'             => '500px',
                               'placeholder'        => 'Search Media File',
                               'minimumInputLength' => 0,
                               'ajax'               => array(
                                   'url'      => Yii::app()->controller->createUrl('sample/getSamplename'),
                                   'dataType' => 'jsonp',
                                   'data'     => 'js: function(term,page) {
                                                        return {
                                                            q: term,
                                                            page_limit: 10,
                                                        };
                                                  }',
                                   'results'  => 'js: function(data,page){
                                                      return {results: data};
                                                  }',
                               ),
                               'formatResult'       => 'js:function(data){
                                    var markup = "<table class=\"data-result\"><tr>";
                                    if (data.image !== undefined) {
                                        markup += "<td class=\"data-image\">" + data.image + "</td>";
                                    }
                                    markup += "<td class=\"data-info\"><div class=\"data-title\">" + data.title + "</div>";
                                    markup += "</td></tr></table>";
                                    return markup;
                                }',
                               'formatSelection'    => 'js: function(data) {
                                    return data.title;
                                }',
                               'initSelection'      => 'js: function(element, callback) {
                                    var elementText = $(element).data("init-text");
                                    callback({"title":elementText});
                               }'
                           ),
                      ));*/
		?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'sampleName'); ?>
		<?php echo $form->textField($model,'sampleName', array('style'=>'width: 255px;')); ?>
		<?php /*$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'model'=>$model,
				'attribute'=>'sampleName',
				//'id'=>'Sample_sampleName',
				//'name'=>'Sample_sampleName',
			    'source'=>$this->createUrl('sample/searchSample'),
			    'options'=>array(
			        //'delay'=>300,
			        'focus'=>'',
			        'minLength'=>1,
			        'showAnim'=>'fold',
					'select'=>'js:function(event, ui) 
						{ 
							//$("#Request_customerId").val(ui.item.id); // assign customerId to hidden field
							//$("#sample").val(ui.item.name);
							//$("#Sample_description").val(ui.item.description);
						}'
			    ),
			    'htmlOptions'=>array(
			    	//'placeholder'=>'enter sample keywords here...',
			    	'style'=>'width:255px;'
			    ),
			    
			));*/
			
		/** Working **/
		/*
			$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			    'model'=>$model,
				'attribute'=>'sampleName',
			    'source'=>'js: function(request, response) {
			    $.ajax({
			        url: "'.$this->createUrl('sample/searchSample').'",
			        dataType: "json",
			        data: {
			            term: request.term,
			            brand: $("#type").val()
			        },
			        success: function (data) {
			            response(data);
			        }
			    })
			}',
			'options' => array(
			    'showAnim' => 'fold',
				'open'=> 'js:function(e, ui) {$(".ui-menu-item").css("background-color","#CCEEFF");}',
			    'select' => 'js:function(event, ui){ alert(ui.item.value) }',
			),
			'htmlOptions' => array(
			    //'onClick' => 'document.getElementById("test1_id").value=""',
			    'style'=>'width:255px;'
			)
			));
		*/
		
		?>
		<?php echo $form->error($model,'sampleName'); ?>
		<?php /*$this->widget('zii.widgets.jui.CJuiAutoComplete',array(
			        'name' => 'doctor',
			        'id'  => 'auto',
			        'source' =>  $this->createUrl('sample/searchSample'),
			        'value'=>$dname,
			        'options' => array(
			        'showAnim' => 'fold',
			        'autoFill'=>true,
			        'minLength'=>'0',
			
			        'select'=>"js:function(event, ui) {
			                   $('#Model_name').val(ui.item.id).change();
			                   $('#Model_department').val(ui.item.name).change();
			
			
			                                    }"
			        ),
			        'htmlOptions'=>array(
			        'id'=>'auto',
			
			  ),
			  ));*/?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'remarks'); ?>
		<?php //echo $form->Dropdownlist($model,'remarks',array()); ?>
		<?php //echo $form->error($model,'remarks'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50, 'style'=>'width: 255px;')); ?>
		<?php echo $form->error($model,'description'); ?>
		<?php echo CHtml::checkBox('saveAsTemplate', //$form->checkBox($model,'discount',
			array(
					//'template'=>'{input} {label}',
					//'separator'=>'',
					//'style' =>"",
					'classname'=>'saveTemplate'
					)
			); ?>
		<?php echo "Save Template";?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'remarks'); ?>
		<?php //echo $form->textField($model,'remarks',array('size'=>60,'maxlength'=>150)); ?>
		<?php //echo $form->error($model,'remarks'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'requestId'); ?>
		<?php echo $form->hiddenField($model,'requestId',array('value'=>$model->isNewRecord ? $request->requestRefNum : $model->requestId,'size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'requestId'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'request_id'); ?>
		<?php echo $form->hiddenField($model,'request_id', array('value'=>$model->isNewRecord ? $id : $model->request_id)); ?>
		<?php //echo $form->error($model,'request_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'sampleMonth'); ?>
		<?php echo $form->hiddenField($model,'sampleMonth',array('value'=>$model->isNewRecord ? date('m', strtotime($request->requestDate)) : $model->sampleMonth)); ?>
		<?php //echo $form->error($model,'sampleMonth'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'sampleYear'); ?>
		<?php echo $form->hiddenField($model,'sampleYear',array('value'=>$model->isNewRecord ? date('Y', strtotime($request->requestDate)) : $model->sampleYear)); ?>
		<?php //echo $form->error($model,'sampleYear'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'cancelled'); ?>
		<?php //echo $form->textField($model,'cancelled'); ?>
		<?php //echo $form->error($model,'cancelled'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
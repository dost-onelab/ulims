<?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'lab-grid',
        'summaryText'=>false,
		'htmlOptions'=>array('class'=>'grid-view padding0'),
        'itemsCssClass'=>'table table-striped table-bordered table-condensed',
        //'rowHtmlOptionsExpression' => 'array("title" => "Click to view details", "class"=>"link-hand")',
        'dataProvider'=>$activeLabDataProvider,
        'columns'=>array(
            //'id',
            //'labName',
            array(
            	'name'=>'labName',
            	'type'=>'raw',
            	'value'=>'$data->labName',
            	'htmlOptions' => array('style' => 'text-align: left; ')
            ),
			//'labCode',
			array(
            	'name'=>'labCode',
            	'htmlOptions' => array('style' => 'text-align: center; ')
            ),
            array(
            	'name'=>'nextRequestCode',
            	'type'=>'raw',
            	'value'=>'Lab::checkIfInitialized($data)',
            	//'value'=>'count($data->initializeCode) ? Request::generateRequestRef($data->id) : "Initialize"',
            	'htmlOptions' => array('style' => 'text-align: center; ')
            ),
           	array(
			//'class'=>'CButtonColumn',
			'header'=>'Status',
           	'htmlOptions'=>array('class'=>'btn-group btn-group-yesno'),
			'class'=>'bootstrap.widgets.TbButtonColumn',
						//'deleteConfirmation'=>"js:'Do you really want to delete sample: '+$.trim($(this).parent().parent().children(':nth-child(2)').text())+'?'",
						'template'=>'{active}{not active}',
						'buttons'=>array
						(
							'active' => array(
								'label'=>'Active',
								'url'=>'Yii::app()->createUrl("/config/activateLab/id/$data->id")',
								'options' => array(
									'class'=>'$data->status ? "btn active btn-success" : "btn"',
									//'confirm'=>'Do you want to set this Lab as Active?',
									'ajax' => array(
										'type' => 'get',
										'url'=>'js:$(this).attr("href")', 
										'success' => 'js:function(data) { $.fn.yiiGridView.update("lab-grid"); $.fn.yiiGridView.update("labmanager-grid")}')
									),
								),
							'not active' => array(
								'label'=>'Inactive',
								'url'=>'Yii::app()->createUrl("/config/deactivateLab/id/$data->id")',
								'options' => array(
									'class'=>'$data->status ? "btn" : "btn active btn-danger"',
									//'confirm'=>'Do you want to set this Lab as Inactive?',
									'ajax' => array(
										'type' => 'get', 
										'url'=>'js:$(this).attr("href")', 
										'success' => 'js:function(data) { $.fn.yiiGridView.update("lab-grid"); $.fn.yiiGridView.update("labmanager-grid")}')
									),
								),
						),
			)
            ),
)); ?>

<!-- Initialize Code Dialog : Start -->
<?php
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		    'id'=>'dialogInitializeCode',
		    // additional javascript options for the dialog plugin
		    'options'=>array(
		        'title'=>'Initialize this Laboratory',
				'show'=>'scale',
				'hide'=>'scale',				
				'width'=>250,
				'modal'=>true,
				'resizable'=>false,
				'autoOpen'=>false,
			    ),
		));

	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<!-- Initialize Code Dialog : End -->

<script type="text/javascript">
function initializeCode(id)
{
    <?php echo CHtml::ajax(array(
			'url'=>$this->createUrl('lab/initializecode/create'),
			'data'=> "js:$(this).serialize()+ '&lab_id='+id",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
					$('#dialogInitializeCode').html(data.div);
                    // Here is the trick: on submit-> once again this function!
                    $('#dialogInitializeCode form').submit(initializeCode);
                }
                else
                {
					$.fn.yiiGridView.update('lab-grid');
					$('#dialogInitializeCode').html(data.div);
					setTimeout(\"$('#dialogInitializeCode').dialog('close') \",1000);
                }
 
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogInitializeCode").html(
						\'<div class="loader">'.$image.'<br\><br\>Processing.<br\> Please wait...</div>\'
					);
             }',
			 'error'=>"function(request, status, error){
				 	$('#dialogInitializeCode').html(status+'('+error+')'+': '+ request.responseText );
					}",
			
            ))?>;
    return false;	
}
</script>
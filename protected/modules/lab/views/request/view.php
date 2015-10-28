<div style="position:relative">
<?php 
/* @var $this RequestController */
/* @var $model Request */

if($model->cancelled)
	$this->renderPartial('_cancelled',array('model'=>$model->cancelDetails));
	
$this->breadcrumbs=array(
	'Requests'=>array('index'),
	$model->id,
);

$this->menu=array(
	//array('label'=>'List Request', 'url'=>array('index')),
	//array('label'=>'Create Order of Payment', 'url'=>array('createOP')),
	array('label'=>'Create Request', 'url'=>array('create')),
	array('label'=>'Update Request', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete Request', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Request', 'url'=>array('admin')),
);  
?>

<?php $linkCancelWithReason = CHtml::link('<span class="icon-white icon-minus-sign"></span> Cancel Request', '', array( 
			'style'=>'cursor:pointer;',
			'class'=>'btn btn-danger btn-small',
			'onClick'=>'js:{
					if('.$generated.'>0){
						alert("Cannot cancel this Request. If you set the wrong Laboratory when creating this Request, \nleave this Request for now and create a new one with the correct Laboratory.");
					}else{
						cancelRequest(); 
						$("#dialogCancel").dialog("open");					
					}
				}',
			));
?>
<h1>View Request: <?php echo $model->requestRefNum; ?><small>
<?php //echo $model->cancelled ? '' : (Yii::app()->getModule('lab')->isLabAdmin() ? $linkCancelWithReason : '');?>
<?php echo $model->cancelled ? '' : (Yii::app()->getModule('lab')->isLabAdmin() ? $linkCancelWithReason : '');?>
</small>
</h1>

<?php $this->widget('ext.widgets.DetailView4Col', array(
	'cssFile'=>false,
	'htmlOptions'=>array('class'=>'detail-view table table-striped table-condensed'),
	'data'=>$model,
	'attributes'=>array(
		array(
            'name'=>'requestDetails',
            'oneRow'=>true,
			'cssClass'=>'title-row',
            'type'=>'raw',
            'value'=>'',
        ),	
		'requestRefNum', 'customer.customerName',
		'requestDate', 'customer.completeAddress',
		'requestTime', 'customer.tel',
		'reportDue', 'customer.fax',
		array(
            'name'=>'paymentDetails',
			'cssClass'=>'title-row',
            'oneRow'=>true,
            'type'=>'raw',
            'value'=>'',
        ),
		array(
			'name'=>'orId',
			'type'=>'raw',
			'value'=>Request::getORs($model->receipts)),
		'collection',
		array(
			'name'=>'orDate',
			'type'=>'raw',
			'value'=>Request::getORDates($model->receipts)),
			//'value'=>$model->analysisTotal),
		array(
			'name'=>'balance',
			'type'=>'raw',
			'value'=>Request::getBalance($model->total, $model->collection)),
		array(
            'name'=>'transactionDetails',
            'oneRow'=>true,
			'cssClass'=>'title-row',
            'type'=>'raw',
            'value'=>'',
        ),
        'receivedBy',
		'conforme',
		
	),
)); ?>

<div class="addSample">
<?php
	$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>"<b>Testing or Calibration Services</b>",
	));	
?>
<h4 class="paddingLeftRight10">Samples
<small>
<?php
	$linkSample = Chtml::link('<span class="icon-white icon-plus-sign"></span> Add Sample', '', array( 
			'style'=>'cursor:pointer;',
			'class'=>'btn btn-info btn-small',
			'onClick'=>$model->cancelled ? 'return false' : 'js:{addSample(); $("#dialogSample").dialog("open");}',
			'disabled'=>$model->cancelled
			));
	echo ($generated >= 1) ? $linkSample : '';
?>
</small>
</h4>
</div>

<?php
    $this->widget('zii.widgets.grid.CGridView', array(
    	'id'=>'sample-grid',
	    'summaryText'=>false,
		'emptyText'=>'No samples.',
		'htmlOptions'=>array('class'=>'grid-view padding0 paddingLeftRight10'),
        'rowCssClassExpression'=>'$data->status',
		'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
		'rowHtmlOptionsExpression' => 'array("title" => "Click to update", "class"=>"link-hand")', 
        //It is important to note, that if the Table/Model Primary Key is not "id" you have to
        //define the CArrayDataProvider's "keyField" with the Primary Key label of that Table/Model.
        'dataProvider' => $sampleDataProvider,
        'columns' => array(
    		array(
				'name'=>'SAMPLE CODE',
				'value'=>'$data->sampleCode',
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'width: 125px; padding-left: 10px; text-align: center;'),
			),
    		array(
				'name'=>'SAMPLE NAME',
				'value'=>'$data->sampleName',
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'width: 250px; padding-left: 10px;'),
			),
    		array(
				'name'=>'DESCRIPTION',
				'value'=>'$data->description',
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'padding-left: 10px;'),
			),
			array(
			'header'=>'Cancel',
			'class'=>'bootstrap.widgets.TbButtonColumn',
						'deleteConfirmation'=>"js:'Do you really want to delete sample: '+$.trim($(this).parent().parent().children(':nth-child(2)').text())+'?'",
						'template'=>($generated >= 1) ? '{delete}' : (Yii::app()->getModule('lab')->isLabAdmin() ? '{cancel}' : ''),
						'buttons'=>array
						(
							'delete' => array(
								'label'=>'Delete Sample',
								'url'=>'Yii::app()->createUrl("lab/sample/delete/id/$data->id")',
								),
							'cancel' => array(
								'label'=>'Cancel',
								'url'=>'Yii::app()->createUrl("lab/sample/cancel/id/$data->id")',
								'options' => array(
									'confirm'=>'Are you want to cancel Sample?',
									'ajax' => array(
										'type' => 'get', 
										'url'=>'js:$(this).attr("href")', 
										'success' => 'js:function(data) { $.fn.yiiGridView.update("sample-grid")}')
									),
								),
						),
			),
        ),
    ));
    ?>

<h4 class="paddingLeftRight10">Analyses
<small>
<?php 
	$linkAnalysis = Chtml::link('<span class="icon-white icon-plus-sign"></span> Add Analyses', '', array( 
			'style'=>'cursor:pointer;',
			'onClick'=>$model->cancelled ? 'return false' : 'js:{addAnalysis(); $("#dialogAnalysis").dialog("open");}',
			'class'=>'btn btn-info btn-small',
			'disabled'=>$model->cancelled
			));
	$linkPackage = Chtml::link('<span class="icon-white icon-plus-sign"></span> Add Package', '', array( 
			'style'=>'cursor:pointer;',
			'onClick'=>$model->cancelled ? 'return false' : 'js:{addPackage(); $("#dialogPackage").dialog("open");}',
			'class'=>'btn btn-info btn-small',
			'disabled'=>$model->cancelled
			));	
	echo ($generated >= 1) ? $linkAnalysis : (Yii::app()->getModule('lab')->isLabAdmin() ? $linkAnalysis : '');
	echo " ";
	echo ($generated >= 1) ? $linkPackage : (Yii::app()->getModule('lab')->isLabAdmin() ? $linkPackage : '');
?>
</small></h4>
<?php
    $this->widget('zii.widgets.grid.CGridView', array(
    	'id'=>'analysis-grid',
	    'summaryText'=>false,
		'emptyText'=>'No analyses.',
		'htmlOptions'=>array('class'=>'grid-view padding0 paddingLeftRight10'),
		'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
		'rowHtmlOptionsExpression' => 'array("title" => "Click to update", "class"=>"link-hand")', 
        //It is important to note, that if the Table/Model Primary Key is not "id" you have to
        //define the CArrayDataProvider's "keyField" with the Primary Key label of that Table/Model.
        'dataProvider' => $analysisDataProvider,
        'columns' => array(
            //'sample.sampleName',
    		array(
				'name'=>'SAMPLE',
				'value'=>'$data->sample->sampleName',
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'width: 100px; padding-left: 10px;'),
			),
           	//'sampleCode',
			array(
				'name'=>'SAMPLE CODE',
				'value'=>'$data->sampleCode',
				'type'=>'raw',
				'htmlOptions' => array('style' => 'width: 100px; text-align: center;'),
			),
    		//'testName',
			array(
				'name'=>'TEST / CALIBRATION REQUESTED',
				'value'=>'($data->package == 1) ? "&nbsp;&nbsp;".$data->testName : $data->testName',
				'type'=>'raw',
				'htmlOptions' => array('style' => 'padding-left: 10px;'),
			),
    		//'method',
    		array(
				'name'=>'TEST METHOD',
				'value'=>'$data->method',
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'padding-left: 10px;'),
			),
    		//'quantity',
    		array(
				'name'=>'QUANTITY',
				'value'=>'($data->package == 1) ? "-" : $data->quantity',
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'width: 50px; text-align: center;'),
    			'footer'=>'SUBTOTAL<br/>DISCOUNT<br/><b>TOTAL</b>',
    			'footerHtmlOptions'=>array('style'=>'text-align: right; padding-right: 10px;'),
			),
    		//'fee'
    		array(
				'name'=>'UNIT PRICE',
				//'value'=>'Yii::app()->format->formatNumber($data->fee)',
				'value'=>'($data->package == 1) ? "-" : Yii::app()->format->formatNumber($data->fee)',
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'width: 65px; text-align: right; padding-right: 10px;'),
    			'footer'=>
    					Yii::app()->format->formatNumber($model->getTestTotal($analysisDataProvider->getKeys())).
    					'<br/>'.
    					Yii::app()->format->formatNumber($model->getDiscount($analysisDataProvider->getKeys(), $model->discount)).
    					'<br/><b>'.
    					Yii::app()->format->formatNumber($model->getRequestTotal($analysisDataProvider->getKeys(), $model->discount)).
    					'</b>'
    					,
    					
    			'footerHtmlOptions'=>array('style'=>'text-align: right; padding-right: 10px;'),
			),
			array(
			//'class'=>'CButtonColumn',
			'header'=>'Actions',
			'class'=>'bootstrap.widgets.TbButtonColumn',
						'deleteConfirmation'=>"js:'Do you really want to delete analysis: '+$.trim($(this).parent().parent().children(':nth-child(3)').text())+'?'",
						'template'=>($generated >= 1) ? '{delete}' : (Yii::app()->getModule('lab')->isLabAdmin() ? '{cancel}' : ''),
						'buttons'=>array
						(
							'delete' => array(
								'label'=>'Delete Sample',
								'url'=>'Yii::app()->createUrl("lab/analysis/delete/id/$data->id")',
								'visible'=>'$data->package == 0'
								),
							'deletePackage' => array(
								'label'=>'Delete Package',
								'url'=>'Yii::app()->createUrl("lab/analysis/deletePackage/id/$data->id")',
								//'options'=>array('class'=>'Add 1 more'),
								'imageUrl'=>'',   
                				'imageUrl'=>Yii::app()->request->baseUrl.'/images/customer_add.png', 
								'visible'=>'$data->package == 1'
								),
							'cancel' => array(
								'label'=>'Cancel',
								'url'=>'Yii::app()->createUrl("lab/analysis/cancel/id/$data->id")',
								'options' => array(
									'confirm'=>'Are you want to cancel Analysis?',
									'ajax' => array('type' => 'get', 'url'=>'js:$(this).attr("href")', 'success' => 'js:function(data) { $.fn.yiiGridView.update("analysis-grid")}')
									),
								),
						),
			),
        ),
    ));
    ?>
<?php $this->endWidget(); //End Portlet ?>    

<div class="generated">
<?php /*echo $generated ? 'Print' : CHtml::ajaxLink(
		Yii::t('default','Generate Sample Code'),
		$this->createUrl('sample/generateSampleCode/',array('id'=>$model->id)), 
		array('success'=>'function(data){
				$.fn.yiiGridView.update("sample-grid");
                $.fn.yiiGridView.update("analysis-grid");
			}') 
		);*/
$image = CHtml::Image(Yii::app()->theme->baseUrl . '/img/page_white_excel.png', 'Print');
switch ($generated) {
	case 0:
		$this->widget('bootstrap.widgets.TbButtonGroup', array(
	        'type'=>'success', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
	        'buttons'=>array(
	            array('label'=>'Print Request', 'url'=>$this->createUrl('request/print',array('id'=>$model->id)), 'htmlOptions'=>array('target'=>(Yii::app()->params['FormRequest']['printFormat'] == 1) ? '' : '_blank')),
	            array('items'=>array(
	                array(	'label'=>'Excel', 'url'=>'#', 'active'=>Yii::app()->params['FormRequest']['printFormat'] == 1 ? true : false, 'linkOptions'=>array('onclick'=>'setPrintFormat("FormRequest", 1)')),
	                array(	'label'=>'PDF', 'url'=>'#', 'active'=>Yii::app()->params['FormRequest']['printFormat'] == 2 ? true : false, 'linkOptions'=>array('onclick'=>'setPrintFormat("FormRequest", 2)')),
	            )),
	        ),
	    ));
		//echo CHtml::link('<span class="icon-white icon-print"></span> Print Request', $this->createUrl('request/genRequestExcel',array('id'=>$model->id)), array('class'=>'btn btn-success'));
		/*echo '&nbsp;';
		echo CHtml::link('<span class="icon-white icon-print"></span> Print Sample Tags', $this->createUrl('request/genSampleTags',array('id'=>$model->id)), array('class'=>'btn btn-warning', 'disabled'=>'disabled'));*/
        break;
    case ($generated < 1):
		$this->widget('bootstrap.widgets.TbButtonGroup', array(
	        'type'=>'success', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
	        'buttons'=>array(
	            array('label'=>'Print Request', 'url'=>$this->createUrl('request/print',array('id'=>$model->id)), 'htmlOptions'=>array('target'=>(Yii::app()->params['FormRequest']['printFormat'] == 1) ? '' : '_blank')),
	            array('items'=>array(
	                array(	'label'=>'Excel', 'url'=>'#', 'active'=>Yii::app()->params['FormRequest']['printFormat'] == 1 ? true : false, 'linkOptions'=>array('onclick'=>'setPrintFormat("FormRequest", 1)')),
	                array(	'label'=>'PDF', 'url'=>'#', 'active'=>Yii::app()->params['FormRequest']['printFormat'] == 2 ? true : false, 'linkOptions'=>array('onclick'=>'setPrintFormat("FormRequest", 2)')),
	            )),
	        ),
	    ));
    	//echo CHtml::link('<span class="icon-white icon-print"></span> Print Request', $this->createUrl('request/genRequestExcel',array('id'=>$model->id)), array('class'=>'btn btn-success'));
		/*echo '&nbsp;';
		echo CHtml::link('<span class="icon-white icon-print"></span> Print Sample Tags', $this->createUrl('request/genSampleTags',array('id'=>$model->id)), array('class'=>'btn btn-success', 'disabled'=>'disabled'));*/
    	break;
    case 1:
		echo Chtml::link('<span class="icon-white icon-list"></span> Generate Sample Code', '', array(
			'id'=>'cancel-button',
			'title'=>'Generate Sample Code',
			'class'=>'btn btn-success',
			//'onClick'=>'js:{ generateSampleCode(); $("#dialogCancel").dialog("open");}',
			"onclick"=>$model->cancelled ? 'return false' : "if (!confirm('Do you really want to GENERATE Sample Codes with the current number of samples?')){return}else{ generateSampleCode(); $('#dialogSampleCode').dialog('open'); }",	
			));				
				
        break;
    case $generated > 1:
        echo '<p style="font-style: italic; font-weight: bold; color: red;">Generate Sample Codes from previous requests and refresh this page!</p>';
        break;
}		
?>
<br/><br/><br/>
</div>

<!-- Cancel Dialog : Start -->
<?php
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		    'id'=>'dialogCancel',
		    // additional javascript options for the dialog plugin
		    'options'=>array(
		        'title'=>'Cancel Request',
				'show'=>'scale',
				'hide'=>'scale',				
				'width'=>450,
				'modal'=>true,
				'resizable'=>false,
				'autoOpen'=>false,
			    ),
		));

	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<!-- Cancel Dialog : End -->

<!-- Sample Dialog : Start -->
<?php
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		    'id'=>'dialogSample',
		    // additional javascript options for the dialog plugin
		    'options'=>array(
		        'title'=>'Sample',
				'show'=>'scale',
				'hide'=>'scale',				
				'width'=>300,
				'modal'=>true,
				'resizable'=>false,
				'autoOpen'=>false,
			    ),
		));

	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<!-- Sample Dialog : End -->

<!-- Analysis Dialog : Start -->
<?php
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		    'id'=>'dialogAnalysis',
		    // additional javascript options for the dialog plugin
		    'options'=>array(
		        'title'=>'Analysis',
				'show'=>'scale',
				'hide'=>'scale',				
				'width'=>400,
				'modal'=>true,
				'resizable'=>false,
				'autoOpen'=>false,
			    ),
		));

	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<!-- Analysis Dialog : End -->

<!-- Package Dialog : Start -->
<?php
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		    'id'=>'dialogPackage',
		    // additional javascript options for the dialog plugin
		    'options'=>array(
		        'title'=>'Package',
				'show'=>'scale',
				'hide'=>'scale',				
				'width'=>400,
				'modal'=>true,
				'resizable'=>false,
				'autoOpen'=>false,
			    ),
		));

	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<!-- Package Dialog : End -->

<!-- SampleCode Dialog : Start -->
<?php
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		    'id'=>'dialogSampleCode',
		    // additional javascript options for the dialog plugin
		    'options'=>array(
		        'title'=>'Generate Sample Code',
				'show'=>'scale',
				'hide'=>'scale',				
				'width'=>400,
				'modal'=>true,
				'resizable'=>false,
				'autoOpen'=>false,
			    ),
		));

	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<!-- SampleCode Dialog : End -->

<!-- ConfirmGenerateSampleCode Dialog : Start -->
<?php
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		    'id'=>'dialogConfirmGenerate',
		    // additional javascript options for the dialog plugin
		    'options'=>array(
		        'title'=>'Confirm Generate',
				'show'=>'scale',
				'hide'=>'scale',				
				'width'=>400,
				'modal'=>true,
				'resizable'=>false,
				'autoOpen'=>false,
			    ),
		));
	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<!-- ConfirmGenerateSampleCode Dialog : End -->
<?php
$image = CHtml::image(Yii::app()->request->baseUrl . '/images/ajax-loader.gif');
Yii::app()->clientScript->registerScript('clkrowgrid', "
$('#sample-grid table tbody tr').live('click',function()
{
	    var id = $.fn.yiiGridView.getKey(
        'sample-grid',
        $(this).prevAll().length 
    	);
		if($(this).children(':nth-child(1)').text()=='No samples.'){
			alert($(this).children(':nth-child(1)').text());
	   		//alert(id);
		}else{
			updateSample(id);
			$('#dialogSample').dialog('open');
		}
});
");

Yii::app()->clientScript->registerScript('clkrowgrid2', "
$('#analysis-grid table tbody tr').live('click',function()
{
	    var id = $.fn.yiiGridView.getKey(
        'analysis-grid',
        $(this).prevAll().length 
    	);
		if($(this).children(':nth-child(1)').text()=='No analyses.'){
			alert($(this).children(':nth-child(1)').text());
	   		//alert(id);
		}else{
			updateAnalysis(id);
			$('#dialogAnalysis').dialog('open');
		}
});
");
?> 

</div>
<script type="text/javascript">
function cancelRequest()
{
    <?php echo CHtml::ajax(array(
			'url'=>$this->createUrl('cancelledrequest/create',array('id'=>$model->id, 'requestRefNum'=>$model->requestRefNum)),
			'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#dialogCancel').html(data.div);
                    // Here is the trick: on submit-> once again this function!
                    $('#dialogCancel form').submit(cancelRequest);
                }
                else
                {
                    $.fn.yiiGridView.update('sample-grid');
	                $.fn.yiiGridView.update('analysis-grid');
	                location.reload();
					$('#dialogCancel').html(data.div);
                    setTimeout(\"$('#dialogSample').dialog('close') \",1000);
					
                }
 
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogCancel").html(
						\'<div class="loader">'.$image.'<br\><br\>Processing...<br\> Please wait...</div>\'
					);
             }',
			 'error'=>"function(request, status, error){
				 	$('#dialogCancel').html(status+'('+error+')'+': '+ request.responseText );
					}",
			
            ))?>;
    return false; 
}

function cancelDetails(id)
{
	<?php 
	echo CHtml::ajax(array(
			'url'=>$this->createUrl('cancelledrequest/update'),
			'data'=> "js:$(this).serialize()+ '&id='+id",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#dialogCancel').html(data.div);
                    // Here is the trick: on submit-> once again this function!
                    $('#dialogCancel form').submit(cancelDetails);
                }
                else
                {
                    //$.fn.yiiGridView.update('sample-grid');
                    //$.fn.yiiGridView.update('analysis-grid');
					$('#dialogCancel').html(data.div);
                    setTimeout(\"$('#dialogSample').dialog('close') \",1000);
                }
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogCancel").html(
						\'<div class="loader">'.$image.'<br\><br\>Processing...<br\> Please wait...</div>\'
					);
            }',
			 'error'=>"function(request, status, error){
				 	$('#dialogCancel').html(status+'('+error+')'+': '+ request.responseText+ ' {'+error.code+'}' );
					}",
            ))?>;
    return false; 
 
}

function addSample()
{
    <?php echo CHtml::ajax(array(
			'url'=>$this->createUrl('sample/create',array('id'=>$model->id, 'requestRefNum'=>$model->requestRefNum)),
			'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#dialogSample').html(data.div);
                    // Here is the trick: on submit-> once again this function!
                    $('#dialogSample form').submit(addSample);
                }
                else
                {
                    $.fn.yiiGridView.update('sample-grid');
					$('#dialogSample').html(data.div);
                    setTimeout(\"$('#dialogSample').dialog('close') \",1000);
					
                }
 
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogSample").html(
						\'<div class="loader">'.$image.'<br\><br\>Generating form.<br\> Please wait...</div>\'
					);
             }',
			 'error'=>"function(request, status, error){
				 	$('#dialogSample').html(status+'('+error+')'+': '+ request.responseText );
					}",
			
            ))?>;
    return false; 
}

function updateSample(id)
{
	<?php 
	echo CHtml::ajax(array(
			'url'=>$this->createUrl('sample/update'),
			'data'=> "js:$(this).serialize()+ '&id='+id",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#dialogSample').html(data.div);
                    // Here is the trick: on submit-> once again this function!
                    $('#dialogSample form').submit(updateSample);
                }
                else
                {
                    $.fn.yiiGridView.update('sample-grid');
                    $.fn.yiiGridView.update('analysis-grid');
					$('#dialogSample').html(data.div);
                    setTimeout(\"$('#dialogSample').dialog('close') \",1000);
                }
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogSample").html(
						\'<div class="loader">'.$image.'<br\><br\>Retrieving record.<br\> Please wait...</div>\'
					);
            }',
			 'error'=>"function(request, status, error){
				 	$('#dialogSample').html(status+'('+error+')'+': '+ request.responseText+ ' {'+error.code+'}' );
					}",
            ))?>;
    return false; 
 
}

function addAnalysis()
{
    <?php echo CHtml::ajax(array(
			'url'=>$this->createUrl('analysis/create',array('id'=>$model->id)),
			'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#dialogAnalysis').html(data.div);
                    // Here is the trick: on submit-> once again this function!
                    $('#dialogAnalysis form').submit(addAnalysis);
                }
                else
                {
                    $.fn.yiiGridView.update('analysis-grid');
					$('#dialogAnalysis').html(data.div);
                    setTimeout(\"$('#dialogAnalysis').dialog('close') \",1000);
					
                }
 
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogAnalysis").html(
						\'<div class="loader">'.$image.'<br\><br\>Generating form.<br\> Please wait...</div>\'
					);
             }',
			 'error'=>"function(request, status, error){
				 	$('#dialogAnalysis').html(status+'('+error+')'+': '+ request.responseText );
					}",
			
            ))?>;
    return false; 
}

function updateAnalysis(id)
{
	<?php 
	echo CHtml::ajax(array(
			'url'=>$this->createUrl('analysis/update'),
			'data'=> "js:$(this).serialize()+ '&id='+id",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#dialogAnalysis').html(data.div);
                    // Here is the trick: on submit-> once again this function!
                    $('#dialogAnalysis form').submit(updateAnalysis);
                }
                else
                {
                    $.fn.yiiGridView.update('analysis-grid');
					$('#dialogAnalysis').html(data.div);
                    setTimeout(\"$('#dialogAnalysis').dialog('close') \",1000);
                }
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogAnalysis").html(
						\'<div class="loader">'.$image.'<br\><br\>Retrieving record.<br\> Please wait...</div>\'
					);
            }',
			 'error'=>"function(request, status, error){
				 	$('#dialogAnalysis').html(status+'('+error+')'+': '+ request.responseText+ ' {'+error.code+'}' );
					}",
            ))?>;
    return false; 
 
}

function addPackage()
{
    <?php echo CHtml::ajax(array(
			'url'=>$this->createUrl('analysis/package',array('id'=>$model->id)),
			'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#dialogPackage').html(data.div);
                    // Here is the trick: on submit-> once again this function!
                    $('#dialogPackage form').submit(addPackage);
                }
                else
                {
                    $.fn.yiiGridView.update('analysis-grid');
					$('#dialogPackage').html(data.div);
                    setTimeout(\"$('#dialogPackage').dialog('close') \",1000);
					
                }
 
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogPackage").html(
						\'<div class="loader">'.$image.'<br\><br\>Generating form.<br\> Please wait...</div>\'
					);
             }',
			 'error'=>"function(request, status, error){
				 	$('#dialogPackage').html(status+'('+error+')'+': '+ request.responseText );
					}",
			
            ))?>;
    return false; 
}

function generateSampleCode()
{
	<?php
	echo CHtml::ajax(array(
			'url'=>$this->createUrl('sample/generateSampleCode',array('id'=>$model->id)),
			//'data'=> "js:$(this).serialize()+ '&id='+id",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#dialogSampleCode').html(data.div);
                    // Here is the trick: on submit-> once again this function!
                    //$('#dialogSampleCode form').submit(generateSampleCode);
                }
                else
                {
                    $.fn.yiiGridView.update('sample-grid');
                    $.fn.yiiGridView.update('analysis-grid');
					$('#dialogSampleCode').html(data.div);
                    setTimeout(\"$('#dialogSampleCode').dialog('close') \",1000);
					location.reload();
                }
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogSampleCode").html(
						\'<div class="loader">'.$image.'<br\><br\>Processing.<br\> Please wait...</div>\'
					);
            }',
			 'error'=>"function(request, status, error){
				 	$('#dialogSampleCode').html(status+'('+error+')'+': '+ request.responseText+ ' {'+error.code+'}' );
					}",
            ))?>;
    return false;
}

function confirmGenerateSampleCode()
{
	<?php
			echo CHtml::ajax(array(
					'url'=>$this->createUrl('sample/confirm',array('id'=>$model->id)),
		            'type'=>'post',
		            'dataType'=>'json',
		            'success'=>"function(data)
		            {
		                if (data.status == 'failure')
		                {
		                    $('#dialogConfirmGenerate').html(data.div);
		                    // Here is the trick: on submit-> once again this function!
		                    $('#dialogConfirmGenerate form').submit(confirmGenerateSampleCode);
		                }
		                else
		                {
							$('#dialogConfirmGenerate').html(data.div);
		                    setTimeout(\"$('#dialogConfirmGenerate').dialog('close') \",1000);
		                }
		            }",
					'beforeSend'=>'function(jqXHR, settings){
		                    $("#dialogConfirmGenerate").html(
								\'<div class="loader">'.$image.'<br\><br\>Retrieving record.<br\> Please wait...</div>\'
							);
		            }',
					 'error'=>"function(request, status, error){
						 	$('#dialogConfirmGenerate').html(status+'('+error+')'+': '+ request.responseText+ ' {'+error.code+'}' );
							}",
		            ))?>;
		    return false; 
}

function setPrintFormat(form, format)
{
	
	<?php
			echo CHtml::ajax(array(
					'url'=>$this->createUrl('/config/setPrintFormat'),
					'data'=> "js:$(this).serialize()+ '&form='+form+ '&format='+format",
					'type'=>'post',
		            'dataType'=>'json',
		            'success'=>"function(data)
		            	{
		            		location.reload();
		            	}"
		            ))?>;
			return false;
		    
}
</script>

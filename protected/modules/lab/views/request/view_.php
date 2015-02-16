<?php
/* @var $this RequestController */
/* @var $model Request */

$this->breadcrumbs=array(
	'Requests'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Request', 'url'=>array('index')),
	array('label'=>'Create Request', 'url'=>array('create')),
	array('label'=>'Update Request', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Request', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Request', 'url'=>array('admin')),
);  
?>

<?php $linkCancel = CHtml::ajaxLink(
				'<span class="icon-white icon-minus-sign"></span> Cancel',
				$this->createUrl('request/cancel/',array('id'=>$model->id)), 
				array('success'=>'function(data){
						$.fn.yiiGridView.update("sample-grid");
		                $.fn.yiiGridView.update("analysis-grid");
		                location.reload();
					}'),
				array(
					"onclick"=>"if (!confirm('Do you really want to Cancel this Request?')){return}",
					'class'=>'btn btn-danger btn-small'
				) 
				);
	/*$linkCancel = CHtml::ajaxLink(
				'<span class="icon-white icon-minus-sign"></span> Cancel',
				$this->createUrl('request/cancel/',array('id'=>$model->id)), 
				array('success'=>'function(data){
						$.fn.yiiGridView.update("sample-grid");
		                $.fn.yiiGridView.update("analysis-grid");
		                location.reload();
					}'),
				array(
					"onclick"=>"if (!confirm('Do you really want to Cancel this Request?')){return}",
					'class'=>'btn btn-danger btn-small'
				) 
				);*/
	
	/*$linkCancelDetails = Chtml::link('<span class="icon-white icon-search"></span> Cancel Details', '', array( 
			'style'=>'cursor:pointer;',
			'class'=>'btn btn-info btn-small',
			'onClick'=>'js:{cancelDetails('.$model->cancelDetails->id.'); $("#dialogCancel").dialog("open");}',
			));*/				
?>
<h1>View Request: <?php echo $model->requestRefNum; ?> <small><?php echo Yii::app()->getModule('lab')->isLabAdmin() ? $linkCancel : '';?></small></h1>

<?php //$this->widget('bootstrap.widgets.TbDetailView', array(
	$this->widget('ext.widgets.DetailView4Col', array(
	//$this->widget('zii.widgets.CDetailView', array(
	'cssFile'=>false,
	'htmlOptions'=>array('class'=>'detail-view table table-striped table-condensed'),
	'data'=>$model,
	'attributes'=>array(
		'requestRefNum', 'customer.customerName',
		'requestDate', 'customer.address',
		'requestTime', 'customer.tel',
		'reportDue', 'customer.fax',
		array(
            'name'=>'blank',
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
            'name'=>'blank',
            'oneRow'=>true,
            'type'=>'raw',
            'value'=>'',
        ),
        /*array(
			'name'=>'receivedBy',
			'type'=>'raw',
			'value'=>User::model()->findByPk($model->receivedBy)->fullname),*/
        'receivedBy',
		'conforme',
		
	),
)); ?>

<div class="addSample">
<h5>TESTING OR CALIBRATION SERVICES</h5>

<h5>SAMPLES
<small>
<?php
	$linkSample = Chtml::link('<span class="icon-white icon-plus-sign"></span> Add Sample', '', array( 
			'style'=>'cursor:pointer;',
			'class'=>'btn btn-info btn-small',
			'onClick'=>'js:{addSample(); $("#dialogSample").dialog("open");}',
			)); 
	//echo ($generated >= 1) ? $linkSample : (Yii::app()->getModule('lab')->isLabAdmin() ? $linkSample : '');
	echo ($generated >= 1) ? $linkSample : '';
?>
</small>
</h5>
</div>

<?php
    $this->widget('zii.widgets.grid.CGridView', array(
    	'id'=>'sample-grid',
	    'summaryText'=>false,
		'htmlOptions'=>array('class'=>'grid-view padding0'),
        'rowCssClassExpression'=>'$data->status',
		'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
		'rowHtmlOptionsExpression' => 'array("title" => "Click to update", "class"=>"link-hand")', 
        //It is important to note, that if the Table/Model Primary Key is not "id" you have to
        //define the CArrayDataProvider's "keyField" with the Primary Key label of that Table/Model.
        'dataProvider' => $sampleDataProvider,
        'columns' => array(
    		//'sampleCode',
    		array(
				'name'=>'SAMPLE CODE',
				'value'=>'$data->sampleCode',
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'width: 125px; padding-left: 10px; text-align: center;'),
			),
    		//'sampleName',
    		array(
				'name'=>'SAMPLE NAME',
				'value'=>'$data->sampleName',
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'width: 250px; padding-left: 10px;'),
			),
    		//'description'
    		array(
				'name'=>'DESCRIPTION',
				'value'=>'$data->description',
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'padding-left: 10px;'),
			),
			array(
			//'class'=>'CButtonColumn',
			'header'=>'Cancel',
			'class'=>'bootstrap.widgets.TbButtonColumn',
						'deleteConfirmation'=>"js:'Do you really want to delete sample: '+$.trim($(this).parent().parent().children(':nth-child(2)').text())+'?'",
						'template'=>($generated >= 1) ? '{delete}' : (Yii::app()->getModule('lab')->isLabAdmin() ? '{cancel}' : ''),
						'buttons'=>array
						(
							'delete' => array(
								'label'=>'Delete Sample',
								'url'=>'Yii::app()->createUrl("lms/sample/delete/id/$data->id")',
								),
							'cancel' => array(
								'label'=>'Cancel',
								//'imageUrl'=>'images/icn/status.png',
								'url'=>'Yii::app()->createUrl("lms/sample/cancel/id/$data->id")',
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

<h5>ANALYSES
<small>
<?php 
	$linkAnalysis = Chtml::link('<span class="icon-white icon-plus-sign"></span> Add Analyses', '', array( 
			'style'=>'cursor:pointer;',
			'onClick'=>'js:{addAnalysis(); $("#dialogAnalysis").dialog("open");}',
			'class'=>'btn btn-info btn-small'
			));
	$linkPackage = Chtml::link('<span class="icon-white icon-plus-sign"></span> Add Package', '', array( 
			'style'=>'cursor:pointer;',
			'onClick'=>'js:{addAnalysis(); $("#dialogAnalysis").dialog("open");}',
			'class'=>'btn btn-info btn-small'
			));			
	echo ($generated >= 1) ? $linkAnalysis : (Yii::app()->getModule('lab')->isLabAdmin() ? $linkAnalysis : '');
	echo " ";
	echo ($generated >= 1) ? $linkPackage : (Yii::app()->getModule('lab')->isLabAdmin() ? $linkPackage : '');
?>
</small></h5>
<?php
    $this->widget('zii.widgets.grid.CGridView', array(
    	'id'=>'analysis-grid',
	    'summaryText'=>false,
		'htmlOptions'=>array('class'=>'grid-view padding0'),
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
				'value'=>'$data->testName',
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
				'value'=>'$data->quantity',
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'width: 50px; text-align: center;'),
    			'footer'=>'SUBTOTAL<br/>DISCOUNT<br/><b>TOTAL</b>',
    			'footerHtmlOptions'=>array('style'=>'text-align: right; padding-right: 10px;'),
			),
    		//'fee'
    		array(
				'name'=>'UNIT PRICE',
				'value'=>'Yii::app()->format->formatNumber($data->fee)',
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
								'url'=>'Yii::app()->createUrl("lms/analysis/delete/id/$data->id")',
								),
							'cancel' => array(
								'label'=>'Cancel',
								'url'=>'Yii::app()->createUrl("lms/analysis/cancel/id/$data->id")',
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
        //$image = CHtml::Image(Yii::app()->theme->baseUrl . '/img/page_white_excel.png', 'Print');
		echo CHtml::link('<span class="icon-white icon-print"></span> Print Request', $this->createUrl('request/genRequestExcel',array('id'=>$model->id)), array('class'=>'btn btn-primary'));
        break;
    case ($generated < 1):
		//$image = CHtml::Image(Yii::app()->theme->baseUrl . '/img/page_white_excel.png', 'Print');
		echo CHtml::link('<span class="icon-white icon-print"></span> Print Request', $this->createUrl('request/genRequestExcel',array('id'=>$model->id)), array('class'=>'btn btn-primary'));
    	break;
    case 1:
        echo CHtml::ajaxLink(
				Yii::t('default','<span class="icon-white icon-list"></span> Generate Sample Code'),
				$this->createUrl('sample/generateSampleCode/',array('id'=>$model->id)), 
				array('success'=>'function(data){
						$.fn.yiiGridView.update("sample-grid");
		                $.fn.yiiGridView.update("analysis-grid");
		                location.reload();
					}'),
				array(
					"onclick"=>"if (!confirm('Do you really want to GENERATE Sample Codes with the current number of samples?')){return}",
					"class"=>"btn btn-primary"
				) 
				);
        break;
    case $generated > 1:
        echo '<p style="font-style: italic; font-weight: bold; color: red;">Generate Sample Codes from previous requests and refresh this page!</p>';
        break;
}		
	echo CHtml::ajaxLink($text, $url)
?>
</div>
<?php /*echo Chtml::link('Generate Sample Codes', '', array( 
			'style'=>'cursor:pointer;',
			'onClick'=>'js:{confirmGenerateSampleCode(); $("#dialogConfirmGenerate").dialog("open");}',
			));*/
?>

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
		if($(this).children(':nth-child(1)').text()=='No results found.'){
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
		if($(this).children(':nth-child(1)').text()=='No results found.'){
			alert($(this).children(':nth-child(1)').text());
	   		//alert(id);
		}else{
			updateAnalysis(id);
			$('#dialogAnalysis').dialog('open');
		}
});
");
?> 
<div style='position: relative; top:-745px; left: 250px;'>
<?php
	$imageCancelled = CHtml::image(Yii::app()->request->baseUrl . '/images/cancelled.png');
	echo $model->cancelled ? $imageCancelled : '';
?>
</div>
<script type="text/javascript">
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
                    $('#dialogSampleCode form').submit(generateSampleCode);
                }
                else
                {
                    //$.fn.yiiGridView.update('sample-grid');
                    //$.fn.yiiGridView.update('analysis-grid');
					$('#dialogSampleCode').html(data.div);
                    //setTimeout(\"$('#dialogSampleCode').dialog('close') \",1000);
                }
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogSampleCode").html(
						\'<div class="loader">'.$image.'<br\><br\>Retrieving record.<br\> Please wait...</div>\'
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
</script>
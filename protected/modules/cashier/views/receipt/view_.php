<?php
/* @var $this ReceiptController */
/* @var $model Receipt */


$image = CHtml::image(Yii::app()->request->baseUrl . '/images/ajax-loader.gif');
Yii::app()->clientScript->registerScript('clkrowgrid', "
$('#collection-grid table tbody tr').live('click',function()
{
	    var id = $.fn.yiiGridView.getKey(
        'collection-grid',
        $(this).prevAll().length 
    	);
		if($(this).children(':nth-child(1)').text()=='No results found.'){
			alert($(this).children(':nth-child(1)').text());
	   		//alert(id);
		}else{
			updateCollection(id);
			$('#dialogCollection').dialog('open');
		}
});
");

Yii::app()->clientScript->registerScript('clkrowgrid2', "
$('#check-grid table tbody tr').live('click',function()
{
	    var id = $.fn.yiiGridView.getKey(
        'check-grid',
        $(this).prevAll().length 
    	);
		if($(this).children(':nth-child(1)').text()=='No results found.'){
			alert($(this).children(':nth-child(1)').text());
	   		//alert(id);
		}else{
			updateCheck(id);
			$('#dialogCheck').dialog('open');
		}
});
");
/*
$this->breadcrumbs=array(
	array('label'=>'Report of Collection', 'url'=>array('reportOfCollection')),
	'Receipts'=>array('index'),
	$model->id,
);*/

$this->menu=array(
	array('label'=>'List Receipt', 'url'=>array('index')),
	array('label'=>'Create Receipt', 'url'=>array('create')),
	array('label'=>'Update Receipt', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete Receipt', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Receipt', 'url'=>array('admin')),
);
?>

<?php $linkCancel = CHtml::ajaxLink(
				'<span class="icon-white icon-minus-sign"></span> Cancel',
				$this->createUrl('receipt/cancel/',array('id'=>$model->id)), 
				array('success'=>'function(data){
						//$.fn.yiiGridView.update("sample-grid");
		                //$.fn.yiiGridView.update("analysis-grid");
		                location.reload();
					}'),
				array(
					"onclick"=>"if (!confirm('Do you really want to Cancel this Receipt?')){return}",
					'class'=>'btn btn-danger btn-small'
				) 
				);?>
<h3>Receipt #: <?php echo $model->receiptId; ?> <small><?php echo Yii::app()->getModule('cashier')->isCashierAdmin() ? $linkCancel : '';?></small></h3>

<?php //$this->widget('bootstrap.widgets.TbDetailView', array(
	$this->widget('ext.widgets.DetailView4Col', array(
	//$this->widget('zii.widgets.CDetailView', array(
	'cssFile'=>false,
	'htmlOptions'=>array('class'=>'detail-view table table-striped table-condensed'),
	'data'=>$model,
	'attributes'=>array(
		'payor', 'receiptDate',
		/*array(
            'name'=>'blank',
            'oneRow'=>true,
            'type'=>'raw',
            'value'=>'',
        ),*/
		'typeOfCollection.natureOfCollection', 
		array(
			'name'=>'totalCollection',
			'type'=>'raw',
			'value'=>Yii::app()->format->formatNumber($model->totalCollection)
		),
	),
)); ?>

<div class="collection">
<?php
	$linkCollection = Chtml::link('<span class="icon-white icon-plus-sign"></span> Add Collection', '', array( 
			'title'=>'Add Collection', 'style'=>'margin-left:10px;',
			'class'=>'btn btn-success btn-small',
			'onClick'=>'js:{addCollection(); $("#dialogCollection").dialog("open");}',
			)); 
?>
<?php
	$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>"<b>Collection(s)</b>",
	));	
?>
<!--h4 class="paddingLeftRight10">COLLECTION
<small>
<?php
	/*$linkCollection = Chtml::link('<span class="icon-white icon-plus-sign"></span> Add Collection', '', array( 
			'style'=>'cursor:pointer;',
			'class'=>'btn btn-info btn-small',
			'onClick'=>'js:{addCollection(); $("#dialogCollection").dialog("open");}',
			)); 
	echo $linkCollection;*/
?>
</small-->
<!--/h5-->
</div>
<h5><small><?php echo $linkCollection; ?></small></h5>
<?php
    $this->widget('zii.widgets.grid.CGridView', array(
    	'id'=>'collection-grid',
		'emptyText'=>'No collection',
	    'summaryText'=>false,
		'htmlOptions'=>array('class'=>'grid-view padding0 paddingLeftRight10'),
        //'rowCssClassExpression'=>'$data->status',
		'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
		'rowHtmlOptionsExpression' => 'array("title" => "Click to update", "class"=>"link-hand")', 
        //It is important to note, that if the Table/Model Primary Key is not "id" you have to
        //define the CArrayDataProvider's "keyField" with the Primary Key label of that Table/Model.
        'dataProvider' => $collectionDataProvider,
        'columns' => array(
    		//'sampleCode',
    		array(
				'name'=>'NATURE',
				'value'=>'$data->nature',
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'width: 125px; padding-left: 20px; text-align: LEFT;'),
			),
    		//'sampleName',
    		array(
				'name'=>'AMOUNT',
				'value'=>'Yii::app()->format->formatNumber($data->amount)',
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'width: 250px; padding-left: 10px; text-align: RIGHT;'),
    			'footer'=>'TOTAL :      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>'.Yii::app()->format->formatNumber($model->totalCollection).'</b>',
    			'footerHtmlOptions' => array('style' => 'width: 250px; padding-left: 10px; text-align: RIGHT;'),
			),
    		//'description'
			array(
			//'class'=>'CButtonColumn',
			//'header'=>'Cancel',
			'class'=>'bootstrap.widgets.TbButtonColumn',
						'deleteConfirmation'=>"js:'Do you really want to delete collection: '+$.trim($(this).parent().parent().children(':nth-child(1)').text())+'?'",
						//'template'=>($generated >= 1) ? '{delete}' : (Yii::app()->getModule('cashier')->isCashierAdmin() ? '{cancel}' : ''),
						'template'=>'{delete}',
						'buttons'=>array
						(
							'delete' => array(
								'label'=>'Delete Collection',
								'url'=>'Yii::app()->createUrl("cashier/collection/delete/id/$data->id")',
								),
							/*'cancel' => array(
								'label'=>'Cancel',
								//'imageUrl'=>'images/icn/status.png',
								'url'=>'Yii::app()->createUrl("cashier/collection/cancel/id/$data->id")',
								'options' => array(
									'confirm'=>'Are you want to cancel Collection?',
									'ajax' => array(
										'type' => 'get', 
										'url'=>'js:$(this).attr("href")', 
										'success' => 'js:function(data) { $.fn.yiiGridView.update("collection-grid")}')
									),
								),*/
						),
			),
        ),
    ));
    ?>

<?php if($model->paymentModeId == 2) :?>
<div class="check">
<h5 style="padding-left:10px;"><i>Cheque(s) Details</i>
<small>
<?php
	$linkCheck = Chtml::link('<span class="icon-white icon-plus-sign"></span> Add Check', '', array( 
			'style'=>'cursor:pointer;',
			'class'=>'btn btn-success btn-small',
			'onClick'=>'js:{addCheck(); $("#dialogCheck").dialog("open");}',
			)); 
	echo $linkCheck;
?>
</small>
</h5>
</div>

<?php
    $this->widget('zii.widgets.grid.CGridView', array(
    	'id'=>'check-grid',
	    'summaryText'=>false,
		'htmlOptions'=>array('class'=>'grid-view padding0 paddingLeftRight10'),
        //'rowCssClassExpression'=>'$data->status',
		'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
		'rowHtmlOptionsExpression' => 'array("title" => "Click to update", "class"=>"link-hand")', 
        //It is important to note, that if the Table/Model Primary Key is not "id" you have to
        //define the CArrayDataProvider's "keyField" with the Primary Key label of that Table/Model.
        'dataProvider' => $checkDataProvider,
        'columns' => array(
    		//'sampleCode',
    		array(
				'name'=>'BANK',
				'value'=>'$data->bank',
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'width: 125px; padding-left: 20px; text-align: LEFT;'),
			),
    		//'sampleName',
    		array(
				'name'=>'CHECK NUMBER',
				'value'=>'$data->checknumber',
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'width: 250px; padding-left: 10px; text-align: RIGHT;'),
			),
			array(
				'name'=>'DATE',
				'value'=>'$data->checkdate',
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'width: 250px; padding-left: 10px; text-align: RIGHT;'),
			),
			
			array(
				'name'=>'AMOUNT',
				'value'=>'Yii::app()->format->formatNumber($data->amount)',
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'width: 250px; padding-left: 10px; text-align: RIGHT;'),
				'footer'=>'TOTAL :      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>'.Yii::app()->format->formatNumber($model->totalCheck).'</b>',
				'footerHtmlOptions' => array('style' => 'width: 250px; padding-left: 10px; text-align: RIGHT;'),
			),
    		//'description'
			array(
			//'class'=>'CButtonColumn',
			//'header'=>'Cancel',
			'class'=>'bootstrap.widgets.TbButtonColumn',
						'deleteConfirmation'=>"js:'Do you really want to delete check: '+$.trim($(this).parent().parent().children(':nth-child(1)').text())+$.trim($(this).parent().parent().children(':nth-child(2)').text())+'?'",
						//'template'=>($generated >= 1) ? '{delete}' : (Yii::app()->getModule('cashier')->isCashierAdmin() ? '{cancel}' : ''),
						'template'=>'{delete}',
						'buttons'=>array
						(
							'delete' => array(
								'label'=>'Delete Cheque',
								'url'=>'Yii::app()->createUrl("cashier/check/delete/id/$data->id")',
								),
							/*'cancel' => array(
								'label'=>'Cancel',
								//'imageUrl'=>'images/icn/status.png',
								'url'=>'Yii::app()->createUrl("cashier/collection/cancel/id/$data->id")',
								'options' => array(
									'confirm'=>'Are you want to cancel Collection?',
									'ajax' => array(
										'type' => 'get', 
										'url'=>'js:$(this).attr("href")', 
										'success' => 'js:function(data) { $.fn.yiiGridView.update("collection-grid")}')
									),
								),*/
						),
			),
        ),
    ));
    ?>
<?php endif;?>
    
<?php $this->endWidget(); //End Portlet ?>
    
<div style='position: relative; top:-250px; left: 250px;'>
<?php
	$imageCancelled = CHtml::image(Yii::app()->request->baseUrl . '/images/cancelled.png');
	echo $model->cancelled ? $imageCancelled : '';
?>
</div>

<?php echo CHtml::link('<span class="icon-white icon-print"></span> Print', $this->createUrl('receipt/printExcel',array('id'=>$model->id)), array('class'=>'btn btn-info'));?>

<!-- Collection Dialog : Start -->
<?php
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		    'id'=>'dialogCollection',
		    // additional javascript options for the dialog plugin
		    'options'=>array(
		        'title'=>'Collection',
				'show'=>'scale',
				'hide'=>'scale',				
				'width'=>320,
				'modal'=>true,
				'resizable'=>false,
				'autoOpen'=>false,
			    ),
		));

	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<!-- Collection Dialog : End -->

<!-- Check Dialog : Start -->
<?php
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		    'id'=>'dialogCheck',
		    // additional javascript options for the dialog plugin
		    'options'=>array(
		        'title'=>'Check',
				'show'=>'scale',
				'hide'=>'scale',				
				'width'=>320,
				'modal'=>true,
				'resizable'=>false,
				'autoOpen'=>false,
			    ),
		));

	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<!-- Check Dialog : End -->

<script>
function addCollection()
{
    <?php echo CHtml::ajax(array(
			'url'=>$this->createUrl('collection/create',array('id'=>$model->id)),
			'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#dialogCollection').html(data.div);
                    // Here is the trick: on submit-> once again this function!
                    $('#dialogCollection form').submit(addCollection);
                }
                else
                {
                    $.fn.yiiGridView.update('collection-grid');
					$('#dialogCollection').html(data.div);
                    setTimeout(\"$('#dialogCollection').dialog('close') \",1000);
					
                }
 
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogCollection").html(
						\'<div class="loader">'.$image.'<br\><br\>Generating form.<br\> Please wait...</div>\'
					);
             }',
			 'error'=>"function(request, status, error){
				 	$('#dialogCollection').html(status+'('+error+')'+': '+ request.responseText );
					}",
			
            ))?>;
    return false; 
}

function updateCollection(id)
{
	<?php 
	echo CHtml::ajax(array(
			'url'=>$this->createUrl('collection/update'),
			'data'=> "js:$(this).serialize()+ '&id='+id",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#dialogCollection').html(data.div);
                    // Here is the trick: on submit-> once again this function!
                    $('#dialogCollection form').submit(updateCollection);
                }
                else
                {
                    $.fn.yiiGridView.update('collection-grid');
					$('#dialogCollection').html(data.div);
                    setTimeout(\"$('#dialogCollection').dialog('close') \",1000);
                }
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogCollection").html(
						\'<div class="loader">'.$image.'<br\><br\>Retrieving record.<br\> Please wait...</div>\'
					);
            }',
			 'error'=>"function(request, status, error){
				 	$('#dialogCollection').html(status+'('+error+')'+': '+ request.responseText+ ' {'+error.code+'}' );
					}",
            ))?>;
    return false; 
}

function addCheck()
{
    <?php echo CHtml::ajax(array(
			'url'=>$this->createUrl('check/create',array('id'=>$model->id)),
			'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#dialogCheck').html(data.div);
                    // Here is the trick: on submit-> once again this function!
                    $('#dialogCheck form').submit(addCheck);
                }
                else
                {
                    $.fn.yiiGridView.update('check-grid');
					$('#dialogCheck').html(data.div);
                    setTimeout(\"$('#dialogCheck').dialog('close') \",1000);
					
                }
 
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogCheck").html(
						\'<div class="loader">'.$image.'<br\><br\>Generating form.<br\> Please wait...</div>\'
					);
             }',
			 'error'=>"function(request, status, error){
				 	$('#dialogCheck').html(status+'('+error+')'+': '+ request.responseText );
					}",
			
            ))?>;
    return false; 
}

function updateCheck(id)
{
	<?php 
	echo CHtml::ajax(array(
			'url'=>$this->createUrl('check/update'),
			'data'=> "js:$(this).serialize()+ '&id='+id",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#dialogCheck').html(data.div);
                    // Here is the trick: on submit-> once again this function!
                    $('#dialogCheck form').submit(updateCheck);
                }
                else
                {
                    $.fn.yiiGridView.update('check-grid');
					$('#dialogCheck').html(data.div);
                    setTimeout(\"$('#dialogCheck').dialog('close') \",1000);
                }
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogCheck").html(
						\'<div class="loader">'.$image.'<br\><br\>Retrieving record.<br\> Please wait...</div>\'
					);
            }',
			 'error'=>"function(request, status, error){
				 	$('#dialogCheck').html(status+'('+error+')'+': '+ request.responseText+ ' {'+error.code+'}' );
					}",
            ))?>;
    return false; 
 
}
</script>



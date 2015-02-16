<?php
/* @var $this OrderofpaymentController */
/* @var $model Orderofpayment */

$this->menu=array(
	//array('label'=>'List Orderofpayment', 'url'=>array('index')),
	array('label'=>'Create Orderofpayment', 'url'=>array('create')),
	array('label'=>'Update Orderofpayment', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Orderofpayment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Orderofpayment', 'url'=>array('admin')),
);
?>

<h3>Order of Payment : <?php echo $model->transactionNum; ?></h3>

<?php $this->widget('ext.widgets.DetailView4Col', array(
	'cssFile'=>false,
	'htmlOptions'=>array('class'=>'detail-view table table-striped table-condensed'),
	'data'=>$model,
	'attributes'=>array(
		'transactionNum',
		'customerName',
		'date',
		'address',
		array(
			'name'=>'collectiontype',
			'value'=>$model->collectiontype->natureOfCollection
		),
		array(
			'name'=>'amount',
			'value'=>Yii::app()->format->formatNumber($model->totalPayment)
		),
	),
)); ?>

<?php	$linkAddPaymentItems = Chtml::link('<span class="icon-white icon-plus-sign"></span> Add Item', '', array( 
			'title'=>'Add Collection', 'style'=>'margin-left:10px; cursor:pointer;',
			'onClick'=>'js:{addPaymentItem(); $("#dialogPaymentItem").dialog("open");}',
			'class'=>'btn btn-success btn-small'
			));
		
			?>

<?php
	$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>"<b>Item(s)</b>",
	));

	echo $linkAddPaymentItems;
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    	'id'=>'paymentitems-grid',
	    'summaryText'=>false,
		'htmlOptions'=>array('class'=>'grid-view padding0 paddingLeftRight10'),
		'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
		'rowHtmlOptionsExpression' => 'array("title" => "Click to update", "class"=>"link-hand")', 
        //It is important to note, that if the Table/Model Primary Key is not "id" you have to
        //define the CArrayDataProvider's "keyField" with the Primary Key label of that Table/Model.
        'dataProvider' => $paymentitemDataProvider,
        'columns' => array(
    		array(
				'name'=>'Details',
				'value'=>'$data->details',
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'width: 125px; padding-left: 10px; text-align: left;'),
			),
    		array(
				'name'=>'Amount',
				'value'=>'Yii::app()->format->formatNumber($data->amount)',
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'width: 250px; padding-right: 50px; text-align: right;'),
    			'footer'=>Yii::app()->format->formatNumber($model->totalPayment),
    			'footerHtmlOptions' => array('style' => 'width: 250px; padding-right: 50px; text-align: right;'),
			),
			array(
			//'class'=>'CButtonColumn',
			'header'=>'Cancel',
			'class'=>'bootstrap.widgets.TbButtonColumn',
						'deleteConfirmation'=>"js:'Do you really want to delete Item: '+$.trim($(this).parent().parent().children(':nth-child(2)').text())+'?'",
						'template'=>($generated >= 1) ? '{delete}' : (Yii::app()->getModule('accounting')->isAccountingAdmin() ? '{cancel}' : ''),
						'buttons'=>array
						(
							'delete' => array(
								'label'=>'Delete Sample',
								'url'=>'Yii::app()->createUrl("accounting/paymentitem/delete/id/$data->id")',
								),
							'cancel' => array(
								'label'=>'Cancel',
								//'imageUrl'=>'images/icn/status.png',
								'url'=>'Yii::app()->createUrl("accounting/paymentitem/cancel/id/$data->id")',
								'options' => array(
									'confirm'=>'Are you want to cancel this Item?',
									'ajax' => array(
										'type' => 'get', 
										'url'=>'js:$(this).attr("href")', 
										'success' => 'js:function(data) { $.fn.yiiGridView.update("paymentitems-grid")}')
									),
								),
						),
			),
        ),
    ));
    ?>

<?php $this->endWidget(); //End Portlet ?>

<?php echo CHtml::link('<span class="icon-white icon-print"></span> Print', $this->createUrl('orderofpayment/printExcel',array('id'=>$model->id)), array('class'=>'btn btn-info'));?>

<!-- Payment Item Dialog : Start -->
<?php
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		    'id'=>'dialogPaymentItem',
		    // additional javascript options for the dialog plugin
		    'options'=>array(
		        'title'=>'Payment Items',
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
<!-- Payment Item Dialog : End -->

<?php 
$image = CHtml::image(Yii::app()->request->baseUrl . '/images/ajax-loader.gif');
Yii::app()->clientScript->registerScript('clkpaymentitemsgrid', "
$('#paymentitems-grid table tbody tr').live('click',function()
{
	    var id = $.fn.yiiGridView.getKey(
        'paymentitems-grid',
        $(this).prevAll().length 
    	);
		if($(this).children(':nth-child(1)').text()=='No results found.'){
			alert($(this).children(':nth-child(1)').text());
		}else{
			updatePaymentItem(id);
			$('#dialogPaymentItem').dialog('open');
		}
});
");?>

<script type="text/javascript">
function addPaymentItem()
{
    <?php echo CHtml::ajax(array(
			'url'=>$this->createUrl('paymentitem/create',array('id'=>$model->id, 'transactionNum'=>$model->transactionNum)),
			'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#dialogPaymentItem').html(data.div);
                    // Here is the trick: on submit-> once again this function!
                    $('#dialogPaymentItem form').submit(addPaymentItem);
                }
                else
                {
                    $.fn.yiiGridView.update('paymentitems-grid');
					$('#dialogPaymentItem').html(data.div);
					setTimeout(\"$('#dialogPaymentItem').dialog('close') \",1000);
                }
 
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogPaymentItem").html(
						\'<div class="loader">'.$image.'<br\><br\>Generating form.<br\> Please wait...</div>\'
					);
             }',
			 'error'=>"function(request, status, error){
				 	$('#dialogPaymentItem').html(status+'('+error+')'+': '+ request.responseText );
					}",
			
            ))?>;
    return false; 
}

function updatePaymentItem(id)
{
	<?php 
	echo CHtml::ajax(array(
			'url'=>$this->createUrl('paymentitem/update'),
			'data'=> "js:$(this).serialize()+ '&id='+id",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#dialogPaymentItem').html(data.div);
                    // Here is the trick: on submit-> once again this function!
                    $('#dialogPaymentItem form').submit(updatePaymentItem);
                }
                else
                {
                    $.fn.yiiGridView.update('paymentitems-grid');
					$('#dialogPaymentItem').html(data.div);
                    setTimeout(\"$('#dialogPaymentItem').dialog('close') \",1000);
                }
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogPaymentItem").html(
						\'<div class="loader">'.$image.'<br\><br\>Retrieving record.<br\> Please wait...</div>\'
					);
            }',
			 'error'=>"function(request, status, error){
				 	$('#dialogPaymentItem').html(status+'('+error+')'+': '+ request.responseText+ ' {'+error.code+'}' );
					}",
            ))?>;
    return false; 
}
</script>
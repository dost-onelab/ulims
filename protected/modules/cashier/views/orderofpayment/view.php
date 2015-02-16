<?php
/* @var $this OrderofpaymentController */
/* @var $model Orderofpayment */

$this->menu=array(
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

<?php
	$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>"<b>Item(s)</b>",
	));
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
			),
    ));
    ?>

<?php $this->endWidget(); //End Portlet ?>

<?php	$linkReceiptFromOP = Chtml::link('<span class="icon-white icon-list-alt"></span> Create Receipt', '', array( 
			'title'=>'Create Receipt', 'style'=>'cursor:pointer;',
			'onClick'=>'js:{createReceiptFromOP(); $("#dialogReceiptFromOP").dialog("open");}',
			'class'=>'btn btn-success'
			));
		$linkViewReceipt = CHtml::link('<span class="icon-white icon-eye-open"></span> View Receipt', $this->createUrl('receipt/view',array('id'=>$model->receipt->id)), array('class'=>'btn btn-info'));

		echo $model->createdReceipt ? $linkViewReceipt : $linkReceiptFromOP;		
?>

<!-- Receipt Dialog : Start -->
<?php
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		    'id'=>'dialogReceiptFromOP',
		    // additional javascript options for the dialog plugin
		    'options'=>array(
		        'title'=>'Receipt from OP',
				'show'=>'scale',
				'hide'=>'scale',				
				'width'=>650,
				'modal'=>true,
				'resizable'=>false,
				'autoOpen'=>false,
			    ),
		));

	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<!-- Receipt Dialog : End -->

<?php $image = CHtml::image(Yii::app()->request->baseUrl . '/images/ajax-loader.gif'); ?>

<script type="text/javascript">
function createReceiptFromOP()
{
    <?php echo CHtml::ajax(array(
			'url'=>$this->createUrl('receipt/CreateReceiptFromOP',array('id'=>$model->id)),
			'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#dialogReceiptFromOP').html(data.div);
                    // Here is the trick: on submit-> once again this function!
                    $('#dialogReceiptFromOP form').submit(createReceiptFromOP);
                }
                else
                {
                    //$.fn.yiiGridView.update('paymentitems-grid');
					$('#dialogReceiptFromOP').html(data.div);
					setTimeout(\"$('#dialogReceiptFromOP').dialog('close') \",1000);
					location.reload();
                }
 
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogReceiptFromOP").html(
						\'<div class="loader">'.$image.'<br\><br\>Processing...<br\> Please wait...</div>\'
					);
             }',
			 'error'=>"function(request, status, error){
				 	$('#dialogReceiptFromOP').html(status+'('+error+')'+': '+ request.responseText );
					}",
			
            ))?>;
    return false; 
}
</script>
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

<?php //$this->widget('ext.widgets.DetailView4Col', array(
	//$this->widget('ext.bootstrap.widgets.TbDetailView', array(
	$this->widget('ext.bootstrap.widgets.TbDetailView', array(
	//'cssFile'=>false,
	//'htmlOptions'=>array('class'=>'detail-view table table-striped table-condensed'),
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
			'value'=>Yii::app()->format->formatNumber($model->totalPayment),
			'cssClass'=>'totalAmount'
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

?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    	'id'=>'paymentitems-grid',
	    'summaryText'=>false,
		'htmlOptions'=>array('class'=>'grid-view padding0 paddingLeftRight10'),
		'itemsCssClass'=>'table table-striped table-bordered table-condensed',
		'rowHtmlOptionsExpression' => 'array("class"=>"link-hand")', 
        //It is important to note, that if the Table/Model Primary Key is not "id" you have to
        //define the CArrayDataProvider's "keyField" with the Primary Key label of that Table/Model.
        'dataProvider' => $paymentitemDataProvider,
        'columns' => array(
    		array(
				'header'=>'Details',
				'name'=>'details',
				'value'=>'$data->details',
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'width: 250px; padding-left: 10px; text-align: left;'),
			),
			/*array(
				'header'=>'Amount Due',
				'name'=>'amount',
				'value'=>'Yii::app()->format->formatNumber($data->amount)',
    			'htmlOptions' => array(
					'style' => 'width: 250px; padding-right: 50px; text-align: right;',
				),
			),*/
    		array(
				'header'=>'Amount'			,
				'class'=>'editable.EditableColumn',
				'name'=>'amount',
				'value'=>'Yii::app()->format->formatNumber($data->amount)',
				'type'=>'raw',
    			'htmlOptions' => array(
					'style' => 'width: 250px; padding-right: 50px; text-align: right;',
				),
    			'footer'=>"<strong>TOTAL &nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;".
							Yii::app()->format->formatNumber($model->totalPayment),
    			'footerHtmlOptions' => array('style' => 'width: 250px; padding-right: 50px; text-align: right; font-weight:bold;'),
				'editable' => array(
					'url' => $this->createUrl('updateAmount'),
					'inputclass' => 'span2',
					//'showbuttons' => false,
					'apply'      => $model->createdReceipt!=1, //can't edit created receipt
					'placement'  => 'left',
					'options'=>array(
						'success'=>'js:function(response, newValue) {
							var total=response.total;
							var parent = $(this).parents("tr");
							if(!response.success){
								return response.msg;
							}else{
								$("tr.totalAmount td").html(total);
								$.fn.yiiGridView.update("paymentitems-grid");

							}
						}',				
					'ajaxOptions' => array('dataType' => 'json')
					),					
				)
			),
        ),
    ));
    ?>
	<div class="alert alert-info" style="margin: 0 10px 10px 10px">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>For partial payment, please click on each amount and modify accordingly.</strong><br />
        <strong>Note!</strong> Only amount with <a class="editable editable-click" style="color:#D9EDF7">_ _ _</a> can be modified. 
    </div>
<?php $this->endWidget(); //End Portlet ?>

<?php echo CHtml::link('<span class="icon-white icon-print"></span> Print', $this->createUrl('orderofpayment/printExcel',array('id'=>$model->id)), array('class'=>'btn btn-info'));?>
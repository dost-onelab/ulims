<?php
/* @var $this CustomerController */
/* @var $model Customer */

$this->breadcrumbs=array(
	'Customers'=>array('index'),
	$model->id,
);

$this->menu=array(
	//array('label'=>'List Customer', 'url'=>array('index')),
	array('label'=>'Create Customer', 'url'=>array('create')),
	array('label'=>'Update Customer', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Customer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Customer', 'url'=>array('admin')),
);
?>

<h1>View Customer <small><?php echo $model->customerName; ?></small></h1>

<h4><i>Agency/Personal Info</i></h4>
<?php
	$this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'customerName',
		'head',
		'completeAddress',
		array(
			'name'=>'typeId',
			'type'=>'raw',
			'value'=>Customertype::model()->findByPk($model->typeId)->type
			),
		array(
			'name'=>'natureId',
			'type'=>'raw',
			'value'=>Businessnature::model()->findByPk($model->natureId)->nature
			),
		array(
			'name'=>'industryId',
			'type'=>'raw',
			'value'=>Industry::model()->findByPk($model->industryId)->classification
			),
	),
)); ?>
<!--h4><i>Address</i></h4-->
<?php /*
	$this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'region_id',
		'province_id',
		'municipalitycity_id',
		'barangay_id',
		'address'
	),
)); */?>

<h4><i>Contact Info</i></h4>
<?php 
	$this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'tel',
		'fax',
		'email',
	),
)); ?>

<h4><a><i>Transaction::History</i></a></h4>
<fieldset class="legend-border">
    <legend class="legend-border">Legend/Status</legend>
    <div style="padding: 0 10px">
    	<span class="badge badge-info">Ongoing</span>
        <span class="badge badge-success">Completed</span>
        <span class="badge badge-warning">Report Nearly Due</span>
        <span class="badge badge-danger">Cancelled</span> 
    </div>
</fieldset>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	//$this->widget('bootstrap.widgets.TbGridView', array(
	'summaryText'=>false,
	'id'=>'request-grid',
	'itemsCssClass'=>'table table-striped table-bordered table-condensed',
	'htmlOptions'=>array('class'=>'grid-view padding0'),
	'rowHtmlOptionsExpression' => 'array("class"=>$data->status["class"])',
	'dataProvider'=>$requests,
	'columns'=>array(
		//'id',
		array(
			'header'=>'Request Ref Num',
			'name'=>'requestRefNum',
			),
		array(
			'header'=>'Request Date',
			'name'=>'requestDate',
			'value'=>'date("Y-m-d", strtotime($data->requestDate))',
    		'htmlOptions' => array('style' => 'width: 100px; text-align: center; '),
			),
		array(
			'header'=>'Total Amount Due',
			'name'=>'total',
			'value'=>'Yii::app()->format->formatNumber($data->total)',
			'type'=>'raw',
    		'htmlOptions' => array('style' => 'width: 140px;text-align: right; padding-right: 5px;'),
			),
		array(
			'header'=>'Report Due',
			'name'=>'reportDue',
    		'htmlOptions' => array('style' => 'width: 100px; text-align: center; '),
			),
		array(
			'header'=>'Conforme',
			'name'=>'conforme',
    		'htmlOptions' => array('style' => 'width: 200px; text-align: center; padding-right: 25px;'),
			),
		array(
			'header'=>'Payment Status',
			'name'=>'paymentStatus',
			'type'=>'raw',
			'value' => function($data){
				$paymentStatus = $data["paymentStatus"];
				return CHtml::link(
					'<span class="'.$paymentStatus['class'].'">'.$paymentStatus['label'].'</span>',
					'javascript:void(0)',
					array(
						'id'=>$data['id'],
						'onclick'=>"js:{ viewPaymentDetail({$data['id']}); $('#dialogPaymentDetails').dialog('open');}",
					)
				);
			},
			'htmlOptions'=>array('style'=>'text-align:center','title'=>'Click to view payment details'),
		),
		/*array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{view} {update}'
		),*/
	),
)); ?>
<!-- Payment Details Dialog : Start -->
<?php
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		    'id'=>'dialogPaymentDetails',
		    // additional javascript options for the dialog plugin
		    'options'=>array(
		        'title'=>'Payment Details',
				'show'=>'scale',
				'hide'=>'scale',				
				'width'=>420,
				'modal'=>true,
				'resizable'=>false,
				'autoOpen'=>false,
			    ),
		));
	echo "Details here...";
	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<!-- Payment Details Dialog : End -->
<?php $image = CHtml::image(Yii::app()->request->baseUrl . '/images/ajax-loader.gif');?>
<script type="text/javascript">
function viewPaymentDetail(id)
{
	<?php 
	echo CHtml::ajax(array(
			'url'=>$this->createUrl('request/paymentDetail'),
			'data'=> "js:$(this).serialize()+ '&id='+id",
			//'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
            	$('#dialogPaymentDetails').html(data.div);
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogPaymentDetails").html(
						\'<div class="loader">'.$image.'<br\><br\>Retrieving record.<br\> Please wait...</div>\'
					);
            }',
			 'error'=>"function(request, status, error){
				 	$('#dialogPaymentDetails').html(status+'('+error+')'+': '+ request.responseText+ ' {'+error.code+'}' );
					}",
            ))?>;
    return false; 
 
}
</script>

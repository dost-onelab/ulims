<?php
/* @var $this RequestController */
/* @var $model Request */

$this->breadcrumbs=array(
	'Requests'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Request', 'url'=>array('index')),
	array('label'=>'Create Request', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#request-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
//echo Yii::app()->user->rstlId;
?>

<h1>Manage Referrals</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php //$this->renderPartial('_search',array('model'=>$model,)); ?>
</div><!-- search-form -->
<!--div class="legend"><h4 style="margin:0"><small><i>Legend:</i></small>  <span class="label label-info"></span>Ongoing <span class="label label-success">Done</span></h4></div-->
<fieldset class="legend-border">
    <legend class="legend-border">Legend/Status</legend>
    <div style="padding: 0 10px">
    	<span class="badge badge-info">Ongoing</span>
        <span class="badge badge-success">Completed</span>
        <span class="badge badge-warning">Report Nearly Due</span>
        <span class="badge badge-danger">Cancelled</span> 
    </div>
</fieldset>
<?php /*$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'request-grid',
	'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
	'htmlOptions'=>array('class'=>'grid-view padding0'),
	//'rowHtmlOptionsExpression' => 'array("title" => "Click to view request", "class"=>"link-hand ".$data->status["class"])',
	'rowHtmlOptionsExpression' => 'array("title"=>"Click on Request Reference Number to view details", "class"=>$data->status["class"])',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		array(
			'name'=>'requestRefNum',
			'type'=>'raw',
			'value'=>'Chtml::link($data->requestRefNum,Yii::app()->Controller->createUrl("request/view",array("id"=>$data->id)))',
			'htmlOptions'=>array('title'=>'Click to view details', 'style'=>'font-weight:bold;')
		),
		array(
				'name'=>'requestDate',
				'value'=>'date("Y-m-d", strtotime($data->requestDate))',
    			'htmlOptions' => array('style' => 'width: 75px; text-align: right; padding-right: 25px;'),
			),
		array( 
				'name'=>'customer_search', 
				'value'=>'$data->customer->customerName',
				'htmlOptions' => array('style' => 'width: 300px; text-align: left; ')
		),
		array(
				'name'=>'total',
				'value'=>'Yii::app()->format->formatNumber($data->total)',
				'type'=>'raw',
    			'htmlOptions' => array('style' => 'text-align: right; padding-right: 25px;'),
			),
		array(
				'name'=>'reportDue',
    			'htmlOptions' => array('style' => 'text-align: right; padding-right: 25px;'),
			),
		array(
			'name'=>'paymentStatus',
			'type'=>'raw',
			'filter'=>false,
			'value'=> function($data){
					$paymentStatus=$data['paymentStatus'];
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
		array(
			//'class'=>'CButtonColumn',
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{view} {update}'
		),
	),
	'selectableRows'=>1,
	//'selectionChanged'=>'function(id){location.href = "'.$this->createUrl('request/view/id').'/"+$.fn.yiiGridView.getSelection(id);}',
));*/ 
	$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'referral-grid',
	'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
	'rowHtmlOptionsExpression' => 'array("title" => "Click to view", "class"=>"link-hand")',
	'dataProvider'=>$referrals,
	'columns'=>array(
		//'id',
		array(
			'name'=>'referralCode',
			'header'=>'Referral Code',
			'type'=>'raw',
			'value'=>$data["referralCode"]
		),
		array(
			'name'=>'referralDate',
			'header'=>'Request Date',
			'type'=>'raw',
			'value'=>$data["referralDate"]
		),
		array(
			'name'=>'customerId',
			'header'=>'Customer',
			'type'=>'raw',
			'value'=>$data["customerId"]
		),
		array(
			'name'=>'rstl_id',
			'header'=>'Request from',
			'type'=>'raw',
			'value'=>$data["rstl_id"]
		),
	),
	'selectableRows'=>1,
	'selectionChanged'=>'function(id){location.href = "'.$this->createUrl('referral/view/id').'/"+$.fn.yiiGridView.getSelection(id);}',
));
?>

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
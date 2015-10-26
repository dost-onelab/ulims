<?php
/* @var $this RequestController */
/* @var $model Request */

$this->breadcrumbs=array(
	'Requests'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Request', 'url'=>array('index')),
	array('label'=>'Create Referral', 'url'=>array('create')),
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

<?php $this->widget('zii.widgets.jui.CJuiTabs',array(
    'tabs'=>array(
        //'StaticTab 1'=>'Content for tab 1',
        //'StaticTab 2'=>array('content'=>'Content for tab 2', 'id'=>'tab2'),
        // panel 3 contains the content rendered by a partial view
        'ReferralIn &nbsp;&nbsp;<span class="badge badge-warning">'.$newReferrals.'</span>'=>
					   array('id'=>'referral-in','content'=>$this->renderPartial(
                                        '_referralIn',
                                        array('referralIn'=>$referralIn),true 
                                        )),
		'ReferralOut'=>array('id'=>'referral-out','content'=>$this->renderPartial(
                                        '_referralOut',
                                        array('referralOut'=>$referralOut),true 
                                        )),
    ),
    // additional javascript options for the tabs plugin
    'options'=>array(
        'collapsible'=>false,
    ),
)); 
?>
<?php
Yii::app()->clientScript->registerScript('message-update', '
if(typeof(EventSource) !== "undefined") {
    var source = new EventSource("' . Yii::app()->Controller->getNotifications(Yii::app()->Controller->getRstlId()) . '");
    source.onmessage = function(event) {
        $("#message").prepend(event.data).fadeIn(); // We want to display new messages above the stack
    };
}
else {
    $("#message").replaceWith("<div class=\"flash-notice\">Sorry, your browser doesn\'t support SSE.<br>Hint: get a real one :-)</div>"); // Don\'t be desperate, we\'ll see what we can do for you at the end of the wiki
}
', CClientScript::POS_READY);
?>
<div id="message"></div>

<?php //$image = CHtml::image(Yii::app()->request->baseUrl . '/images/ajax-loader.gif');?>
<script type="text/javascript">
function viewPaymentDetail(id)
{
	<?php 
	/*echo CHtml::ajax(array(
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
            ))*/?>;
    return false; 
	}
</script>
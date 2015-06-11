<div style="width: 100%">
<?php
	//Yii::app()->user->setFlash('notice', '<strong>Warning!</strong> Sample notice');
	//Yii::app()->user->setFlash('notice','Authentication unsuccessful!');
	//Yii::app()->user->setFlash('errormessage', 'Password does not match with the selected Technical Manager.');
	
	/*$notices = array(
		'0'=>array('notice'=>'Notice 1'),
		'1'=>array('notice'=>'Notice 2'),
		'2'=>array('notice'=>'Notice 3'),
		'3'=>array('notice'=>'Notice 4'),
	);*/
	
	$notifications = RestController::getAdminData('notifications');
	
	$notifications = new CArrayDataProvider($notifications, 
				array('pagination'=>$pagination));
	
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'notices-grid',
		'summaryText'=>false,
		'emptyText'=>'No notifications',
		'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
		'rowHtmlOptionsExpression' => 'array("title" => "Click to view", "class"=>"link-hand")',
		'dataProvider'=>$notifications,
		'columns'=>array(
			array(
				'name'=>'notificationDate',
				'htmlOptions'=>array('style'=>'text-align: left;'),
				'headerHtmlOptions' => array('style' => 'display:none'),
			),
		),
		'selectableRows'=>1,
		//'selectionChanged'=>'function(id){location.href = "'.$this->createUrl('referral/view/id').'/"+$.fn.yiiGridView.getSelection(id);}',
	));			
?>
</div>
<p>A script on this page starts this clock:</p>
<p id="demo"></p>
<!-- >button onclick="clearInterval(myVar)">Stop time</button-->
<script>
//var myVar = setInterval(function(){myTimer()},1000);

var myVar = setInterval(
		function()
		{
			myTimer()
		},1000);

function myTimer() {
    var d = new Date();
    document.getElementById("demo").innerHTML = d.toLocaleTimeString();
}

function getNotifications(id)
{
	<?php 
    		echo CHtml::ajax(array(
			'url'=>$this->createUrl('referral/validateReferral'),
    		'data'=> "js:$(this).serialize()+ '&id='+id",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#dialogValidate').html(data.div);
                    // Here is the trick: on submit-> once again this function!
                    $('#dialogValidate form').submit(validateReferral);
                }
                else
                {
                    //$.fn.yiiGridView.update('sample-grid');
					$('#dialogValidate').html(data.div);
                    setTimeout(\"$('#dialogValidate').dialog('close') \",1000);
                    location.reload();
                }
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogValidate").html(
						\'<div class="loader">'.$image.'<br\><br\>Generating form.<br\> Please wait...</div>\'
					);
             }',
			 'error'=>"function(request, status, error){
				 	$('#dialogValidate').html(status+'('+error+')'+': '+ request.responseText );
					}",
			
            ))?>;
return false;
</script>
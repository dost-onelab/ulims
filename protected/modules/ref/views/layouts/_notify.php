<?php
//if(!isset(Yii::app()->user->getFlash('referralUpdates')))
	//Yii::app()->user->setFlash('referralUpdates','<div class="alert alert-alert" style="width:75%; margin: 5px 5px 5px 3px"><span id="count" class="badge badge-info pull-right">...</span><strong>Referral Updates</strong></div>');

//if(!isset(Yii::app()->user->getFlash('systemUpdates')))
	//Yii::app()->user->setFlash('systemUpdates','<div class="alert alert-info" style="width:75%; margin: 5px 5px 5px 3px"><span class="badge badge-info pull-right">...</span><strong>System Updates</strong></div>');
?>

<?php $linkReferralUpdates = Chtml::link('Referral Updates', '', array( 
							'style'=>'cursor:pointer;',
							//'onClick'=>'js:{$("#dialogNotifications").dialog("open");}',
							'onClick'=>'js:{getNotifications('.Yii::app()->Controller->getRstlId().'); $("#dialogNotifications").dialog("open");}',
				));
?>

<div id="referralUpdates" class="alert alert-alert" style="width:75%; margin: 5px 5px 5px 3px"><strong><?php echo $linkReferralUpdates;?></strong><span id="count" class="badge badge-info pull-right">&nbsp;</span></div>

<!-- Notifications Dialog : Start -->
<?php
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		    'id'=>'dialogNotifications',
		    // additional javascript options for the dialog plugin
		    'options'=>array(
		        'title'=>'New Notifications',
				'show'=>'scale',
				'hide'=>'scale',				
				'width'=>600,
				'modal'=>true,
				'resizable'=>false,
				'autoOpen'=>false,
			    ),
		));
	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<!-- Notifications Dialog : End -->

<script>
$().ready(function(){
	notify();
});

setInterval("notify();", 60000);

function notify(){
	$.ajax(
		{
			type: "POST",
	        url: "<?php echo $this->createUrl('/site/notify')?>",
			data: {"referralUpdates":""},
			dataType: "json",
	        success: function (data)
	        {
		        //alert(data.referralUpdates);
		        $("div.alert span").html(''+ data.referralUpdates +'');
	        	//$('#referralUpdates').html('');
	            //$('#referralUpdates').html('<div class="alert alert-alert" style="width:75%; margin: 5px 5px 5px 3px"><span id="count" class="badge badge-info pull-right">'+  data.referralUpdates  +'</span><strong>Referral Updates</strong></div>');

	            //$('#systemUpdates').html('');
	            //$('#systemUpdates').html('<div class="alert alert-info" style="width:75%; margin: 5px 5px 5px 3px"><span class="badge badge-info pull-right">'+  data.systemUpdates  +'</span><strong>System Updates</strong></div>');
	        }
			
		}
	);
}

function animateCounters()
{
	//$('#count').animate({opacity: "toggle"}, 1000, "linear");
}

function getNotifications(id)
{
	<?php 
    		echo CHtml::ajax(array(
			'url'=>$this->createUrl('/site/notifications'),
    		'data'=> "js:$(this).serialize()+ '&id='+id",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#dialogNotifications').html(data.div);
                    // Here is the trick: on submit-> once again this function!
                    //$('#dialogValidate form').submit(validateReferral);
                }
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogNotifications").html(
						\'<div class="loader">'.$image.'<br\><br\>Generating form.<br\> Please wait...</div>\'
					);
             }',
			 'error'=>"function(request, status, error){
				 	$('#dialogNotifications').html(status+'('+error+')'+': '+ request.responseText );
					}",
			
            ))?>;
    return false;  
}
</script>
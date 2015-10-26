<div style="width: 100%">
<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'notices-grid',
		'summaryText'=>false,
		'emptyText'=>'No notifications',
		'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
		'rowHtmlOptionsExpression' => 'array("title" => "Click to view", "class"=>"link-hand")',
		'dataProvider'=>$notifications,
		'columns'=>array(
			array(
				'name'=>'referralCode',
				'header'=>'Referral',
				'type'=>'raw',
				//'value'=>'Chtml::link($data["referralCode"],Yii::app()->Controller->createUrl("/ref/referral/preview",array("id"=>$data["resource_id"])))',
				'htmlOptions'=>array('style'=>'text-align: left; padding-left: 10px;'),
				//'headerHtmlOptions' => array('style' => 'display:none'),
			),
			array(
				'name'=>'notificationDate',
				'header'=>'Notice Date',
				'htmlOptions'=>array('style'=>'text-align: center;'),
				'headerHtmlOptions' => array('style' => 'align: center;'),
			),
			array(
				'name'=>'sender',
				'header'=>'Sender',
				'htmlOptions'=>array('style'=>'text-align: center;'),
				//'headerHtmlOptions' => array('style' => 'display:none'),
			),
			/*array(
				'name'=>'remarks',
				'header'=>'Remarks',
				'htmlOptions'=>array('style'=>'text-align: center;'),
				//'headerHtmlOptions' => array('style' => 'display:none'),
				'value'=>'($data["type_id"] == 1) ? "Candidate for Referral" : "Referral Sent"'
			),*/
			array(
				'name'=>'',
				'header'=>'Action',
				'htmlOptions'=>array('style'=>'text-align: center;'),
				//'headerHtmlOptions' => array('style' => 'display:none'),
				'type'=>'raw',
				/*'value'=>function($data){
							
							if($data["read"] == 0){
								echo Chtml::link("Confirm", "", array("onClick"=>"js:{readNotice(".$data['id'].");}"));
							}else{
								echo Chtml::link("Done", "");
								
							}
						}*/
				'value'=>'Chtml::link(Preview,Yii::app()->Controller->createUrl("/ref/referral/view",array("id"=>$data["resource_id"])))',
			),
		),
		'selectableRows'=>1,
		//'selectionChanged'=>'function(id){location.href = "'.$this->createUrl('referral/view/id').'/"+$.fn.yiiGridView.getSelection(id);}',
	));			
?>
</div>

<script>
function readNotice(resource_id)
{
	<?php 
	echo CHtml::ajax(array(
			'url'=>$this->createUrl('ref/referral/markread'),
			'data'=> "js:$(this).serialize()+ '&resource_id='+resource_id",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
            	$.fn.yiiGridView.update('notices-grid');
            	//$('#dialogNotifications').html(data.div);
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogSearchAgency").html(
						\'<div class="loader">'.$image.'<br\><br\>Retrieving record.<br\> Please wait...</div>\'
					);
            }',
			 'error'=>"function(request, status, error){
				 	$('#dialogSearchAgency').html(status+'('+error+')'+': '+ request.responseText+ ' {'+error.code+'}' );
					}",
            ))?>;
    return false; 
}
</script>

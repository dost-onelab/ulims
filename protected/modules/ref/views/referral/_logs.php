<h4 class='comments'>Activity Logs</h4>

<div id="notice-logs" class="alert alert-info">
	
	<br/>
		<?php 
			foreach($logs as $log) 
			{
				switch($log["type_id"])
				{
					case 1: 
						
						$date = new DateTime($log["notificationDate"], new DateTimeZone('Asia/Manila'));
						//echo $date->format('Y-m-d H:i:sP') . "\n";
						$this->beginWidget('zii.widgets.CPortlet', 
							array(	'title'=>'Referral Notice',
									'decorationCssClass'=>'portlet-decoration-notification',
									'titleCssClass'=>'portlet-title-notification',
									'contentCssClass'=>'portlet-content-notification',
									//'htmlOptions'=>array('style'=>'')			
									)
						);
							echo 'Notice sent to '.$log['recipient'].'<br/><br/>';
							echo $log['sender']."<br/>";
							//echo '<i>'.$log["notificationDate"].'</i>';
							echo '<i>'.$date->format('Y-m-d H:i:sP').'</i>';
							
		
						$this->endWidget();
						break;
						
					case 2: 
						$date = new DateTime($log["notificationDate"], new DateTimeZone('Asia/Manila'));
						$this->beginWidget('zii.widgets.CPortlet', 
							array(	'title'=>'Notice Confirmation',
									'decorationCssClass'=>'portlet-decoration-notification',
									'titleCssClass'=>'portlet-title-notification',
									'contentCssClass'=>'portlet-content-notification',
									//'htmlOptions'=>array('style'=>'')			
									)
						);
							echo 'Confirmed for Referral.<br/><br/>';
							
							echo $log['sender']."<br/>";
							//echo '<i>'.$log["notificationDate"].'</i>';
							echo '<i>'.$date->format('Y-m-d H:i:sP').'</i>';
		
						$this->endWidget();
						break;
					
					case 3: 
						$this->beginWidget('zii.widgets.CPortlet', 
							array(	'title'=>'Referral sent',
									'decorationCssClass'=>'portlet-decoration-notification',
									'titleCssClass'=>'portlet-title-notification',
									'contentCssClass'=>'portlet-content-notification',
									//'htmlOptions'=>array('style'=>'')			
									)
						);
							echo $log['sender']."<br/>";
							echo '<i>'.$log["notificationDate"].'</i>';
		
						$this->endWidget();
						break;
				}
			}
		?>
		
		<?php /*echo CHtml::ajaxSubmitButton('Submit Comment',CHtml::normalizeUrl(array('myController/MyAction','render'=>true)),
                 array(
                     'dataType'=>'json',
                     'type'=>'post',
                     'success'=>'function(data) {
                         $("#AjaxLoader").hide();  
                        if(data.status=="success"){
                         $("#formResult").html("form submitted successfully.");
                         $("#user-form")[0].reset();
                        }
                         else{
                        $.each(data, function(key, val) {
                        $("#user-form #"+key+"_em_").text(val);                                                    
                        $("#user-form #"+key+"_em_").show();
                        });
                        }       
                    }',                    
                     'beforeSend'=>'function(){                        
                           $("#AjaxLoader").show();
                      }'
                     ),array('id'=>'mybtn','class'=>'class1 class2'));*/ ?>
                     
	<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'reply-form',
			'enableAjaxValidation'=>false,
		)); ?> 
		
		<?php
			$image = CHtml::image(Yii::app()->request->baseUrl . '/images/ajax-loader.gif');
			if($referral['receivingAgencyId'] != Yii::app()->Controller->getRstlId()){
				echo $referral['status'] ? '' : 
					CHtml::ajaxSubmitButton('Confirm', $this->createUrl('referral/updateStatus', array('id'=>$_GET['id'], 'recipient_id'=>$referral['receivingAgencyId'])),
						array(
	                     'dataType'=>'json',
	                     'type'=>'post',
	                     'success'=>'function(data) {
	                           location.reload();
	                    }',                    
	                     'beforeSend'=>'function(){                        
	                           //$("#AjaxLoader").show();
	                      }'
	                     ), 
						array(
							'class'=>'btn btn-success', 
							'style'=>'width: 150px;'
						)
						);
			} 
		?><a></a>
		<br/><br/>	
		<?php echo CHtml::textArea('Text', $content,
		 array(	'id'=>'widget', 
				'style'=>'width:100%; height:100px;')); ?>
		<?php //echo CHtml::submitButton('Submit Comment', array('class'=>'btn btn-success', 'style'=>'width: 150px;')); ?>
		
		<?php 
				echo CHtml::ajaxSubmitButton('Submit Comment',CHtml::normalizeUrl(array('notifications/post','render'=>true)),
		                 array(
		                     'dataType'=>'json',
		                     'type'=>'post',
		                     'success'=>'function(data) {
		                         $("#AjaxLoader").hide();  
		                        if(data.status=="success"){
		                         	alert("Message successfully posted!");
		                         	location.reload();
		                        }
		                         else{
		                        $.each(data, function(key, val) {
		                        
		                        });
		                        }       
		                    }',                    
		                     'beforeSend'=>'function(){                        
		                           $("#AjaxLoader").show();
		                      }'
		                     ),
						array(
							'id'=>'postNotification',
							'class'=>'btn btn-success')); 
						
		?>
		
	<?php $this->endWidget(); ?>
</div>
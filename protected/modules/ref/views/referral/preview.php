<?php
/* @var $this ReferralController */
/* @var $model Referral */
$this->menu=array(
	array('label'=>'Create Referral', 'url'=>array('create')),
	array('label'=>'Update Referral', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Manage Referral', 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('search', "
$('.comments').click(function(){
	$('#notice-logs').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#analysis-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Referral Preview: <?php echo $referral['referralCode']; ?><small>
<?php //echo $model->cancelled ? '' : (Yii::app()->getModule('lab')->isLabAdmin() ? $linkCancelWithReason : '');?>
</small>
</h1>
<?php 
	$this->widget('ext.widgets.DetailView4Col', array(
	'cssFile'=>false,
	'htmlOptions'=>array('class'=>'detail-view table table-striped table-condensed'),
	'data'=>$referral,
	'attributes'=>array(
		array(
            'name'=>'referralDetails',
            'oneRow'=>true,
			'cssClass'=>'title-row',
            'type'=>'raw',
            'value'=>'',
        ),	
        
		'referralCode',
		array(
			'name' => 'Customer / Agency',
			'type'=>'raw',
            'value'=>$referral['customer']['customerName'],
		), 
        
		'referralDate', 
		array(
			'name' => 'Address',
			'type'=>'raw',
            'value'=>$referral['customer']['houseNumber'],
		), 
		
		'referralTime', 
		
		array(
			'name' => 'tel',
			'type'=>'raw',
            'value'=>$referral['customer']['tel'],
		),
		
		'reportDue', 
		
		array(
			'name' => 'fax',
			'type'=>'raw',
            'value'=>$referral['customer']['fax'],
		),
		
		array(
            'name'=>'paymentDetails',
            'oneRow'=>true,
			'cssClass'=>'title-row',
            'type'=>'raw',
            'value'=>'',
        ),
        array(
        	'name' => 'ORs',
        	'label' => 'ORs',
        	'value' => Referral::getReceipts($referral['collections'])
        ),
        
        array(
        	'name' => 'collection',
        	'label' => 'Collection',
        	'value' => Referral::getCollection($referral['collections'])
        ),
        
        array(
        	'name' => 'ORDates',
        	'label' => 'OR Dates',
        ),
        
        array(
        	'name' => 'unpaidBalance',
        	'label' => 'Unpaid Balance',
        	'value' => Yii::app()->format->formatNumber($referral['balance'])
        ),
        
        array(
            'name'=>'transactionDetails',
            'oneRow'=>true,
			'cssClass'=>'title-row',
            'type'=>'raw',
            'value'=>'',
        ),
        
        'receivedBy',
        'conforme'
	),
));
?>

<br/>
<?php	/*$linkSample = Chtml::link('<span class="icon-white icon-plus-sign"></span> Add Sample', '', array( 
			'style'=>'cursor:pointer;',
			'class'=>'btn btn-info',
			'onClick'=>'js:{addSample('.$_GET["id"].', '.$referral["lab_id"].'); $("#dialogSample").dialog("open");}',
			));
		
		$linkAnalysis = Chtml::link('<span class="icon-white icon-plus-sign"></span> Add Analysis', '', array( 
			'style'=>'cursor:pointer;',
			'onClick'=>'js:{addAnalysis('.$_GET["id"].'); $("#dialogAnalysis").dialog("open");}',
			'class'=>'btn btn-info',
			));
			
		$linkPackagedTests = Chtml::link('<span class="icon-white icon-plus-sign"></span> Add Packaged Tests', '', array( 
			'style'=>'cursor:pointer;',
			'onClick'=>'js:{addTest('.$referral["acceptingLabId"].', '.$_GET["id"].'); $("#dialogTest").dialog("open");}',
			'class'=>'btn btn-info',
			));*/
		//$display = Referral::owner($referral["receivingAgencyId"]) ? '' : 'display:none';
		//echo '<div style="text-align: center; '.$display.'">'.$linkSample.'&nbsp;&nbsp;&nbsp;';
		//echo $linkAnalysis.'&nbsp;&nbsp;&nbsp;'.$linkPackagedTests.'</div>';
		//echo $linkAnalysis.'&nbsp;&nbsp;&nbsp;</div>';
?>

<h4 style="margin-bottom: -15px;">Samples</h4>
<?php 
	$this->widget('zii.widgets.grid.CGridView', array(
    	'id'=>'sample-grid',
	    'summaryText'=>false,
		'emptyText'=>'No samples.',
		//'htmlOptions'=>array('class'=>'grid-view padding0 paddingLeftRight10'),
        //'rowCssClassExpression'=>'$data->status',
		'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
		'rowHtmlOptionsExpression' => 'array("title" => "Click to update", "class"=>"link-hand")', 
        //It is important to note, that if the Table/Model Primary Key is not "id" you have to
        //define the CArrayDataProvider's "keyField" with the Primary Key label of that Table/Model.
        'dataProvider' => $samples,
        'columns' => array(
			array(
    			'name'=>'barcode',
				'header'=>'Barcode',
    			'value'=>'CHtml::encode($data["barcode"])',
    			'htmlOptions' => array('style' => 'width: 150px; text-align: center;'),
    		),
			array(
				'name'=>'sampleCode',
				'header'=>'Sample Code',
				'value'=>'CHtml::encode($data["sampleCode"])',
				'htmlOptions' => array('style' => 'width: 150px; text-align: center;'),
			),
			array(
				'name'=>'sampleName',
				'header'=>'Sample Name',
				'value'=>'CHtml::encode($data["sampleName"])',
				'htmlOptions' => array('style' => 'width: 200px; padding-left: 10px; text-align: left;'),
			),
    		array(
				'name'=>'description',
				'header'=>'Description',
				'type'=>'raw',
				'value'=>'CHtml::encode($data["description"])'
			),
        )
    ));
?>
<h4 style="margin-top: -20px; margin-bottom: -15px;">Analyses</h4>
<?php 
    $this->widget('zii.widgets.grid.CGridView', array(
    	'id'=>'analysis-grid',
	    'summaryText'=>false,
		'emptyText'=>'No analyses.',
		//'htmlOptions'=>array('class'=>'grid-view padding0 paddingLeftRight10'),
		'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
		'rowHtmlOptionsExpression' => 'array("title" => "Click to update", "class"=>"link-hand")', 
        //It is important to note, that if the Table/Model Primary Key is not "id" you have to
        //define the CArrayDataProvider's "keyField" with the Primary Key label of that Table/Model.
        'dataProvider' => $analyses,
        'columns' => array(
    		//'id',
    		array(
				'name'=>'sampleName',
				'header'=>'Sample Name',
    			'htmlOptions' => array('style' => 'width: 175px; padding-left: 10px; text-align: left;'),
			),
			array(
				'name'=>'testName',
				'header'=>'Test Name',
				'htmlOptions' => array('style' => 'width: 175px; padding-left: 10px; text-align: left;'),
				'value'=>'$data["testName"]["testName"]',
			),
			array(
				'name'=>'method',
				'header'=>'Method',
				'htmlOptions' => array('style' => 'width: 300px; padding-left: 10px; text-align: left;'),
			),
			array(
				'name'=>'reference',
				'header'=>'Reference',
				'htmlOptions' => array('style' => 'width: 175px; padding-left: 10px; text-align: center;'),
				'footer'=>'SUBTOTAL<br/>DISCOUNT<br/><b>TOTAL</b>',
				'footerHtmlOptions'=>array('style'=>'text-align: right; padding-right: 10px;'),
			),
			array(
				'name'=>'fee',
				'header'=>'Fee',
				'value'=>'Yii::app()->format->formatNumber($data["fee"])',
				'htmlOptions' => array('style' => 'width: 75px; padding-right: 20px; text-align: right;'),
				'footer'=>Yii::app()->format->formatNumber($referral['total']).'<br/>'.Yii::app()->format->formatNumber($referral['discountAmount']).'<br/><b>'.Yii::app()->format->formatNumber($referral['total']).'</b>',
				'footerHtmlOptions'=>array('style'=>'text-align: right; padding-right: 20px;'),
			),
        ),
    ));
?>

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
						//print_r($logs);
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
							echo 'Confirmed for Referral '.$log['recipient'].'<br/><br/>';
							
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
		                     ),
						array(
							'id'=>'postNotification',
							'class'=>'btn btn-success')); 
						
		?>
		
	<?php $this->endWidget(); ?>
</div>
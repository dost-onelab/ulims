<div style="position:relative">
<?php
/* @var $this RequestController */
/* @var $model Request */

//if($model->cancelled)
	//$this->renderPartial('_cancelled',array('model'=>$model->cancelDetails));

$this->menu=array(
	array('label'=>'Create Request', 'url'=>array('create')),
	//array('label'=>'Update Request', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Manage Request', 'url'=>array('admin')),
);  
?>

<?php /*$linkCancel = CHtml::ajaxLink(
				'<span class="icon-white icon-minus-sign"></span> Cancel',
				$this->createUrl('request/cancel/',array('id'=>$model->id)), 
				array('success'=>'function(data){
						$.fn.yiiGridView.update("sample-grid");
		                $.fn.yiiGridView.update("analysis-grid");
		                location.reload();
					}'),
				array(
					"onclick"=>"if (!confirm('Do you really want to Cancel this Request?')){return}",
					'class'=>'btn btn-danger btn-small'
				) 
				);
	
	$linkCancelWithReason = Chtml::link('<span class="icon-white icon-minus-sign"></span> Cancel Request', '', array( 
			'style'=>'cursor:pointer;',
			'class'=>'btn btn-danger btn-small',
			'onClick'=>'js:{cancelRequest(); $("#dialogCancel").dialog("open");}',
			));
	*/
	/*$linkCancelDetails = Chtml::link('<span class="icon-white icon-search"></span> Cancel Details', '', array( 
			'style'=>'cursor:pointer;',
			'class'=>'btn btn-info btn-small',
			'onClick'=>'js:{cancelDetails('.$model->cancelDetails->id.'); $("#dialogCancel").dialog("open");}',
			));*/
?>
<h1>View Referral: <?php echo $referral['referralCode']; ?><small>
<?php //echo $model->cancelled ? '' : (Yii::app()->getModule('lab')->isLabAdmin() ? $linkCancelWithReason : '');?>
</small>
</h1>
<?php /*$this->widget('ext.widgets.DetailView4Col', array(
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
		'referralCode', 'customerId',//'customer.customerName',
		'referralDate', 'customer.address',
		'referralTime', 'customer.tel',
		'reportDue', 'customer.fax',
		array(
            'name'=>'paymentDetails',
			'cssClass'=>'title-row',
            'oneRow'=>true,
            'type'=>'raw',
            'value'=>'',
        ),
        'receivedBy',
		'conforme',
		
	),
));*/

//echo $response; ?>


<?php 
	$ch = curl_init();
	$url = 'http://localhost/API/index.php';
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	
	//Add data
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "firstname=BayMax&lastname=Cabral");
	
	$data = curl_exec($ch);
	curl_close($ch);
	
	$json = json_decode($data, true);
	
	for($i=0; $i<1; $i++){
		if($json['Result'][$i]['Status'] === 200){
			echo 'First Name: '.$json['Result'][$i]['Firstname'].'<br/>';
			echo 'Last Name: '.$json['Result'][$i]['Lastname'];
		}else{
			echo 'No Data Found';
		}
	}
	//echo '<pre>';
	//print_r($json);
	//echo '</pre>';
?>
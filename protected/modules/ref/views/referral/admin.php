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
        'ReferralIn &nbsp;&nbsp;<span class="badge badge-warning">'.$newReferrals.'</span>'=>array('id'=>'referral-in','content'=>$this->renderPartial(
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
    var source = new EventSource("' . Yii::app()->Controller->getNotifications(11) . '");
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

<!-- Payment Details Dialog : Start -->
<?php
	/*$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
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
	$this->endWidget('zii.widgets.jui.CJuiDialog');*/
?>
<!-- Payment Details Dialog : End -->
<?php
	/* Onelab API Server Authentication
	 * 
	 * Authentication will start with verification of the Agency Key which the client will send
	 * to the server. The server will send permission to the client for login.
	 * with username and password to login apiHost for user/id's access_token
	 * after the basic authentication 
	 * token will be generated at the api server end
	 * 
	 */
		//$hahaha = sha1(Yii::app()->securityManager->encrypt('thequickbrownfox'));
       	//echo $hahaha;
       	//$x = Yii::app()->securityManager->encrypt('1');
        //echo $x.'<br/>'.Yii::app()->securityManager->decrypt($x);
        //echo Yii::app()->securityManager->decrypt('1');
        //echo '<br/>';
        //$agencyKey = file_get_contents(Yii::app()->params['keyPath']);
		//echo $agencyKey;
		/*echo '<table>';
		for($i=1; $i<=26; $i++){
			echo '<tr>';
			echo '<td>';
				$randomNumber = rand(100000, 9999999);
				//$agency_key = file_get_contents(Yii::app()->params['keyPath']);
				//echo $agency_key;
				echo $randomNumber;
			echo '</td>';
			echo '<td>';
				echo base64_encode($agency_key);
			
			echo '</td>';
		}
		echo '</table>';
		*/
	
	//$response = curl_exec($ch);
	//curl_close($ch);
	
	//$agency_key = file_get_contents(Yii::app()->params['keyPath']);
	//$auth = array('Authorization: '.base64_encode($agency_key));
	//$auth = array('Authorization: '.$agency_key);
	//$response = Yii::app()->curl->setOption(CURLOPT_HTTPHEADER, $auth)->get($apiHost);
	
	//echo '<pre>';
	//print_R(json_decode($response));
	//echo '<br/>';
	//echo '</pre>';
	
	//$accesstoken = json_decode($response);
	//echo $accesstoken->exp.' -- '.time($accesstoken->exp).' -- '.(time($accesstoken->exp) + 900);
	//$expiryTime = time($accesstoken->exp) + 900;
	//$expiryDate = date("Y-m-d H:i:s", $expiryTime);
	
	//echo $accesstoken->exp.' -- '.time($accesstoken->exp).' -- '.$expiryTime.' -- '.$expiryDate;
	/*$codes = array( 
		'0'=>'69384378399970',
		'1'=>'98199661678880',
		'2'=>'107302885900852',
		'3'=>'137137952455866',
		'4'=>'54954088970740',
		'5'=>'23155898670185',
		'6'=>'108922808235152',
		'7'=>'68938832423137',
		'8'=>'81897415368521',
		'9'=>'90354260514632',
		'10'=>'67398399136381',
		'11'=>'74545363124033',
		'12'=>'39359546991297',
		'13'=>'42719480693905',
		'14'=>'28194251428114',
		'15'=>'85735135658413',
		'16'=>'62023892749013',
		'17'=>'119727575170418',
		'18'=>'32669978215400',
		'19'=>'87835499311177',
		'20'=>'68488431172265',
		'21'=>'42453384918353',
		'22'=>'21613100375729',
		'23'=>'43679711449937',
		'24'=>'106023699260744',
		'25'=>'96581780456897');
	
	echo '<table>';
	foreach($codes as $code){
		echo '<tr><td>';
		echo base64_encode($code);
		echo '</td></tr>';
	}
	echo '<table>';*/
	/*
	$a = 3;
	$b = 4;
	
	$c = sqrt(pow($a, 2) + pow($b, 2));*/
	//echo $c;
	//echo RestController::verifyAgencyKey();
	//echo '<br/>';
	
	//echo Yii::app()->user->accessToken;
	//echo '<br/>';
	
	//$user = User::model()->notsafe()->findByAttributes(array('username'=>Yii::app()->user->name));
	
	//$useridentity = new UserIdentity($user->username, $user->password);
	//print_r($useridentity);
	//echo Yii::app()->user->accessToken;
	//echo '<br/>';
	//Yii::app()->user->setState('accessToken', 'hahahhaaha');
	//echo Yii::app()->user->accessToken->token;
	//$accesstoken = Yii::app()->user->accessToken;
	//echo $accesstoken['accesstoken'];
	//echo Yii::app()->user->getState('accessToken');
	//echo RestController::verifyAgencyKey(11);
	//print_r(Yii::app()->user->accessToken);
	
	//print_r($res->code);
	//$user = User::model()->notsafe()->findByAttributes(array('username'=>Yii::app()->user->name));
?>

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
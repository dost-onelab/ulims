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
	);
	
	$notifications = RestController::getAdminData('notifications'); 
	$notifications = new CArrayDataProvider($notifications, 
				array('pagination'=>$pagination));*/
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
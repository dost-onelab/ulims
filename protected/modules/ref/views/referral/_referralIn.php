<?php
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'referralin-grid',
	'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
	//'rowHtmlOptionsExpression' => 'array("title" => "Click to view", "class"=>"link-hand")',
	'dataProvider'=>$referralIn,
	'columns'=>array(
		//'id',
		array(
			'name'=>'referralDate',
			'header'=>'Referral Date',
			'htmlOptions'=>array('style'=>'text-align: center;')
		),
		array(
			'name'=>'referralCode',
			'header'=>'Referral Code',
			'type'=>'raw',
			'value'=>'Chtml::link($data["referralCode"],Yii::app()->Controller->createUrl("referral/view",array("id"=>$data["id"])))',
			'htmlOptions'=>array('title'=>'Click to view details', 'style'=>'font-weight:bold; padding-left: 25px;')
		),
		array(
			'name'=>'customer',
			'header'=>'Customer',
			'htmlOptions'=>array('style'=>'text-align: center;'),
			'value'=>'$data["customer"]["customerName"]'
		),
		array(
			'name'=>'receivingAgency',
			'header'=>'Referred By',
			'htmlOptions'=>array('style'=>'text-align: center;'),
		),
		//'acceptingAgencyId',
		//'receivingAgencyId',
		array(
			'name'=>'reportDue',
			'header'=>'Report Due',
			'htmlOptions'=>array('style'=>'text-align: center;')
		),
		/*array(
			'name'=>'status',
			'header'=>'Status',
			'value'=>'Referral::itemAlias("StatusAll", $data["status"])',
			'htmlOptions'=>array('style'=>'text-align: center;')
		),*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update}',
			'buttons'=>array
						(
							'update' => array(
								'label'=>'Update Referrals',
								'url'=>'Yii::app()->createUrl(\'ref/referral/update\', array(\'id\'=>$data["id"]))',
								'visible'=>'Referral::owner($data["receivingAgencyId"])',
							),
						),
		),
	),
	'selectableRows'=>1,
	//'selectionChanged'=>'function(id){location.href = "'.$this->createUrl('referral/view/id').'/"+$.fn.yiiGridView.getSelection(id);}',
));
?>
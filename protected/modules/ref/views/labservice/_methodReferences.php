<?php
//Yii::app()->clientscript->scriptMap['jquery.js'] = false;
//Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
$this->widget('zii.widgets.grid.CGridView', array(
//$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'methodReferences',
	'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
	'htmlOptions'=>array('class'=>'grid-view padding0 paddingLeftRight10'),
	'dataProvider'=>$gridDataProvider,
	//'filter'=>$model,
	'columns'=>array(
		//'id',
		//'lab_id',
		//'labName',
		//'sampleType_id',
		//'type',
		//'testName_id',
		//'testName',
		//'methodreference_id',
		//'method',
		/*array(
			'id'=>'method_id', // the columnID for getChecked
			'class'=>'CCheckBoxColumn',
			'header'=>'Offered',
			'selectableRows'=>2,
			//'disabled'=>'(($data["balance"] == 0) OR ($data["createdReceipt"] == 1))  ? TRUE : FALSE  '
		),*/
		
		array(
			'header'=>'Offered',
           	//'htmlOptions'=>array('class'=>'btn-group btn-group-offer'),
			'class'=>'bootstrap.widgets.TbButtonColumn',
						'template'=>'{yes}{no}',
						'buttons'=>array
						(
							'yes' => array(
								'label'=>'Yes',
								'url'=>'Yii::app()->createUrl("ref/labservice/deactivateService", array("id"=>$data["method_id"]))',
								'visible'=>'in_array(Yii::app()->Controller->getRstlId(), $data["offers"])',
								'options' => array(
									'style'=>'width: 30px;',
									'class'=>function(){return "btn active btn-success";},
									'title'=>'Remove from Services',
									'ajax' => array(
										'type' => 'post',
										'url'=>'js:$(this).attr("href")',
										'update' => '#methodReferences',
										//'success' => '$.fn.yiiGridView.update("lab-service-grid");'
									),
									//'onChange'=>'js:{alert("hahaha");}'
								),
							),
							'no' => array(
								'label'=>'No',
								'url'=>'Yii::app()->createUrl("ref/labservice/activateService", array("id"=>$data["method_id"]))',
								'visible'=>'!in_array(Yii::app()->Controller->getRstlId(), $data["offers"])',
								'options' => array(
									'style'=>'width: 30px;',
									'class'=>function(){return "btn active btn-warning";},
									'title'=>'Add to Services',
									'ajax' => array(
										'type' => 'post', 
										'url'=>'js:$(this).attr("href")',
										'update' => '#methodReferences',
										)
									),
								),
						),
			),
		array(
			'name'=>'method',
			'header'=>'Method',
		),
		//'reference',
		array(
			'name'=>'reference',
			'header'=>'Reference',
		),
		//'fee',
		array(
			'name'=>'fee',
			'header'=>'Fee',
			'type'=>'html',
			'value'=>'Yii::app()->format->formatNumber($data["fee"])',
			'htmlOptions' => array(
								'style' => 'width: 75px; padding-right: 20px; text-align: right;',
							),
		),
		array(
			'name'=>'availableAgencies',
			'header'=>'Available Agencies',
			'type'=>'html',
			'value'=>function($data){
				$images = '';
				foreach($data['offeredBy'] as $offeredBy)
				{
					$images .= '&nbsp'.CHtml::image('http://dost-onelab.com/onelab/frontend/web/images/icons/'.$offeredBy["id"].'.png',
                                          $offeredBy, array("width"=>"25px" ,"height"=>"25px", "title"=>$offeredBy["name"]));
				}
				return $images;
			},
			'htmlOptions' => array('style' => 'width: 150px; text-align: center;'),
		),
		array(
			'name'=>'accreditation',
			'header'=>'Accreditation',
		),
	),
));
?>
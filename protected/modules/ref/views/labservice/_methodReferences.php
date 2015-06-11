<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'methodReferences',
	'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
	'dataProvider'=>$gridDataProvider,
	//'filter'=>$model,
	'columns'=>array(
		//'lab_id',
		//'labName',
		//'sampleType_id',
		//'type',
		//'testName_id',
		//'testName',
		//'methodreference_id',
		//'method',
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
			'value'=>'Yii::app()->format->formatNumber($data["fee"])',
			'htmlOptions' => array('style' => 'width: 75px; padding-right: 20px; text-align: right;'),
		),
		array(
			'name'=>'offered',
			'header'=>'Offered by',
		)
	),
));
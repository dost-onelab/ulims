<?php
/* @var $this LabServiceController */
/* @var $model LabService */

$this->breadcrumbs=array(
	'Lab Services'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List LabService', 'url'=>array('index')),
	array('label'=>'Create LabService', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#lab-service-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

?>

<h1>Manage Services Offered</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'lab-service-grid',
	'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
	'dataProvider'=>$labservices,
	//'dataProvider'=>$model->search2(),
	'filter'=>$model,
	'columns'=>array(
		//'lab_id',
		'labName',
		//'sampleType_id',
		'type',
		//'testName_id',
		'testName',
		//'methodreference_id',
		'method',
		'reference',
		'fee',
		array(
			'header'=>'Offered',
           	'htmlOptions'=>array('class'=>'btn-group btn-group-yesno'),
			'class'=>'bootstrap.widgets.TbButtonColumn',
						'template'=>'{yes}{no}',
						'buttons'=>array
						(
							'yes' => array(
								'label'=>'Yes',
								//'url'=>'Yii::app()->createUrl(\'ref/labservice/activateService\', array(\'id\'=>$data["methodreference_id"]))',
								'url'=>'Yii::app()->createUrl("ref/labservice/activateService", array("id"=>$data["methodreference_id"]))',
								'options' => array(
									'class'=>'Labservice::checkOffered($data["agency_id"]) ? "btn active btn-success" : "btn"',
									'ajax' => array(
										'type' => 'get',
										'url'=>'js:$(this).attr("href")', 
										'success' => 'js:function(data) { $.fn.yiiGridView.update("lab-service-grid");}')
									),
								),
							'no' => array(
								'label'=>'No',
								//'url'=>'Yii::app()->createUrl(\'ref/labservice/deactivateService\', array(\'id\'=>$data["methodreference_id"]))',
								'url'=>'Yii::app()->createUrl("ref/labservice/deactivateService", array("id"=>$data["methodreference_id"]))',
								'options' => array(
									//'class'=>'$data->status ? "btn" : "btn active btn-danger"',
									'class'=>'Labservice::checkOffered($data["agency_id"]) ? "btn" : "btn active btn-danger"',
									//'confirm'=>'Do you want to set this Lab as Inactive?',
									'ajax' => array(
										'type' => 'get', 
										'url'=>'js:$(this).attr("href")', 
										'success' => 'js:function(data) { $.fn.yiiGridView.update("lab-service-grid");}')
									),
								),
						),
			),
	),
)); ?>
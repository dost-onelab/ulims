<?php
/* @var $this PackageController */
/* @var $model Package */

$this->breadcrumbs=array(
	'Packages'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Package', 'url'=>array('index')),
	array('label'=>'Create Package', 'url'=>array('create')),
	array('label'=>'Update Package', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Package', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Package', 'url'=>array('admin')),
);
?>

<h1>View Package</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'name',
		array(
			'name'=>'testcategory_id',
			'type'=>'raw',
			'value'=>$model->testCategory->categoryName,
			),
		array( 
			'name'=>'sampletype_id',
			'type'=>'raw',
			'value'=>$model->sampleType->sampleType, 
		),			
		array(
			'name'=>'rate',
			'type'=>'raw',
			'value'=>Yii::app()->format->formatNumber($model->rate),
		),
		/*array(
			'name'=>'tests',
			'type'=>'html',
			'value'=>$this->renderPartial('_tests', array('model'=>$model, 'gridDataProviderTest'=>$gridDataProviderTest)),
			)*/
	),
)); ?>
<table class="table">
<tr><th style="text-align:right; width:140px;">Tests Details</th><td>
<?php $this->renderPartial('_tests', array('model'=>$model, 'gridDataProviderTest'=>$gridDataProviderTest)); ?>
</td>
</tr>
</table>

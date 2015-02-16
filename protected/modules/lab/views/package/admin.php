<?php
/* @var $this PackageController */
/* @var $model Package */

$this->breadcrumbs=array(
	'Packages'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Package', 'url'=>array('index')),
	array('label'=>'Create Package', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#package-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Packages</h1>

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

<?php /*$this->widget('zii.widgets.grid.CGridView', array(*/
	$this->widget('ext.groupgridview.GroupGridView', array(
	'id'=>'package-grid',
	'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
	'rowHtmlOptionsExpression' => 'array("title" => "Click to view project", "class"=>"link-hand")',
	'dataProvider'=>$model->search(),
    //'extraRowColumns' => array('testcategory_id'),
	'mergeColumns' => array('testcategory_id','sampletype_id'),
	'extraRowExpression' => '"<b style=\"font-size: 1.2em; color: green\">".$data->testCategory->categoryName."</b>"',
    'extraRowPos' => 'above',	
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'testcategory_id',
		array( 
			'name'=>'testcategory_id', 
			'value'=>'$data->testCategory->categoryName',
			'filter'=> Testcategory::listData(),
		),
		array( 
			'name'=>'sampletype_id', 
			'value'=>'$data->sampleType->sampleType', 
			//'filter'=> Sampletype::listData(),
			'filter'=>/*$model->testcategory_id ?*/
								    CHtml::listData(Sampletype::model()->findAllByAttributes(
								       array(),
								       "testCategoryId = :testCategoryId",
								       array(':testCategoryId'=>$model->testcategory_id)),
								       'id','sampleType')/*:*/
								    /*false*/,
		),		
		'name',
		//'sampletype_id',
		'rate',
		'tests',
		array(
			//'class'=>'CButtonColumn',
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
	'selectableRows'=>1,
	'selectionChanged'=>'function(id){location.href = "'.$this->createUrl('package/view/id').'/"+$.fn.yiiGridView.getSelection(id);}',
)); ?>

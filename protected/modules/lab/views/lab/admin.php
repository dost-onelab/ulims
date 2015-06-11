<?php
/* @var $this LabController */
/* @var $model Lab */

$this->breadcrumbs=array(
	'Labs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Lab', 'url'=>array('index')),
	array('label'=>'Create Lab', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#lab-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Labs</h1>

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
	'id'=>'lab-grid',
	'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
	'rowHtmlOptionsExpression' => 'array("title" => "Click to view project", "class"=>"link-hand")',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'labName',
		'labCode',
		/*array(
			//'class'=>'CButtonColumn',
			//'class'=>'bootstrap.widgets.TbButtonColumn',
		),*/
	),
	'selectableRows'=>1,
	'selectionChanged'=>'function(id){location.href = "'.$this->createUrl('lab/view/id').'/"+$.fn.yiiGridView.getSelection(id);}',
)); ?>
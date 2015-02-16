<?php
/* @var $this DepositController */
/* @var $model Deposit */

$this->breadcrumbs=array(
	'Deposits'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Cash Receipts Record', 'url'=>array('cashReceiptsRecord')),
	array('label'=>'List Deposit', 'url'=>array('index')),
	array('label'=>'Create Deposit', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#deposit-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Deposits</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'deposit-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
	'rowHtmlOptionsExpression' => 'array("title" => "Click to view project", "class"=>"link-hand")',
	'selectableRows'=>1,
	'selectionChanged'=>'function(id){location.href = "'.$this->createUrl('deposit/view/id').'/"+$.fn.yiiGridView.getSelection(id);}',
	'columns'=>array(
		//'id',
		'depositDate',
		'startOr',
		'endOr',
		array(
			'name'=>'amount',
			'type'=>'raw',
			'value'=>'Yii::app()->format->formatNumber($data->amount)'
			),
		array(
			'name'=>'depositType',
			'type'=>'raw',
			'value'=>'$data->depositType==0?"Bureau of Treasury":"Project"',
			'filter'=>array("0"=>"Bureau of Treasury", "1"=>"Project")
			),		
		array(
			//'class'=>'CButtonColumn',
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>

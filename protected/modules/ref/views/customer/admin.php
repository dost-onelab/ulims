<?php
/* @var $this CustomerController */
/* @var $model Customer */

$this->breadcrumbs=array(
	'Customers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Customer', 'url'=>array('index')),
	array('label'=>'Create Customer', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#customer-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Customers</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php //print_r($customers);?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'customer-grid',
	'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
	'rowHtmlOptionsExpression' => 'array("title" => "Click to view", "class"=>"link-hand")',
	'dataProvider'=>$customers,
	//'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'customerName',
		array(
			'name'=>'customerName',
			'header'=>'Customer',
			'htmlOptions'=>array('style'=>'text-align: left;'),
			'value'=>'$data["customerName"]'
		),
		//'agencyHead',
		array(
			'name'=>'agencyHead',
			'header'=>'Head of Agency',
			'htmlOptions'=>array('style'=>'text-align: left;'),
			'value'=>'$data["agencyHead"]'
		),
		//'tel',
		array(
			'name'=>'tel',
			'header'=>'Landline',
			'htmlOptions'=>array('style'=>'text-align: left;'),
			'value'=>'$data["tel"]'
		),
		//'fax',
		array(
			'name'=>'fax',
			'header'=>'Fax',
			'htmlOptions'=>array('style'=>'text-align: left;'),
			'value'=>'$data["fax"]'
		),
		//'email',
		array(
			'name'=>'email',
			'header'=>'Email',
			'htmlOptions'=>array('style'=>'text-align: left;'),
			'value'=>'$data["email"]'
		),
		//'region_id',
		//'province_id',
		//'municipalityCity_id',
		//'type_id',
		/*
		'barangay_id',
		'houseNumber',
		'tel',
		'fax',
		'email',
		'type_id',
		'nature_id',
		'industry_id',
		'create_time',
		'update_time',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update}'
		),
	),
	'selectableRows'=>1,
	'selectionChanged'=>'function(id){location.href = "'.$this->createUrl('customer/view/id').'/"+$.fn.yiiGridView.getSelection(id);}',
)); ?>

<?php
/* @var $this InitializecodeController */
/* @var $model Initializecode */

$this->breadcrumbs=array(
	'Initializecodes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Initializecode', 'url'=>array('index')),
	array('label'=>'Create Initializecode', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#initializecode-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Initializecodes</h1>

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
	'id'=>'initializecode-grid',
	'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
	'rowHtmlOptionsExpression' => 'array("title" => "Click to Initialize Code", "class"=>"link-hand")',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		/*array( 
			'name'=>'rstl_id', 
			'value'=>'$data->rstl->name',
			//'htmlOptions' => array('style' => 'text-align: right; padding-right: 25px;')
		),*/
		array( 
			'name'=>'codeType', 
			'value'=>'Initializecode::getCodeType($data->codeType)',
			//'htmlOptions' => array('style' => 'text-align: right; padding-right: 25px;')
		),
		array( 
			'name'=>'lab_id', 
			'value'=>'$data->lab->labCode',
			//'htmlOptions' => array('style' => 'text-align: right; padding-right: 25px;')
		),
		'startCode',
		//'active',
		array(
			//'class'=>'CButtonColumn',
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update}'
		),
	),
	'selectableRows'=>1,
	'selectionChanged'=>'function(id){location.href = "'.$this->createUrl('initializecode/update/id/').'/"+$.fn.yiiGridView.getSelection(id);}',
)); ?>

<?php 
	/*foreach($rstls as $rstl){
		foreach($labs as $lab){
			for($i=1; $i<=2; $i++){
				//echo $rstl->id." ::::: ".$rstl->name." ::::: ".$lab->labCode." ::::: ".$i."<br/>";
				$initializecode = New Initializecode;
				$initializecode->rstl_id = $rstl->id;
				$initializecode->lab_id = $lab->id;
				$initializecode->codeType = $i;
				$initializecode->startCode = 0;
				$initializecode->active = 0;
				$initializecode->save();
			}
		}
	}*/

?>
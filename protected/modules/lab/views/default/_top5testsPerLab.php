<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'top5-analysis-grid',
	'summaryText'=>false,
	'htmlOptions'=>array('class'=>'grid-view padding0'),
	'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',	
	'dataProvider'=>$topAnalysisByLab,
	'columns'=>array(
		array(
			'name'=>'id',
			'header'=>'Rank #',
			'type'=>'raw',
			'value'=>'$row+1',
			'htmlOptions'=>array('style'=>'text-align:center')
			),
		//'testId',
		array('name'=>'testName','header'=>'Test Name'),
		array('name'=>'countTest','header'=>'No. of Tests','htmlOptions'=>array('style'=>'text-align:center')),
		/*array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),*/
	),
)); ?>

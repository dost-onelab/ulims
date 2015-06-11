<?php
	/*$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>"<b>Technical Managers</b> ",
	));*/	
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'labmanager-grid',
        'summaryText'=>false,
		'htmlOptions'=>array('class'=>'grid-view padding0'),
        'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
        'rowHtmlOptionsExpression' => 'array("title" => "Click to update", "class"=>"link-hand")',
        'dataProvider'=>$labManagerDataProvider,
        'columns'=>array(
            //'id',
            'labName',
            array(
            	'name'=>'Manager', 
				'value'=>'$data->manager->user->profile->firstname." ".$data->manager->user->profile->mi.". ".$data->manager->user->profile->lastname',
				'htmlOptions' => array('style' => 'width: 300px; text-align: left; ')
            )
))); ?>
<?php //$this->endWidget(); //End Portlet ?>
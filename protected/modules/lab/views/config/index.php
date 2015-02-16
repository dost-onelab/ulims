<?php
/* @var $this ConfigController */

$this->breadcrumbs=array(
	'Config',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>



<?php
	$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>"<b>Active Laboratories</b> [update]",
	));	
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'lab-grid',
        'summaryText'=>false,
		'htmlOptions'=>array('class'=>'grid-view padding0'),
        'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
        /*'rowHtmlOptionsExpression' => 'array("title" => "Click to view details", "class"=>"link-hand")',*/
        'dataProvider'=>$dataProvider,
        'columns'=>array(
            //'id',
            'labName',
            'labCode',
            //'references',
            /*array(
                    'header' =>'Test Name',
                    'name'=>'testName',
                    ),
            array(
                    'header' =>'Method',
                    'name'=>'method',
					'htmlOptions'=>array('style'=>'max-width:400px;min-width:auto;'),
                    'footer'=>'Package Rate',
                    'footerHtmlOptions' => array('style' => 'text-align: right;'),
                    ),
            array(
                    'header' =>'References',
                    'name'=>'references',
                    'footer' => Yii::app()->format->formatNumber($model->rate),
                    'footerHtmlOptions' => array('style' => 'text-align: right;'),
                    ),								
            array(
                    'header' =>'Fee',
                    'name'=>'fee',
                    'value'=>'Yii::app()->format->formatNumber($data["fee"])',
                    'htmlOptions' => array('style' => 'text-align: right;'),
                    'footer' => Yii::app()->format->formatNumber(Package::getPackageTotal($model->tests, $model->rate)),
                    'footerHtmlOptions' => array('style' => 'text-align: right;'),
                    //'footer'=>Yii::app()->format->formatNumber($provider->itemCount===0 ? '' : 
                            //$this->getTotal($barangays->totalCount(),'householdPerBarangay'))
                    ),*/
            ),
)); ?>

<?php $this->endWidget(); //End Portlet ?>    

<?php
$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>"Rank by Lab",
));
		
?>
<?php
//$topAnalysis3yearsByLab
foreach($topAnalysisYearsByLab as $topAnalysisYearByLab){
			$labName=$topAnalysisYearByLab['lab']->labCode;
			$tabs[$labName]=array('content'=>$this->renderPartial('_top5testsPerLab',array(
																'topAnalysis'=>$topAnalysis3year['topAnalysis'],
																'topAnalysisByLab'=>$topAnalysisYearByLab['topAnalysisLab'],
																)
																,true),'id'=>$labName);
		}
?>
<?php
    $this->widget('zii.widgets.jui.CJuiTabs', array(
		'tabs'=>$tabs,
		// additional javascript options for the tabs plugin
		'options'=>array(
			'collapsible'=>true,
		),
	));
?>
<?php $this->endWidget();?>

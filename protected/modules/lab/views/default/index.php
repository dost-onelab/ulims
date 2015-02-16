<?php
/* @var $this DefaultController */
/*
$this->breadcrumbs=array(
	$this->module->id,
);*/
?>

<?php echo $this->renderPartial('_rstlbox', array(
		'yearListStr'=>$yearListStr, 'yearRange'=>$yearRange, 'yearListCategories'=>$yearListCategories,
		'rstlPerformanceIndicators'=>$rstlPerformanceIndicators, 'rstlPerformanceData'=>$rstlPerformanceData,
		
		'defaultSeries'=>$defaultSeries, 'defaultSingleSeries'=>$defaultSingleSeries
	));?>    
<?php /*foreach($topAnalysis3years as $topAnalysis3year){
	$year=$topAnalysis3year['year'];
?>
<!--div class="span4a">
<?php
	$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>"<b>".$year." Top Five (5)</b> Tests/Analysis",
	));	
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'top5-analysis-grid',
	'summaryText'=>false,
	'htmlOptions'=>array('class'=>'grid-view padding0'),
	'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',	
	'dataProvider'=>$topAnalysis3year[topAnalysis],
	'columns'=>array(
		array(
			'name'=>'id',
			'header'=>'#',
			'type'=>'raw',
			'value'=>'$row+1'
			),
		//'testId',
		array('name'=>'testName','header'=>'Test Name'),
		array('name'=>'countTest','header'=>'No. of Tests','htmlOptions'=>array('style'=>'text-align:center')),
		/*array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),*/
	/*),
)); ?>   
<?php $this->endWidget();?>
</div-->
<?php }*/?>
  <div class="span6">
  	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>"<b>Top Five (5) Tests/Analysis</b>",
		));
		
	?>
    <?php 
		//foreach($topAnalysis3years as $topAnalysis3year){
		foreach($topAnalysis3yearsByLab as $topAnalysis3YearByLab){	
			$year=$topAnalysis3YearByLab['year'];
			$topAnalysisYearsByLab=$topAnalysis3YearByLab['topAnalysisByLab'];
			$panels[$year]=$this->renderPartial('_top5tests',array(
																'topAnalysis'=>$topAnalysis3year['topAnalysis'],
																//'topAnalysis3yearsByLab'=>$topAnalysis3yearsByLab,
																'topAnalysisYearsByLab'=>$topAnalysisYearsByLab,
																'year'=>$year
																)
																,true);
		}
	?>
    <?php
    $this->widget('zii.widgets.jui.CJuiAccordion', array(
		'panels'=>$panels,
		// additional javascript options for the accordion plugin
		'options'=>array(
			'animated'=>'bounceslide',
		),
	));
	?>
    
    <?php $this->endWidget();?>
  </div>
<div class="span5">
<?php
	$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>"<b>Testing/Calibration Services Rendered by Lab in ".$currYear."</b>",
	));	
?>
    <?php
    $this->widget('ext.highcharts.HighchartsWidget', array(
	   //'dataProvider'=>$pieProgramDataProvider,
	   //'summaryText'=>false,
	   //'template'=>'{items}',
       'options'=>array(
	   	  'chart'=>array(
		  		'height'=>475,
		  	),
		  'credits' => array('enabled' => false),	
          'title' => array('text' => ''),
          //'xAxis' => array(
			// 'categories' => 'districtName'
          //),
          'series' => array(
		  	array(
				//'type' => 'areaspline',
				'type' => 'pie',
				'dataLabels'=>array(
					'enabled'=>true,
					//'format'=>'<b>{point.name}</b>: {point.percentage:.1f} %',
					//'format'=>'{point.percentage:.1f} %',
					'format'=>'{point.y}',
				),
				'name'=>'No. of Testing/Calibration Services',
				'showInLegend'=>true,
				'data'=>$testAnalysisByLabPieColumns
			 )
          ),
       )
    ));
	?>  
<?php $this->endWidget();?>
</div>
<?php //Yii::app()->clientScript->registerScript('sidebar',"$(window).scroll(function(){if ($(window).scrollTop() >= 400){ $('.orbit-next, .orbit-prev').css({position:'fixed',top:'0'});}else{ $('.orbit-next, .orbit-prev').css({position:'absolute',top:'400px'});}});");?>
<script type="text/javascript">
//http://andornagy.com/create-a-simple-jquery-image-slider/
$(document).ready(function(){
var $first = $('#rstl ul:first'), 
	$last = $('#rstl ul:last');

$(".orbit-next").click(function (e) { 
    var $next,
        $selected = $(".selected");
    // get the selected item
    // If next li is empty , get the first
    $next = $selected.next('ul').length ? $selected.next('ul') : $first;
    $selected.removeClass("selected").fadeOut('slow');
    $next.addClass('selected').fadeIn('slow');
	e.preventDefault();
});
$(".orbit-prev").click(function (e) {
    var $prev,
        $selected = $(".selected");
    // get the selected item
    // If prev li is empty , get the last
    $prev = $selected.prev('ul').length ? $selected.prev('ul') : $last;
    $selected.removeClass("selected").fadeOut('slow');
    $prev.addClass('selected').fadeIn('slow');
	e.preventDefault();
});

var time = 8000; //every 5sec
var tid = setTimeout(timer, time);
 
function timer() {
    var $next,
    $selected = $(".selected");
    // get the selected item
    // If next li is empty , get the first
    $next = $selected.next('ul').length ? $selected.next('ul') : $first;
    $selected.removeClass("selected").fadeOut('slow');
    $next.addClass('selected').fadeIn('slow');
 
    tid = setTimeout(timer, time); // repeat myself
}
function abortTimer() { // to be called when you want to stop the timer
    clearTimeout(tid);
}
//from infoboard
/*function rstlslide(){
	var w=$('#rstl ul:first').width();
	var $first = $('#rstl ul:first');
    $first.animate({ 'margin-left': '-'+w+'px', 'padding':'0px 40px' }, 1000, function() {
        $first.remove().css({ 'margin-left': '0px', 'padding':'0px 40px' });
        $('#rstl ul:last').after($first);
    });
	
	// Have the first and last li's set to a variable

}
window.setInterval(rstlslide, 10000); //every 10 sec*/
});//end document ready
</script>
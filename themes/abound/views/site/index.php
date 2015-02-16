<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl; 
?>
<div class="page-header">
	<h1>Welcome!</h1>
</div>
<!--div class="alert alert-info"-->
  <!--button type="button" class="close" data-dismiss="alert">×</button-->
  <h4 style="margin-left:60px;"><strong>DOST Unified Laboratory Information Management System</strong></h4>
  <p style="margin-left:60px;">A web-based Information Systems</p>
  
<!--/div-->
<?php 
$dir = "./images/lab_header/*.png"; 
//get the list of all files with .jpg extension in the directory and safe it in an array named $images
$images = glob($dir);

?>
<div class="row-fluid">
  <div class="span12 box-header h320" style="float:none;">
  <div class="orbit-container" style="float:left;"><a class="orbit-prev" href="#" title="Previous"><span></span></a></div><div class="orbit-container" style="float:right;"><a class="orbit-next" href="#" title="Next"><span></span></a></div>	
  <?php //$filename='dost9-header.png';?>
  <?php //echo CHtml::image(Yii::app()->baseUrl.'/images/'.strtolower($filename),'header-image',array('class'=>'header-image'));?>
  <?php //extract only the name of the file without the extension and save in an array named $find
		foreach( $images as $image ):
			echo "<ul>";
			//echo "<img src='" . $image . "' />";
			echo CHtml::image($image,'header-image',array('class'=>'header-image'));
			echo "</ul>";
		endforeach;?>
  </div>
  
</div>
<script type="text/javascript">
//http://andornagy.com/create-a-simple-jquery-image-slider/
$(document).ready(function(){
	var $first = $('.row-fluid ul:first'), 
		$last = $('.row-fluid ul:last');
	
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
	
	var time = 5000; //every 5sec
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
});//end document ready
</script>

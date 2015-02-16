<?php print_r($reqs);?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'conso-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php $image = CHtml::Image(Yii::app()->theme->baseUrl . '/images/big_icons/icon-export-to-excel.png', 'Print'); ?>
<?php echo CHtml::link($image, $this->createUrl('accomplishments/exportConso')); ?>

<?php echo CHtml::hiddenField('lab', '1');?>
<?php echo CHtml::dropDownList('year', $select,	
				   CHtml::listData($this->getYear(), 'index', 'year'),
				   array(
						'ajax'=>array(
							'type'=>'POST',
							'url'=>$this->createUrl('accomplishments/updateConso'),
							'update'=>'#conso',
							//'success'=>'js:function(data){}'
									  ),
					)
				   );?>
<div id="labmenu">
	<?php echo CHtml::Link('CHEMLAB', '', 
	    	array(
	    		'onClick' => '{$("#lab").val("1");}',
				'style'=>'cursor: pointer',
	    		'ajax'=>array(
						'type'=>'POST',
	    				'url'=>$this->createUrl('accomplishments/updateConso'),
	    				'update'=>'#conso',
						//'dataType' => 'JSON'
						)
	        	));?>
	<?php echo CHtml::Link('MICROLAB', '', 
	    	array(
	    		'onClick' => '{$("#lab").val("2");}',
				'style'=>'cursor: pointer',
	    		'ajax'=>array(
						'type'=>'POST',
	    				'url'=>$this->createUrl('accomplishments/updateConso'),
	    				'update'=>'#conso',
						//'dataType' => 'JSON'
						)
	        	));?>
	<?php echo CHtml::Link('METROLAB', '', 
	    	array(
	    		'onClick' => '{$("#lab").val("3");}',
				'style'=>'cursor: pointer',
	    		'ajax'=>array(
						'type'=>'POST',
	    				'url'=>$this->createUrl('accomplishments/updateConso'),
	    				'update'=>'#conso',
						//'dataType' => 'JSON'
						)
	        	));?>
</div>					   
<?php $this->endWidget(); ?>
<div id="submenu" style="display: none">
<?php	  
	  $this->widget('zii.widgets.CMenu',array(
				'items'=>array(
					array('label'=>'CHEMLAB', 'url'=>array('/accomplishments/consolidated/1')),
					array('label'=>'MICROLAB', 'url'=>array('/accomplishments/consolidated/2')),
					array('label'=>'METROLAB', 'url'=>array('/accomplishments/consolidated/3')),
				),
			));
?>
</div>
<br/><br/>
<table id="title" style="border:1px;">
	<tr><td><center><h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	RSTL IX <?php echo date('Y');?> Summary of Accomplishment</h3></center></td></tr>
</table>

<div id="conso">
	<?php 
	$this->renderpartial('_conso', array('lab'=>Lab::model()->findByPk($lab),
									   'accomp'=>$accomp, 'requests'=>$requests, 
									   'requests2'=>$requests2, 'sampleCount'=>$sampCount,
									   'total'=>$total));?>
</div>
<table>
<?php $total=0; $count=0; $discount = 0;?>
<?php //foreach($requests2 as $request){?>
<?php //$customer = Customer::model()->findByPk($request->customerId);?>
  <tr>
    <td><?php //echo $request->requestRefNum.'--'.$request->total.'-------';
		//echo $customer->customerName.'--'.$customer->id;
		//if($request->discount){
					//$discount = $discount + ($request->total / 0.75) * 0.25;
					//echo ($request->total / 0.75) * 0.25;
				//}	
    ?>
	</td>
    <td></td>
  </tr>
  	
	<?php
		//if($request->discount)
			//$discount = $discount + ($request->total / 0.75) * 0.25;
		
		//$total = $total + $request->total;
	?>
				
	<?php //$count = $count + 1;?>
<?php //}?>
	
</table>
<?php //echo $total.'--'.$discount.'<br/>'?>
<?php //echo $total + $discount?>

<script>
	$(document).ready(function(){
		$("#accomplishment tbody tr").click(function(){
			//$(this).addClass("selected");
			//alert("aksjdhakljdhlakjs");
			});
		});
</script>
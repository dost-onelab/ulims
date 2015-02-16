<?php //print_r($summarys);?>
<?php echo CHtml::dropDownList('year', $select,	
				   CHtml::listData($this->getYear(), 'index', 'year'));?>
<div id="submenu">
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
<?php ?>

<table id="hide">
  <tr>
    <th colspan="4">SHOW / HIDE COLUMNS</th>
  </tr>
  <tr>
    <th class="customers">CUSTOMERS</th>
    <th class="samples">SAMPLES</th>
    <th class="tests">TESTS</th>
    <th class="amount">AMOUNT</th>
  </tr>
</table>


<table id="title" style="border:1px;">
	<tr><td><center><h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	RSTL IX <?php echo $_SESSION['year'];?> Summary of Accomplishment</h3></center></td></tr>
</table>

<div id="summary_container">
<table id="summary">
  
  <tr>
  	<th class="references" rowspan="3"><div>Request Reference Number</div></th>
    <th class="customers" colspan="3" rowspan="2"><div>Customers</div></th>
    <th class="samples" colspan="4" rowspan="2"><div align="center">Samples</div></th>
    <th class="tests" colspan="4" rowspan="2"><div align="center">Tests</div></th>
    
    <th class="income" colspan="7"><div align="center">Amount</div></th>

    
    <th class="or-date" rowspan="3"><div align="center">OR-Date</div>      <div align="center"></div>      <div align="center"></div></th>
  </tr>
  <tr>
    <th class="gross" rowspan="2"><div align="center">Total</div>      <div align="center"></div>      <div align="center"></div></th>
    <th class="paid" colspan="2"><div align="center">PAID</div></th>
    <th class="gratis" colspan="2"><div align="center">GRATIS</div></th>
    <th class="discount" width="43" rowspan="2"><div align="center">25%</div>      <div align="center"></div></th>
    <th class="balance" width="43" rowspan="2"><div align="center">Balance</div>      <div align="center"></div></th>
  </tr>
  <tr>
    <th class="name" width="78"><div>Name of Client</div></th>
    <th class="customer_nonsetup"><div>NS</div></th>
    <th class="customer_setup"><div>S</div></th>

	<th class="samplename"><div>Name</div></th>
	<th class="samplecode"><div>Code</div></th>
	<th class="sample_nonsetup"><div>NS</div></th>
	<th class="sample_setup"><div>S</div></th>
    
    <th class="parameters" width="78"><div align="center">Params</div></th>
    <th class="unit_price" width="78"><div align="center">Unit Price</div></th>
    <th class="test_nonsetup" width="43"><div align="center">NS</div></th>
    <th class="test_setup" width="43"><div align="center">S</div></th>
    
    <th class="nonsetup" width="43"><div align="center">NON-SETUP</div></th>
    <th class="setup" width="43"><div align="center">SETUP</div></th>
    
    <th class="nonsetup" width="43"><div align="center">NON-SETUP</div></th>
    <th class="setup" width="43"><div align="center">SETUP</div></th>
  </tr>
  <?php $countRequest = 0//for($month = 1; $month <= 12; $month = $month + 1){?>
  <?php 
  		$customerNonSetup = 0;
  		$customerSetup = 0;
  		$sampleNonSetup = 0;
  		$sampleSetup = 0;
  		$testNonSetup = 0;
  		$testSetup = 0;
  		
  		$total = 0;
  		
  		
  		$paidNonSetup = 0;
  		$paidSetup = 0;
  		
  		$gratisNonSetup = 0;
  		$gratisSetup = 0;
  		
  		$discountTotal = 0;
  		$balanceTotal = 0;
  ?>
  <?php //$hehe = count($summarys[$countRequest]['sample'][$countRequest]['test'])?>
  <?php foreach($summarys as $summary){?>
  
  <tr>
    <td class="reference"><?php echo $summary['request'];?></td>
    
    <!-- Customers -->
    <td class="customer_name"><?php echo $summary['customer']['agency'];?></td>
    <td class="customer_nonsetup"><?php if($summary['customer']['type'] == 2) { echo '1'; $customerNonSetup += 1; }else{ echo '-';}?></td>
    <td class="customer_setup"><?php if($summary['customer']['type'] == 1) { echo '1'; $customerSetup += 1;}else{ echo '-';}?></td>
    
    <!-- Samples -->
    <?php $countSamples = 0;?>
    <?php foreach($summary['sample'] as $sample){?>
	   <?php if($countSamples !=0){?>
	    	<td class="reference"></td>
	    	<td class="customer_name"></td>
	    	<td class="customer_nonsetup"></td>
	    	<td class="customer_setup"></td>
	    <?php }?>
	    <td class="sample_name"><?php echo $sample['name'];?></td>
	    <td class="sample_code"><div><?php echo $sample['code'];?></div></td>
	    <td class="sample_nonsetup"><?php if($summary['customer']['type'] == 2) { echo '1'; $sampleNonSetup += 1;}else{ echo '-';}?></td>
	    <td class="sample_setup"><?php if($summary['customer']['type'] == 1) { echo '1'; $sampleSetup += 1;}else{ echo '-';}?></td>
		
	    <!-- Analyses -->
	    <?php $countAnalyses = 0;?>
	    <?php foreach($sample['test'] as $test){?>
	    	<?php if($countAnalyses !=0){?>
		    	<td class="reference"></td>
		    	<td class="customer_name"></td>
		    	<td class="customer_nonsetup"></td>
		    	<td class="customer_setup"></td>
		    	<td class="sample_name"></td>
		    	<td class="sample_code"></td>
		    	<td class="sample_nonsetup"></td>
		    	<td class="sample_setup"></td>
	    	<?php }?>
	    	<td class="test_param"><?php echo $test['param'];?></td>
	    	<td class="test_fee"><?php echo Yii::app()->format->formatNumber($test['fee']);?></td>
	    	<td class="test_nonsetup"><?php if($summary['customer']['type'] == 2) { echo '1'; $testNonSetup += 1;}else{ echo '-';}?></td>
		    <td class="test_setup"><?php if($summary['customer']['type'] == 1) { echo '1'; $testSetup += 1;}else{ echo '-';}?></td>
		    <td class="total"><?php if($countSamples == 0 && $countAnalyses == 0) {if($summary['payment']['discount'] == 1){$discount = 0.75;}else{$discount = 1;} $total += $summary['payment']['total']/$discount; echo Yii::app()->format->formatNumber($summary['payment']['total']/$discount);}?></td>
		    <?php if($summary['payment']['type']){?>
		    	<td class="payment_paid_nonsetup"><?php if($summary['customer']['type'] == 2 && $countSamples == 0 && $countAnalyses == 0) { $paidNonSetup += $summary['payment']['total']; echo Yii::app()->format->formatNumber($summary['payment']['total']);}?></td>
		    	<td class="payment_paid_setup"><?php if($summary['customer']['type'] == 1 && $countSamples == 0 && $countAnalyses == 0) { $paidSetup += $summary['payment']['total']; echo Yii::app()->format->formatNumber($summary['payment']['total']);}?></td>
		    	<td class="payment_gratis_nonsetup">-</td>
		    	<td class="payment_gratis_setup">-</td>
		   <?php }else{?> 
		   		<td class="payment_paid_nonsetup">-</td>
		    	<td class="payment_paid_setup">-</td>
		   		<td class="payment_gratis_nonsetup"><?php if($summary['customer']['type'] == 2 && $countSamples == 0 && $countAnalyses == 0) { $gratisNonSetup += $summary['payment']['total']; echo Yii::app()->format->formatNumber($summary['payment']['total']); }?></td>
		    	<td class="payment_gratis_setup"><?php if($summary['customer']['type'] == 1 && $countSamples == 0 && $countAnalyses == 0) { $gratisSetup += $summary['payment']['total']; echo Yii::app()->format->formatNumber($summary['payment']['total']); }?></td>
		   <?php }?>

		    <td class="discount"><?php if($summary['payment']['discount'] == 1 && $countAnalyses == 0 && $countSamples == 0) { $discountTotal += ($summary['payment']['total'] / 0.75) * 0.25; echo Yii::app()->format->formatNumber(($summary['payment']['total'] / 0.75) * 0.25); }else{ echo '-';}?></td>
		    <td class="balance"><?php //if($countSamples == 0 && $countAnalyses == 0) echo Yii::app()->format->formatNumber($summary['payment']['total']);?>	</td>
		    
		    <td class="or_date"><?php ?></td>
		    </tr>
		    <?php $countAnalyses = $countAnalyses +1;?>
	    <?php }?>
	    
	    <?php $countSamples = $countSamples +1;?>
    <?php }?>
    
 	<?php $countRequest = $countRequest + 1;?>
  <?php }?>
  <tr>
    <td><div align="center">Sub-Total</div></td>
    <td class=""><?php //echo $total['samples_nonsetup'];?></td>
    <td class="customerNonSetup"><?php echo $customerNonSetup;?></td>
    <td class="customerSetup"><?php echo $customerSetup;?></td>
    <td class=""><?php //echo $total['tests_setup'];?></td>
    <td class=""><?php //echo $total['customers_nonsetup'];?></td>
    <td class="sampleNonSetup"><?php echo $sampleNonSetup?></td>
    <td class="sampleSetup"><?php echo $sampleSetup;?></td>
    <td class=""><?php //echo Yii::app()->format->formatNumber($total['income_setup']);?></td>
    <td class=""><?php //echo Yii::app()->format->formatNumber($total['value_gratis_nonsetup']);?></td>
    <td class="testNonSetup"><?php echo $testNonSetup;?></td>
    <td class="testSetup"><?php echo $testSetup;?></td>
    <td class="total"><?php echo Yii::app()->format->formatNumber($total);?></td>
    <td class="paidNonSetup"><?php echo Yii::app()->format->formatNumber($paidNonSetup);?></td>
    <td class="paidSetup"><?php echo Yii::app()->format->formatNumber($paidSetup);?></td>
    <td class="gratisNonSetup"><?php echo Yii::app()->format->formatNumber($gratisNonSetup);?></td>
    <td class="gratisSetup"><?php echo Yii::app()->format->formatNumber($gratisSetup);?></td>
    <td class="discountTotal"><?php echo Yii::app()->format->formatNumber($discountTotal);?></td>
    <td class="balance"><?php echo Yii::app()->format->formatNumber($balanceTotal);?></td>
    <td class="or_date"></td>
  </tr>
  <tr>
    <td><div align="center">TOTAL</div></td>
    <td class="samples_total" colspan="2"><?php echo $total['samples_nonsetup'] + $total['samples_setup'];?></td>
    <td class="tests_total" colspan="2"><?php echo $total['tests_nonsetup'] + $total['tests_setup'];?></td>
    <td class="customers_total" colspan="2"><?php echo $total['customers_nonsetup'] + $total['customers_setup'];?></td>
    <td class="income_total" colspan="2"><?php echo Yii::app()->format->formatNumber($total['income_nonsetup'] + $total['income_setup']);?></td>
    <td class="value_total" colspan="3"><?php echo Yii::app()->format->formatNumber($total['value_gratis_nonsetup'] + $total['value_gratis_setup'] + $total['value_discount']);?></td>
    <td class="gross_total"><?php echo Yii::app()->format->formatNumber($total['gross']);?></td>
  </tr>
</table>


</div>	
<?php
    $hideColumns = "
    				//$('table#summary tr *:nth-child('+ 2 +')').toggle();
    				
    				$('table#hide th.customers').click(function(){
    					    $('table#summary th.customers').toggle();
    					    $('table#summary th.name').toggle();
    					    $('table#summary th.customer_nonsetup').toggle();
    					    $('table#summary th.customer_setup').toggle();

							$('table#summary td.customer_name').toggle();
    					    $('table#summary td.customer_nonsetup').toggle();
    					    $('table#summary td.customer_setup').toggle();
    				});

    				$('table#hide th.samples').click(function(){
    					    $('table#summary th.samples').toggle();
    					    $('table#summary th.samplename').toggle();
    					    $('table#summary th.samplecode').toggle();
    					    $('table#summary th.sample_nonsetup').toggle();
    					    $('table#summary th.sample_setup').toggle();

							$('table#summary td.sample_name').toggle();
							$('table#summary td.sample_code').toggle();
    					    $('table#summary td.sample_nonsetup').toggle();
    					    $('table#summary td.sample_setup').toggle();
    				});
    ";
    Yii::app()->clientScript->registerScript('',$hideColumns,CClientScript::POS_READY);
    
?>
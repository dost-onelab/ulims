<?php //print_r($accomp);?>
<?php $summaryImage = CHtml::Image(Yii::app()->theme->baseUrl . '/images/small_icons/page_excel.png', 'Export'); ?>
<table id="consolidated" style="{border: 1px solid #000;}">
  
  <tr>
    <th class="month" width="102" rowspan="3"><div align="center">Month</div></th>
    <th class="<?php echo $lab->labCode;?>" colspan="12"><div align="center"><?php echo $lab->labName;?></div></th>
  </tr>
  <tr>
    <th class="samples" colspan="2" rowspan="2"><div align="center">Samples</div></th>
    <th class="tests" colspan="2" rowspan="2"><div align="center">Tests</div></th>
    <th class="customers" colspan="2" rowspan="2"><div align="center">Customers</div></th>
    <th class="income" colspan="2" rowspan="2"><div align="center">Income (Actual Fees Collected)</div></th>
    <th class="value" colspan="3"><div align="center">Value of Assistance</div></th>
    <th class="gross" width="71" rowspan="3"><div align="center">GROSS</div>      <div align="center"></div>      <div align="center"></div></th>
  </tr>
  <tr>
    <th class="gratic" colspan="2"><div align="center">GRATIS</div></th>
    <th class="discount" width="43" rowspan="2"><div align="center">25%</div>      <div align="center"></div></th>
  </tr>
  <tr>
    <th><div align="center"><?php echo $_SESSION['year'];?></div></th>
	<th class="nonsetup" width="78"><div align="center">NON-SETUP</div></th>
	<th class="setup" width="43"><div align="center">SETUP</div></th>
    <th class="nonsetup" width="78"><div align="center">NON-SETUP</div></th>
    <th class="setup" width="57"><div align="center">SETUP</div></th>
    <th class="nonsetup" width="43"><div align="center">NON-SETUP</div></th>
    <th class="setup" width="43"><div align="center">SETUP</div></th>
    <th class="nonsetup" width="43"><div align="center">NON-SETUP</div></th>
    <th class="setup" width="43"><div align="center">SETUP</div></th>
    <th class="nonsetup" width="43"><div align="center">NON-SETUP</div></th>
    <th class="setup" width="43"><div align="center">SETUP</div></th>
  </tr>
  <?php for($month = 1; $month <= 12; $month = $month + 1){?>
  <tr>
    <td class="month">
    	<div align="center">
    		<?php //echo CHtml::link(date('M',mktime(0, 0, 0, $month, 1, $_SESSION['year'])), $this->createUrl('accomplishment/summary', array('labId'=>$lab->id, 'month'=>$month,'year'=>date('Y'))));?>
    		<?php echo CHtml::link(date('M',mktime(0, 0, 0, $month, 1, $_SESSION['year'])), $this->createUrl('accomplishment/exportSummary', array('labId'=>$lab->id, 'month'=>$month))); ?>
    	</div>
    	<div align="center">
    	<?php //echo CHtml::link($summaryImage, $this->createUrl('accomplishment/exportSummary', array('labId'=>$lab->id, 'month'=>$month))); ?>
    	</div>	
    </td>
    <td class="samples_nonsetup"><?php echo $accomp[$month]['samples']['nonsetup'] ? $accomp[$month]['samples']['nonsetup'] : '-';?></td>
    <td class="samples_setup"><?php echo $accomp[$month]['samples']['setup'] ? $accomp[$month]['samples']['setup'] : '-';?></td>
    <td class="tests_nonsetup"><?php echo $accomp[$month]['tests']['nonsetup'] ? $accomp[$month]['tests']['nonsetup'] : '-';?></td>
    <td class="tests_setup"><?php echo $accomp[$month]['tests']['setup'] ? $accomp[$month]['tests']['setup'] : '-';?></td>
    <td class="customers_nonsetup"><?php echo $accomp[$month]['customers']['nonsetup'] ? $accomp[$month]['customers']['nonsetup'] : '-';?></td>
    <td class="customers_setup"><?php echo $accomp[$month]['customers']['setup'] ? $accomp[$month]['customers']['setup'] : '-';?></td>
    <td class="income_nonsetup"><?php echo $accomp[$month]['income']['nonsetup'] ? Yii::app()->format->formatNumber($accomp[$month]['income']['nonsetup']) : '-';?></td>
    <td class="income_setup"><?php echo $accomp[$month]['income']['setup'] ? Yii::app()->format->formatNumber($accomp[$month]['income']['setup']) : '-';?></td>
    <td class="value_gratis_nonsetup"><?php echo $accomp[$month]['value']['gratis_nonsetup'] ? Yii::app()->format->formatNumber($accomp[$month]['value']['gratis_nonsetup']) : '-';?></td>
    <td class="value_gratis_setup"><?php echo $accomp[$month]['value']['gratis_setup'] ? Yii::app()->format->formatNumber($accomp[$month]['value']['gratis_setup']) : '-';?></td>
    
    <td class="value_discount"><?php echo $accomp[$month]['value']['discount'] ? Yii::app()->format->formatNumber($accomp[$month]['value']['discount']) : '-';?></td>
    <td class="gross"><?php echo $accomp[$month]['gross'] ? Yii::app()->format->formatNumber($accomp[$month]['gross']) : '-';?></td>
  </tr>
  <?php }?>
  <tr>
    <td class="month"><div align="center">Sub-Total</div></td>
    <td class="samples_nonsetup_subtotal"><?php echo $total['samples_nonsetup'];?></td>
    <td class="samples_setup_subtotal"><?php echo $total['samples_setup'];?></td>
    <td class="tests_nonsetup_subtotal"><?php echo $total['tests_nonsetup'];?></td>
    <td class="tests_setup_subtotal"><?php echo $total['tests_setup'];?></td>
    <td class="customers_nonsetup_subtotal"><?php echo $total['customers_nonsetup'];?></td>
    <td class="customers_setup_subtotal"><?php echo $total['customers_setup'];?></td>
    <td class="income_nonsetup_subtotal"><?php echo Yii::app()->format->formatNumber($total['income_nonsetup']);?></td>
    <td class="income_setup_subtotal"><?php echo Yii::app()->format->formatNumber($total['income_setup']);?></td>
    <td class="value_gratis_nonsetup_subtotal"><?php echo Yii::app()->format->formatNumber($total['value_gratis_nonsetup']);?></td>
    <td class="value_gratis_setup_subtotal"><?php echo Yii::app()->format->formatNumber($total['value_gratis_setup']);?></td>
    <td class="value_discount_subtotal"><?php echo Yii::app()->format->formatNumber($total['value_discount']);?></td>
    <td class="gross_subtotal"><?php echo Yii::app()->format->formatNumber($total['gross']);?></td>
  </tr>
  <tr>
    <td class="month"><div align="center">TOTAL</div></td>
    <td class="samples_total" colspan="2"><?php echo $total['samples_nonsetup'] + $total['samples_setup'];?></td>
    <td class="tests_total" colspan="2"><?php echo $total['tests_nonsetup'] + $total['tests_setup'];?></td>
    <td class="customers_total" colspan="2"><?php echo $total['customers_nonsetup'] + $total['customers_setup'];?></td>
    <td class="income_total" colspan="2"><?php echo Yii::app()->format->formatNumber($total['income_nonsetup'] + $total['income_setup']);?></td>
    <td class="value_total" colspan="3"><?php echo Yii::app()->format->formatNumber($total['value_gratis_nonsetup'] + $total['value_gratis_setup'] + $total['value_discount']);?></td>
    <td class="gross_total"><?php echo Yii::app()->format->formatNumber($total['gross']);?></td>
  </tr>
</table>

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

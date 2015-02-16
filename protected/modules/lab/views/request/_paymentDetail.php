<?php
/* @var $this RequestController */
/* @var $data Request */
Yii::app()->clientscript->scriptMap['jquery.js'] = false;
Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
?>

<div class="view">
<span style="display:inline-block;">
<?php echo "<font color='#666666'>Request Reference #: </font><br \><b style='font-size:1.25em;'>". $request->requestRefNum."</b>";?>
</span>
<span class="<?php echo $request->paymentStatus['class']; ?>" style="float:right; min-width:80px; min-height:30px; line-height:30px;text-align:center;display:inline-block;font-weight:bold;"><?php echo $request->paymentStatus['label']; ?></span>
	<?php
		$this->widget('ext.groupgridview.GroupGridView', array(
			'id'=>'collection-grid',
			'summaryText'=>false,
			'emptyText'=>'No payment record',
			'htmlOptions'=>array('style'=>'padding-bottom:0px;'),
			'itemsCssClass'=>'table table-striped table-bordered table-condensed',
			'dataProvider'=>$model,
			//'filter'=>$model,
			'extraRowColumns' => array('request_id'),
			'extraRowColumnsGroupFooter' => array('request_id'),
			'extraRowPos' => 'below',
			'extraRowTotals' => function($data, $row, &$totals) {
          	if(!isset($totals['count'])) $totals['count'] = 0;
         	 $totals['count']++;

          	if(!isset($totals['sum_amount'])) $totals['sum_amount'] = 0;
          		$totals['sum_amount'] += $data['amount'];
      		},
			'extraRowExpression' => '"<i class=\"total\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Amount Paid</i><td class=\"payment-detail amount subtotal\">".Yii::app()->format->formatNumber($totals["sum_amount"])."</td>"',
			'extraRowColSpan' => 2, //modified by RBG at source code of extension
			//'hiddenColumns' => 1, //modified by RBG at source code of extension
			'extraRowExpressionGroupFooter'=>'"<b class=\"total\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Amount Due</b><td class=\"payment-detail amount amount-due\">".Yii::app()->format->formatNumber('.$request->total.')."</td>"',
			'extraRowFooterColSpan'=>2,
			'columns'=>array(
				array(
					'header'=>'O.R. #',
					'name'=>'receiptid',
					'htmlOptions'=>array('style'=>'text-align:center;width:120px;'),
					),
				array(
					'name'=>'date',
					'headerHtmlOptions'=>array('style'=>'width:130px;'),
					'value'=>'Receipt::model()->findByPk($data->receipt_id)->receiptDate',
					'htmlOptions'=>array('style'=>'text-align:center'),
					'footer'=>'<b>Balance</b>',
					'footerHtmlOptions'=>array('class'=>'amount','style'=>'border-left:none;')					
				),
				array(
					'name'=>'amount',
					'type'=>'raw',
					'value'=>'Yii::app()->format->formatNumber($data->amount)',
					'htmlOptions'=>array('class'=>'amount','style'=>'width:110px;'),
					'footer'=>Yii::app()->format->formatNumber(Request::getBalance($request->total, $request->collection)),
					'footerHtmlOptions'=>array('class'=>'payment-detail amount amount-balance', 'style'=>'text-align:right;font-weight:bold;')
					),
			),
		));		
	?>
</div>

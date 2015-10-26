<?php
/* @var $this RequestController */
/* @var $data Request */
Yii::app()->clientscript->scriptMap['jquery.js'] = false;
Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
?>

<div class="view">
<span style="display:inline-block;">
<?php echo "<font color='#666666'>Request Reference #: </font><br \><b style='font-size:1.25em;'>". $request['requestRefNum']."</b>";?>
</span>
<span class="<?php echo $request->paymentStatus['class']; ?>" style="float:right; min-width:80px; min-height:30px; line-height:30px;text-align:center;display:inline-block;font-weight:bold;"><?php echo $request->paymentStatus['label']; ?></span>
</div>
<?php
		$this->widget('ext.groupgridview.GroupGridView', array(
			'id'=>'collection-grid',
			'summaryText'=>false,
			'emptyText'=>'No payment record',
			'htmlOptions'=>array('style'=>'padding-bottom:0px;'),
			'itemsCssClass'=>'table table-striped table-bordered table-condensed',
			//'dataProvider'=>$samplesDataProvider,
			'dataProvider'=>$analysesDataProvider,
			'mergeColumns' => array('sampleCode'),
			//'filter'=>$model,
			//'extraRowColumns' => array('sampleCode'),
			//'extraRowColumnsGroupFooter' => array('sampleCode'),
			//'extraRowPos' => 'below',
			'extraRowTotals' => function($data, $row, &$totals) {
          	if(!isset($totals['count'])) $totals['count'] = 0;
         	 $totals['count']++;
          
          	if(!isset($totals['sum_fee'])) $totals['sum_fee'] = 0;
          		$totals['sum_fee'] += $data['fee'];
      		},
			//'extraRowExpression' => '"<i class=\"total\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Amount Paid</i><td class=\"payment-detail amount subtotal\">".Yii::app()->format->formatNumber($analyses_sum)."</td>"',
      		'extraRowExpression' => '"<i class=\"total\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Amount Paid</i>',
			//'extraRowColSpan' => 4, //modified by RBG at source code of extension
			//'extraRowExpressionGroupFooter'=>'"<b class=\"total\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Amount Due</b><td class=\"payment-detail amount amount-due\">".Yii::app()->format->formatNumber('.$request->total.')."</td>"',
			//'extraRowFooterColSpan'=>2,
			'columns'=>array(
      			array(
      				'header'=>'Sample Code',
					'name'=>'sampleCode',      				
					'htmlOptions'=>array('style'=>'text-align:center;width:120px;'),
      			),
      			array(
      				'header'=>'Sample Name',
					'name'=>'sampleName',      				
					'htmlOptions'=>array('style'=>'text-align:left;width:400px;'),
      			),
      			array(
      				'header'=>'Description',
					'name'=>'description',      				
					'htmlOptions'=>array('style'=>'text-align:left;width:400px;'),
      			),
      			array(
      				'header'=>'Test Name',
					'name'=>'testName',      				
					'htmlOptions'=>array('style'=>'text-align:left;width:150px;'),
      			),
      			array(
      				'header'=>'Method',
					'name'=>'method',      				
					'htmlOptions'=>array('style'=>'text-align:left;width:200px;'),
      			),
      			array(
      				'header'=>'References',
					'name'=>'references',      				
					'htmlOptions'=>array('style'=>'text-align:left;width:200px;'),
      				'footer'=>'Sub-Total<br/>Discount<br/>Total',
      				'footerHtmlOptions'=>array('style'=>'color:blue;text-align:right;width:150px;'),
      			),
      			array(
      				'header'=>'Fee',
					'name'=>'fee',      
      				'value'=>'Yii::app()->format->formatNumber($data["fee"])',				
					'htmlOptions'=>array('style'=>'text-align:right;width:150px;'),
      				'footer'=>Yii::app()->format->formatNumber($analyses_sum).'<br/>'.Yii::app()->format->formatNumber($discount).'<br/>'.Yii::app()->format->formatNumber($analyses_sum-$discount),
      				'footerHtmlOptions'=>array('style'=>'color:blue;text-align:right;width:150px;'),
      			)
				/*array(
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
					),*/
			),
		));
	?>
	
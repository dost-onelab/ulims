<font style="font-weight:bold;font-size:0.9em">Select Referrals : </font>
<?php 
		$this->widget('zii.widgets.grid.CGridView', array(
		   'id'=>'referrals-grid', // the containerID for getChecked
		   'emptyText'=>'No request.',
		   'summaryText'=>false,
		   'htmlOptions'=>array('class'=>'grid-view padding0', 'style'=>'width:560px;'),
		   'dataProvider'=>$gridDataProvider,
		   'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
		   'rowHtmlOptionsExpression' => 'array("class"=>"link-hand")',
		   //'selectableRows'=>2,
		   'columns'=>array(
		       array(
					'id'=>'referralIds', // the columnID for getChecked
					'class'=>'CCheckBoxColumn',
					'selectableRows'=>2,
					'disabled'=>'($data["balance"] == 0)?TRUE:FALSE'
		       ),
		       //'customer.customerName',
		       array(
		       	'header'=>'Referral Code',
		       	'name'=>'referralCode',
		       	'htmlOptions' => array('style' => 'width: 200px; text-align: left;')
		       ),
		       array(
		       	'header'=>'Referral Date',
		       	'name'=>'referralDate',
		       	'htmlOptions' => array('style' => 'width: 80px; text-align: center;'),
		       ),
		       array(
		       	'header'=>'Balance',
		       	'name'=>'balance',
		       	'htmlOptions' => array('style' => 'width: 80px; text-align: right;'),
		       ),
			   array(
			   	'header'=>'Status/ O.P. #',
				'type'=>'raw',
				'name'=>'paymentItem',
				'htmlOptions' => array('style' => 'width: 180px; text-align: center; ')
			   )
		   ),
		));
		?>
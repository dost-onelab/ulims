<font style="font-weight:bold;font-size:0.9em">Select Request : </font>
<?php
		$this->widget('zii.widgets.grid.CGridView', array(
		   'id'=>'requests-grid', // the containerID for getChecked
		   'emptyText'=>'No request.',
		   'summaryText'=>false,
		   'htmlOptions'=>array('class'=>'grid-view padding0', 'style'=>'width:560px;'),
		   'dataProvider'=>$gridDataProvider,
		   'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
		   'rowHtmlOptionsExpression' => 'array("class"=>"link-hand")',
		   //'selectableRows'=>2,
		   'columns'=>array(
		       array(
					'id'=>'requestIds', // the columnID for getChecked
					'class'=>'CCheckBoxColumn',
					'selectableRows'=>2,
					'disabled'=>'$data[orderOfPayment]?TRUE:FALSE'
		       ),
		       //'customer.customerName',
		       array(
		       	'header'=>'Request Ref Num',
		       	'name'=>'requestRefNum',
		       	'htmlOptions' => array('style' => 'width: 200px; text-align: left;')
		       ),
		       array(
		       	'header'=>'Request Date',
		       	'name'=>'requestDate',
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
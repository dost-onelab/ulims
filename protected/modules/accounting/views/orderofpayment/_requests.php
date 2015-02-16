<?php
		$this->widget('zii.widgets.grid.CGridView', array(
		   'id'=>'requests-grid', // the containerID for getChecked
		   'dataProvider'=>$gridDataProvider,
		   'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
		   'rowHtmlOptionsExpression' => 'array("title" => "Click to view project", "class"=>"link-hand")',
		   'selectableRows'=>2,
		   'columns'=>array(
		       array(
					'id'=>'requestIds', // the columnID for getChecked
					'class'=>'CCheckBoxColumn',
		       ),
		       'customer.customerName',
		       'requestRefNum',
		       'requestDate'
		   ),
		));
		?>
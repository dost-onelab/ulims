<?php
		$this->widget('zii.widgets.grid.CGridView', array(
		   'id'=>'requests-grid', // the containerID for getChecked
		   'dataProvider'=>$gridDataProvider,
		   'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
		   'rowHtmlOptionsExpression' => 'array("title" => "Click to view project", "class"=>"link-hand")',
		   'selectableRows'=>2,
		   'columns'=>array(
		       array(
		           'class'=>'CCheckBoxColumn',
		       	   'header'=>'Select',
		           'id'=>'example-check-boxes', // the columnID for getChecked
   					'value'=>'$data->id',
		       ),
		       'id',
		       'customer.customerName',
		       'requestRefNum',
		       'requestDate'
		   ),
		));
		?>
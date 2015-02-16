<?php 
//default no-image
$noImage='<span class="no-image">NO IMAGE</span>';
//TRUNCATE TABLE tablename
?>
<div class="alert alert-danger">
<i class="icon-warning-sign"></i>
<font><b>WARNING!</b> <i>(For systems administrator only)</i></font>
<p><br />
This option will TRUNCATE all existing data on the following database tables</p>
</div>


<div class="form wide">
	<div class="row">
    <h5><small>Database name:</small> ulimslab</h5>
	<?php $this->widget('zii.widgets.grid.CGridView', array(
                    'id'=>'ulimslab-grid',
                    'summaryText'=>false,
                    'htmlOptions'=>array('class'=>'grid-view padding0'),
                    'itemsCssClass'=>'table table-striped table-condensed',
                    'rowHtmlOptionsExpression' => 'array("title" => "Click to update", "class"=>"link-hand")',
                    'dataProvider'=>$ulimsLabAffectedTables,
                    'columns'=>array(
							array(
								'header'=>'Affected Tables',
								'name'=>'tableName',
								'htmlOptions'=>array('style'=>'text-align:center;')
								),
							array(
								'header'=>'Rows',
								'name'=>'numRows',
								'htmlOptions'=>array('style'=>'text-align:center;')
								),
							array(
								'header'=>'Size',
								'name'=>'size',
								'htmlOptions'=>array('style'=>'text-align:center;')
								)
                        ),
	)); ?>            
	</div>
	<div class="row">
    <h5><small>Database name:</small> ulimscashiering</h5>
	<?php $this->widget('zii.widgets.grid.CGridView', array(
                    'id'=>'ulimscashiering-grid',
                    'summaryText'=>false,
                    'htmlOptions'=>array('class'=>'grid-view padding0'),
                    'itemsCssClass'=>'table table-striped table-condensed',
                    'rowHtmlOptionsExpression' => 'array("title" => "Click to update", "class"=>"link-hand")',
                    'dataProvider'=>$ulimsCashieringAffectedTables,
                    'columns'=>array(
							array(
								'header'=>'Affected Tables',
								'name'=>'tableName',
								'htmlOptions'=>array('style'=>'text-align:center;')
								),
							array(
								'header'=>'Rows',
								'name'=>'numRows',
								'htmlOptions'=>array('style'=>'text-align:center;')
								),
							array(
								'header'=>'Size',
								'name'=>'size',
								'htmlOptions'=>array('style'=>'text-align:center;')
								)
                        ),
	)); ?>            
	</div>
	<div class="row">
    <h5><small>Database name:</small> ulimsaccounting</h5>
	<?php $this->widget('zii.widgets.grid.CGridView', array(
                    'id'=>'ulimsaccounting-grid',
                    'summaryText'=>false,
                    'htmlOptions'=>array('class'=>'grid-view padding0'),
                    'itemsCssClass'=>'table table-striped table-condensed',
                    'rowHtmlOptionsExpression' => 'array("title" => "Click to update", "class"=>"link-hand")',
                    'dataProvider'=>$ulimsAccountingAffectedTables,
                    'columns'=>array(
							array(
								'header'=>'Affected Tables',
								'name'=>'tableName',
								'htmlOptions'=>array('style'=>'text-align:center;')
								),
							array(
								'header'=>'Rows',
								'name'=>'numRows',
								'htmlOptions'=>array('style'=>'text-align:center;')
								),
							array(
								'header'=>'Size',
								'name'=>'size',
								'htmlOptions'=>array('style'=>'text-align:center;')
								)
                        ),
	)); ?>            
	</div>          
     
     <input type="hidden" id="str_var" name="str_var" value="<?php print base64_encode(serialize($affectedTables)); ?>"/>   
     
            <?php echo CHtml::ajaxButton('Truncate',
						array('config/truncate'),
						array(
							'type'=>'POST',
							'data'=>'js:$("#str_var").serialize()',
							'dataType'=>'json',
							'success'=>'function(data){
									$.fn.yiiGridView.update("ulimslab-grid");
									$.fn.yiiGridView.update("ulimscashiering-grid");
									$.fn.yiiGridView.update("ulimsaccounting-grid");
									show_message(data.status);
								}',
							'beforeSend' => 'js:
                                function(){
                                   var r = confirm("Are you sure you want to truncate data on affected tables?");
                           		   if(!r){return false;} 
                                }
                               '	
						),
						array('class'=>'btn btn-warning')); 
			?>
       		
            <span id="truncate_msg" style="color:#F00;font-weight:bold; width:300px;"></span>
</div>
<script type="text/javascript">

	function show_message(msg){
		$('#truncate_msg').show();
		$('#truncate_msg').html(msg);
		$('#truncate_msg').fadeOut(5000);
	}
</script>
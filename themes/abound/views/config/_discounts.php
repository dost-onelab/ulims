<?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'discounts-grid',
        'summaryText'=>false,
		'htmlOptions'=>array('class'=>'grid-view padding0'),
        'itemsCssClass'=>'table table-striped table-bordered table-condensed',
        'rowHtmlOptionsExpression' => 'array("title" => "Click to update", "class"=>"link-hand")',
        'dataProvider'=>$discountsDataProvider,
        'columns'=>array(
            //'id',
            'type',
			array(
            	'name'=>'rate',
				'value'=>'$data->rate." %"',
				'htmlOptions' => array('style' => 'width: 300px; text-align: center; ')
			),
           	array(
			'header'=>'Status',
			'htmlOptions'=>array('class'=>'btn-group btn-group-yesno'),
			'class'=>'bootstrap.widgets.TbButtonColumn',
						//'deleteConfirmation'=>"js:'Do you really want to delete sample: '+$.trim($(this).parent().parent().children(':nth-child(2)').text())+'?'",
						'template'=>'{active}{not active}',
						'buttons'=>array
						(
							'active' => array(
								'label'=>'Active',
								'url'=>'Yii::app()->createUrl("/config/activateDiscount/id/$data->id")',
								'options' => array(
									'class'=>'$data->status ? "btn active btn-success" : "btn"',
									//'confirm'=>'Do you want to set this Lab as Active?',
									'ajax' => array(
										'type' => 'get',
										'url'=>'js:$(this).attr("href")', 
										'success' => 'js:function(data) { $.fn.yiiGridView.update("discounts-grid"); }')
									),
								),
							'not active' => array(
								'label'=>'Inactive',
								'url'=>'Yii::app()->createUrl("/config/deactivateDiscount/id/$data->id")',
								'options' => array(
									'class'=>'$data->status ? "btn" : "btn active btn-danger"',
									//'confirm'=>'Do you want to set this Lab as Inactive?',
									'ajax' => array(
										'type' => 'get', 
										'url'=>'js:$(this).attr("href")', 
										'success' => 'js:function(data) { $.fn.yiiGridView.update("discounts-grid"); }')
									),
								),
						),
			)
            ),
));
?>

<?php echo Chtml::link('<span class="icon-plus icon-white"></span> Add New Discount', '', array(
				'class'=>'btn btn-success btn-small',
                'style'=>'cursor:pointer; font-weight:normal;color:white;',
				'title'=>'Add New Discount',
                'onClick'=>'js:{addNewDiscount(); $("#dialogNewDiscount").dialog("open");}',
                ));
?>

<!-- Discount Dialog : Start -->
<?php
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		    'id'=>'dialogNewDiscount',
		    // additional javascript options for the dialog plugin
		    'options'=>array(
		        'title'=>'Add New Discount',
				'show'=>'scale',
				'hide'=>'scale',				
				'width'=>250,
				'modal'=>true,
				'resizable'=>false,
				'autoOpen'=>false,
			    ),
		));

	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<!-- Discount Dialog : End -->

<?php 
Yii::app()->clientScript->registerScript('discountsgrid', "
$('#discounts-grid table tbody tr').live('click',function()
{
	    var id = $.fn.yiiGridView.getKey(
        'discounts-grid',
        $(this).prevAll().length 
    	);
    	
		if($(this).children(':nth-child(1)').text()=='No results found.'){
			alert($(this).children(':nth-child(1)').text());
		}else{
			updateDiscount(id);
			$('#dialogUpdateDiscount').dialog('open');
		}
});
");
?>

<script type="text/javascript">
function addNewDiscount()
{
    <?php echo CHtml::ajax(array(
			'url'=>$this->createUrl('lab/discount/create'),
			'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
					$('#dialogNewDiscount').html(data.div);
                    // Here is the trick: on submit-> once again this function!
                    $('#dialogNewDiscount form').submit(addNewDiscount);
                }
                else
                {
					$.fn.yiiGridView.update('discounts-grid');
					$('#dialogNewDiscount').html(data.div);
					setTimeout(\"$('#dialogNewDiscount').dialog('close') \",1000);
                }
 
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogNewDiscount").html(
						\'<div class="loader">'.$image.'<br\><br\>Processing.<br\> Please wait...</div>\'
					);
             }',
			 'error'=>"function(request, status, error){
				 	$('#dialogNewDiscount').html(status+'('+error+')'+': '+ request.responseText );
					}",
			
            ))?>;
    return false;	
}

function updateDiscount(id)
{
	<?php 
	echo CHtml::ajax(array(
			'url'=>$this->createUrl('lab/discount/update'),
			'data'=> "js:$(this).serialize()+ '&id='+id",
			//'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#dialogUpdateDiscount').html(data.div);
                    // Here is the trick: on submit-> once again this function!
                    $('#dialogUpdateDiscount form').submit(updateDiscount);
                }
                else
                {
                    $.fn.yiiGridView.update('discounts-grid');
					$('#dialogUpdateDiscount').html(data.div);
                    setTimeout(\"$('#dialogUpdateDiscount').dialog('close') \",1000);
                }
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogUpdateDiscount").html(
						\'<div class="loader">'.$image.'<br\><br\>Retrieving record.<br\> Please wait...</div>\'
					);
            }',
			 'error'=>"function(request, status, error){
				 	$('#dialogUpdateDiscount').html(status+'('+error+')'+': '+ request.responseText+ ' {'+error.code+'}' );
					}",
            ))?>;
    return false; 
 
}
</script>
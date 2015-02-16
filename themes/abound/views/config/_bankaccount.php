<?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'accounts-grid',
        'summaryText'=>false,
		'htmlOptions'=>array('class'=>'grid-view padding0'),
        'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
        'rowHtmlOptionsExpression' => 'array("title" => "Click to update", "class"=>"link-hand")',
        'dataProvider'=>$bankaccountDataProvider,
        'columns'=>array(
            //'id',
            'bankName',
			array(
            	'name'=>'accountNumber',
				'value'=>'$data->accountNumber',
				'htmlOptions' => array('style' => 'width: 300px; text-align: center; ')
			),
			//array('class'=>'bootstrap.widgets.TbButtonColumn')
			),
));
?>

<?php echo Chtml::link('<span class="icon-plus icon-white"></span> Add New Account', '', array(
				'class'=>'btn btn-success btn-small',
                'style'=>'cursor:pointer; font-weight:normal;color:white;',
				'title'=>'Add New Account',
                'onClick'=>'js:{addNewAccount(); $("#dialogAccount").dialog("open");}',
                ));
?>

<!-- Discount Dialog : Start -->
<?php
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		    'id'=>'dialogAccount',
		    // additional javascript options for the dialog plugin
		    'options'=>array(
		        'title'=>'Account',
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
Yii::app()->clientScript->registerScript('accountsgrid', "
$('#accounts-grid table tbody tr').live('click',function()
{
	    var id = $.fn.yiiGridView.getKey(
        'accounts-grid',
        $(this).prevAll().length 
    	);
    	
		if($(this).children(':nth-child(1)').text()=='No results found.'){
			alert($(this).children(':nth-child(1)').text());
		}else{
			updateAccount(id);
			$('#dialogAccount').dialog('open');
		}
});
");
?>

<script type="text/javascript">
function addNewAccount()
{
    <?php echo CHtml::ajax(array(
			'url'=>$this->createUrl('accounting/bankaccount/create'),
			'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
					$('#dialogAccount').html(data.div);
                    // Here is the trick: on submit-> once again this function!
                    $('#dialogAccount form').submit(addNewAccount);
                }
                else
                {
					$.fn.yiiGridView.update('accounts-grid');
					$('#dialogAccount').html(data.div);
					setTimeout(\"$('#dialogAccount').dialog('close') \",1000);
                }
 
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogAccount").html(
						\'<div class="loader">'.$image.'<br\><br\>Processing.<br\> Please wait...</div>\'
					);
             }',
			 'error'=>"function(request, status, error){
				 	$('#dialogAccount').html(status+'('+error+')'+': '+ request.responseText );
					}",
			
            ))?>;
    return false;	
}

function updateAccount(id)
{
	<?php 
	echo CHtml::ajax(array(
			'url'=>$this->createUrl('accounting/bankaccount/update'),
			'data'=> "js:$(this).serialize()+ '&id='+id",
			//'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#dialogAccount').html(data.div);
                    // Here is the trick: on submit-> once again this function!
                    $('#dialogAccount form').submit(updateAccount);
                }
                else
                {
                    $.fn.yiiGridView.update('accounts-grid');
					$('#dialogAccount').html(data.div);
                    setTimeout(\"$('#dialogAccount').dialog('close') \",1000);
                }
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogAccount").html(
						\'<div class="loader">'.$image.'<br\><br\>Retrieving record.<br\> Please wait...</div>\'
					);
            }',
			 'error'=>"function(request, status, error){
				 	$('#dialogAccount').html(status+'('+error+')'+': '+ request.responseText+ ' {'+error.code+'}' );
					}",
            ))?>;
    return false; 
 
}
</script>
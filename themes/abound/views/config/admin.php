<h1>System Configurations<?php //echo $this->id . '/' . $this->action->id; ?></h1>

<?php 
$linkUpdate = Chtml::link('Update', '', array( 
			'style'=>'cursor:pointer;',
			'onClick'=>'js:{updateLab(); $("#dialogUpdateLab").dialog("open");}',
			'class'=>'btn btn-info btn-small'
			));
?>    
<h3><i>Laboratory</i></h3>
<?php
    $this->widget('zii.widgets.jui.CJuiAccordion', array(
		'panels'=>array(
			'Laboratories'=>$this->renderPartial('_laboratories',array('activeLabDataProvider'=>$activeLabDataProvider),true),
			'Technical Managers'=>$this->renderPartial('_labmanagers',array('labManagerDataProvider'=>$labManagerDataProvider),true),
			'Discounts'=>$this->renderPartial('_discounts',array('discountsDataProvider'=>$discountsDataProvider),true),
		),
		// additional javascript options for the accordion plugin
		'options'=>array(
			'animated'=>'bounceslide',
			'heightStyle'=>'content',
		),
	));
?>
<hr />
<h3><i>Cashiering</i></h3>
<?php
    $this->widget('zii.widgets.jui.CJuiAccordion', array(
		'panels'=>array(
			'OR Categories/Series'=>$this->renderPartial('_orcatseries',array('orseries'=>$orseries),true),
    		'Bank Accounts'=>$this->renderPartial('_bankaccount',array('bankaccountDataProvider'=>$bankaccountDataProvider),true),
			'OR Print Setup'=>$this->renderPartial('_orprintsetup',array('labManagerDataProvider'=>$labManagerDataProvider),true),
		),
		// additional javascript options for the accordion plugin
		'options'=>array(
			'animated'=>'bounceslide',
			'heightStyle'=>'content',
		),
	));
?>

<hr />
<h3><i>Personnel</i> <small></small></h3>
<?php
    $this->widget('zii.widgets.jui.CJuiAccordion', array(
		'panels'=>array(
			'Signatories'=>$this->renderPartial('_signatories',array('signatoriesDataProvider'=>$signatoriesDataProvider),true),
			//'Laboratory'=>$sample_text,
		),
		// additional javascript options for the accordion plugin
		'options'=>array(
			'animated'=>'bounceslide',
			'heightStyle'=>'content',
		),
	));
?>

<hr />
<h3><i>Web Application</i></h3>
<?php

    $this->widget('zii.widgets.jui.CJuiAccordion', array(
		'panels'=>array(
    		'API Settings <font style="font-weight:normal;font-size:80%;">(Click save button to apply changes)</font>'=>$this->renderPartial('_apiSettings',NULL,true),
			'Site Settings <font style="font-weight:normal;font-size:80%;">(Click save button to apply changes)</font>'=>$this->renderPartial('_siteSettings',NULL,true),
			'Form Settings <font style="font-weight:normal;font-size:80%;">(Click save button to apply changes)</font>'=>$this->renderPartial('_formSettings',NULL,true),			
			'Test Data (Database)'=>$this->renderPartial('_testdata',array(
				'affectedTables'=>$affectedTables,
				'ulimsLabAffectedTables'=>$ulimsLabAffectedTables,
				'ulimsCashieringAffectedTables'=>$ulimsCashieringAffectedTables,
				'ulimsAccountingAffectedTables'=>$ulimsAccountingAffectedTables,
				),true),
		),
		// additional javascript options for the accordion plugin
		'options'=>array(
			'animated'=>'bounceslide',
			'heightStyle'=>'content',
		),
	));
?>
<p style="font-size:14px; color:#333; margin:10px 0px;">For more details on how to further configure system settings, please read
the <a href="http://localhost/ulims/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.facebook.com/groups/dostulims/">facebook group page</a>,
should you have any questions.</p>

<!-- Laboratory Dialog : Start -->
<?php
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		    'id'=>'dialogUpdateLab',
		    // additional javascript options for the dialog plugin
		    'options'=>array(
		        'title'=>'Update Laboratories',
				'show'=>'scale',
				'hide'=>'scale',				
				'width'=>400,
				'modal'=>true,
				'resizable'=>false,
				'autoOpen'=>false,
			    ),
		));

	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<!-- Laboratory Dialog : End -->

<!-- Laboratory Manager Dialog : Start -->
<?php
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		    'id'=>'dialogUpdateLabManager',
		    // additional javascript options for the dialog plugin
		    'options'=>array(
		        'title'=>'Update Lab Managers',
				'show'=>'scale',
				'hide'=>'scale',				
				'width'=>330,
				'modal'=>true,
				'resizable'=>false,
				'autoOpen'=>false,
			    ),
		));

	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<!-- Laboratory Manager Dialog : End -->

<!-- Discount Dialog : Start -->
<?php
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		    'id'=>'dialogUpdateDiscount',
		    // additional javascript options for the dialog plugin
		    'options'=>array(
		        'title'=>'Update Discount',
				'show'=>'scale',
				'hide'=>'scale',				
				'width'=>330,
				'modal'=>true,
				'resizable'=>false,
				'autoOpen'=>false,
			    ),
		));

	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<!-- Discount Dialog : End -->

<!-- Signatory Dialog : Start -->
<?php
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		    'id'=>'dialogUpdateSignatory',
		    // additional javascript options for the dialog plugin
		    'options'=>array(
		        'title'=>'Update Signatory',
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
<!-- Signatory Dialog : End -->
<?php 
$image = CHtml::image(Yii::app()->request->baseUrl . '/images/ajax-loader.gif');
Yii::app()->clientScript->registerScript('labmanagersgrid', "
$('#labmanager-grid table tbody tr').live('click',function()
{
	    var id = $.fn.yiiGridView.getKey(
        'labmanager-grid',
        $(this).prevAll().length 
    	);
    	
    	//var id = $(this).children(':nth-child(3)').text();
		if($(this).children(':nth-child(1)').text()=='No results found.'){
			alert($(this).children(':nth-child(1)').text());
		}else{
			updateLabManager(id);
			$('#dialogUpdateLabManager').dialog('open');
		}
});
");

Yii::app()->clientScript->registerScript('signatoriesgrid', "
$('#signatories-grid table tbody tr').live('click',function()
{
	    var id = $.fn.yiiGridView.getKey(
        'signatories-grid',
        $(this).prevAll().length 
    	);
    	
		if($(this).children(':nth-child(1)').text()=='No results found.'){
			alert($(this).children(':nth-child(1)').text());
		}else{
			updateSignatory(id);
			$('#dialogUpdateSignatory').dialog('open');
		}
});
");

Yii::app()->clientScript->registerScript('viewInactiveSeries', "
$('#Orseries_status').live('click', function(){
        var id = parseInt($(this).val(), 10);
        if($(this).is(':checked')) {
			var status=1;
			$('#orseries-grid').yiiGridView('update', {
				data: $(this).serialize() + '&Orseries[status]='+status
			});
			
        } else {
			var status='';
			$('#orseries-grid').yiiGridView('update', {
				data: $(this).serialize() + '&Orseries[status]='+status
			});			
        }
}); return false;

");
?>

<script type="text/javascript">
function updateLab()
{
    <?php echo CHtml::ajax(array(
			'url'=>$this->createUrl('lab/configlab/update',array('id'=>$rstl->labConfig->id)),
			'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#dialogUpdateLab').html(data.div);
                    // Here is the trick: on submit-> once again this function!
                    $('#dialogUpdateLab form').submit(updateLab);
                }
                else
                {
                    $.fn.yiiGridView.update('lab-grid');					
					$('#dialogUpdateLab').html(data.div);
                    setTimeout(\"$('#dialogUpdateLab').dialog('close') \",1000);
					
                }
 
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogUpdateLab").html(
						\'<div class="loader">'.$image.'<br\><br\>Generating form.<br\> Please wait...</div>\'
					);
             }',
			 'error'=>"function(request, status, error){
				 	$('#dialogUpdateLab').html(status+'('+error+')'+': '+ request.responseText );
					}",
			
            ))?>;
    return false; 
 
}

function updateLabManager(id)
{
	<?php 
	echo CHtml::ajax(array(
			'url'=>$this->createUrl('lab/labmanager/update'),
			'data'=> "js:$(this).serialize()+ '&id='+id",
			//'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#dialogUpdateLabManager').html(data.div);
                    // Here is the trick: on submit-> once again this function!
                    $('#dialogUpdateLabManager form').submit(updateLabManager);
                }
                else
                {
                    $.fn.yiiGridView.update('labmanager-grid');
					$('#dialogUpdateLabManager').html(data.div);
                    setTimeout(\"$('#dialogUpdateLabManager').dialog('close') \",1000);
                }
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogUpdateLabManager").html(
						\'<div class="loader">'.$image.'<br\><br\>Retrieving record.<br\> Please wait...</div>\'
					);
            }',
			 'error'=>"function(request, status, error){
				 	$('#dialogUpdateLabManager').html(status+'('+error+')'+': '+ request.responseText+ ' {'+error.code+'}' );
					}",
            ))?>;
    return false; 
 
}

function updateSignatory(id)
{
	<?php 
	echo CHtml::ajax(array(
			'url'=>$this->createUrl('personnel/update'),
			'data'=> "js:$(this).serialize()+ '&id='+id",
			//'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#dialogUpdateSignatory').html(data.div);
                    // Here is the trick: on submit-> once again this function!
                    $('#dialogUpdateSignatory form').submit(updateSignatory);
                }
                else
                {
                    $.fn.yiiGridView.update('signatories-grid');
					$('#dialogUpdateSignatory').html(data.div);
                    setTimeout(\"$('#dialogUpdateSignatory').dialog('close') \",1000);
                }
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogUpdateSignatory").html(
						\'<div class="loader">'.$image.'<br\><br\>Processing...<br\> Please wait...</div>\'
					);
            }',
			 'error'=>"function(request, status, error){
				 	$('#dialogUpdateSignatory').html(status+'('+error+')'+': '+ request.responseText+ ' {'+error.code+'}' );
					}",
            ))?>;
    return false; 
 
}
</script>
<?php
	/*$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>"<b>Laboratories</b> ",//.$linkUpdate,
	));	*/
	
?>

<?php $this->widget('ext.groupgridview.GroupGridView', array(
        'id'=>'orseries-grid',
        'summaryText'=>false,
		'emptyText'=>'No active series available',
		'htmlOptions'=>array('class'=>'grid-view padding0'),
        'itemsCssClass'=>'table table-striped table-bordered table-condensed',
        //'rowHtmlOptionsExpression' => 'array("title" => "Click to view details", "class"=>"link-hand")',
        'dataProvider'=>$orseries->search(),
		'extraRowColumns' => array('orcategory_id'),
		'extraRowExpression' => '"<b>".Orcategory::model()->findByPk($data->orcategory_id)->name."</b> (".Orcategory::model()->findByPk($data->orcategory_id)->code.")"',
		'mergeColumns' => array('name'),
		'columns'=>array(
			//'id',
			/*array(
				'name'=>'orcategory_id',
				'type'=>'raw',
				'value'=>'',
				),*/
			//'rstl_id',
			'name',
			'startor',
			'nextor',
			'endor',
			/*array(
				'name'=>'status',
				'type'=>'raw',
				'value'=>'$data->status?CHtml::image("'.Yii::app()->request->baseUrl.'/images/status/status-open.png","OPEN"):CHtml::image("'.Yii::app()->request->baseUrl.'/images/status/status-exhausted.png","EXHAUSTED")',
			  	'htmlOptions'=>array('style'=>'text-align:center')
			),*/
           	array(
			//'class'=>'CButtonColumn',
			'header'=>'Status',
			'htmlOptions'=>array('class'=>'btn-group btn-group-yesno'),
			'class'=>'bootstrap.widgets.TbButtonColumn',
						//'deleteConfirmation'=>"js:'Do you really want to delete sample: '+$.trim($(this).parent().parent().children(':nth-child(2)').text())+'?'",
						'template'=>'{active}{not active}',
						'buttons'=>array
						(
							'active' => array(
								//'visible'=>'$data->status',
								'label'=>'Active',
								'url'=>'Yii::app()->createUrl("/cashier/orseries/activateSeries/id/$data->id")',
								'options' => array(
									'class'=>'$data->status ? "btn active btn-success" : "btn"',
									//'confirm'=>'Do you want to set this Lab as Active?',
									'ajax' => array(
										'type' => 'get',
										'dataType'=> 'json',
										'url'=>'js:$(this).attr("href")', 
										'success' => 'js:function(data) {
												if (data.status=="failure"){
													$("#dialogError").dialog("open");
													$("#dialogError").html(data.error);
												}else{
													$.fn.yiiGridView.update("orseries-grid");
												}
											}'
										)
									),
								),
							'not active' => array(
								//'visible'=>'!$data->status',
								'label'=>'Inactive',
								'url'=>'Yii::app()->createUrl("/cashier/orseries/deactivateSeries/id/$data->id")',
								'options' => array(
									'class'=>'$data->status ? "btn" : "btn active btn-danger"',
									//'confirm'=>'Do you want to set this Lab as Inactive?',
									'ajax' => array(
										'type' => 'get',
										'dataType'=>'json',
										'url'=>'js:$(this).attr("href")', 
										'success' => 'js:function(data) {
												if(data.status=="success"){
													$.fn.yiiGridView.update("orseries-grid");
												}
											}'
										)
									),
								),
						),
			)
		),
)); ?>

<?php //$this->endWidget(); //End Portlet ?>    

<?php echo Chtml::link('<span class="icon-th-large icon-white"></span> Manage O.R. Categories', '', array(
				'class'=>'btn btn-info btn-small',
                'style'=>'cursor:pointer; font-weight:normal;color:white;',
				'title'=>'Manage O.R. category',
                //'onClick'=>'js:{manageORCategory(); $("#dialogORCategory").dialog("open");}',
				'onClick'=>' js:{ manageORCategory(); $("#dialogORCategory").dialog("open")}',
                ));
?>

<?php echo Chtml::link('<span class="icon-plus icon-white"></span> Add New O.R. Series', '', array(
				'class'=>'btn btn-success btn-small',
                'style'=>'cursor:pointer; font-weight:normal;color:white;',
				'title'=>'Add New O.R. series',
                'onClick'=>'js:{addNewORSeries(); $("#dialogNewORSeries").dialog("open");}',
                ));
?>

<?php
/*
Yii::app()->clientScript->registerScript('viewInactiveSeries', "
$('#checkInactiveSeries').live('click', function(){
        var id = parseInt($(this).val(), 10);
        if($(this).is(':checked')) {
			var id=0;
			updateOrSeriesGridView(id);
			//$.fn.yiiGridView.update('orseries-grid');
			//alert(id);
				//$('#orseries-grid').yiiGridView('update', {
				//	data: $(this).serialize() + '&Orseries[status]='+id
				//});
				//return false;
			
        } else {
			var id=1;
			updateOrSeriesGridView(id);
			//$.fn.yiiGridView.update('orseries-grid');
			//alert(id);
        }
});
");
*/
?>

<?php echo CHtml::activeCheckBox($orseries,'status',array('style'=>'float:right; margin-left:5px;')); ?>
<label for="Orseries_Status" style="float:right;">Show only active series </label>
<!-- ORCategory Dialog : Start -->
<?php
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		    'id'=>'dialogORCategory',
		    // additional javascript options for the dialog plugin
		    'options'=>array(
		        'title'=>'Manage O.R. Categories',
				'show'=>'scale',
				'hide'=>'scale',				
				'width'=>500,
				'modal'=>true,
				'resizable'=>false,
				'autoOpen'=>false,
			    ),
		));
	/*$modelORCategory=new Orcategory;
	$this->renderPartial('cashier.views.orcategory._admin',array('modelORCategory'=>$modelORCategory));*/
	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<!-- ORCategory Dialog : End -->

<!-- NewORCategory Dialog : Start -->
<?php
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		    'id'=>'dialogNewORCategory',
		    // additional javascript options for the dialog plugin
		    'options'=>array(
		        'title'=>'Add New O.R. Category',
				'show'=>'scale',
				'hide'=>'scale',				
				'width'=>500,
				'modal'=>true,
				'resizable'=>false,
				'autoOpen'=>false,
			    ),
		));
	/*$modelORCategory=new Orcategory;
	$this->renderPartial('cashier.views.orcategory._admin',array('modelORCategory'=>$modelORCategory));*/
	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<!-- NewORCategory Dialog : End -->

<!-- NewORSeries Dialog : Start -->
<?php
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		    'id'=>'dialogNewORSeries',
		    // additional javascript options for the dialog plugin
		    'options'=>array(
		        'title'=>'Add New OR Series',
				'show'=>'scale',
				'hide'=>'scale',				
				'width'=>450,
				'modal'=>true,
				'resizable'=>false,
				'autoOpen'=>false,
			    ),
		));

	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<!-- NewORSeries Dialog : End -->

<!-- UpdateORSeries Dialog : Start -->
<?php
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		    'id'=>'dialogUpdateORSeries',
		    // additional javascript options for the dialog plugin
		    'options'=>array(
		        'title'=>'Update OR Series',
				'show'=>'scale',
				'hide'=>'scale',				
				'width'=>450,
				'modal'=>true,
				'resizable'=>false,
				'autoOpen'=>false,
			    ),
		));
	echo "<p>UPDATE OR SERIES form here....</p>";
	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<!-- UpdateORSeries Dialog : End -->

<script type="text/javascript">
function manageORCategory()
{
    <?php echo CHtml::ajax(array(
			//'url'=>$this->createUrl('cashier/orcategory/manage',array('id'=>$rstl->labConfig->id)),
			'url'=>$this->createUrl('cashier/orcategory/manage'),
			'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#dialogORCategory').html(data.div);
                    // Here is the trick: on submit-> once again this function!
                    $('#dialogORCategory form').submit(manageORCategory);
                }
                else
                {
					$.fn.yiiGridView.update('orcategory-grid');	
					$('#dialogORCategory').html(data.div);					                   
					setTimeout(\"$('#dialogORCategory').dialog('close') \",1000);
                }
 
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogORCategory").html(
						\'<div class="loader">'.$image.'<br\><br\>Processing.<br\> Please wait...</div>\'
					);
             }',
			 'error'=>"function(request, status, error){
				 	$('#dialogORCategory').html(status+'('+error+')'+': '+ request.responseText );
					}",
			
            ))?>;
    return false;	
}

function addNewORCategory()
{
    <?php echo CHtml::ajax(array(
			//'url'=>$this->createUrl('cashier/orcategory/manage',array('id'=>$rstl->labConfig->id)),
			'url'=>$this->createUrl('cashier/orcategory/create'),
			'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#dialogORCategory').dialog('close');
					$('#dialogNewORCategory').html(data.div);
                    // Here is the trick: on submit-> once again this function!
                    $('#dialogNewORCategory form').submit(addNewORCategory);
                }
                else
                {
					//$.fn.yiiGridView.update('orcategory-grid');
					manageORCategory(); $('#dialogORCategory').dialog('open');
					$('#dialogNewORCategory').html(data.div);
					setTimeout(\"$('#dialogNewORCategory').dialog('close') \",1000);
                }
 
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogNewORCategory").html(
						\'<div class="loader">'.$image.'<br\><br\>Processing.<br\> Please wait...</div>\'
					);
             }',
			 'error'=>"function(request, status, error){
				 	$('#dialogNewORCategory').html(status+'('+error+')'+': '+ request.responseText );
					}",
			
            ))?>;
    return false;	
}

function addNewORSeries()
{
    <?php echo CHtml::ajax(array(
			//'url'=>$this->createUrl('cashier/orcategory/manage',array('id'=>$rstl->labConfig->id)),
			'url'=>$this->createUrl('cashier/orseries/create'),
			'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
					$('#dialogNewORSeries').html(data.div);
                    // Here is the trick: on submit-> once again this function!
                    $('#dialogNewORSeries form').submit(addNewORSeries);
                }
                else
                {
					$.fn.yiiGridView.update('orseries-grid');
					$('#dialogNewORSeries').html(data.div);
					setTimeout(\"$('#dialogNewORSeries').dialog('close') \",1000);
                }
 
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogNewORSeries").html(
						\'<div class="loader">'.$image.'<br\><br\>Processing.<br\> Please wait...</div>\'
					);
             }',
			 'error'=>"function(request, status, error){
				 	$('#dialogNewORSeries').html(status+'('+error+')'+': '+ request.responseText );
					}",
			
            ))?>;
    return false;	
}

</script>




<?php
/* @var $this LabServiceController */
/* @var $model LabService */

$this->breadcrumbs=array(
	'Lab Services'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List LabService', 'url'=>array('index')),
	array('label'=>'Create LabService', 'url'=>array('create')),
);

?>

<h1>Manage Services Offered</h1>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>

<?php 
	$image = CHtml::image(Yii::app()->request->baseUrl . '/images/ajax-loader.gif');
	echo CHtml::link('<span class="icon-white icon-plus-sign"></span> Add / Remove Services', '',
		array(
			'style'=>'cursor:pointer;',
			'class'=>'btn btn-info',
			'onClick'=>'js:{updateServices(); $("#dialogUpdateServices").dialog("open");}',
		)
	);
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'lab-service-grid',
	'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
	'dataProvider'=>$labservices,
	//'dataProvider'=>$model->search2(),
	'filter'=>$model,
	'columns'=>array(
		//'lab_id',
		'labName',
		//'sampleType_id',
		'type',
		//'testName_id',
		'testName',
		//'methodreference_id',
		'method',
		'reference',
		'fee',
		/*array(
			'header'=>'Offered',
           	'htmlOptions'=>array('class'=>'btn-group btn-group-yesno'),
			'class'=>'bootstrap.widgets.TbButtonColumn',
						'template'=>'{yes}{no}',
						'buttons'=>array
						(
							'yes' => array(
								'label'=>'Yes',
								//'url'=>'Yii::app()->createUrl(\'ref/labservice/activateService\', array(\'id\'=>$data["methodreference_id"]))',
								'url'=>'Yii::app()->createUrl("ref/labservice/activateService", array("id"=>$data["methodreference_id"]))',
								'options' => array(
									'class'=>'Labservice::checkOffered($data["agency_id"]) ? "btn active btn-success" : "btn"',
									'ajax' => array(
										'type' => 'get',
										'url'=>'js:$(this).attr("href")', 
										'success' => 'js:function(data) { $.fn.yiiGridView.update("lab-service-grid");}')
									),
								),
							'no' => array(
								'label'=>'No',
								//'url'=>'Yii::app()->createUrl(\'ref/labservice/deactivateService\', array(\'id\'=>$data["methodreference_id"]))',
								'url'=>'Yii::app()->createUrl("ref/labservice/deactivateService", array("id"=>$data["methodreference_id"]))',
								'options' => array(
									//'class'=>'$data->status ? "btn" : "btn active btn-danger"',
									'class'=>'Labservice::checkOffered($data["agency_id"]) ? "btn" : "btn active btn-danger"',
									//'confirm'=>'Do you want to set this Lab as Inactive?',
									'ajax' => array(
										'type' => 'get', 
										'url'=>'js:$(this).attr("href")', 
										'success' => 'js:function(data) { $.fn.yiiGridView.update("lab-service-grid");}')
									),
								),
						),
			),*/
	),
)); ?>

<!-- Referral Dialog : Start -->
<?php
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		    'id'=>'dialogUpdateServices',
		    // additional javascript options for the dialog plugin
		    'options'=>array(
		        'title'=>'Add / Remove Services',
				'show'=>'scale',
				'hide'=>'scale',				
				'width'=>960,
				'modal'=>true,
				'resizable'=>false,
				'autoOpen'=>false,
			    ),
		));
	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<!-- Referral Dialog : End -->  

<script>
function updateServices()
{
    <?php echo CHtml::ajax(array(
    		'url'=>$this->createUrl('labservice/update'),
    		'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#dialogUpdateServices').html(data.div);
                    // Here is the trick: on submit-> once again this function!
                    $('#dialogUpdateServices form').submit(updateServices);
                }
                else
                {
                    $.fn.yiiGridView.update('lab-service-grid');
					$('#dialogUpdateServices').html(data.div);
                    setTimeout(\"$('#dialogUpdateServices').dialog('close') \",1000);
                }
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogUpdateServices").html(
						\'<div class="loader">'.$image.'<br\><br\>Generating form.<br\> Please wait...</div>\'
					);
             }',
			 'error'=>"function(request, status, error){
				 	$('#dialogUpdateServices').html(status+'('+error+')'+': '+ request.responseText );
					}",
			
            ))?>;
    return false; 
}
</script>
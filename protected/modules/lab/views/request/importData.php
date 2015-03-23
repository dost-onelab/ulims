<?php
/* @var $this RequestController */
/* @var $model Request */

$this->breadcrumbs=array(
	'Requests'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Request', 'url'=>array('index')),
	array('label'=>'Create Request', 'url'=>array('create')),
	array('label'=>'Manage Requests', 'url'=>array('admin')),
);
?>
<h1>Import Data</h1>
<div class="form">
<?php $image=Yii::app()->baseUrl.('/images/ajax-loader.gif');?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>
	
	<div class="row">
		<?php echo CHtml::fileField('import_path',''); ?>
        <?php echo CHtml::submitButton('Load File', array('class'=>'btn btn-info')); ?>
        <?php echo CHtml::link('<span class="icon-edit icon-white"></span> Create data entry file', $this->createUrl('request/createdataentryfile'), array('class'=>'btn btn-inverse', 'style'=>'margin: 0.2em 0 0.5em 0; float:right;','title'=>'Create data entry file'));?>
	</div>
	
<?php $this->endWidget(); ?>

<?php if($data != NULL)
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'grid-import',
		'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
		'htmlOptions'=>array('class'=>'grid-view padding0'),
		'rowHtmlOptionsExpression' => 'array("title"=>"Click on Request Reference Number to view details", "class"=>$data->status["class"])',
		'dataProvider'=>$importDataProvider,
		'columns'=>array(
			array('name'=>'id', 'header'=>'#','value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + $row+1'),
			array(
				'name'=>'Request Reference Number',
				'type'=>'raw',
				'value'=>function($data){
					return CHtml::link(
						$data['requestRefNum'],
						'javascript:void(0)',
						array(
							//'id'=>$data['id'],
							'onclick'=>"js:{ viewImportRequestDetail({$data['id']}); $('#dialogImportRequestDetail').dialog('open');}",						)
					);
				},
				'htmlOptions'=>array('style' => 'width: 120px; text-align: center;'),
			),
			array(
					'name'=>'Lab',
					'value'=>'Lab::model()->findByPk($data["labId"])->labCode',
			),
			array(
					'name'=>'Payment Type',
					'value'=>'($data["paymentType"] == 1) ? "Paid" : (($data["paymentType"] == 2) ? "Fully Subsidized" : "")',
			),
			array(
					'name'=>'Discount',
					'value'=>'Discount::model()->findByPk($data["discount"])->rate." %"',
			),
			array(
					'name'=>'Request Date',
					'value'=>'$data["requestDate"]',
			),	
			array(
					'name'=>'Report Due',
					'value'=>'$data["reportDue"]',
			),	
			array(
					'name'=>'Customer',
					'type'=>'html',
					'value'=>'$data["customer"]',
			),
			/*array(
					'name'=>'Address',
					'value'=>'$data["address"]',
			),*/
			array(
					'name'=>'Received By',
					'value'=>'$data["receivedBy"]',
			),
			array(
					'name'=>'Conforme',
					'value'=>'$data["conforme"]',
			),
		),
		'selectableRows'=>1,
	));
?>
</div>	

<?php 
	$importLink = Chtml::link('<span class="icon-white icon-download-alt"></span> Import Requests', '', array(
			'title'=>'Import Requests',
			'class'=>'btn btn-success',
			"onclick"=>"if (!confirm('Import all Request?')){return}else{ confirmImport(); $('#dialogConfirmImport').dialog('open'); }",	
			));
			
	echo $has_duplicate ? '' : $importLink;
?>

<!-- Request Details Dialog : Start -->
<?php
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		    'id'=>'dialogImportRequestDetail',
		    // additional javascript options for the dialog plugin
		    'options'=>array(
		        'title'=>'Request Details',
				'show'=>'scale',
				'hide'=>'scale',				
				'width'=>800,
				'modal'=>true,
				'resizable'=>false,
				'autoOpen'=>false,
			    ),
		));
	//echo "Details here...";
	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<!-- Request Details Dialog : End -->

<!-- ConfirmImport Dialog : Start -->
<?php
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		    'id'=>'dialogConfirmImport',
		    // additional javascript options for the dialog plugin
		    'options'=>array(
		        'title'=>'Import Details',
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
<!-- ConfirmImport Dialog : End -->
<?php $image = CHtml::image(Yii::app()->request->baseUrl . '/images/ajax-loader.gif');?>
<script type="text/javascript">
function viewImportRequestDetail(id)
{
	<?php 
	echo CHtml::ajax(array(
			'url'=>$this->createUrl('request/importRequestDetail'),
			//'data'=> new FormData(this),
			'data'=> "js:$(this).serialize()+ '&id='+id",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
            	$('#dialogImportRequestDetail').html(data.div);
            }",
			'beforeSend'=>'function(jqXHR, settings){
                    $("#dialogImportRequestDetail").html(
						\'<div class="loader">'.$image.'<br\><br\>Retrieving record.<br\> Please wait...</div>\'
					);
            }',
			 'error'=>"function(request, status, error){
				 	$('#dialogImportRequestDetail').html(status+'('+error+')'+': '+ request.responseText+ ' {'+error.code+'}' );
					}",
            ))?>;
    return false; 
}

function confirmImport()
{
	<?php 
			echo CHtml::ajax(array(
					'url'=>$this->createUrl('request/import'),
		            'type'=>'post',
		            'dataType'=>'json',
		            'success'=>"function(data)
		            {
		                if (data.status == 'failure')
		                {
		                    $('#dialogConfirmImport').html(data.div);
		                    // Here is the trick: on submit-> once again this function!
		                    $('#dialogConfirmImport form').submit(confirmImport);
		                }
		                else
		                {
							$('#dialogConfirmImport').html(data.div);
		                    setTimeout(\"$('#dialogConfirmImport').dialog('close') \",2500);
		                }
		            }",
					'beforeSend'=>'function(jqXHR, settings){
		                    $("#dialogConfirmImport").html(
								\'<div class="loader">'.$image.'<br\><br\>Import in progress.<br\> Please wait...</div>\'
							);
		            }',
					 'error'=>"function(request, status, error){
						 	$('#dialogConfirmImport').html(status+'('+error+')'+': '+ request.responseText+ ' {'+error.code+'}' );
							}",
		            ))?>;
		    return false; 
}
</script>

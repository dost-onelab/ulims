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



$iconLoading = '<img src=\"/ulims/images/loading.gif\"/>';
$iconOk = '<i class=\"icon icon-ok\"></i>';
?>

<h1>Manage Services Offered</h1>

<hr/>

<!-- Add Services : Start -->

<?php
	$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>"<b>Add / Remove Services</b>",
	));
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lab-service-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<table>
		<tr>
			<td>Laboratories</td>
			<td></td>
			<td>Sample Type&nbsp;<span id="type"></span></td>
			<td></td>
			<td>Test Name&nbsp;<span id="testname"></span></td>
		</tr>
		<tr>
			<td>
			<?php echo $form->dropDownList($model, 'lab_id',
						$labs, 
						array(
							'style'=>'width: 350px;',
							'ajax'=>array( 
										'type'=>'POST',
								 		'url'=>$this->createUrl('labservice/getSampleType'),
								 		//'update'=>'#Analysis_testName_id',
								 		'beforeSend'=>'function(){
								 				$("#type").html("'.$iconLoading.'");
								 				
        									}', 
										'success'=>'function(response){
												$("#Labservice_type").html(response);
												$("#type").html("'.$iconOk.'");
											}'
								    ),
						'empty'=>''
								    ));?>
			</td>
			<td>&nbsp;</td>
			<td><?php echo $form->dropDownList($model, 'type',
						array(), 
						array(
							'style'=>'width: 350px;',
							'ajax'=>array( 
										'type'=>'POST',
								 		'url'=>$this->createUrl('labservice/getTestName'),
								 		//'update'=>'#Analysis_testName_id',
								 		'beforeSend'=>'function(){
								 				$("#testname").html("'.$iconLoading.'");
        									}', 
										'success'=>'function(response){
												$("#Labservice_testName_id").html(response);
												$("#testname").html("'.$iconOk.'");
											}'
								    ),
						'empty'=>''
								    ));?>
		</td>
		<td>&nbsp;</td>
		<td>
		<?php echo $form->dropDownList($model, 'testName_id',
						array(), 
						array(
							'style'=>'width: 350px;',
							'ajax'=>array( 
										'type'=>'POST',
								 		'url'=>$this->createUrl('labservice/getMethodReference'),
								 		'update'=>'#methodReferences',
								    ),
						'empty'=>''
								    ));?>
		</td>
		<td>&nbsp;</td>
		</tr>
	<?php $this->endWidget(); // End Form?>
	
<tr><td colspan="5">


<?php
$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'methodReferences',
	'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
	'htmlOptions'=>array('class'=>'grid-view padding0 paddingLeftRight10'),
	'dataProvider'=>$gridDataProvider,
	//'filter'=>$model,
	'columns'=>array(
		//'id',
		//'lab_id',
		//'labName',
		//'sampleType_id',
		//'type',
		//'testName_id',
		//'testName',
		//'methodreference_id',
		//'method',
		array(
			'name'=>'',
			'header'=>'Offered',
		),
		array(
			'name'=>'method',
			'header'=>'Method',
		),
		//'reference',
		array(
			'name'=>'reference',
			'header'=>'Reference',
		),
		//'fee',
		array(
			'name'=>'fee',
			'header'=>'Fee',
			'value'=>'Yii::app()->format->formatNumber($data["fee"])',
			'htmlOptions' => array('style' => 'width: 75px; padding-right: 20px; text-align: right;'),
		),
		array(
			'name'=>'offeredBy',
			'header'=>'Offered by',
			'type'=>'html',
			'value'=>function($data){
				$images = '';
				foreach($data['offeredBy'] as $offeredBy)
				{
					$images .= '&nbsp'.CHtml::image(Yii::app()->request->baseUrl.'/images/icons/'.$offeredBy.'.png',
                                          $offeredBy, array("width"=>"25px" ,"height"=>"25px", "title"=>$offeredBy));
				}
				return $images;
			},
			'htmlOptions' => array('style' => 'width: 150px; text-align: center;'),
		),
		array(
			'name'=>'accreditation',
			'header'=>'Accreditation',
		),
	),
));

?>
</td></tr>
</table>	
	 
<?php $this->endWidget(); //End Portlet ?>

<!-- Add Services : End -->

<hr/>
<br/>




<!-- Services Offered : Start -->

<?php
	/*$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>"<b>Services Offered</b>",
	));*/
?>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>

<?php 
	$image = CHtml::image(Yii::app()->request->baseUrl . '/images/ajax-loader.gif');
	/*echo CHtml::link('<span class="icon-white icon-plus-sign"></span> Add / Remove Services', '',
		array(
			'style'=>'cursor:pointer;',
			'class'=>'btn btn-info',
			'onClick'=>'js:{updateServices(); $("#dialogUpdateServices").dialog("open");}',
		)
	);*/
?>

<?php /*$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'lab-service-grid',
	'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
	'dataProvider'=>$labservices,
	//'dataProvider'=>$model->search2(),
	'filter'=>$model,
	'columns'=>array(
		//'lab_id',
		array(
			'name'=>'labName',
			'header'=>'Laboratory',
			'filter'=>Lab::listData(),
			'htmlOptions'=>array('style'=>'text-align: left;'),
			'value'=>'$data["labName"]'
		),
		//'sampleType_id',
		array(
			'name'=>'type',
			'header'=>'Sample Type',
			'htmlOptions'=>array('style'=>'text-align: left;'),
			'value'=>'$data["type"]'
		),
		//'testName_id',
		array(
			'name'=>'testName',
			'header'=>'Test Name',
			'htmlOptions'=>array('style'=>'text-align: left;'),
			'value'=>'$data["method"]["testname"]'
			//'value'=>'$data["testName"]'
		),
		//'methodreference_id',
		array(
			//'name'=>'id',
			'header'=>'Method ID',
			'htmlOptions'=>array('style'=>'text-align: left;'),
			'value'=>'$data["method"]["id"]'
		),
		//'method',
		array(
			'name'=>'method',
			'header'=>'Method',
			'htmlOptions'=>array('style'=>'text-align: left;'),
			'value'=>'$data["method"]["method"]'
		),
		array(
			'name'=>'reference',
			'header'=>'Reference',
			'htmlOptions'=>array('style'=>'text-align: left;'),
			'value'=>'$data["method"]["reference"]'
		),
		array(
			'name'=>'fee',
			'header'=>'Fee',
			'htmlOptions'=>array('style'=>'text-align: right;'),
			'value'=>'Yii::app()->format->formatNumber($data["method"]["fee"])'
		),
	),
));*/ ?>

<?php //$this->endWidget(); //End Portlet ?>
<!-- Services Offered : End -->

<script>
function updateOfferedServices()
{
	<?php
	echo CHtml::ajax(array(
			'url'=>$this->createUrl('labservices/updateOfferedServices'),
			'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
            	$.fn.yiiGridView.update('lab-service-grid');
            }",
			 'error'=>"function(request, status, error){
				 	$('#dialogSampleCode').html(status+'('+error+')'+': '+ request.responseText+ ' {'+error.code+'}' );
					}",
            ))?>;
    return false;
}
</script>
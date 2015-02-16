<?php
/* @var $this RequestController */
/* @var $model Request */

$this->breadcrumbs=array(
	'Requests'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Order of Payment', 'url'=>array('createOP')),
	array('label'=>'List Request', 'url'=>array('index')),
	array('label'=>'Create Request', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#request-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
//echo Yii::app()->user->rstlId;
?>

<h1>Create Order of Payment</h1>

<!-- p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p-->

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'orderofpayment-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

<div class="form">

	<div class="row">
		<?php echo $form->labelEx($model,'customer_id'); ?>
		<?php $this->widget('ext.select2.ESelect2',array(
					'model'=>$model,
					'attribute'=>'customer_id',
					'data'=>$customers,
					'htmlOptions'=>array(
					  	'style'=>'width:400px',
						'ajax'=>array( 
									'type'=>'POST',
							 		'url'=>$this->createUrl('request/searchRequests'),
									'update'=>'#requests',
							 		/*'dataType'=>'json',
									'data'=>'js:$(this).serialize()',
									'success'=>'js:function(data){
											if(data){
												$("#requests").html(data.requests);
											}
										}
									'*/
							    ),
					  ),
				));
			?>
			<?php echo $form->error($model,'customer_id'); ?>
			
	</div>

	<div class="row">
			<?php echo $form->labelEx($model,'requests'); ?>
			<?php /*$this->widget('ext.select2.ESelect2',array(
			  'id'=>'requests',
			  'name'=>'requests',
			  'data'=>array(),
			  'options'=>array(
			    'placeholder'=>' Select Requests',
			    'allowClear'=>true,
			  ),
			  'htmlOptions'=>array(
			    'multiple'=>'multiple',
			  	'style'=>'width:400px'
			  ),
			));*/?>
			<?php echo $form->error($model,'requests'); ?>
	</div>
	
	<div class="row buttons" id="requests">
		<?php $this->renderPartial('_requests', array('gridDataProvider'=>$gridDataProvider)); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', 
					array(
						'class'=>'btn btn-primary',
						/*'ajax'=>array(
							//'url'=>$this->createUrl('request/createOP'),
							'type'=>'POST',
           					'data'=>'js:{
           							data: $(".orderofpayment-form").serialize(),
           							selectedRequests : $.fn.yiiGridView.getChecked("requests-grid","example-check-boxes").toString()
           						}'
        					)*/
					));
		?>
		<?php 
		$linkSample = Chtml::link('<span class="icon-white icon-plus-sign"></span> Create OP', '', array( 
			'style'=>'cursor:pointer;',
			'class'=>'btn btn-info btn',
			'onClick'=>'js:{
					//createOP(); 
					//alert($.fn.yiiGridView.getChecked("requests-grid","example-check-boxes").toString())
				}',
			)); 
			echo $linkSample;
		?>
	</div>
	
<?php $this->endWidget(); ?>
	
</div>	

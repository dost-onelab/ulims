<?php
/* @var $this OrcategoryController */
/* @var $model Orcategory */
/*
$this->breadcrumbs=array(
	'Orcategories'=>array('index'),
	'Manage',
);*/

$this->menu=array(
	array('label'=>'List Orcategory', 'url'=>array('index')),
	array('label'=>'Create Orcategory', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#orcategory-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'orcategory-grid',
	'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
	'dataProvider'=>$model->search2(),
	//'filter'=>$model,
	'columns'=>array(
		//'id',
		'name',
		'code',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
<?php echo Chtml::link('<span class="icon-plus icon-white"></span> Add New O.R. Category', '', array(
				'class'=>'btn btn-success btn-small',
                'style'=>'cursor:pointer; font-weight:normal;color:white;',
				'title'=>'Add New O.R. category',
                'onClick'=>'js:{addNewORCategory(); $("#dialogNewORCategory").dialog("open");}',
                ));
?>
<div class="form wide">

<?php /*$form=$this->beginWidget('CActiveForm', array(
	'id'=>'orcategory-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'code'); ?>
		<?php echo $form->textField($model,'code',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'code'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-info')); ?>
	</div>

<?php $this->endWidget(); */?>

</div><!-- form -->



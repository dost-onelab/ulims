<?php
/* @var $this SampletypeController */
/* @var $model Sampletype */

$this->breadcrumbs=array(
	'Sampletypes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Sampletype', 'url'=>array('index')),
	array('label'=>'Create Sampletype', 'url'=>array('create')),
	array('label'=>'View Sampletype', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Sampletype', 'url'=>array('admin')),
);
?>

<h1>Update Sampletype <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
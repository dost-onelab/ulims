<?php
/* @var $this SamplenameController */
/* @var $model Samplename */

$this->breadcrumbs=array(
	'Samplenames'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Samplename', 'url'=>array('index')),
	array('label'=>'Create Sample Template', 'url'=>array('create')),
	array('label'=>'View Sample Template', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Sample Template', 'url'=>array('admin')),
);
?>

<h1>Update Sample Template <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
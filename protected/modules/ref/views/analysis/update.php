<?php
/* @var $this AnalysisController */
/* @var $model Analysis */

$this->breadcrumbs=array(
	'Analysises'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Analysis', 'url'=>array('index')),
	array('label'=>'Create Analysis', 'url'=>array('create')),
	array('label'=>'View Analysis', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Analysis', 'url'=>array('admin')),
);
?>

<h1>Update Analysis <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
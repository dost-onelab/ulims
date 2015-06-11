<?php
/* @var $this ResultController */
/* @var $model Result */

$this->breadcrumbs=array(
	'Results'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Result', 'url'=>array('index')),
	array('label'=>'Create Result', 'url'=>array('create')),
	array('label'=>'View Result', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Result', 'url'=>array('admin')),
);
?>

<h1>Update Result <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
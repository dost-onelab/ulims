<?php
/* @var $this ConfiglabController */
/* @var $model Configlab */

$this->breadcrumbs=array(
	'Configlabs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Configlab', 'url'=>array('index')),
	array('label'=>'Create Configlab', 'url'=>array('create')),
	array('label'=>'View Configlab', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Configlab', 'url'=>array('admin')),
);
?>

<h1>Update Configlab <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
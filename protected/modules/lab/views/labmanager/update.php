<?php
/* @var $this LabmanagerController */
/* @var $model Labmanager */

$this->breadcrumbs=array(
	'Labmanagers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Labmanager', 'url'=>array('index')),
	array('label'=>'Create Labmanager', 'url'=>array('create')),
	array('label'=>'View Labmanager', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Labmanager', 'url'=>array('admin')),
);
?>

<h1>Update Labmanager <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
/* @var $this CancelledorController */
/* @var $model Cancelledor */

$this->breadcrumbs=array(
	'Cancelledors'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Cancelledor', 'url'=>array('index')),
	array('label'=>'Create Cancelledor', 'url'=>array('create')),
	array('label'=>'View Cancelledor', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Cancelledor', 'url'=>array('admin')),
);
?>

<h1>Update Cancelledor <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
/* @var $this LastorController */
/* @var $model Lastor */

$this->breadcrumbs=array(
	'Lastors'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Lastor', 'url'=>array('index')),
	array('label'=>'Create Lastor', 'url'=>array('create')),
	array('label'=>'View Lastor', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Lastor', 'url'=>array('admin')),
);
?>

<h1>Update Lastor <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
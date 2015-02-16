<?php
/* @var $this RequestcodeController */
/* @var $model Requestcode */

$this->breadcrumbs=array(
	'Requestcodes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Requestcode', 'url'=>array('index')),
	array('label'=>'Create Requestcode', 'url'=>array('create')),
	array('label'=>'View Requestcode', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Requestcode', 'url'=>array('admin')),
);
?>

<h1>Update Requestcode <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
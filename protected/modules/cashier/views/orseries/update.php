<?php
/* @var $this OrseriesController */
/* @var $model Orseries */

$this->breadcrumbs=array(
	'Orseries'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Orseries', 'url'=>array('index')),
	array('label'=>'Create Orseries', 'url'=>array('create')),
	array('label'=>'View Orseries', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Orseries', 'url'=>array('admin')),
);
?>

<h1>Update Orseries <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
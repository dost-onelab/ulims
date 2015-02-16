<?php
/* @var $this LabController */
/* @var $model Lab */

$this->breadcrumbs=array(
	'Labs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Lab', 'url'=>array('index')),
	array('label'=>'Create Lab', 'url'=>array('create')),
	array('label'=>'View Lab', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Lab', 'url'=>array('admin')),
);
?>

<h1>Update Lab <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
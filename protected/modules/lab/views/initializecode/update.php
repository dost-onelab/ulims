<?php
/* @var $this InitializecodeController */
/* @var $model Initializecode */

$this->breadcrumbs=array(
	'Initializecodes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Initializecode', 'url'=>array('index')),
	array('label'=>'Create Initializecode', 'url'=>array('create')),
	array('label'=>'View Initializecode', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Initializecode', 'url'=>array('admin')),
);
?>

<h1>Update Initializecode <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
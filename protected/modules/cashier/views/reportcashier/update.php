<?php
/* @var $this ReportcashierController */
/* @var $model Reportcashier */

$this->breadcrumbs=array(
	'Reportcashiers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Reportcashier', 'url'=>array('index')),
	array('label'=>'Create Reportcashier', 'url'=>array('create')),
	array('label'=>'View Reportcashier', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Reportcashier', 'url'=>array('admin')),
);
?>

<h1>Update Reportcashier <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
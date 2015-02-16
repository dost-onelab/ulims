<?php
/* @var $this ReportcashierController */
/* @var $model Reportcashier */

$this->breadcrumbs=array(
	'Reportcashiers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Reportcashier', 'url'=>array('index')),
	array('label'=>'Manage Reportcashier', 'url'=>array('admin')),
);
?>

<h1>Create Reportcashier</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
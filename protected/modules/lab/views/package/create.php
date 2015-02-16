<?php
/* @var $this PackageController */
/* @var $model Package */

$this->breadcrumbs=array(
	'Packages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Package', 'url'=>array('index')),
	array('label'=>'Manage Package', 'url'=>array('admin')),
);
?>

<h1>Create Package</h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'gridDataProviderTest'=>$gridDataProviderTest)); ?>
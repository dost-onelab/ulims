<?php
/* @var $this LabServiceController */
/* @var $model LabService */

$this->breadcrumbs=array(
	'Lab Services'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List LabService', 'url'=>array('index')),
	array('label'=>'Manage LabService', 'url'=>array('admin')),
);
?>

<h1>Create LabService</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
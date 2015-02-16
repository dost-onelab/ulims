<?php
/* @var $this LabServiceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Lab Services',
);

$this->menu=array(
	array('label'=>'Create LabService', 'url'=>array('create')),
	array('label'=>'Manage LabService', 'url'=>array('admin')),
);
?>

<h1>Lab Services</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php
/* @var $this LabmanagerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Labmanagers',
);

$this->menu=array(
	array('label'=>'Create Labmanager', 'url'=>array('create')),
	array('label'=>'Manage Labmanager', 'url'=>array('admin')),
);
?>

<h1>Labmanagers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

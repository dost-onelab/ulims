<?php
/* @var $this ConfiglabController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Configlabs',
);

$this->menu=array(
	array('label'=>'Create Configlab', 'url'=>array('create')),
	array('label'=>'Manage Configlab', 'url'=>array('admin')),
);
?>

<h1>Configlabs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php
/* @var $this LabController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Labs',
);

$this->menu=array(
	array('label'=>'Create Lab', 'url'=>array('create')),
	array('label'=>'Manage Lab', 'url'=>array('admin')),
);
?>

<h1>Labs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

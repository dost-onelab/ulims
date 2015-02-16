<?php
/* @var $this LastorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Lastors',
);

$this->menu=array(
	array('label'=>'Create Lastor', 'url'=>array('create')),
	array('label'=>'Manage Lastor', 'url'=>array('admin')),
);
?>

<h1>Lastors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

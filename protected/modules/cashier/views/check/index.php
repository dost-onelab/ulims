<?php
/* @var $this CheckController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Checks',
);

$this->menu=array(
	array('label'=>'Create Check', 'url'=>array('create')),
	array('label'=>'Manage Check', 'url'=>array('admin')),
);
?>

<h1>Checks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

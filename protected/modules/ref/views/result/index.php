<?php
/* @var $this ResultController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Results',
);

$this->menu=array(
	array('label'=>'Create Result', 'url'=>array('create')),
	array('label'=>'Manage Result', 'url'=>array('admin')),
);
?>

<h1>Results</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php
/* @var $this AnalysisController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Analysises',
);

$this->menu=array(
	array('label'=>'Create Analysis', 'url'=>array('create')),
	array('label'=>'Manage Analysis', 'url'=>array('admin')),
);
?>

<h1>Analysises</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

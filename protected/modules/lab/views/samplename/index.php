<?php
/* @var $this SamplenameController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Samplenames',
);

$this->menu=array(
	array('label'=>'Create Samplename', 'url'=>array('create')),
	array('label'=>'Manage Samplename', 'url'=>array('admin')),
);
?>

<h1>Samplenames</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

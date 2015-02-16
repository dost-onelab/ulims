<?php
/* @var $this SampletypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sampletypes',
);

$this->menu=array(
	array('label'=>'Create Sampletype', 'url'=>array('create')),
	array('label'=>'Manage Sampletype', 'url'=>array('admin')),
);
?>

<h1>Sampletypes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

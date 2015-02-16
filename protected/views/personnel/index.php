<?php
/* @var $this PersonnelController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Personnels',
);

$this->menu=array(
	array('label'=>'Create Personnel', 'url'=>array('create')),
	array('label'=>'Manage Personnel', 'url'=>array('admin')),
);
?>

<h1>Personnels</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

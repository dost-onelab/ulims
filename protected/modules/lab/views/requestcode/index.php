<?php
/* @var $this RequestcodeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Requestcodes',
);

$this->menu=array(
	array('label'=>'Create Requestcode', 'url'=>array('create')),
	array('label'=>'Manage Requestcode', 'url'=>array('admin')),
);
?>

<h1>Requestcodes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

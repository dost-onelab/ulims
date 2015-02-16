<?php
/* @var $this InitializecodeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Initializecodes',
);

$this->menu=array(
	array('label'=>'Create Initializecode', 'url'=>array('create')),
	array('label'=>'Manage Initializecode', 'url'=>array('admin')),
);
?>

<h1>Initializecodes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php
/* @var $this CancelledorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cancelledors',
);

$this->menu=array(
	array('label'=>'Create Cancelledor', 'url'=>array('create')),
	array('label'=>'Manage Cancelledor', 'url'=>array('admin')),
);
?>

<h1>Cancelledors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

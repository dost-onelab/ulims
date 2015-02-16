<?php
/* @var $this CancelledrequestController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cancelledrequests',
);

$this->menu=array(
	array('label'=>'Create Cancelledrequest', 'url'=>array('create')),
	array('label'=>'Manage Cancelledrequest', 'url'=>array('admin')),
);
?>

<h1>Cancelledrequests</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

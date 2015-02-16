<?php
/* @var $this CancelledrequestController */
/* @var $model Cancelledrequest */

$this->breadcrumbs=array(
	'Cancelledrequests'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Cancelledrequest', 'url'=>array('index')),
	array('label'=>'Manage Cancelledrequest', 'url'=>array('admin')),
);
?>

<h1>Create Cancelledrequest</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
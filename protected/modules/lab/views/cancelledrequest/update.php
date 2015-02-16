<?php
/* @var $this CancelledrequestController */
/* @var $model Cancelledrequest */

$this->breadcrumbs=array(
	'Cancelledrequests'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Cancelledrequest', 'url'=>array('index')),
	array('label'=>'Create Cancelledrequest', 'url'=>array('create')),
	array('label'=>'View Cancelledrequest', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Cancelledrequest', 'url'=>array('admin')),
);
?>

<h1>Update Cancelledrequest <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
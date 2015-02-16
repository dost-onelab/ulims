<?php
/* @var $this LabServiceController */
/* @var $model LabService */

$this->breadcrumbs=array(
	'Lab Services'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List LabService', 'url'=>array('index')),
	array('label'=>'Create LabService', 'url'=>array('create')),
	array('label'=>'View LabService', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage LabService', 'url'=>array('admin')),
);
?>

<h1>Update LabService <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
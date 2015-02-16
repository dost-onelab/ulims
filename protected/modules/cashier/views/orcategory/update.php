<?php
/* @var $this OrcategoryController */
/* @var $model Orcategory */

$this->breadcrumbs=array(
	'Orcategories'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Orcategory', 'url'=>array('index')),
	array('label'=>'Create Orcategory', 'url'=>array('create')),
	array('label'=>'View Orcategory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Orcategory', 'url'=>array('admin')),
);
?>

<h1>Update Orcategory <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
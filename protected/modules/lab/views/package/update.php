<?php
/* @var $this PackageController */
/* @var $model Package */

$this->breadcrumbs=array(
	'Packages'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Package', 'url'=>array('index')),
	array('label'=>'Create Package', 'url'=>array('create')),
	array('label'=>'View Package', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Package', 'url'=>array('admin')),
);
?>

<h1>Update Package <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form',	array(
										'model'=>$model, 
										'selected'=>$selected,
										'gridDataProviderTest'=>$gridDataProviderTest,
										'tests'=>$tests,
										'modelTests'=>$modelTests
	));/*, '', true); */
	
?>
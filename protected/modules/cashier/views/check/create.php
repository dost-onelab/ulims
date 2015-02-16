<?php
/* @var $this CheckController */
/* @var $model Check */

$this->breadcrumbs=array(
	'Checks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Check', 'url'=>array('index')),
	array('label'=>'Manage Check', 'url'=>array('admin')),
);
?>

<h1>Create Check</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
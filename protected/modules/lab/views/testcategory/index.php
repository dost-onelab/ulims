<?php
/* @var $this TestcategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Testcategories',
);

$this->menu=array(
	array('label'=>'Create Testcategory', 'url'=>array('create')),
	array('label'=>'Manage Testcategory', 'url'=>array('admin')),
);
?>

<h1>Testcategories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

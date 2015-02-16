<?php
/* @var $this OrcategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Orcategories',
);

$this->menu=array(
	array('label'=>'Create Orcategory', 'url'=>array('create')),
	array('label'=>'Manage Orcategory', 'url'=>array('admin')),
);
?>

<h1>Orcategories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

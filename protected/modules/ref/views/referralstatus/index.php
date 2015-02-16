<?php
/* @var $this ReferralstatusController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Referralstatuses',
);

$this->menu=array(
	array('label'=>'Create Referralstatus', 'url'=>array('create')),
	array('label'=>'Manage Referralstatus', 'url'=>array('admin')),
);
?>

<h1>Referralstatuses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

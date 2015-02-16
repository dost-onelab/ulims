<?php
/* @var $this ReferralController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Referrals',
);

$this->menu=array(
	array('label'=>'Create Referral', 'url'=>array('create')),
	array('label'=>'Manage Referral', 'url'=>array('admin')),
);
?>

<h1>Referrals</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

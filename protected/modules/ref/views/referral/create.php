<?php
/* @var $this ReferralController */
/* @var $model Referral */

$this->breadcrumbs=array(
	'Referrals'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Referral', 'url'=>array('index')),
	array('label'=>'Manage Referral', 'url'=>array('admin')),
);
?>

<h1>Create Referral</h1>

<?php //$this->renderPartial('_form', array('model'=>$model)); ?>

<?php $this->renderPartial('_form', array(
				'model'=>$model, 
				'labs' => $labs,
				'agencies' => $agencies,
				'discounts' => $discounts
)); ?>
<?php
/* @var $this TestcategoryController */
/* @var $data Testcategory */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('categoryName')); ?>:</b>
	<?php echo CHtml::encode($data->categoryName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('labId')); ?>:</b>
	<?php echo CHtml::encode($data->labId); ?>
	<br />


</div>
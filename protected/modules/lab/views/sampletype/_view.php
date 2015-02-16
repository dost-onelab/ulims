<?php
/* @var $this SampletypeController */
/* @var $data Sampletype */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sampleType')); ?>:</b>
	<?php echo CHtml::encode($data->sampleType); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('testCategoryId')); ?>:</b>
	<?php echo CHtml::encode($data->testCategoryId); ?>
	<br />


</div>
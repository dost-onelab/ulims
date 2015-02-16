<?php
/* @var $this CustomerController */
/* @var $model Customer */
/* @var $form CActiveForm */
if(Yii::app()->request->isAjaxRequest){
	Yii::app()->clientscript->scriptMap['jquery.js'] = false;
	Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
}
?>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'customer-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    <h4><i>Agency/Personal Info</i></h4>
	<div class="row">
    	<?php echo $form->labelEx($model,'customerName'); ?>
        <?php echo $form->textField($model,'customerName',array('size'=>60,'maxlength'=>200)); ?>
        <?php echo $form->error($model,'customerName'); ?>
    </div>
	
    <div class="row">
    	<?php echo $form->labelEx($model,'head'); ?>
        <?php echo $form->textField($model,'head',array('size'=>60,'maxlength'=>100)); ?>
        <?php echo $form->error($model,'head'); ?>
    </div>

    <div class="row">
    	<?php echo $form->labelEx($model,'typeId'); ?>
        <?php echo $form->dropDownList($model,'typeId',	Customertype::listData());?>
        <?php echo $form->error($model,'typeId'); ?>
    </div>

    <div class="row">
    	<?php echo $form->labelEx($model,'natureId'); ?>
        <?php echo $form->dropDownList($model,'natureId', Businessnature::listData());?>
        <?php echo $form->error($model,'natureId'); ?>
    </div>               

    <div class="row">
    	<?php echo $form->labelEx($model,'industryId'); ?>
        <?php echo $form->dropDownList($model,'industryId',	Industry::listData());?>
        <?php echo $form->error($model,'industryId'); ?>
    </div>               
     
	<h4><i>Address</i></h4>
    <div class="row">
    	<?php echo $form->labelEx($model,'region_id'); ?>
        <?php $region=Region::listData();?>
		<?php echo $form->dropDownList($model, 'region_id', 
						$region, 
						array(
							'ajax'=>array( 
								'type'=>'POST',
								'url'=>$this->createUrl('customer/getProvince'),
								'dataType'=>'json',
								'data'=>'js:$(this).serialize()',
								'update'=>'#Customer_province_id',
								'success'=>'js:function(data){
									if(data){		
										$("#Customer_province_id").html(data.dropDownProvince);
										$("#Customer_municipalitycity_id").html(data.dropDownMunicipalityCity);
										$("#Customer_barangay_id").html(data.dropDownBarangay);
									}
								}'
							),
							'empty'=>''
						));?>
		<?php echo $form->error($model,'region_id'); ?>
    </div>    
    
    <div class="row">
    	<?php echo $form->labelEx($model,'province_id'); ?>
		<?php 
			$provinces=Province::listDataByRegion($model->region_id);
			echo $form->dropDownList($model, 'province_id',
						$provinces,
						array(
							'ajax'=>array( 
								'type'=>'POST',
						 		'url'=>$this->createUrl('customer/getMunicipalityCity'),
						 		'dataType'=>'json',
								'data'=>'js:$(this).serialize()',
								'success'=>'js:function(data){
									if(data){		
										$("#Customer_municipalitycity_id").html(data.dropDownMunicipalityCity);
										$("#Customer_barangay_id").html(data.dropDownBarangay);
									}
								}'
							),
							'empty'=>''
						)	
					);
		?>  
		<?php echo $form->error($model,'province_id'); ?>              
    </div>
	
    <div class="row">
    	<?php echo $form->labelEx($model,'municipalitycity_id'); ?>
		<?php
		//echo $model->province_id;
		$provinceId=MunicipalityCity::model()->findByPk($model->municipalitycity_id)->provinceId;
		if($model->province_id)
			$provinceId=$model->province_id;
		$municipality=MunicipalityCity::listDataByProvince($provinceId);
					//$municipality=array(''=>'');
					echo $form->dropDownList($model, 'municipalitycity_id', 
								$municipality,
								array('ajax'=>array( 
									'type'=>'POST',
								 	'url'=>$this->createUrl('customer/getBarangay'),
								 	'dataType'=>'json',
									'data'=>'js:$(this).serialize()',
									'success'=>'js:function(data){
										if(data){
											$("#Customer_barangay_id").html(data.dropDownBarangay);
										}
									}
									'
								),
									'empty'=>''
					));?>
				<?php echo $form->error($model,'municipalitycity_id'); ?>
        
    </div>

    <div class="row">
    	<?php echo $form->labelEx($model,'barangay_id'); ?>
		<?php
			$municipalityCityId=Barangay::model()->findByPk($model->barangay_id)->municipalityCityId;
			if($model->municipalitycity_id)
				$municipalityCityId=$model->municipalitycity_id;
			$barangay=Barangay::listDataByMunicipalityCity($municipalityCityId);
		?>
		<?php echo $form->dropDownList($model,'barangay_id',$barangay,array('empty'=>''));?>
		<?php echo $form->error($model,'barangay_id'); ?>        
    </div>

    <div class="row">
    	<?php echo $form->labelEx($model,'address'); ?>
        <?php echo $form->textArea($model,'address',array('size'=>60,'maxlength'=>200)); ?>
        <?php echo $form->error($model,'address'); ?>
    </div>
	<h4><i>Contact Info</i></h4>
    <div class="row">
    	<?php echo $form->labelEx($model,'tel'); ?>
        <?php echo $form->textField($model,'tel',array('size'=>50,'maxlength'=>50)); ?>
        <?php echo $form->error($model,'tel'); ?>
    </div>
    
    <div class="row">
    	<?php echo $form->labelEx($model,'fax'); ?>
        <?php echo $form->textField($model,'fax',array('size'=>50,'maxlength'=>50)); ?>
        <?php echo $form->error($model,'fax'); ?>
    </div> 

    <div class="row">
    	<?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50)); ?>
        <?php echo $form->error($model,'email'); ?>
    </div>
    
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-info')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
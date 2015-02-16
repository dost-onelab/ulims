<?php
/* @var $this CustomerController */
/* @var $model Customer */
/* @var $form CActiveForm */
if(Yii::app()->request->isAjaxRequest){
	Yii::app()->clientscript->scriptMap['jquery.js'] = false;
	Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
}
?>

<div class="form">

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
	
	<div class="row">
			<?php echo $form->labelEx($model,'customerName'); ?>
			<?php 
				/*$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
					'id'=>'Request_customerName',
				    'name'=>'Request[customerName]',
				    'source'=>$this->createUrl('customer/searchLocalCustomer'),
					//'value'=>$model->customer->customerName,
				    'options'=>array(
				        'minLength'=>3,
				        'showAnim'=>'fold',
						'select'=>'js:function(event, ui) 
							{ 
								//$("#Request_customerId").val(ui.item.id); // assign customerId to hidden field
							}'
				    ),
				    'htmlOptions'=>array(
				    	'placeholder'=>'Search from local ULIMS',
				    	'style'=>'width:400px;',
						'onBlur'=>'	if(value==""){
								$("#Request_customerId").val("");
								//$("#customer tr td.fieldcust").html("");
								//$("#customer tr td.fieldtel").html("");
								//$("#customer tr td.fieldaddr").html("");
								//$("#customer tr td.fieldfax").html("");
							}
						',
				    ),
				   
				));*/
			
			?>
			<?php 
			/*$this->widget('ext.select2.ESelect2',array(
				'name'=>'localCustomer',
			  //'id'=>'localCustomer',
	          //'model'=>$model,
			  //'attribute'=>'customer_id',
	          'data'=>Customerlocal::listData(),
	          'options'=>array(
	                'width'=>'350px',
	                'allowClear'=>true,
					'minimumInputLength'=>3,
	                'placeholder'=>'Search from local Customers ...',
	            ),
	          'events' =>array('change'=>'js:function(e) 
	                    { 
	                       data = $(this).select2("data");
	                       localCustomer = '.Customerlocal::model()->findByPk(data.id).'
	                       
	                       $("#Customer_customerName").val(data.id);
	                    }
	                    '
	            ),
	        ));*/?>
		</div>
		
	<fieldset class="legend-border customer" style="float: left; width: 200px; margin-right: 50px;">
    	<legend class="legend-border" style="font-size: 16px;">Agency/Personal Info</legend>
		<div class="row">
			<?php echo $form->labelEx($model,'customerName'); ?>
			<?php echo $form->textField($model,'customerName',array('size'=>50,'maxlength'=>50)); ?>
			<?php echo $form->error($model,'customerName'); ?>
		</div>
	
		<div class="row">
			<?php echo $form->labelEx($model,'agencyHead'); ?>
			<?php echo $form->textField($model,'agencyHead',array('size'=>50,'maxlength'=>50)); ?>
			<?php echo $form->error($model,'agencyHead'); ?>
		</div>
	
		<div class="row">
			<?php echo $form->labelEx($model,'type_id'); ?>
			<?php echo $form->dropDownList($model,'type_id',	Customertype::listData());?>
			<?php echo $form->error($model,'type_id'); ?>
		</div>
	
		<div class="row">
			<?php echo $form->labelEx($model,'nature_id'); ?>
			<?php echo $form->dropDownList($model,'nature_id', Businessnature::listData());?>
			<?php echo $form->error($model,'nature_id'); ?>
		</div>
	
		<div class="row">
			<?php echo $form->labelEx($model,'industry_id'); ?>
			<?php echo $form->dropDownList($model,'industry_id', Industrytype::listData());?>
			<?php echo $form->error($model,'industry_id'); ?>
		</div>
	</fieldset>	   
	
	
	<fieldset class="legend-border" style="float: left; width: 200px; margin-right: 50px;">
    	<legend class="legend-border" style="font-size: 16px;">Address</legend>
		<div class="row">
			<?php echo $form->labelEx($model,'region_id'); ?>
			<?php $region = Region::listData();?>
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
				$provinces = Province::listDataByRegion($model->region_id);
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
											$("#Customer_municipalityCity_id").html(data.dropDownMunicipalityCity);
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
			<?php echo $form->labelEx($model,'municipalityCity_id'); ?>
			<?php
			//echo $model->province_id;
			$provinceId=MunicipalityCity::model()->findByPk($model->municipalityCity_id)->provinceId;
			if($model->province_id)
				$provinceId = $model->province_id;
				$municipality = MunicipalityCity::listDataByProvince($provinceId);
						//$municipality=array(''=>'');
						echo $form->dropDownList($model, 'municipalityCity_id', 
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
			<?php echo $form->error($model,'municipalityCity_id'); ?>
		</div>
	
		<div class="row">
			<?php echo $form->labelEx($model,'barangay_id'); ?>
			<?php //echo $form->textField($model,'barangay_id'); ?>
			<?php 
				$municipalityCityId = $model->municipalityCity_id;
				$barangay = Barangay::listDataByMunicipalityCity($municipalityCityId);
				echo $form->dropDownList($model, barangay_id, $barangay);
			?>
			<?php echo $form->error($model,'barangay_id'); ?>
		</div>
	
		<div class="row">
			<?php echo $form->labelEx($model,'houseNumber'); ?>
			<?php echo $form->textField($model,'houseNumber',array('size'=>60,'maxlength'=>200)); ?>
			<?php echo $form->error($model,'houseNumber'); ?>
		</div>
	</fieldset>
	
	<fieldset class="legend-border" style="float: left; width: 200px; padding-right: 50px;">
    	<legend class="legend-border" style="font-size: 16px;">Contact Info</legend>
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
		
		<?php if(Yii::app()->user->hasFlash('error')): ?>
		    <div class="alert alert-warning" style="width:375px; margin: 10px 5px 10px 65px">
	        
	        <strong> <?php echo Yii::app()->user->getFlash('error'); ?> </strong> <br/>
	        Error Message: <strong> <?php echo Yii::app()->user->getFlash('errormessage'); ?></strong> 
			</div>
		<?php endif; ?>
		
		<div class="row buttons">
			<?php echo CHtml::submitButton(!isset($model->id) ? 'Create' : 'Save', 
							array('class'=>'btn btn-info')); 
			?>
	</div>
	</fieldset>
	
	
<?php $this->endWidget(); ?>

</div><!-- form -->
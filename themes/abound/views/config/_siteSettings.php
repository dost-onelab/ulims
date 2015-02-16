<?php 
//default no-image
$noImage='<span class="no-image">NO IMAGE</span>';
?>
<div class="form wide">
<form id="site-settings" method='POST' enctype="multipart/form-data" action="<?php echo $this->createUrl('config/saveSettings');?>">
	<table class="table table-striped table-bordered table-condensed">
    <tr>
    	<th>About the Agency/Laboratory <small>(Used in reports/forms)</small></th>
    </tr>
    <tr>
        <td>
            <div class="row">
            <label style="width:180px; line-height:35px;">Name:</label>
            <input type="text" name="Agency[name]" value="<?php echo Yii::app()->params['Agency']['name'];?>" style="width:70%;"/>
        	</div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="row">
            <label style="width:180px; line-height:35px;">Short Name:</label>
            <input type="text" name="Agency[shortName]" value="<?php echo Yii::app()->params['Agency']['shortName'];?>" style="width:70%;"/> <!--span style="color:#999;"><i>used in receipt</i></span-->
        	</div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="row">
            <label style="width:180px; line-height:35px;">Laboratory Name (Full):</label>
            <input type="text" name="Agency[labName]" value="<?php echo Yii::app()->params['Agency']['labName'];?>" style="width:70%;"/> <!--span style="color:#999;"><i>used in receipt</i></span-->
        	</div>
        </td>
    </tr>    
        
    <tr>
        <td>
            <div class="row">
            <label style="width:180px; line-height:35px;">Address:</label>
            <textarea name="Agency[address]" cols="200" rows="4" style="width:70%;"><?php echo Yii::app()->params['Agency']['address'];?></textarea>
        	</div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="row">
            <label style="width:180px; line-height:35px;">Contact Nos.:</label>
            <input type="text" name="Agency[contacts]" value="<?php echo Yii::app()->params['Agency']['contacts'];?>" style="width:70%;"/>
        	</div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="row">            
            <label style="width:180px; line-height:35px;">Logo:</label>
            <?php 
				//display image
				$defaultLogo=Yii::app()->createAbsoluteUrl('/images/dost_logo.png');
				$defaultLogo=Helper::checkRemoteFile($defaultLogo)?CHtml::image(Yii::app()->request->baseUrl.'/images/dost_logo.png','agency-logo', array('class'=>'image-thumb fltl')):$noImage;
				echo Yii::app()->params['Agency']['logo']?CHtml::image(Yii::app()->request->baseUrl .'/images/'.Yii::app()->params['Agency']['logo'],'agency-logo', array('class'=>'image-thumb fltl')):$defaultLogo;
			?>
            <input type="file" name="Agency[logo]" value="<?php echo Yii::app()->params['Agency']['logo'];?>" style="margin-left:10px"/>
        	</div>
        </td>
    </tr>    
    <tr>
    	<th>Dashboard</th>
    </tr>
    <tr>
        <td>
            <div class="row">
            <label style="width:180px; line-height:35px;">Title:</label>
            <input type="text" name="Dashboard[title]" value="<?php echo Yii::app()->params['Dashboard']['title'];?>" style="width:70%;"/>
        	</div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="row">
            <label style="width:180px; line-height:35px;">Description:</label>
            <textarea name="Dashboard[description]" cols="200" rows="6" style="width:70%;"><?php echo Yii::app()->params['Dashboard']['description'];?></textarea>
        	</div>
        </td>
    </tr>
    <tr>
    	<th>Sidebar Images</th>
    </tr>
    <tr>
        <td>
            <div class="row">            
            <label style="width:180px; line-height:35px;">Lab:</label>
            <?php 
				//display image
				$defaultImgLabUrl=Yii::app()->createAbsoluteUrl('/images/iso17025-accredited.png');
				$defaultImgLab=Helper::checkRemoteFile($defaultImgLabUrl)?CHtml::image(Yii::app()->request->baseUrl.'/images/iso17025-accredited.png','lab-sidebar-image', array('class'=>'image-thumb fltl')):$noImage;
				echo Yii::app()->params['Lab']['sidebarImage']?CHtml::image(Yii::app()->request->baseUrl .'/images/'.Yii::app()->params['Lab']['sidebarImage'],'lab-sidebar-image', array('class'=>'image-thumb fltl')):$defaultImgLab;
			?>
            <input type="file" name="Lab[sidebarImage]" value="<?php echo Yii::app()->params['Lab']['sidebarImage'];?>" style="margin-left:10px"/>
        	</div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="row">
            <label style="width:180px; line-height:35px;">Cashier:</label>
            <?php 
				//display image
				$defaultImgCashierUrl=Yii::app()->createAbsoluteUrl('/images/iso9001-2008certified.png');
				$defaultImgCashier=Helper::checkRemoteFile($defaultImgCashierUrl)?CHtml::image(Yii::app()->request->baseUrl.'/images/iso9001-2008certified.png','cashier-sidebar-image', array('class'=>'image-thumb fltl')):$noImage;
				echo Yii::app()->params['Cashier']['sidebarImage']?CHtml::image(Yii::app()->request->baseUrl .'/images/'.Yii::app()->params['Cashier']['sidebarImage'],'cashier-sidebar-image', array('class'=>'image-thumb fltl')):$defaultImgCashier;
				
			?>
            <input type="file" name="Cashier[sidebarImage]" style="margin-left:10px"/>
        	</div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="row">
            <label style="width:180px; line-height:35px;">Accounting:</label>
            <?php 
				//display image
				$defaultImgAccountingUrl=Yii::app()->createAbsoluteUrl('/images/iso9001-2008certified.png');
				$defaultImgAccounting=Helper::checkRemoteFile($defaultImgCashierUrl)?CHtml::image(Yii::app()->request->baseUrl.'/images/iso9001-2008certified.png','accounting-sidebar-image', array('class'=>'image-thumb fltl')):$noImage;
				echo Yii::app()->params['Accounting']['sidebarImage']?CHtml::image(Yii::app()->request->baseUrl .'/images/'.Yii::app()->params['Accounting']['sidebarImage'],'accounting-sidebar-image', array('class'=>'image-thumb fltl')):$defaultImgAccounting;
			?>
            <input type="file" name="Accounting[sidebarImage]" style="margin-left:10px"/>
        	</div>
        </td>
    </tr>       
    <tr>
    	<th>Administrator</th>
    </tr>
    <tr>
    	<td>
            <div class="row">
            <label style="width:180px; line-height:35px;">Admin e-mail:</label>
            <input type="text" name="adminEmail" value="<?php echo Yii::app()->params[adminEmail];?>" 
            style="width:70%;" disabled="disabled" />
            </div>
		</td>    
    </tr>  
    <tr>
    <!--tr>
    	<th colspan="3">Allowed Ips</th>
    </tr>
        <td>
            IP admin access (max. 3):
            <div class="row">
            <input type="text" name="allowip_admin[admin1]" value="<?php echo Yii::app()->params[Allowips_admin][0];?>" style="width:250px"/>
            </div>            
            <div class="row">
            <input type="text" name="allowip_admin[admin2]" value="<?php echo Yii::app()->params[Allowips_admin][1];?>" style="width:250px"/>
            </div>            
            <div class="row">
            <input type="text" name="allowip_admin[admin3]" value="<?php echo Yii::app()->params[Allowips_admin][2];?>" style="width:250px"/>
            </div>                       
        </td>        
    </tr-->
    </tr>
    </table>
        	
			<?php
            /*echo CHtml::ajaxSubmitButton("Save",
                                  array('config/saveSettings'), 
                                  array(
								  	'method' => 'POST',//'update' => '#msg',
									'success'=>'function(data){show_message(data);}',
									),
                                  //array('id'=>'button_saveSettings','onClick'=> 'show_message()')
                                  array('id'=>'button_saveSettings','class'=>'btn btn-success','onclick'=>'js:$("#site-settings").submit(); return false;')
                                  );
			*/?>
            <?php echo CHtml::submitButton('Save',array('class'=>'btn btn-success')); ?>
       		
            <span id="msg" style="color:#F00;font-weight:bold; width:300px;"></span>
    
</form>
</div>
<script type="text/javascript">

	function show_message(msg){
		$('#msg').show();
		$('#msg').html(msg);
		//$('#msg').fadeOut(1500);
	}
</script>
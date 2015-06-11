<?php 
//default no-image
$noImage='<span class="no-image">NO IMAGE</span>';
?>
<div class="form wide">
<form id="api-settings" method='POST' enctype="multipart/form-data" action="<?php echo $this->createUrl('config/saveAPISettings');?>">
	<table class="table table-striped table-bordered table-condensed">
    <tr>
    	<th>OneLab API Configuration</th>
    </tr>
    <tr>
        <td>
            <div class="row">
            <label style="width:180px; line-height:35px;">URL:</label>
            <input type="text" name="API[url]" value="<?php echo Yii::app()->params['API']['url'];?>" style="width:70%;"/>
        	</div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="row">
            <label style="width:180px; line-height:35px;">Version:</label>
            <input type="text" name="API[version]" value="<?php echo Yii::app()->params['API']['version'];?>" style="width:70%;"/> <!--span style="color:#999;"><i>used in receipt</i></span-->
        	</div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="row">
            <label style="width:180px; line-height:35px;">Proxy: URL</label>
            <input type="text" name="API[proxy_url]" value="<?php echo Yii::app()->params['API']['proxy_url'];?>" style="width:70%;"/> <!--span style="color:#999;"><i>used in receipt</i></span-->
        	</div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="row">
            <label style="width:180px; line-height:35px;">Proxy: Port</label>
            <input type="text" name="API[proxy_port]" value="<?php echo Yii::app()->params['API']['proxy_port'];?>" style="width:70%;"/> <!--span style="color:#999;"><i>used in receipt</i></span-->
        	</div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="row">
            <label style="width:180px; line-height:35px;">Proxy: User</label>
            <input type="text" name="API[proxy_user]" value="<?php echo Yii::app()->params['API']['proxy_user'];?>" style="width:70%;"/> <!--span style="color:#999;"><i>used in receipt</i></span-->
        	</div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="row">
            <label style="width:180px; line-height:35px;">Proxy: Password</label>
            <input type="password" name="API[proxy_pass]" value="<?php echo Yii::app()->params['API']['proxy_pass'];?>" style="width:70%;"/> <!--span style="color:#999;"><i>used in receipt</i></span-->
        	</div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="row">
            <label style="width:180px; line-height:35px;">API: Secret</label>
            <input type="text" name="API[api_secret]" value="<?php echo Yii::app()->params['API']['api_secret'];?>" disabled="disabled" style="width:70%;"/> <!--span style="color:#999;"><i>used in receipt</i></span-->
        	</div>
        </td>
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
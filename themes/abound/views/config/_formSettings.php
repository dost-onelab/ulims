<?php 
//default no-image
$noImage='<span class="no-image">NO LOGO</span>';
?>
<div class="form wide">
<form id="form-settings" method='POST' enctype="multipart/form-data" action="<?php echo $this->createUrl('config/saveFormSettings');?>">
	<table class="table table-striped table-bordered table-condensed">
    <tr>
    	<th>Request Form</th>
    </tr>
    <tr>
        <td>
            <div class="row">
            <label style="width:180px; line-height:35px;">Form Title:</label>
            <input type="text" name="FormRequest[title]" value="<?php echo Yii::app()->params['FormRequest']['title'];?>" style="width:70%;"/>
        	</div>
        </td>
    </tr>
     <tr>
        <td>
            <div class="row">
            <label style="width:180px; line-height:35px;">Form Number:</label>
            <input type="text" name="FormRequest[number]" value="<?php echo Yii::app()->params['FormRequest']['number'];?>" style="width:70%;"/>
        	</div>
        </td>
    </tr>
     <tr>
        <td>
            <div class="row">
            <label style="width:180px; line-height:35px;">Form Revision No.:</label>
            <input type="text" name="FormRequest[revNum]" value="<?php echo Yii::app()->params['FormRequest']['revNum'];?>" style="width:70%;"/>
        	</div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="row">
            <label style="width:180px; line-height:35px;">Form Revision Date:</label>
            <input type="text" name="FormRequest[revDate]" value="<?php echo Yii::app()->params['FormRequest']['revDate'];?>" style="width:70%;"/>
        	</div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="row">
            <label style="width:180px; line-height:35px;">Print Format:</label>
            <?php echo CHtml::dropDownList("FormRequest[printFormat]", Yii::app()->params['FormRequest']['printFormat'], array('1'=>'Excel', '2'=>'PDF'));?>
            <!-- input type="select" name="FormRequest[printFormat]" value="<?php echo Yii::app()->params['FormRequest']['printFormat'];?>" style="width:70%;"/-->
        	</div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="row">            
            <label style="width:180px; line-height:35px;">Header Logo (Left):</label>
            <div class="rq-logoLeft">
            <?php 
			if(Yii::app()->params['FormRequest']['logoLeft']){
				echo CHtml::image(Yii::app()->request->baseUrl .'/images/'.
				Yii::app()->params['FormRequest']['logoLeft'],'agency-logo', array('class'=>'image-thumb fltl'));
				echo CHtml::link(' x','javascript:void(0)', 
					array('class'=>'remove-link', 'title'=>'Remove image',
						'rel'=>Yii::app()->params['FormRequest']['logoLeft'],
						'name'=>'FormRequest[logoLeft]'
					));
			}else{ echo $noImage;
			?>
            <input type="file" name="FormRequest[logoLeft]" accept="image/*" style="margin-left:10px"/>            
			<?php }?>
            </div>
        	</div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="row">            
            <label style="width:180px; line-height:35px;">Header Logo (Right):</label>
            <div class="rq-logoRight">
            <?php 
			if(Yii::app()->params['FormRequest']['logoRight']){
				echo CHtml::image(Yii::app()->request->baseUrl .'/images/'.
				Yii::app()->params['FormRequest']['logoRight'],'agency-logo', array('class'=>'image-thumb fltl'));
				echo CHtml::link(' x','javascript:void(0)', 
						array('class'=>'remove-link', 'title'=>'Remove image',
								'rel'=>Yii::app()->params['FormRequest']['logoRight'],
								'name'=>'FormRequest[logoRight]'
						));
			}else{ echo $noImage;
			?>
            <input type="file" name="FormRequest[logoRight]"  accept="image/*" style="margin-left:10px"/>
            <?php }?>
            </div>
        	</div>
        </td>
    </tr>                      
    <tr>
    	<th>Order of Payment Form</th>
    </tr>
    <tr>
        <td>
            <div class="row">
            <label style="width:180px; line-height:35px;">Form Title:</label>
            <input type="text" name="FormOrderofpayment[title]" value="<?php echo Yii::app()->params['FormOrderofpayment']['title'];?>" style="width:70%;"/>
        	</div>
        </td>
    </tr>
     <tr>
        <td>
            <div class="row">
            <label style="width:180px; line-height:35px;">Form Number:</label>
            <input type="text" name="FormOrderofpayment[number]" value="<?php echo Yii::app()->params['FormOrderofpayment']['number'];?>" style="width:70%;"/>
        	</div>
        </td>
    </tr>
     <tr>
        <td>
            <div class="row">
            <label style="width:180px; line-height:35px;">Form Revision No.:</label>
            <input type="text" name="FormOrderofpayment[revNum]" value="<?php echo Yii::app()->params['FormOrderofpayment']['revNum'];?>" style="width:70%;"/>
        	</div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="row">
            <label style="width:180px; line-height:35px;">Form Revision Date:</label>
            <input type="text" name="FormOrderofpayment[revDate]" value="<?php echo Yii::app()->params['FormOrderofpayment']['revDate'];?>" style="width:70%;"/>
        	</div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="row">
            <label style="width:180px; line-height:35px;">Print Format:</label>
            <?php echo CHtml::dropDownList("FormOrderofpayment[printFormat]", Yii::app()->params['FormOrderofpayment']['printFormat'], array('1'=>'Excel', '2'=>'PDF'));?>
            <!-- input type="select" name="FormRequest[printFormat]" value="<?php echo Yii::app()->params['FormRequest']['printFormat'];?>" style="width:70%;"/-->
        	</div>
        </td>
    </tr>   
     <tr>
        <td>
            <div class="row">            
            <label style="width:180px; line-height:35px;">Header Logo (Left):</label>
            <div class="op-logoLeft">
            <?php 
			if(Yii::app()->params['FormOrderofpayment']['logoLeft']){
				echo CHtml::image(Yii::app()->request->baseUrl .'/images/'.
				Yii::app()->params['FormOrderofpayment']['logoLeft'],'agency-logo', array('class'=>'image-thumb fltl'));
				echo CHtml::link(' x','javascript:void(0)', 
					array('class'=>'remove-link', 'title'=>'Remove image',
						'rel'=>Yii::app()->params['FormOrderofpayment']['logoLeft'],
						'name'=>'FormOrderofpayment[logoLeft]'
					));
			}else{ echo $noImage;
			?>
            <input type="file" name="FormOrderofpayment[logoLeft]" accept="image/*" style="margin-left:10px"/>            
			<?php }?>
            </div>
        	</div>
        </td>
    </tr>
     <tr>
        <td>
            <div class="row">            
            <label style="width:180px; line-height:35px;">Header Logo (Right):</label>
            <div class="op-logoRight">
            <?php 
			if(Yii::app()->params['FormOrderofpayment']['logoRight']){
				echo CHtml::image(Yii::app()->request->baseUrl .'/images/'.
				Yii::app()->params['FormOrderofpayment']['logoRight'],'agency-logo', array('class'=>'image-thumb fltl'));
				echo CHtml::link(' x','javascript:void(0)', 
						array('class'=>'remove-link', 'title'=>'Remove image',
								'rel'=>Yii::app()->params['FormOrderofpayment']['logoRight'],
								'name'=>'FormOrderofpayment[logoRight]'
						));
			}else{ echo $noImage;
			?>
            <input type="file" name="FormOrderofpayment[logoRight]" accept="image/*" style="margin-left:10px"/>
            <?php }?>
            </div>
        	</div>
        </td>
    </tr>                  
                      
    </table>
    <?php echo CHtml::submitButton('Save',array('class'=>'btn btn-success')); ?>
</form>
</div>
<script type="text/javascript">

$('.remove-link').live('click', function() {
    $.ajax({
        type: 'POST',
        data: $('#form-settings').serialize() + "&"+ $(this).attr("name") + "=" + "&imagefile="+$(this).attr("rel") + "&divclass="+ $(this).closest("div").attr('class') + "&inputname="+ $(this).attr("name"),
        url: '<?php echo Yii::app()->createUrl('config/removeImage');?>',
        success: function(data) {
			var className=data.divclass;
			var inputName=data.inputname;
			$("."+className).html('<span class="no-image">NO LOGO</span><input type="file" style="margin-left:10px" value="" name="'+inputName+'"></input>');
        },
		dataType:"json"
    })
})	
</script>
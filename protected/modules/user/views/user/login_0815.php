<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
/*
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);*/
?>
<div class="page-header">
	<h1>Login <small>to your account</small></h1>
</div>
<div class="row-fluid">
	
    <div class="span5" style="margin-left:25%;">
<?php
	$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>"Please fill out the following form with your login credentials",
	));
	
?>



    <!--p>Please fill out the following form with your login credentials:</p-->
    
    <div class="form wide">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>
    
        <!--p class="note">Fields with <span class="required">*</span> are required.</p-->
    	<br />
        <div class="row">        	
            <?php //echo $form->labelEx($model,'username'); ?>
            <label></label>
            <div class="input-prepend" title="Username" data-rel="tooltip">
            <span class="add-on"><i class="icon-user"></i> </span>
            <?php echo $form->textField($model,'username'); ?>
            </div>
            <?php echo $form->error($model,'username'); ?>
        </div>
    
        <div class="row">
            <?php //echo $form->labelEx($model,'password'); ?>
            <label></label>
            <div class="input-prepend" title="Username" data-rel="tooltip">
            <span class="add-on"><i class="icon-lock"></i> </span>
            <?php echo $form->passwordField($model,'password'); ?>
            </div>
            <?php echo $form->error($model,'password'); ?>
        </div>
    
        <div class="row rememberMe">
            <?php echo $form->checkBox($model,'rememberMe'); ?>
            <?php echo $form->label($model,'rememberMe'); ?>
            <?php echo $form->error($model,'rememberMe'); ?>
        </div>
    
        <div class="row buttons">
            <?php echo CHtml::submitButton('Login',array('class'=>'btn btn btn-info', 'style'=>'width:250px')); ?>
        </div>
    
    <?php $this->endWidget(); ?>
    </div><!-- form -->

<?php $this->endWidget();?>

    </div>

</div>
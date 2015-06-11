<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
  <div class="row-fluid">
	<div class="span3">
		<div class="sidebar-nav">
    
		  <?php $this->widget('zii.widgets.CMenu', array(
			/*'type'=>'list',*/
			'encodeLabel'=>false,
			'items'=>array(
				array('label'=>'<i class="icon icon-home"></i> Dashboard', 'url'=>array('/ref/default/index')	),
				array('label'=>'<i class="icon icon-globe" id="test"></i> Referrals', 'url'=>array('/ref/referral/admin'),	
					/*'submenuOptions'=>array('class'=>'nav-sub'),'items'=>array(
		            array('label'=>'Referral In', 'url'=>array('site/anot','id'=>'12')),
		            array('label'=>'Referral Out', 'url'=>array('site/anot','id'=>'13')),	
					)*/
				),
				array('label'=>'<i class="icon icon-file"></i> Order of Payment', 'url'=>array('/ref/orderofpayment/admin')	),
				array('label'=>'<i class="icon icon-filter"></i> Tests / Calibration', 'url'=>array('/ref/labservice/admin')	),
				array('label'=>'<i class="icon icon-user"></i> Customers', 'url'=>array('/ref/customer/admin')	),
				// Include the operations menu
				//array('label'=>'OPERATIONS','items'=>$this->menu),
			),
			));?>
		</div>
        <hr>
		<div id="sidebar">
		<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'<span class="icon icon-sitemap_color">Operations</span>',
			));
			
				$this->widget('zii.widgets.CMenu', array(
					'items'=>$this->menu,
					'htmlOptions'=>array('class'=>'operations'),
				));
				
			$this->endWidget();
		?>
		
		<?php /** Notifications **/
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'<span class="icon icon-sitemap_color">Notifications</span>',
			));

				$this->renderPartial('/layouts/_notify');
			
			$this->endWidget();
		?>
		
        <?php $defaultImgLab=CHtml::image(Yii::app()->request->baseUrl.'/images/iso17025-accredited.png','lab-sidebar-image');echo Yii::app()->params['Lab']['sidebarImage']?CHtml::image(Yii::app()->request->baseUrl .'/images/'.Yii::app()->params['Lab']['sidebarImage'],'lab-sidebar-image',array('class'=>'sidebar-image')):$defaultImgLab;?>
        </div>
		
    </div><!--/span-->
    
    <div class="span9">
    
    <!-- Include content pages -->
    <?php echo $content; ?>

	</div><!--/span-->
  </div><!--/row-->
<?php $this->endContent(); ?>


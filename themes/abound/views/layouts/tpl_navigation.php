<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
    <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
     
          <!-- Be sure to leave the brand out there if you want it shown -->
          <!--a class="brand" href="#"><?php echo CHtml::encode(Yii::app()->name);?></a-->
          <a class="brand" href="#"><?php echo CHtml::image(Yii::app()->request->baseUrl."/images/logo.png");?> <?php echo CHtml::encode(Yii::app()->name);?></a>
          <?php 
          		$menu = array();
          
				if(Yii::app()->user->isSuperuser){
					$menu = array(
	                        array('label'=>'Admin', 'url'=>array('/config/admin')),
	                        array('label'=>'Rights', 'url'=>array('/rights')),
	                        array('label'=>'Gii', 'url'=>array('/gii/default/login')),
	                        );
				}else{
					
					if(isset(Yii::app()->user->access)){
						$accesslist = explode(',', Yii::app()->user->access);
						for($i=0; $i<count($accesslist); $i++)
						{
							$access = Accesslist::model()->findByPk($accesslist[$i]);
							array_push($menu, array('label'=>$access->label, 'url'=>array($access->url)));
						}
		          	}
				}
				
				$url = Yii::app()->controller->id;
				if($url == 'site')
					$ctrl = 'lab/';
				else
					$ctrl = '';
				
				array_push($menu, array(
					'label'=>'System <span class="caret"></span>', 
					'url'=>'#',
					'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),
					'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
					'items'=>array(
						array('label'=>'Laboratories', 'url'=>array($ctrl.'lab/admin'), 'visible'=>(!Yii::app()->user->isGuest && (Yii::app()->getModule('lab')->isLabAdmin() == 1)) ? true : false),
						//array('label'=>'Signatories', 'url'=>array('default/index'), 'visible'=>(!Yii::app()->user->isGuest && (Yii::app()->getModule('lab')->isLabAdmin() == 1)) ? true : false),
						array('label'=>'Test Categories', 'url'=>array($ctrl.'testcategory/admin'), 'visible'=>(!Yii::app()->user->isGuest && (Yii::app()->getModule('lab')->isLabAdmin() == 1)) ? true : false),
						array('label'=>'Sample Types', 'url'=>array($ctrl.'sampletype/admin'), 'visible'=>(!Yii::app()->user->isGuest && (Yii::app()->getModule('lab')->isLabAdmin() == 1)) ? true : false),
						
						array('label'=>'Set New OR Series', 'url'=>array('default/index'), 'visible'=>(!Yii::app()->user->isGuest && (Yii::app()->getModule('cashier')->isCashierAdmin() == 1)) ? true : false),
						array('label' => '<hr>', 'visible'=>(!Yii::app()->user->isGuest && (Yii::app()->getModule('lab')->isLabAdmin() == 1)) ? true : false, array('itemOptions'=>array('class'=>'divider'))),
						array('url'=>Yii::app()->getModule('user')->profileUrl, 'label'=>'My Account', 'visible'=>!Yii::app()->user->isGuest),
						array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
						array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
						)
				));
				//array_push($menu, array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest));
				//array_push($menu, array('label'=>'Logout ('.Yii::app()->getModule('user')->user()->getFullName().')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest));				
          ?>
          
          <div class="nav-collapse">
          
			<?php $this->widget('zii.widgets.CMenu',array(
                    'htmlOptions'=>array('class'=>'pull-right nav'),
                    'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
					'itemCssClass'=>'item-test',
                    'encodeLabel'=>false,
                    'items'=>$menu,
                )); ?>
    		
				<?php /*$this->widget('zii.widgets.CMenu',array(
	                    'htmlOptions'=>array('class'=>'pull-right nav'),
	                    'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
						'itemCssClass'=>'item-test',
	                    'encodeLabel'=>false,
	                    'items'=>array(
	                        array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
	                        array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
	                    ),
	                ));*/ ?>
	    </div>
    </div>
	</div>
</div>
<div class="subnav navbar navbar-fixed-top">
    <div class="navbar-inner">
    	<div class="container">
        <div class="style-switcher pull-left">
       	 <?php //echo Yii::app()->Controller->module->name;?>
         <b><?php echo (Yii::app()->Controller->module->name == 'rights') ? 'Rights Management Module' : Yii::app()->Controller->appTitle(Yii::app()->Controller->module->name);?></b>
        </div>
        	
        	<!--div class="style-switcher pull-left">
                <a href="javascript:chooseStyle('none', 60)" checked="checked"><span class="style" style="background-color:#0088CC;"></span></a>
                <a href="javascript:chooseStyle('style2', 60)"><span class="style" style="background-color:#7c5706;"></span></a>
                <a href="javascript:chooseStyle('style3', 60)"><span class="style" style="background-color:#468847;"></span></a>
                <a href="javascript:chooseStyle('style4', 60)"><span class="style" style="background-color:#4e4e4e;"></span></a>
                <a href="javascript:chooseStyle('style5', 60)"><span class="style" style="background-color:#d85515;"></span></a>
                <a href="javascript:chooseStyle('style6', 60)"><span class="style" style="background-color:#a00a69;"></span></a>
                <a href="javascript:chooseStyle('style7', 60)"><span class="style" style="background-color:#a30c22;"></span></a>
          	</div-->
           <form class="navbar-search pull-right" action="">
           	 
           <input type="text" class="search-query span2" placeholder="Search">
           
           </form>
    	</div><!-- container -->
    </div><!-- navbar-inner -->
</div><!-- subnav -->


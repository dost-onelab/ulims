<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
    <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
     
          <!-- Be sure to leave the brand out there if you want it shown -->
          <a class="brand" href="#">Department of Science and Technology IX Portal</a>
          
          <?php 
			$roles = Rights::getAssignedRoles(Yii::app()->user->Id);
			foreach($roles as $role){
				//echo $role->name;
			}
          ?>
          
          <?php 
			//if($role->name == 'Administrator' || $role->name == 'Admin'){
				$menu = array(
	                        //array('label'=>'Users', 'url'=>array('/user/admin')),
	                        //array('label'=>'Dashboard', 'url'=>array('/site/barangay')),
	                        array('label'=>'PMIS', 'url'=>array('/pmis/project/admin')),
							//array('label'=>'Projects', 'url'=>array('/project/admin')),
							array('label'=>'Gii', 'url'=>array('/gii/default/login')),
							//array('label'=>'Users', 'url'=>array('/user/admin')),
	                        //array('label'=>'Manage Assets <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
	                        //'items'=>array(
								//array('label'=>'Incident <span class="badge badge-info pull-right">'.Incident::model()->count().'</span>', 'url'=>array('incident/admin')),
								//array('label'=>'Assistance Type <span class="badge badge-info pull-right">'.Assistancetype::model()->count().'</span>', 'url'=>array('assistancetype/admin')),
								//array('label'=>'Disability <span class="badge badge-info pull-right">'.Disability::model()->count().'</span>', 'url'=>array('disability/admin')),
								//array('label'=>'Education <span class="badge badge-info pull-right">'.Education::model()->count().'</span>', 'url'=>array('education/admin')),
								//array('label'=>'Evacuation Centers <span class="badge badge-info pull-right">'.Evacuation::model()->count().'</span>', 'url'=>array('evacuation/admin')),
								//array('label'=>'Ethnicity <span class="badge badge-info pull-right">'.Ethnicity::model()->count().'</span>', 'url'=>array('ethnicity/admin')),
								//array('label'=>'Household Status <span class="badge badge-info pull-right">'.Householdstatus::model()->count().'</span>', 'url'=>array('householdstatus/admin')),
								//array('label'=>'Occupational Skills <span class="badge badge-info pull-right">'.Occupationalskill::model()->count().'</span>', 'url'=>array('occupationalskill/admin')),
								//array('label'=>'Member Status <span class="badge badge-info pull-right">'.Memberstatus::model()->count().'</span>', 'url'=>array('memberstatus/admin')),
								//array('label'=>'Relation to Head <span class="badge badge-info pull-right">'.Relationtohead::model()->count().'</span>', 'url'=>array('relationtohead/admin')),
								//array('label'=>'Socialworker <span class="badge badge-info pull-right">'.Socialworker::model()->count().'</span>', 'url'=>array('socialworker/admin')),
								//array('label'=>'Source of Income <span class="badge badge-info pull-right">'.Sourceofincome::model()->count().'</span>', 'url'=>array('sourceofincome/admin')),
	                        //)),
	                        array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
	                        array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
	                        );
	        /*
			//}elseif($role->name == 'Data Encoder' || $role->name == 'Supervisor'){
				$menu = array(
	                        array('label'=>'Dashboard', 'url'=>array('/site/barangay')),
							//array('label'=>'Households', 'url'=>array('/household/admin')),
							//array('label'=>'Evacuees', 'url'=>array('/evacuee/admin')),
	                        array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
	                        array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
	                        );
			//}elseif(Yii::app()->user->isGuest){
				$menu = array(
	                        array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
	                        array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
	                        );
			}*/
          ?>
          
          <div class="nav-collapse">
          <?php //if($role->name == 'Administrator' || $role->name == 'Admin'){?>
          
			<?php $this->widget('zii.widgets.CMenu',array(
                    'htmlOptions'=>array('class'=>'pull-right nav'),
                    'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
					'itemCssClass'=>'item-test',
                    'encodeLabel'=>false,
                    'items'=>$menu,
					/*
					array(
                        //array('label'=>'Users', 'url'=>array('/user/admin')),
                        array('label'=>'Dashboard', 'url'=>array('/site/status/1')),
						array('label'=>'Households', 'url'=>array('/household/admin')),
						array('label'=>'Evacuees', 'url'=>array('/evacuee/admin')),
                        array('label'=>'Manage Assets <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                        'items'=>array(
							array('label'=>'Incident <span class="badge badge-info pull-right">'.Incident::model()->count().'</span>', 'url'=>array('incident/admin')),
							array('label'=>'Assistance Type <span class="badge badge-info pull-right">'.Assistancetype::model()->count().'</span>', 'url'=>array('assistancetype/admin')),
							array('label'=>'Disability <span class="badge badge-info pull-right">'.Disability::model()->count().'</span>', 'url'=>array('disability/admin')),
							array('label'=>'Education <span class="badge badge-info pull-right">'.Education::model()->count().'</span>', 'url'=>array('education/admin')),
							array('label'=>'Evacuation Centers <span class="badge badge-info pull-right">'.Evacuation::model()->count().'</span>', 'url'=>array('evacuation/admin')),
							array('label'=>'Ethnicity <span class="badge badge-info pull-right">'.Ethnicity::model()->count().'</span>', 'url'=>array('ethnicity/admin')),
							array('label'=>'Household Status <span class="badge badge-info pull-right">'.Householdstatus::model()->count().'</span>', 'url'=>array('householdstatus/admin')),
							array('label'=>'Occupational Skills <span class="badge badge-info pull-right">'.Occupationalskill::model()->count().'</span>', 'url'=>array('occupationalskill/admin')),
							array('label'=>'Relation to Head <span class="badge badge-info pull-right">'.Relationtohead::model()->count().'</span>', 'url'=>array('relationtohead/admin')),
							array('label'=>'Socialworker <span class="badge badge-info pull-right">'.Socialworker::model()->count().'</span>', 'url'=>array('socialworker/admin')),
							array('label'=>'Source of Income <span class="badge badge-info pull-right">'.Sourceofincome::model()->count().'</span>', 'url'=>array('sourceofincome/admin')),
                        )),
                        //array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                        //array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                    ),*/
                )); ?>
    		
    		<?php //}elseif($role->name == 'Data Encoder'){?>
          
          <?php //if($role->name == 'Data Encoder'){?>
         
			<?php /*$this->widget('zii.widgets.CMenu',array(
                    'htmlOptions'=>array('class'=>'pull-right nav'),
                    'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
					'itemCssClass'=>'item-test',
                    'encodeLabel'=>false,
                    'items'=>array(
                        //array('label'=>'Users', 'url'=>array('/user/admin')),
                        array('label'=>'Dashboard', 'url'=>array('/site/status/1')),
						array('label'=>'Households', 'url'=>array('/household/admin')),
						array('label'=>'Evacuees', 'url'=>array('/evacuee/admin')),
                    ),*/
                //)); ?>
    
    		<?php //}?>
    		
	
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
                <a href="javascript:chooseStyle('none', 60)" checked="checked"><span class="style" style="background-color:#0088CC;"></span></a>
                <a href="javascript:chooseStyle('style2', 60)" ><span class="style" style="background-color:#7c5706;"></span></a>
                <a href="javascript:chooseStyle('style3', 60)"><span class="style" style="background-color:#468847;"></span></a>
                <a href="javascript:chooseStyle('style4', 60)"><span class="style" style="background-color:#4e4e4e;"></span></a>
                <a href="javascript:chooseStyle('style5', 60)"><span class="style" style="background-color:#d85515;"></span></a>
                <a href="javascript:chooseStyle('style6', 60)"><span class="style" style="background-color:#a00a69;"></span></a>
                <a href="javascript:chooseStyle('style7', 60)"><span class="style" style="background-color:#a30c22;"></span></a>
          	</div>
           <form class="navbar-search pull-right" action="">
           	 
           <input type="text" class="search-query span2" placeholder="Search">
           
           </form>
    	</div><!-- container -->
    </div><!-- navbar-inner -->
</div><!-- subnav -->

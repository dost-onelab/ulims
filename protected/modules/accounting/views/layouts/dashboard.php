<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

  <div class="row-fluid">
	<div class="span3">
		<div class="sidebar-nav">
        
		  <?php 
		  if(Yii::app()->user->isGuest){
			  $items = array(
			  		array('label'=>'Barangay', 'url'=>array('/site/barangay'),'itemOptions'=>array('class'=>'')),
			  		array('label'=>'Evacuation Center', 'url'=>array('/site/evacuation'),'itemOptions'=>array('class'=>'')),
			  		array('label'=>'Age Bracket', 'url'=>array('/site/agebracket'),'itemOptions'=>array('class'=>'')),
			  		//array('label'=>'Evacuee Finder', 'url'=>array('/site/evacueefinder'),'itemOptions'=>array('class'=>'')),
			  		//array('label'=>'Age Bracket', 'url'=>array('/site/age'),'itemOptions'=>array('class'=>'')),
			  		array('label'=>'Gender', 'url'=>array('/site/gender'),'itemOptions'=>array('class'=>'')),
			  		//array('label'=>'Educational Attainment', 'url'=>array('/site/education'),'itemOptions'=>array('class'=>'')),
			  		//array('label'=>'Vulnerable Group', 'url'=>array('/site/vulnerable'),'itemOptions'=>array('class'=>'')),
			  		//array('label'=>'', 'url'=>array(''),'itemOptions'=>array('class'=>'')),
			  		array('label'=>'Household Status', 'url'=>array('/site/status'),'itemOptions'=>array('class'=>'')),
			  		//array('label'=>'Assistance Received', 'url'=>array('/site/vulnerable'),'itemOptions'=>array('class'=>'')),
			  		//array('label'=>'Occupation of Household Heads', 'url'=>array('/site/vulnerable'),'itemOptions'=>array('class'=>'')),
			  		//array('label'=>'Fire Victims', 'url'=>array('/site/firevictim'),'itemOptions'=>array('class'=>'')),
			  		//array('label'=>'Evacuees Held Hostage', 'url'=>array('/site/vulnerable'),'itemOptions'=>array('class'=>'')),
			  		
			  		 /*
							array('label'=>'Status of Evacuees', 'url'=>array('/evacuee/admin')),
							array('label'=>'Assistance Received', 'url'=>array('/evacuee/admin')),
							array('label'=>'Occupation of Household Heads', 'url'=>array('/evacuee/admin')),
							array('label'=>'Age Bracket', 'url'=>array('/evacuee/admin')),
							array('label'=>'Fire Victims', 'url'=>array('/evacuee/admin')),
							array('label'=>'Hostages', 'url'=>array('/evacuee/admin')),
							*/
					// Include the operations menu
					array('label'=>'OPERATIONS','items'=>$this->menu),
				);
		  }else{
			$items = array(
		  		array('label'=>'Barangay', 'url'=>array('/site/barangay'),'itemOptions'=>array('class'=>'')),
		  		array('label'=>'Evacuation Center', 'url'=>array('/site/evacuation'),'itemOptions'=>array('class'=>'')),
		  		array('label'=>'Age Bracket', 'url'=>array('/site/agebracket'),'itemOptions'=>array('class'=>'')),
		  		array('label'=>'Evacuee Finder', 'url'=>array('/site/evacueefinder'),'itemOptions'=>array('class'=>'')),
		  		//array('label'=>'Age Bracket', 'url'=>array('/site/age'),'itemOptions'=>array('class'=>'')),
		  		array('label'=>'Gender', 'url'=>array('/site/gender'),'itemOptions'=>array('class'=>'')),
		  		//array('label'=>'Educational Attainment', 'url'=>array('/site/education'),'itemOptions'=>array('class'=>'')),
		  		//array('label'=>'Vulnerable Group', 'url'=>array('/site/vulnerable'),'itemOptions'=>array('class'=>'')),
		  		//array('label'=>'', 'url'=>array(''),'itemOptions'=>array('class'=>'')),
		  		array('label'=>'Household Status', 'url'=>array('/site/status'),'itemOptions'=>array('class'=>'')),
		  		//array('label'=>'Assistance Received', 'url'=>array('/site/vulnerable'),'itemOptions'=>array('class'=>'')),
		  		//array('label'=>'Occupation of Household Heads', 'url'=>array('/site/vulnerable'),'itemOptions'=>array('class'=>'')),
		  		
		  		array('label'=>'Fire Victims', 'url'=>array('/site/firevictim'),'itemOptions'=>array('class'=>'')),
		  		//array('label'=>'Evacuees Held Hostage', 'url'=>array('/site/vulnerable'),'itemOptions'=>array('class'=>'')),
		  		
		  		 /*
						array('label'=>'Status of Evacuees', 'url'=>array('/evacuee/admin')),
						array('label'=>'Assistance Received', 'url'=>array('/evacuee/admin')),
						array('label'=>'Occupation of Household Heads', 'url'=>array('/evacuee/admin')),
						array('label'=>'Age Bracket', 'url'=>array('/evacuee/admin')),
						array('label'=>'Fire Victims', 'url'=>array('/evacuee/admin')),
						array('label'=>'Hostages', 'url'=>array('/evacuee/admin')),
						*/
				// Include the operations menu
				array('label'=>'OPERATIONS','items'=>$this->menu),
			);
		  }
		  $this->widget('zii.widgets.CMenu', array(
			/*'type'=>'list',*/
			'encodeLabel'=>false,
			'items'=>$items,
			));
				
			?>
		</div>
        <br>
        <!-- table class="table table-striped table-bordered">
          <tbody>
            <tr>
              <td width="50%">Bandwith Usage</td>
              <td>
              	<div class="progress progress-danger">
                  <div class="bar" style="width: 80%"></div>
                </div>
              </td>
            </tr>
            <tr>
              <td>Disk Spage</td>
              <td>
             	<div class="progress progress-warning">
                  <div class="bar" style="width: 60%"></div>
                </div>
              </td>
            </tr>
            <tr>
              <td>Conversion Rate</td>
              <td>
             	<div class="progress progress-success">
                  <div class="bar" style="width: 40%"></div>
                </div>
              </td>
            </tr>
            <tr>
              <td>Closed Sales</td>
              <td>
              	<div class="progress progress-info">
                  <div class="bar" style="width: 20%"></div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
		<div class="well">
        
            <dl class="dl-horizontal">
              <dt>Account status</dt>
              <dd>$1,234,002</dd>
              <dt>Open Invoices</dt>
              <dd>$245,000</dd>
              <dt>Overdue Invoices</dt>
              <dd>$20,023</dd>
              <dt>Converted Quotes</dt>
              <dd>$560,000</dd>
              
            </dl>
      </div-->
		
    </div><!--/span-->
    <div class="span9">
    
    <?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
			'homeLink'=>CHtml::link('Dashboard'),
			'htmlOptions'=>array('class'=>'breadcrumb')
        )); ?><!-- breadcrumbs -->
    <?php endif?>
    
    <!-- Include content pages -->
    <?php echo $content; ?>

	</div><!--/span-->
  </div><!--/row-->


<?php $this->endContent(); ?>
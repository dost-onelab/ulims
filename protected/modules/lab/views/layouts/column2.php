<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

  <div class="row-fluid">
	<div class="span3">
		<div class="sidebar-nav">
        
		  <?php $this->widget('zii.widgets.CMenu', array(
			/*'type'=>'list',*/
			'encodeLabel'=>false,
			'items'=>array(
				//array('label'=>'<i class="icon icon-home"></i>  Dashboard', 'url'=>array('/lab'),'itemOptions'=>array('class'=>'')),
				array('label'=>'<i class="icon icon-home"></i> Dashboard', 'url'=>array('/lab/default/index')	),
				array('label'=>'<i class="icon icon-globe"></i> Requests', 'url'=>array('/lab/request/admin')	),
				//array('label'=>'<i class="icon icon-globe"></i> Order of Payment', 'url'=>array('/lab/request/createOP')	),
				array('label'=>'<i class="icon icon-file"></i> Order of Payment', 'url'=>array('/lab/orderofpayment/admin')	),
				array('label'=>'<i class="icon icon-briefcase"></i> Packages', 'url'=>array('/lab/package/admin')	),
				array('label'=>'<i class="icon icon-filter"></i> Tests / Calibration', 'url'=>array('/lab/test/admin')	),
				//array('label'=>'<i class="icon icon-tasks"></i> Tests for Update', 'url'=>array('/lab/testforupdate/admin')	),
				array('label'=>'<i class="icon icon-user"></i> Customers', 'url'=>array('/lab/customer/admin')	),
				array('label'=>'<i class="icon icon-book"></i> Sample Templates', 'url'=>array('/lab/samplename/admin')	),
				//array('label'=>'<i class="icon icon-th-list"></i> Accomplishments', 'url'=>array('/lab/accomplishments')	),
				//array('label'=>'<i class="icon icon-th-large"></i> Statistics', 'url'=>array('/lab/statistic/customer')),
				array('label'=>'<i class="icon icon-list-alt"></i> Reports', 'url'=>array('/lab/report/index')),
				// Include the operations menu
				//array('label'=>'OPERATIONS','items'=>$this->menu),
			),
			));?>
		</div>
        <hr>
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
        <!--/div-->
        <?php $defaultImgLab=CHtml::image(Yii::app()->request->baseUrl.'/images/iso17025-accredited.png','lab-sidebar-image');echo Yii::app()->params['Lab']['sidebarImage']?CHtml::image(Yii::app()->request->baseUrl .'/images/'.Yii::app()->params['Lab']['sidebarImage'],'lab-sidebar-image',array('class'=>'sidebar-image')):$defaultImgLab;?>
        </div>
		
    </div><!--/span-->
    
    <div class="span9">
    
    <?php /*if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
			'homeLink'=>CHtml::link('Dashboard'),
			'htmlOptions'=>array('class'=>'breadcrumb')
        )); ?><!-- breadcrumbs -->
    <?php endif*/?>
    
    <!-- Include content pages -->
    <?php echo $content; ?>

	</div><!--/span-->
  </div><!--/row-->


<?php $this->endContent(); ?>

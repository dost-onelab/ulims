<?php /* @var $this Controller */ ?>
<?php $orderOfPayment=new Orderofpayment;?>
<?php $this->beginContent('//layouts/main'); ?>

  <div class="row-fluid">
	<div class="span3">
		<div class="sidebar-nav">
        
		  <?php $this->widget('zii.widgets.CMenu', array(
			/*'type'=>'list',*/
			'encodeLabel'=>false,
			'items'=>array(
				array('label'=>'<i class="icon icon-home"></i> Receipt', 'url'=>array('/cashier/receipt/admin')	),
				array('label'=>'<i class="icon icon-file"></i> Order of Payment <span class="badge badge-important pull-right">'.$orderOfPayment->countForReceipt().'</span>', 'url'=>array('/cashier/orderofpayment/admin')	),
				array('label'=>'<i class="icon icon-tasks"></i> Deposit', 'url'=>array('/cashier/deposit/admin')	),
				//array('label'=>'<i class="icon icon-th-list"></i> Reports', 'url'=>array('/cashier/receipt/reports')	),
				// Include the operations menu
				//array('label'=>'OPERATIONS','items'=>$this->menu),
			),
			));?>
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
        <?php //echo CHtml::image(Yii::app()->baseUrl.'/images/iso9001-2008certified.png','iso9001:2008');?>
        <?php $defaultImgCashier=CHtml::image(Yii::app()->request->baseUrl.'/images/iso9001-2008certified.png','cashier-sidebar-image');echo Yii::app()->params['Cashier']['sidebarImage']?CHtml::image(Yii::app()->request->baseUrl .'/images/'.Yii::app()->params['Cashier']['sidebarImage'],'cashier-sidebar-image',array('class'=>'sidebar-image')):$defaultImgCashier;?>
        </div>
		
    </div><!--/span-->
    <div class="span9">
    
    <?php /*if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
			'homeLink'=>CHtml::link('Dashboard'),
			'htmlOptions'=>array('class'=>'breadcrumb')
        )); */?><!-- breadcrumbs -->
    <?php //endif?>
    
    <!-- Include content pages -->
    <?php echo $content; ?>

	</div><!--/span-->
  </div><!--/row-->


<?php $this->endContent(); ?>

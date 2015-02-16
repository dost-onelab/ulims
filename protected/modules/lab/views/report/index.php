<h1>Reports</h1>

<?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl . '/images/icons_report/accomplishment-report-lms.png', 'Accomplishment Report', array('class'=>'image-icon-large')),
			$this->createUrl('/lab/accomplishments')
)?>
<?php echo CHtml::link(
			CHtml::image(Yii::app()->baseUrl . '/images/icons_report/customers-statistics.png', 'Customers Statistics', array('class'=>'image-icon-large')),
			$this->createUrl('/lab/statistic/customer')
			)?>
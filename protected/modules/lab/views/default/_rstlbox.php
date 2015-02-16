	<!--div class="box span4 box-programs" style="height:510px;"-->
	<div class="box span12 box-rstl h580">          

		<div>
			<h4>
				<i class="icon-th"></i> <?php echo Yii::app()->params['Dashboard']['title']?Yii::app()->params['Dashboard']['title']:'Dashboard Title <small>(modify @ system config)</small>';?>
			</h4>
			<!--div class="box-icon">
				<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i>
				</a> <a href="#" class="btn btn-minimize btn-round"><i
					class="icon-chevron-up"></i> </a> <a href="#"
					class="btn btn-close btn-round"><i class="icon-remove"></i> </a>
			</div-->
		</div>
		<div id="rstl" class="box-content">            
            <p class="description"><?php echo Yii::app()->params['Dashboard']['description']?Yii::app()->params['Dashboard']['description']:'About the Laboratory or Dashboard description <small style="color:#999;">(modify @ system config)</small>';?></p>
            <div class="orbit-container" style="float:left;"><a class="orbit-prev" href="#" title="Previous"><span></span></a></div><div class="orbit-container" style="float:right;"><a class="orbit-next" href="#" title="Next"><span></span></a></div>
			<?php if ($rstlPerformanceIndicators){
					foreach($rstlPerformanceIndicators as $rstlPerformanceIndicator){
			?>	
                <ul class="dashboard-list h580">
                <!--div class="span11"-->
                    <!--div-->
                    <?php
					$indicatorId=$rstlPerformanceIndicator['id'];
					$series=$rstlPerformanceData[$indicatorId];
					$titleBarTotalProvince=$rstlPerformanceIndicator['name'];
					
					$this->widget('ext.highcharts.HighchartsWidget', array(
					   //'dataProvider'=>$columnBarProgramDataProvider,
					   //'summaryText'=>false,
						'scripts' => array('themes/dark-unica'),
						'options'=> array(
							'chart' => array(
								//'width'=>839,
								'height'=>385,
								'defaultSeriesType' => 'column',
								'style' => array(
									'fontFamily' => 'Verdana, Arial, Helvetica, sans-serif',
								),
							),
						  	'plotOptions'=> array(
								'column'=>array(
									//'stacking'=> 'normal',
									//'minPointLength'=>1,
									//'treshold'=> 1,
									'dataLabels'=> array(
										'enabled'=> true,
										'color'=> (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
									),
								),
								'series'=>array(
									'pointWidth'=>30,
								),								
							),							
							'credits' => array('enabled' => false),
							'title' => array(
								'text' => $titleBarTotalProvince,
								'style' => array(
									'fontSize' => '14px',
								),
							),
							'xAxis' => array(
								 //'categories' => 'name'
								'categories' => $yearListCategories,
								'labels'=>array(	
									'style' => array (
											'fontSize' => '11px',
										),
								),
							),
							'yAxis' => array(
								'title' => array(
									'text' => 'No. of '. $rstlPerformanceIndicator['name'],
									'style' => array(
										'fontSize' => '12px',
									),
								),
								'labels' => array(
									'style' => array(
										'fontSize' => '12px',
									),
								),
							 //'tickInterval'=>50,
							 //'endOnTick'=> false,
							 //'min'=> 0,
							'maxPadding'=> 0.0,
							'stackLabels'=> array(
								'enabled'=> true,
								'style'=> array(
									'fontWeight'=> 'bold',
									'color'=> 'gray'
									)
								),			 
							 
							),
							'legend' => array(
								'itemStyle' => array(
									'fontSize' => '11px',
									'text-align'=>'center',
								),
								'borderWidth' => 0,
								//'floating'=>true,
							),
							//'series' => $program->code=='SCHOLARSHIP'?$scholarshipCategoryBarColumns:$defaultSeries,		 
							'series' =>$series,
							
					   ),
					   //'htmlOptions'=>array('style'=>'height:280px;')
					));					
					?>
                    <!--/div-->
				</ul>
                <!--/div-->
			<?php }}?>
		</div>
	</div>
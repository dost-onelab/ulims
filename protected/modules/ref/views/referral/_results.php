        <?php echo /*CHtml::link('<span class="icon-plus-sign icon-white"> </span> Add action taken', 
                                '',//array('subAllotment/create','id'=>$model->id), 
                                array('onClick'=>'js:{$("#dialogAddResult").dialog("open"); return false;}',
                                        'class'=>'btn btn-success btn-small',
                                        'title'=>'Add new action to do'));*/
    	 Chtml::link('<span class="icon-white icon-plus-sign"></span> Add Result(s)', '', array( 
			'style'=>'cursor:pointer;',
			'class'=>'btn btn-success btn-small',
			'onClick'=>'js:{ $("#dialogAddResult").dialog("open"); return false;}',
			));
                                
                                ?>

<?php

$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		    'id'=>'dialogAddResult',
		    // additional javascript options for the dialog plugin
		    'options'=>array(
		        'title'=>'Add Result',
				'show'=>'scale',
				'hide'=>'scale',				
				'width'=>425,
				'modal'=>true,
				'resizable'=>false,
				'autoOpen'=>false,
			    ),
		));
		
		$modelResult = new Result;
		echo $this->renderPartial('/referral/_modal',
							array(
								'model'=>$modelResult, 
								'id'=>$model->id,
								)
						);

	$this->endWidget('zii.widgets.jui.CJuiDialog');	
?>
<?php 
		/*$linkResult = Chtml::link('<span class="icon-white icon-plus-sign"></span> Upload Result', '', array( 
			'style'=>'cursor:pointer;',
			//'onClick'=>$model->cancelled ? 'return false' : 'js:{addResult('.$_GET["id"].'); $("#dialogResult").dialog("open");}',
			'onClick'=>$model->cancelled ? 'return false' : 'js:{addResult('.$_GET["id"].'); $("#dialogResult").dialog("open");}',
			//'onClick'=>$model->cancelled ? 'return false' : 'js:{$("#dialogResult").dialog("open");}',
			//'class'=>'btn btn-info btn-small',
			//'disabled'=>$model->cancelled
			));

		echo '<h4 style="margin-bottom: -15px;">Reports<small>'. Referral::recipient($referral["acceptingAgencyId"]) ? $linkResult : ''.'</small></h4>';	
		echo '<hr style="margin-bottom: -5px;">';*/

		
    	$this->widget('zii.widgets.grid.CGridView', array(
		    	'id'=>'result-grid',
			    'summaryText'=>false,
				'emptyText'=>'No result(s) uploaded',
				
				//'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
				'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
				'rowHtmlOptionsExpression' => 'array("class"=>"link-hand")', 
		        //It is important to note, that if the Table/Model Primary Key is not "id" you have to
		        //define the CArrayDataProvider's "keyField" with the Primary Key label of that Table/Model.
		        'dataProvider' => $results,
		        'columns' => array(
		        	array(
							'name'=>'filename',
							'header'=>'Available Results',
						),
		    		array(
						'class'=>'bootstrap.widgets.TbButtonColumn',
						'template'=>'{download}',
		    			'buttons'=>array
								(
									'download' => array(
										'label'=>'Download',
										//'url'=>'http://localhost/onelab/api/web/v1/results/download?id=65',
										'url'=>'Yii::app()->createUrl(\'ref/result/download\', array(\'id\'=>$data["id"]))',
										//'visible'=>'Referral::owner('.$referral["receivingAgencyId"].')',
										),
								),
					),
		        ),
		    ));s
?>
<?php 
$this->widget('editable.EditableDetailView', array(
			    'data'       => $modelStatus,
			    //you can define any default params for child EditableFields 
			    
			    'params'     => array('YII_CSRF_TOKEN' => Yii::app()->request->csrfToken), //params for all fields
			    'emptytext'  => 'Not set', 
			    'attributes' => array(
					//'id',
					array(
						'name'=>'acceptingAgencyId',
						'label'		=> 'Referred To',
						//'value'		=> Referral::owner($referral["receivingAgencyId"]) ? '' : $referral["acceptingAgency"],
						'value'		=> $referral["acceptingAgency"],
						'rowHtmlOptions' => array('style' => 'width: 550px; text-align: center;'),
						'editable' => array(
			                'type'   	=> 'select',
							'source'	=> Referral::agencyLookUp('matchingAgencies', $acceptingAgencyLookup),
							'url'       => $this->createUrl('referralstatus/updateStatus'),
							'pk'		=> $modelStatus->id,
							'apply'		=> Referral::owner($referral["receivingAgencyId"]) ? true : false,
			            )
					),
			    	array(
						'name'=>'sampleArrivalDate',
						'editable' => array(
			                'type'			=> 'date',
			                'viewformat'	=> 'yyyy-mm-dd',
			    			'url'       => $this->createUrl('referralstatus/updateStatus'),
							'pk'		 => $modelStatus->id,
			    			'apply'		=> Referral::owner($referral["receivingAgencyId"]) ? true : false,
			            )
					),
					array(
						'name'=>'shipmentDetails',
						'editable' => array(
			                'type'       => 'text',
							'url'       => $this->createUrl('referralstatus/updateStatus'),
							'pk'		 => $modelStatus->id,
			                'inputclass' => 'input-large',
							'apply'		=> Referral::owner($referral["receivingAgencyId"]) ? true : false,
			            )
					),
					array(
						'name'=>'status_id',
						'editable' => array(
							'id'=>'select-status',
			                'type'   => 'select',
			                //'source' => Referral::itemAlias('StatusReceivingRelease'),
			                'source' => Referral::itemAlias('StatusAll'),
							'url'       => $this->createUrl('referralstatus/updateStatus'),
							'pk'		 => $modelStatus->id,
			            )
					),
			    )));
?>
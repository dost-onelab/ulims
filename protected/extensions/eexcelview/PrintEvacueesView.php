<?php

Yii::import('zii.widgets.grid.CGridView');
	/**
	* @author Nikola Kostadinov
	* @license GPL
	* @version 0.2
	*/	
	class PrintEvacueesView extends CGridView
	{
		// PHP Excel Path
		public static $phpExcelPathAlias = 'ext.phpexcel.Classes.PHPExcel';
	
		//the PHPExcel object
		public static $objPHPExcel = null;
		public static $activeSheet = null;
	
		//Document properties
		public $creator = 'RSTL';
		public $title = null;
		public $subject = 'Subject';
		public $description = '';
		public $category = '';
		
		//config
		public $autoWidth = false;
		public $exportType = 'Excel2007';
		public $disablePaging = true;
		public $filename = null; //export FileName ->original value = null
		public $stream = true; //stream to browser

		//data
		//For performance reason, it's good to have it static and populate it once in all the execution
		public static $data = null;
		
		//models
		public $displayBy;
		public $searchBy;
		//public $customer;
		//public $samples;
		//public $analyses;
		
		//mime types used for streaming
		public $mimeTypes = array(
			'Excel5' => array(
				'Content-type'=>'application/vnd.ms-excel',
				'extension'=>'xls',
			),
			'Excel2007'	=> array(
				'Content-type'=>'application/vnd.ms-excel',
				'extension'=>'xlsx',
			),
			'PDF' =>array(
				'Content-type' => 'application/pdf',
				'extension'=>'pdf',
			),
			'HTML' =>array(
				'Content-type'=>'text/html',
				'extension'=>'html',
			),
			'CSV' =>array(
				'Content-type'=>'application/csv',			
				'extension'=>'csv',
			)
		);
		
		public function init()
		{
			if(!isset($this->title))
				$this->title = Yii::app()->getController()->getPageTitle();

			parent::init();
			
			//Autoload fix
			spl_autoload_unregister(array('YiiBase','autoload'));             
			Yii::import(self::$phpExcelPathAlias, true);
			//edited
			//self::$objPHPExcel = PHPExcel_IOFactory::load('template.xlsx');
			self::$objPHPExcel = new PHPExcel();
			self::$activeSheet = self::$objPHPExcel->getActiveSheet();
			spl_autoload_register(array('YiiBase','autoload'));  
			
			// Creating a workbook
			$properties = self::$objPHPExcel->getProperties();
			$properties
			->setTitle($this->title)
			->setCreator($this->creator)
			->setSubject($this->subject)
			->setDescription($this->description)
			->setCategory($this->category);

			//$this->initColumns();
		}
		
		
		public function renderHeader()
		{
			/*
			$i=0;
			foreach($this->columns as $n=>$column)
			{
				++$i;
				if($column->name!==null && $column->header===null)
				{
					if($column->grid->dataProvider instanceof CActiveDataProvider)
						$head = $column->grid->dataProvider->model->getAttributeLabel($column->name);
					else
						$head = $column->name;
				} else
					$head =trim($column->header)!=='' ? $column->header : $column->grid->blankDisplay;

				self::$activeSheet->setCellValue($this->columnName($i)."1" ,$head);
			}*/			
		}
		public function renderFooter()//footer created by francis
		{
			/*
			$i=0;
			$data=$this->dataProvider->getData();
			$row=count($data);
			foreach($this->columns as $n=>$column)
			{
				$i=$i+1;
			  
					$footer =trim($column->footer)!=='' ? $column->footer : "";

				self::$activeSheet->setCellValue($this->columnName($i).($row+2),$footer);
			}*/		
		}
		
		// Main consuming function, apply every optimization you could think of
		public function renderBody()
		{
			if($this->disablePaging) //if needed disable paging to export all data
				$this->enablePagination = false;

			self::$data = $this->dataProvider->getData();
			$n=count(self::$data);

			if($n>0)
				for($row=0; $row < $n; ++$row)
					$this->renderRow($row);
		}
		

		public function renderRow($row)
		{
			/*
			$request = Request::model()->find(
			    'requestRefNum = :requestRefNum', array( ':requestRefNum' => $_SESSION['request']['code']
			));*/
			//$customer = Customer::model()->findByPk($request->customerId);
			/*
			self::$activeSheet->getDefaultStyle()->getFont()->setName('Arial');
			self::$activeSheet->getDefaultStyle()->getFont()->setSize(10); 
			
			
			//PAGE SETUP
			self::$activeSheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
			self::$activeSheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
			self::$activeSheet->getPageSetup()->setFitToPage(false);
			self::$activeSheet->getPageSetup()->setScale(90);
			self::$activeSheet->getPageSetup()->setHorizontalCentered(true);
			
			self::$activeSheet->getPageMargins()->setTop(0.5);
			self::$activeSheet->getPageMargins()->setRight(0.15);
			self::$activeSheet->getPageMargins()->setLeft(0.15);
			self::$activeSheet->getPageMargins()->setBottom(0.25);
			
			//SET COLUMN WIDTHs
			self::$activeSheet->getColumnDimension('A')->setWidth(15);
			self::$activeSheet->getColumnDimension('B')->setWidth(12);
			self::$activeSheet->getColumnDimension('C')->setWidth(10);
			self::$activeSheet->getColumnDimension('D')->setWidth(8);
			self::$activeSheet->getColumnDimension('E')->setWidth(7);
			self::$activeSheet->getColumnDimension('F')->setWidth(7);
			self::$activeSheet->getColumnDimension('G')->setWidth(9);
			self::$activeSheet->getColumnDimension('H')->setWidth(13);
			self::$activeSheet->getColumnDimension('I')->setWidth(10);
			self::$activeSheet->getColumnDimension('J')->setWidth(10);
			self::$activeSheet->getColumnDimension('K')->setWidth(10);
			
			//SET ROW HEIGHT
			//self::$activeSheet->getRowDimension('41')->setRowHeight(9);
			//self::$activeSheet->getRowDimension('43')->setRowHeight(9);
			self::$activeSheet->getRowDimension('56')->setRowHeight(9);
			self::$activeSheet->getRowDimension('60')->setRowHeight(11);
			self::$activeSheet->getRowDimension('63')->setRowHeight(7);
			
			
			//BORDERS
			$outline = array(
				'borders' => array(
					'outline' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => '00000000'),
					),
				),
			);
			
			$allborders = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => '00000000'),
					),
				),
			);
			
			$top = array(
				'borders' => array(
					'top' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => '00000000'),
					),
				),
			);
			
			$bottom = array(
				'borders' => array(
					'bottom' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => '00000000'),
					),
				),
			);
			
			$left = array(
				'borders' => array(
					'left' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => '00000000'),
					),
				),
			);
			
			$right = array(
				'borders' => array(
					'right' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => '00000000'),
					),
				),
			);
			self::$activeSheet->getStyle('A8:E8')->applyFromArray($outline);
			self::$activeSheet->getStyle('A9:E9')->applyFromArray($outline);
			self::$activeSheet->getStyle('A10:E10')->applyFromArray($outline);
			self::$activeSheet->getStyle('A12:H13')->applyFromArray($outline);
			self::$activeSheet->getStyle('I12:K12')->applyFromArray($outline);
			self::$activeSheet->getStyle('I13:K13')->applyFromArray($outline);
			self::$activeSheet->getStyle('A15:K36')->applyFromArray($allborders);
			self::$activeSheet->getStyle('A39:K48')->applyFromArray($outline);
			//self::$activeSheet->getStyle('A38:F40')->applyFromArray($outline);
			//self::$activeSheet->getStyle('G38:H40')->applyFromArray($outline);
			//self::$activeSheet->getStyle('I38:K40')->applyFromArray($outline);
			self::$activeSheet->getStyle('J50:K50')->applyFromArray($bottom);
			self::$activeSheet->getStyle('A52:F53')->applyFromArray($outline);
			self::$activeSheet->getStyle('G52:K53')->applyFromArray($outline);
			
			self::$activeSheet->getStyle('A55:K56')->applyFromArray($outline);
			
			self::$activeSheet->getStyle('A59:E63')->applyFromArray($outline);
			self::$activeSheet->getStyle('A58:K58')->applyFromArray($outline);
			self::$activeSheet->getStyle('F59:K63')->applyFromArray($outline);
			self::$activeSheet->getStyle('A64:K64')->applyFromArray($outline);
			
			self::$activeSheet->getStyle('B61:D61')->applyFromArray($bottom);
			self::$activeSheet->getStyle('B62:D62')->applyFromArray($bottom);
			self::$activeSheet->getStyle('H61:J61')->applyFromArray($bottom);
			self::$activeSheet->getStyle('H62:J62')->applyFromArray($bottom);
			
			self::$activeSheet->mergeCells('A1:K1');
			self::$activeSheet->mergeCells('A2:K2');
			self::$activeSheet->mergeCells('A3:K3');
			self::$activeSheet->mergeCells('A4:K4');
			self::$activeSheet->mergeCells('A5:K5');
			self::$activeSheet->mergeCells('A6:K6');
			self::$activeSheet->getStyle('A1:K6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			//self::$activeSheet->SetCellValue('A1', $this->request->requestRefNum);
			self::$activeSheet->SetCellValue('A1', 'Department of Science and Technology IX');
			
			self::$activeSheet->getStyle('A2')->getFont()->setBold(true); 
			self::$activeSheet->SetCellValue('A2', 'REGIONAL STANDARDS AND TESTING LABORATORIES');
			 
			self::$activeSheet->SetCellValue('A3', 'Pettit Barracks, Zamboanga City');
			self::$activeSheet->SetCellValue('A4', 'Tel. No. 991-1024 loc. 08');
			
			self::$activeSheet->getStyle('A6')->getFont()->setSize(14);
			self::$activeSheet->getStyle('A6')->getFont()->setBold(true); 
			self::$activeSheet->SetCellValue('A6', 'Request for DOST IX-RSTL Services');
			
			self::$activeSheet->SetCellValue('A8', 'Req. Ref. No.:');
			self::$activeSheet->SetCellValue('A9', 'Date:');
			self::$activeSheet->SetCellValue('A10', 'Time:');
			
			//Values
			self::$activeSheet->SetCellValue('B8', $this->request->requestRefNum);
			self::$activeSheet->SetCellValue('B9', $this->request->requestDate);
			self::$activeSheet->SetCellValue('B10', $this->request->requestTime);
			
			self::$activeSheet->SetCellValue('A12', 'CUSTOMER:');
			self::$activeSheet->SetCellValue('A13', 'ADDRESS:');
			
			self::$activeSheet->getStyle('B12')->getFont()->setBold(true);
			self::$activeSheet->SetCellValue('B12', $this->customer->customerName);
			self::$activeSheet->SetCellValue('B13', $this->customer->address);
			
			self::$activeSheet->SetCellValue('I12', 'TEL NO.:');
			self::$activeSheet->SetCellValue('I13', 'FAX NO.:');
			self::$activeSheet->SetCellValue('J12', $this->customer->tel);
			self::$activeSheet->SetCellValue('J13', $this->customer->fax);
			
			self::$activeSheet->getStyle('A14')->getFont()->setBold(true);
			self::$activeSheet->SetCellValue('A14', ' 1. TESTING OR CALIBRATION SERVICE');
			
			for($i=15; $i<=36; $i+=1){
				self::$activeSheet->mergeCells('A'.$i.':B'.$i);
				self::$activeSheet->mergeCells('D'.$i.':F'.$i);
				self::$activeSheet->mergeCells('G'.$i.':H'.$i);
			}
			self::$activeSheet->getStyle('A15:K15')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			self::$activeSheet->getStyle('A15:K15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			self::$activeSheet->getStyle('A15:K15')->getAlignment()->setWrapText(true);
			
			self::$activeSheet->SetCellValue('A15', 'SAMPLE');
			self::$activeSheet->SetCellValue('C15', 'SAMPLE CODE');
			self::$activeSheet->SetCellValue('D15', 'TEST/CALIBRATION REQUESTED');
			self::$activeSheet->SetCellValue('G15', 'TEST METHOD');
			self::$activeSheet->SetCellValue('I15', 'NO. OF SAMPLES/UNITS');
			self::$activeSheet->SetCellValue('J15', 'UNIT COST');
			self::$activeSheet->SetCellValue('K15', 'TOTAL');
			
			$row = 16;
			$descRow = 39;
			$sampleCount = 0;
			
			//foreach($_SESSION['sample'] as $samp){
			foreach($this->samples as $samp){
				
				//Samples
				self::$activeSheet->mergeCells('A'.$row.':B'.$row);
				self::$activeSheet->SetCellValue('A'.$row, $samp['sample']);
				self::$activeSheet->SetCellValue('C'.$row, $samp['code']);
				
				//Sample Descriptions
				self::$activeSheet->SetCellValue('A'.$descRow, $samp['code'].': '.$samp['description']);
				
					//Analyses
					$analyses = Analysis::model()->findAll('requestId=:requestId AND sampleCode=:sampleCode', 
					  array(':requestId'=>$req->requestId, ':sampleCode'=>$samp->sampleCode));
					//foreach($_SESSION['sample'][$sampleCount]['analysis'] as $analyses){
					
					foreach($samp['analysis'] as $analysis){
						
						//self::$activeSheet->mergeCells('D'.$row.':F'.$row);
						self::$activeSheet->SetCellValue('D'.$row, $analysis['testName']);
						
						//self::$activeSheet->mergeCells('G'.$row.':H'.$row);
						self::$activeSheet->SetCellValue('G'.$row, $analysis['method']);
						
						self::$activeSheet->getStyle('I'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						self::$activeSheet->SetCellValue('I'.$row, $analysis['quantity']);
						self::$activeSheet->getStyle('J'.$row)->getNumberFormat()->setFormatCode('#,##0.00');
						self::$activeSheet->SetCellValue('J'.$row, $analysis['fee']);
						
						self::$activeSheet->getStyle('K'.$row)->getNumberFormat()->setFormatCode('#,##0.00');
						self::$activeSheet->SetCellValue('K'.$row,
                                   '=I'.$row.'*J'.$row);
						
						$row = $row + 1;
					}
				$sampleCount = $sampleCount + 1;
				$descRow = $descRow + 1;
			}
			
			//self::$activeSheet->SetCellValue('I29', 'TOTAL');
			
			//self::$activeSheet->getStyle('K29')->getNumberFormat()->setFormatCode('#,##0.00');
			//self::$activeSheet->SetCellValue('K29', '=SUM(K16:K28)');
			
			self::$activeSheet->getStyle('A38')->getFont()->setBold(true);
			self::$activeSheet->SetCellValue('A38', ' 2. BRIEF SAMPLE DESCRIPTION OF SAMPLE/REMARKS');
			
			//self::$activeSheet->getStyle('A37')->getFont()->setBold(true);
			//self::$activeSheet->SetCellValue('A37', ' 3. OTHER SERVICES');
			//self::$activeSheet->getStyle('I39:G39')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			//self::$activeSheet->SetCellValue('G39', 'P');
			//self::$activeSheet->SetCellValue('I39', 'P');
			
			
			self::$activeSheet->SetCellValue('H50', 'TOTAL');
			self::$activeSheet->getStyle('I50')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			self::$activeSheet->SetCellValue('I50', 'P');
			self::$activeSheet->getStyle('K35')->getNumberFormat()->setFormatCode('#,##0.00');
			self::$activeSheet->getStyle('K36')->getNumberFormat()->setFormatCode('#,##0.00');
			self::$activeSheet->getStyle('K50')->getNumberFormat()->setFormatCode('#,##0.00');
			self::$activeSheet->getStyle('I50')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			
			self::$activeSheet->SetCellValue('J35', 'Sub-Total');
			self::$activeSheet->SetCellValue('K35', '=SUM(K16:K33)');
			
			if($this->request->discount)
				//$discount = 0.25;
				self::$activeSheet->SetCellValue('K36', '=SUM(K16:K33)*0.25');
			else
				//$discount = 0;
				self::$activeSheet->SetCellValue('K36', '=SUM(K16:K33)*0');
				
			self::$activeSheet->SetCellValue('J36', 'Discount');
			
//			self::$activeSheet->SetCellValue('K36', '=SUM(K16:K33)*0.25');
			//self::$activeSheet->SetCellValue('K37', $request->discount);
			
			if($this->request->discount)
				self::$activeSheet->SetCellValue('K50', '=SUM(K16:K28) - SUM(K16:K28)*0.25');
			else 
				self::$activeSheet->SetCellValue('K50', '=K35-K36');
				
			self::$activeSheet->SetCellValue('A52', 'OR NO.:');
			self::$activeSheet->SetCellValue('A53', 'DATE:');
			
			self::$activeSheet->SetCellValue('G52', 'AMOUNT RECEIVED:');
			self::$activeSheet->SetCellValue('G53', 'UNPAID BALANCE:');
			
			self::$activeSheet->SetCellValue('A55', 'REPORT DUE ON:');
			self::$activeSheet->SetCellValue('C55', date("M. j, Y", strtotime($this->request->reportDue)).' (4:00 PM)');
			
			self::$activeSheet->SetCellValue('A58', 'DISCUSSED WITH CUSTOMER');
			self::$activeSheet->SetCellValue('A59', 'CONFORME: Customer/Authorized Representative');
			self::$activeSheet->SetCellValue('A61', 'Printed Name:');
			self::$activeSheet->SetCellValue('A62', 'Signature:');
			
			self::$activeSheet->SetCellValue('F59', 'Sample/s Received by:');
			self::$activeSheet->SetCellValue('F61', 'Printed Name:');
			self::$activeSheet->SetCellValue('F62', 'Signature:');
			
			self::$activeSheet->SetCellValue('B61', $this->request->conforme);
			self::$activeSheet->SetCellValue('H61', $this->request->receivedBy);
			
			self::$activeSheet->SetCellValue('A64', 'REPORT NO:');
			self::$activeSheet->getStyle('K65')->getFont()->setSize(8);
			self::$activeSheet->SetCellValue('K65', 'OP-007-F1');
			self::$activeSheet->getStyle('K66')->getFont()->setSize(8);
			self::$activeSheet->SetCellValue('K66', 'Rev. 04');
			*//*
			$row = 2;
			foreach($this->barangays as $barangay){
				self::$activeSheet->SetCellValue('A'.$row, $barangay->id);
				self::$activeSheet->SetCellValue('B'.$row, $barangay->name);
				$row = $row + 1;
			}
			
			$row = 2;
			foreach($this->mods as $mod){
				self::$activeSheet->SetCellValue('C'.$row, $mod->id);
				self::$activeSheet->SetCellValue('D'.$row, $mod->name);
				$row = $row + 1;
			}*/
			/*
			$evacuees = new Barangay;
			$evacuees = Yii::app()->db->createCommand()
			    ->select('m.id, m.name, h.purokStreet ,h.householdCode, e.surname, e.firstname, e.middlename')
			    //->select('m.id, m.name, h.purokStreet ,h.householdCode')
			    ->from('barangay m')
			    ->join('household h', 'm.id=h.barangay_id')
			    ->join('evacuee e', 'h.id=e.household_id')
			    ->where('m.id=:id', array(':id'=>1))
			    ->queryAll();
			*/
			//$displayBy = 1; 
			//$searchBy = 2;
			
			if($this->displayBy == 1){
				$model = new Barangay;
				
				$model = Yii::app()->db->createCommand()
				    ->select('m.id, m.name, h.purokStreet ,h.householdCode, evac.site, hh.status, e.surname, e.firstname, e.middlename, e.extension, e.birthMonth, e.birthDay, e.birthYear, g.genderShort')
				    ->from('barangay m')
				    ->join('household h', 'm.id=h.barangay_id')
				    ->join('evacuee e', 'h.id=e.household_id')
				    ->join('evacuation evac', 'evac.id=h.evacuation_id')
				    ->join('householdstatus hh', 'hh.id=h.hhstatus_id')
				    ->join('gender g', 'g.id=e.gender_id')
				    ->where('m.id=:id', array(':id'=>$this->searchBy))
				    ->queryAll();
				    
			}elseif($this->displayBy == 2){
				$model = new Evacuation;
				
				$model = Yii::app()->db->createCommand()
				    ->select('m.id, m.site, h.purokStreet , h.householdCode, bar.name, hh.status, 
				    	e.surname, e.firstname, e.middlename, e.extension, 
				    	e.birthMonth, e.birthDay, e.birthYear, g.genderShort,
				    	e.pregnant, e.pwd, e.fireVictim, e.pantawidBeneficiary, e.ethnic_id, e.sourceofincome_id,
				    	e.income, e.relationtohead_id, e.education_id, e.occupation_id, e.attendingSchool,
				    	e.school, e.healthCenter, e.assessedBy, e.dateRegistered, e.encoder, e.memberStatus
				    	')
				    ->from('evacuation m')
				    ->join('household h', 'm.id=h.barangay_id')
				    ->join('evacuee e', 'h.id=e.household_id')
				    ->join('barangay bar', 'bar.id=h.barangay_id')
				    ->join('householdstatus hh', 'hh.id=h.hhstatus_id')
				    ->join('gender g', 'g.id=e.gender_id')
				    ->where('m.id=:id', array(':id'=>$this->searchBy))
				    ->queryAll();
			}
			/*																

			*/
			self::$activeSheet->SetCellValue('A1', 'HEAD');
			self::$activeSheet->SetCellValue('B1', 'BARANGAY');
			self::$activeSheet->SetCellValue('C1', 'PUROK/STREET');
			self::$activeSheet->SetCellValue('D1', 'HOUSEHOLD ID');
			self::$activeSheet->SetCellValue('E1', 'EVACUATION CENTER');
			self::$activeSheet->SetCellValue('F1', 'HH STATUS');
			self::$activeSheet->SetCellValue('G1', 'NAME');
			self::$activeSheet->SetCellValue('H1', 'BIRTHDAY');
			self::$activeSheet->SetCellValue('I1', 'GENDER');
			self::$activeSheet->SetCellValue('J1', 'PREGNANT');
			self::$activeSheet->SetCellValue('K1', 'PERSON WITH DISABILITY (PWD)');
			self::$activeSheet->SetCellValue('L1', 'FIRE VICTIM');
			self::$activeSheet->SetCellValue('M1', 'PANTAWID BENEFICIARY');
			self::$activeSheet->SetCellValue('N1', 'ETHNICITY');
			self::$activeSheet->SetCellValue('O1', 'SOURCE OF INCOME');
			self::$activeSheet->SetCellValue('P1', 'MONTHLY INCOME');
			self::$activeSheet->SetCellValue('Q1', 'RELATION TO HH HEAD');
			self::$activeSheet->SetCellValue('R1', 'EDUCATIONAL ATTAINMENT');
			self::$activeSheet->SetCellValue('S1', 'SOURCE OF INCOME');
			self::$activeSheet->SetCellValue('T1', 'ASSESSED BY');
			self::$activeSheet->SetCellValue('U1', 'DATE REGISTERED');
			self::$activeSheet->SetCellValue('V1', 'ENCODER');
			self::$activeSheet->SetCellValue('W1', 'DATE ENCODED');
			self::$activeSheet->SetCellValue('X1', 'MEMBER STATUS');
			self::$activeSheet->SetCellValue('Y1', 'UPDATED BY');
			self::$activeSheet->SetCellValue('Z1', 'ENCODERBACKUP');
			//self::$activeSheet->SetCellValue('AA1', '');

			$row = 2;
			foreach($model as $evacuee){
				//self::$activeSheet->SetCellValue('A'.$row, $evacuee['id']);
				self::$activeSheet->SetCellValue('B'.$row, ($this->displayBy == 1) ? $evacuee['name'] : $evacuee['site']);
				self::$activeSheet->SetCellValue('C'.$row, $evacuee['purokStreet']);
				self::$activeSheet->SetCellValue('D'.$row, $evacuee['householdCode']);
				self::$activeSheet->SetCellValue('E'.$row, ($this->displayBy == 1) ? $evacuee['site'] : $evacuee['name']);
				self::$activeSheet->SetCellValue('F'.$row, $evacuee['householdCode']);
				self::$activeSheet->SetCellValue('G'.$row, $evacuee['surname'].", ".$evacuee['firstname']." ".$evacuee['middlename']." ".$evacuee['extension']);
				self::$activeSheet->SetCellValue('H'.$row, $evacuee['birthMonth']."/".$evacuee['birthDay'].'/'.$evacuee['birthYear']);
				self::$activeSheet->SetCellValue('I'.$row, $evacuee['genderShort']);
				self::$activeSheet->SetCellValue('I'.$row, $evacuee['genderShort']);
				self::$activeSheet->SetCellValue('I'.$row, $evacuee['genderShort']);
				self::$activeSheet->SetCellValue('I'.$row, $evacuee['genderShort']);
				self::$activeSheet->SetCellValue('I'.$row, $evacuee['genderShort']);
				self::$activeSheet->SetCellValue('I'.$row, $evacuee['genderShort']);
				self::$activeSheet->SetCellValue('I'.$row, $evacuee['genderShort']);
				self::$activeSheet->SetCellValue('I'.$row, $evacuee['genderShort']);
				self::$activeSheet->SetCellValue('I'.$row, $evacuee['genderShort']);
				self::$activeSheet->SetCellValue('I'.$row, $evacuee['genderShort']);
				self::$activeSheet->SetCellValue('I'.$row, $evacuee['genderShort']);
				self::$activeSheet->SetCellValue('I'.$row, $evacuee['genderShort']);
				self::$activeSheet->SetCellValue('I'.$row, $evacuee['genderShort']);
				self::$activeSheet->SetCellValue('I'.$row, $evacuee['genderShort']);
				self::$activeSheet->SetCellValue('I'.$row, $evacuee['genderShort']);
				self::$activeSheet->SetCellValue('I'.$row, $evacuee['genderShort']);
				self::$activeSheet->SetCellValue('I'.$row, $evacuee['genderShort']);
				self::$activeSheet->SetCellValue('I'.$row, $evacuee['genderShort']);
				$row = $row + 1;
			}
		}

		public function dataProcess($name,$row)
		{
			// Separate name (eg person.code into array('person', 'code'))
			$separated_name = explode(".", $name);
			
			// Count 
			$n=count($separated_name);
				
			// Create a copy of  the data row. Now we can "dive" trough the array until we reach the desired value
			// (because is nested)
			$aux = self::$data[$row]; //if n is greater than zero, we will loop, if not, $aux actually holds the desired value

			for($i=0; $i < $n; ++$i)
				$aux = $aux[$separated_name[$i]]; // We keep a deeper reference each time

			return $aux;
		}	
				
		public function run()
		{
			$this->renderHeader();
			$this->renderBody();	
			$this->renderFooter();
			
			//set auto width
			if($this->autoWidth)
				foreach($this->columns as $n=>$column)
					self::$objPHPExcel->getActiveSheet()->getColumnDimension($this->columnName($n+1))->setAutoSize(true);
			
			//create writer for saving
			$objWriter = PHPExcel_IOFactory::createWriter(self::$objPHPExcel, $this->exportType);
			if(!$this->stream)
				$objWriter->save($this->filename);
			else //output to browser
			{
				if(!$this->filename)
					$this->filename = $this->title;
				ob_end_clean();
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Pragma: public');
				header('Content-type: '.$this->mimeTypes[$this->exportType]['Content-type']);
				header('Content-Disposition: attachment; filename="'.$this->filename.'.'.$this->mimeTypes[$this->exportType]['extension'].'"');
				header('Cache-Control: max-age=0');				
				$objWriter->save('php://output');			
				Yii::app()->end();
			}
		}

		/**
		* Returns the coresponding excel column.(Abdul Rehman from yii forum)
		* 
		* @param int $index
		* @return string
		*/
		public function columnName($index)
		{
			--$index;
			if($index >= 0 && $index < 26)
				return chr(ord('A') + $index);
			else if ($index > 25)
				return ($this->columnName($index / 26)).($this->columnName($index%26 + 1));
			else
				throw new Exception("Invalid Column # ".($index + 1));
		}		
		
	}
<?php

Yii::import('zii.widgets.grid.CGridView');
	/**
	* @author Nikola Kostadinov
	* @license GPL
	* @version 0.2
	*/	
	class PrintRequestView extends CGridView
	{
		// PHP Excel Path
		public static $phpExcelPathAlias = 'ext.phpexcel.Classes.PHPExcel';
	
		//the PHPExcel object
		public static $objPHPExcel = null;
		public static $activeSheet = null;
		//worksheet drawing image
		public static $objPHPExcelDrawing = null;
		
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
		public $request;
		//public $customer;
		public $samples;
		public $analyses;
		public $labManager = NULL;
		
		public $agencyName = 'Department of Science and Technology';
		public $fullLabName = 'Regional Standards and Testing Laboratories';
		public $agencyAddress = '';
		public $agencyContact = '';
		public $formTitle = 'Request for Laboratory Services';
		public $formNum = '';
		public $formRevNum = '';
		public $formRevDate = '';
		public $logoLeft=NULL;
		public $logoRight=NULL;		
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
			self::$activeSheet->getDefaultStyle()->getFont()->setName('Arial');
			self::$activeSheet->getDefaultStyle()->getFont()->setSize(10); 
			
			//PAGE SETUP
			self::$activeSheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
			self::$activeSheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
			self::$activeSheet->getPageSetup()->setHorizontalCentered(true);
			self::$activeSheet->getPageSetup()->setFitToPage(false);
			self::$activeSheet->getPageSetup()->setScale(90);
			
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
			
			self::$activeSheet->getStyle('A58:K58')->applyFromArray($outline);
			self::$activeSheet->getStyle('A59:C63')->applyFromArray($outline);
			self::$activeSheet->getStyle('D59:G63')->applyFromArray($outline);
			self::$activeSheet->getStyle('H59:K63')->applyFromArray($outline);
			self::$activeSheet->getStyle('A64:K64')->applyFromArray($outline);
			
			self::$activeSheet->getStyle('A61:K61')->applyFromArray($bottom);
			/*self::$activeSheet->getStyle('B61:D61')->applyFromArray($bottom);
			self::$activeSheet->getStyle('B62:D62')->applyFromArray($bottom);
			self::$activeSheet->getStyle('H61:J61')->applyFromArray($bottom);
			self::$activeSheet->getStyle('H62:J62')->applyFromArray($bottom);*/
			
			self::$activeSheet->mergeCells('A1:K1');
			self::$activeSheet->mergeCells('A2:K2');
			self::$activeSheet->mergeCells('A3:K3');
			self::$activeSheet->mergeCells('A4:K4');
			self::$activeSheet->mergeCells('A5:K5');
			self::$activeSheet->mergeCells('A6:K6');
			self::$activeSheet->getStyle('A1:K6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			self::$activeSheet->mergeCells('A61:C61');
			self::$activeSheet->mergeCells('D61:G61');
			self::$activeSheet->mergeCells('H61:K61');
			self::$activeSheet->mergeCells('A62:C62');
			self::$activeSheet->mergeCells('D62:G62');
			self::$activeSheet->mergeCells('H62:K62');
			self::$activeSheet->getStyle('A61:K62')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			//self::$activeSheet->SetCellValue('A1', $this->request->requestRefNum);
			self::$activeSheet->SetCellValue('A1', $this->agencyName);
			
			self::$activeSheet->getStyle('A2')->getFont()->setBold(true); 
			self::$activeSheet->SetCellValue('A2', mb_strtoupper($this->fullLabName));
			 
			self::$activeSheet->SetCellValue('A3', $this->agencyAddress);
			self::$activeSheet->SetCellValue('A4', 'Contact No. '.$this->agencyContact);
			
			self::$activeSheet->getStyle('A6')->getFont()->setSize(14);
			self::$activeSheet->getStyle('A6')->getFont()->setBold(true); 
			self::$activeSheet->SetCellValue('A6', $this->formTitle);
			
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
			self::$activeSheet->SetCellValue('B12', $this->request->customer->customerName);
			self::$activeSheet->SetCellValue('B13', $this->request->customer->completeAddress);
			
			self::$activeSheet->SetCellValue('I12', 'TEL NO.:');
			self::$activeSheet->SetCellValue('I13', 'FAX NO.:');
			self::$activeSheet->mergeCells('J12:K12');
			self::$activeSheet->getStyle('J12:K12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			self::$activeSheet->SetCellValue('J12', $this->request->customer->tel);
			self::$activeSheet->mergeCells('J13:K13');
			self::$activeSheet->getStyle('J13:K13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			self::$activeSheet->SetCellValue('J13', $this->request->customer->fax);
			self::$activeSheet->mergeCells('J66:K66');
			
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
				self::$activeSheet->SetCellValue('A'.$row, $samp->sampleName);
				self::$activeSheet->SetCellValue('C'.$row, $samp->sampleCode);
				
				//Sample Descriptions
				self::$activeSheet->mergeCells('A'.$descRow.':K'.$descRow);
				self::$activeSheet->getStyle('A'.$descRow.':K'.$descRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				self::$activeSheet->SetCellValue('A'.$descRow, $samp->sampleCode.': '.$samp->description);
				
					//Analyses
					//$analyses = Analysis::model()->findAll('requestId=:requestId AND sampleCode=:sampleCode', 
					//  array(':requestId'=>$req->requestId, ':sampleCode'=>$samp->sampleCode));
					//foreach($_SESSION['sample'][$sampleCount]['analysis'] as $analyses){
					
					foreach($samp->analysesForGeneration as $analysis){
						
						//self::$activeSheet->mergeCells('D'.$row.':F'.$row);
						self::$activeSheet->SetCellValue('D'.$row, ($analysis['package'] == 1) ? "  ".$analysis['testName'] : $analysis['testName']);
						
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
			self::$activeSheet->getStyle('K65')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			self::$activeSheet->getStyle('J66')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			
			self::$activeSheet->SetCellValue('J35', 'Sub-Total');
			self::$activeSheet->SetCellValue('K35', '=SUM(K16:K34)');
			
			if($this->request->discount){
				$discount = $this->request->disc->rate/100;
				self::$activeSheet->SetCellValue('K36', '=SUM(K16:K34)*'.$discount);
			}else{
				self::$activeSheet->SetCellValue('K36', '=SUM(K16:K34)*0');
			}	
			
			self::$activeSheet->SetCellValue('J36', 'Discount');
			
			self::$activeSheet->SetCellValue('K50', $this->request->total);
	
			self::$activeSheet->SetCellValue('A52', 'OR NO.:');
			self::$activeSheet->SetCellValue('A53', 'DATE:');
			
			self::$activeSheet->SetCellValue('G52', 'AMOUNT RECEIVED:');
			self::$activeSheet->SetCellValue('G53', 'UNPAID BALANCE:');
			
			self::$activeSheet->SetCellValue('A55', 'REPORT DUE ON:');
			self::$activeSheet->SetCellValue('C55', date("M. j, Y", strtotime($this->request->reportDue)).' (4:00 PM)');
			
			self::$activeSheet->SetCellValue('A58', 'DISCUSSED WITH CUSTOMER');
			self::$activeSheet->SetCellValue('A59', 'CONFORME: ');
			
			//self::$activeSheet->SetCellValue('F59', 'Sample/s Received by:');
			
			self::$activeSheet->SetCellValue('A61', $this->request->conforme);
			self::$activeSheet->SetCellValue('D61', $this->request->receivedBy);
			self::$activeSheet->SetCellValue('H61', $this->labManager?$this->labManager:"Lab Manager Not Set");
			if($this->labManager==NULL)//set font color of unset value
			self::$activeSheet->getStyle('H61')->getFont()->getColor()->setRGB("FF99FF");
			
			self::$activeSheet->SetCellValue('A62', 'Customer/Authorized Representative');
			self::$activeSheet->SetCellValue('D62', 'Sample/s Received by:');
			self::$activeSheet->SetCellValue('H62', 'Sample/s Reviewed by:');
			
			self::$activeSheet->SetCellValue('A64', 'REPORT NO:');
			self::$activeSheet->getStyle('K65')->getFont()->setSize(8);
			self::$activeSheet->SetCellValue('K65', $this->formNum);
			self::$activeSheet->getStyle('J66')->getFont()->setSize(8);
			self::$activeSheet->SetCellValue('J66', $this->formRevNum. " | ". $this->formRevDate);
			
			
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

			/* Additional code for image/logo insert*/
			if($this->logoLeft){
				self::$objPHPExcelDrawing = new PHPExcel_Worksheet_Drawing();
				self::$objPHPExcelDrawing->setWorksheet(self::$activeSheet);
				self::$objPHPExcelDrawing->setName("logo-left");
				self::$objPHPExcelDrawing->setPath(Yii::app()->basePath.DIRECTORY_SEPARATOR."../images/".$this->logoLeft);
				self::$objPHPExcelDrawing->setCoordinates('B2');
				self::$objPHPExcelDrawing->setHeight(60);
			}

			if($this->logoRight){
				self::$objPHPExcelDrawing = new PHPExcel_Worksheet_Drawing();
				self::$objPHPExcelDrawing->setWorksheet(self::$activeSheet);
				self::$objPHPExcelDrawing->setName("logo-right");
				self::$objPHPExcelDrawing->setPath(Yii::app()->basePath.DIRECTORY_SEPARATOR."../images/".$this->logoRight);
				self::$objPHPExcelDrawing->setCoordinates('J2');
				self::$objPHPExcelDrawing->setHeight(60);
			}
			/* End Code image/logo insert*/
			
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
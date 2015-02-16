<?php

Yii::import('zii.widgets.grid.CGridView');
	/**
	* @author Nikola Kostadinov
	* @license GPL
	* @version 0.2
	*/	
	class EExcelViewPrintOP extends CGridView
	{
		// PHP Excel Path
		public static $phpExcelPathAlias = 'ext.phpexcel.Classes.PHPExcel';
	
		//the PHPExcel object
		public static $objPHPExcel = null;
		public static $activeSheet = null;
		//worksheet drawing image
		public static $objPHPExcelDrawing = null;
		
		//Document properties
		public $creator = 'Aris Moratalla';
		public $title = null;
		public $subject = 'Subject';
		public $description = '';
		public $category = '';
		
		//config
		public $autoWidth = false;
		public $exportType = 'Excel5';
		//public $exportType = 'PDF';
		public $disablePaging = true;
		public $filename = null; //export FileName ->original value = null
		public $stream = true; //stream to browser

		//data
		//For performance reason, it's good to have it static and populate it once in all the execution
		public static $data = null;
		
		//models
		public $orderOfPayment;
		public $paymentitems;
		public $collectiontype;
		public $totalInWords;
		public $samples;
		public $references;
		public $collectionOfficer;
		public $accountant;
		public $bankAccount;
		public $formTitle = 'Order of Payment';
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
			//BORDERS
			$outline = array(
				'borders' => array(
					'outline' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => '00000000'),
					),
				),
			);
			
			$outline2 = array(
				'borders' => array(
					'outline' => array(
						'style' => PHPExcel_Style_Border::BORDER_DOUBLE,
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
			
			$bottom2 = array(
				'borders' => array(
					'bottom' => array(
						'style' => PHPExcel_Style_Border::BORDER_DOUBLE,
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
			
			//PAGE SETUP
			self::$activeSheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
			self::$activeSheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
			self::$activeSheet->getPageSetup()->setHorizontalCentered(true);
			
			self::$activeSheet->getPageMargins()->setTop(0.75);
			self::$activeSheet->getPageMargins()->setLeft(0.375);
			//self::$activeSheet->getPageMargins()->setRight(0.4);
			
			self::$activeSheet->getColumnDimension('A')->setWidth(3.71);
			self::$activeSheet->getColumnDimension('B')->setWidth(3.71);
			self::$activeSheet->getColumnDimension('C')->setWidth(3.71);
			self::$activeSheet->getColumnDimension('D')->setWidth(3.71);
			self::$activeSheet->getColumnDimension('E')->setWidth(1.71);
			self::$activeSheet->getColumnDimension('F')->setWidth(2.71);
			self::$activeSheet->getColumnDimension('G')->setWidth(0);
			self::$activeSheet->getColumnDimension('H')->setWidth(3.71);
			self::$activeSheet->getColumnDimension('I')->setWidth(3.71);
			self::$activeSheet->getColumnDimension('J')->setWidth(3.71);
			self::$activeSheet->getColumnDimension('K')->setWidth(11.14);
			self::$activeSheet->getColumnDimension('L')->setWidth(3.71);
			self::$activeSheet->getColumnDimension('M')->setWidth(3.71);
			self::$activeSheet->getColumnDimension('N')->setWidth(3.71);
			self::$activeSheet->getColumnDimension('O')->setWidth(3.71);
			self::$activeSheet->getColumnDimension('P')->setWidth(3.71);
			self::$activeSheet->getColumnDimension('Q')->setWidth(3.85);
			self::$activeSheet->getColumnDimension('R')->setWidth(3.71);
			self::$activeSheet->getColumnDimension('S')->setWidth(3.71);
			self::$activeSheet->getColumnDimension('T')->setWidth(3.71);
			self::$activeSheet->getColumnDimension('U')->setWidth(3.71);
			self::$activeSheet->getColumnDimension('V')->setWidth(9.57);
			self::$activeSheet->getColumnDimension('W')->setWidth(3.71);
			self::$activeSheet->getRowDimension('26')->setRowHeight(60);
			self::$activeSheet->getRowDimension('39')->setRowHeight(8);
			self::$activeSheet->getRowDimension('45')->setRowHeight(8);
			self::$activeSheet->getRowDimension('49')->setRowHeight(8);
			
			self::$activeSheet->SetCellValue('I2', 'DEPARTMENT OF SCIENCE AND TECHNOLOGY');
			//self::$activeSheet->getStyle('B9')->getFont()->setSize(14);
			self::$activeSheet->getStyle('I2')->getFont()->setBold(true);
			self::$activeSheet->SetCellValue('I3', Yii::app()->params['Agency']['name']);
			self::$activeSheet->SetCellValue('I4', Yii::app()->params['Agency']['labName']);			
				
				self::$activeSheet->getStyle('Q5:Q6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				self::$activeSheet->SetCellValue('Q6', 'No.:');
				self::$activeSheet->SetCellValue('Q7', 'Date:');
				
				self::$activeSheet->mergeCells('S6:V6');
				self::$activeSheet->mergeCells('S7:V7');
				self::$activeSheet->getStyle('S6:S7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				self::$activeSheet->getStyle('S6:V6')->applyFromArray($bottom);
				self::$activeSheet->getStyle('S7:V7')->applyFromArray($bottom);
				self::$activeSheet->SetCellValue('S6', $this->orderOfPayment->transactionNum);
				self::$activeSheet->SetCellValue('S7', date('F d, Y',strtotime($this->orderOfPayment->date)));
				
				self::$activeSheet->mergeCells('B9:W9');
				self::$activeSheet->getStyle('B9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				self::$activeSheet->SetCellValue('B9', mb_strtoupper($this->formTitle));
				self::$activeSheet->getStyle('B9')->getFont()->setSize(14);
				self::$activeSheet->getStyle('B9')->getFont()->setBold(true);
				
				self::$activeSheet->getStyle('J11:V11')->applyFromArray($bottom);
				self::$activeSheet->getStyle('J12:V12')->applyFromArray($bottom);
				self::$activeSheet->SetCellValue('B11', 'The Collecting Officer');
				self::$activeSheet->SetCellValue('B12', 'Cash Unit');
				
				self::$activeSheet->SetCellValue('J11', mb_strtoupper($this->collectionOfficer['name']));
				self::$activeSheet->SetCellValue('J12', $this->collectionOfficer['designation']);
				
				self::$activeSheet->SetCellValue('H14', 'Please issue Official Receipt in favor of');
				
				self::$activeSheet->mergeCells('B16:W16');
				self::$activeSheet->getStyle('B16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				self::$activeSheet->getStyle('B16:W16')->applyFromArray($bottom);
				self::$activeSheet->SetCellValue('B16', $this->orderOfPayment->customerName);
				
				self::$activeSheet->mergeCells('B18:W18');
				self::$activeSheet->getStyle('B18')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				self::$activeSheet->getStyle('B18:W18')->applyFromArray($bottom);
				self::$activeSheet->SetCellValue('B18', $this->orderOfPayment->address);
				
				self::$activeSheet->SetCellValue('B20', 'in the amount of');
				self::$activeSheet->mergeCells('H20:W20');
				self::$activeSheet->getStyle('H20:W20')->applyFromArray($bottom);
				self::$activeSheet->getStyle('H20:W20')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				self::$activeSheet->SetCellValue('H20', $this->totalInWords);
				
				self::$activeSheet->mergeCells('H21:W21');
				self::$activeSheet->mergeCells('H22:W22');
				self::$activeSheet->getStyle('H21:W21')->applyFromArray($bottom);
				self::$activeSheet->getStyle('H22:W22')->applyFromArray($bottom);
				
				self::$activeSheet->SetCellValue('P23', '(P');
				self::$activeSheet->mergeCells('B23:O23');
				self::$activeSheet->mergeCells('Q23:V23');
				self::$activeSheet->getStyle('B23:V23')->applyFromArray($bottom);
				self::$activeSheet->getStyle('Q23:V23')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
				self::$activeSheet->getStyle('Q23')->getNumberFormat()->setFormatCode('#,##0.00');
				self::$activeSheet->SetCellValue('Q23', $this->orderOfPayment->totalPayment);
				self::$activeSheet->SetCellValue('W23', ')');
				
				self::$activeSheet->mergeCells('H25:W25');
				self::$activeSheet->SetCellValue('B25', 'for payment of');
				self::$activeSheet->SetCellValue('H25', $this->orderOfPayment->purpose);
				self::$activeSheet->getStyle('H25:W25')->applyFromArray($bottom);
				
				self::$activeSheet->mergeCells('B26:W26');
				self::$activeSheet->getStyle('B26')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				self::$activeSheet->getStyle('B26')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
				self::$activeSheet->getStyle('B26')->getAlignment()->setWrapText(true);
				self::$activeSheet->getStyle('B26:W26')->applyFromArray($bottom);
				self::$activeSheet->getStyle('B26')->getFont()->setSize(7);
				self::$activeSheet->SetCellValue('B26', ($this->collectiontype->id == 1) ? $this->samples : '');
				
				self::$activeSheet->mergeCells('B27:G27');
				self::$activeSheet->SetCellValue('B27', 'REFERENCE:');
				self::$activeSheet->mergeCells('H27:W27');
				self::$activeSheet->getStyle('B27:W27')->applyFromArray($bottom);
				self::$activeSheet->SetCellValue('H27', ($this->collectiontype->id == 1) ? $this->references : '');
				
				self::$activeSheet->SetCellValue('B29', 'Please deposit the collections under Bank');
				self::$activeSheet->SetCellValue('B30', 'Accounts:');
				
				for($i=32; $i<=37; $i+=1){
					self::$activeSheet->mergeCells('B'.$i.':F'.$i);
					self::$activeSheet->mergeCells('H'.$i.':O'.$i);
					self::$activeSheet->mergeCells('Q'.$i.':V'.$i);
					self::$activeSheet->getStyle('B'.$i.':V'.$i)->applyFromArray($bottom);
					self::$activeSheet->getStyle('H'.$i.':O'.$i)->applyFromArray($outline);
				}
				
				self::$activeSheet->mergeCells('B31:F31');
				self::$activeSheet->mergeCells('H31:O31');
				self::$activeSheet->mergeCells('P31:V31');
				self::$activeSheet->getStyle('B31:V31')->applyFromArray($bottom);
				
				self::$activeSheet->SetCellValue('B31', 'No.');
				self::$activeSheet->SetCellValue('H31', 'Name of Bank');
				self::$activeSheet->SetCellValue('P31', 'Amount');
				self::$activeSheet->getStyle('B31:V31')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				
				self::$activeSheet->getStyle('Q32:Q38')->getNumberFormat()->setFormatCode('#,##0.00');
				self::$activeSheet->getStyle('B32:H32')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				self::$activeSheet->SetCellValue('B32', $this->bankAccount['accountNumber']);
				self::$activeSheet->SetCellValue('H32', $this->bankAccount['bankName']);
				self::$activeSheet->SetCellValue('P32', 'P');
				self::$activeSheet->SetCellValue('Q32', '=Q23');
				self::$activeSheet->mergeCells('H38:O38');
				self::$activeSheet->mergeCells('Q38:V38');
				self::$activeSheet->getStyle('H38:O38')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
				self::$activeSheet->SetCellValue('H38', 'TOTAL');
				self::$activeSheet->SetCellValue('P38', 'P');
				self::$activeSheet->getStyle('P38:V38')->applyFromArray($bottom2);
				self::$activeSheet->SetCellValue('Q38', '=SUM(Q32:Q37)');
				
				self::$activeSheet->mergeCells('M42:W42');
				self::$activeSheet->mergeCells('M43:W43');
				self::$activeSheet->mergeCells('M44:W44');				
				
				self::$activeSheet->getStyle('M42:W42')->applyFromArray($bottom);
				self::$activeSheet->SetCellValue('M42', strtoupper($this->accountant['name']));
				self::$activeSheet->getStyle('M42')->getFont()->setBold(true);
				self::$activeSheet->SetCellValue('M43', '(Authorized Signatory)');
				self::$activeSheet->SetCellValue('M44', 'Accounting Unit');
				self::$activeSheet->getStyle('M42:M44')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				
				self::$activeSheet->getStyle('T46:T48')->getFont()->setSize(8);
				self::$activeSheet->getRowDimension('T46')->setRowHeight(4);
				self::$activeSheet->SetCellValue('T46', $this->formNum); //'PM-AD-05-001-F2'
				self::$activeSheet->SetCellValue('T47', $this->formRevNum);//'Revision No. 0'
				self::$activeSheet->SetCellValue('T48', $this->formRevDate);//'30 August 2007'
				
				self::$activeSheet->getStyle('B1:W49')->applyFromArray($outline2);
				//self::$activeSheet->SetCellValue('A27', 'per Bill No.');
				//self::$activeSheet->SetCellValue('A29', 'dated');
				
				/*
				$total = 0;
				$row = 49;
				foreach($this->paymentitems as $item)
				{
					self::$activeSheet->getRowDimension($row)->setRowHeight(17);
					self::$activeSheet->SetCellValue('A'.$row, $item->details);
					
					self::$activeSheet->getStyle('D'.$row)->getNumberFormat()->setFormatCode('#,##0.00');
					self::$activeSheet->SetCellValue('D'.$row, $item->amount);
				
					$row = $row + 1;
					$total = $total + $item['amount'];
				}*/
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
				self::$objPHPExcelDrawing->setCoordinates('D2');
				self::$objPHPExcelDrawing->setHeight(60);
			}

			if($this->logoRight){
				self::$objPHPExcelDrawing = new PHPExcel_Worksheet_Drawing();
				self::$objPHPExcelDrawing->setWorksheet(self::$activeSheet);
				self::$objPHPExcelDrawing->setName("logo-right");
				self::$objPHPExcelDrawing->setPath(Yii::app()->basePath.DIRECTORY_SEPARATOR."../images/".$this->logoRight);
				self::$objPHPExcelDrawing->setCoordinates('T2');
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
				//$objWriter = PHPExcel_IOFactory::createWriter($objPHPexcel, ‘PDF’);
				//$objWriter->writeAllSheets();
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

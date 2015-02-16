<?php

Yii::import('zii.widgets.grid.CGridView');
	/**
	* @author Nikola Kostadinov
	* @license GPL
	* @version 0.2
	*/	
	class PrintPmisPaymentDetailsView extends CGridView
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
		public $project;
		public $payments;
		public $totalAmountDue;
		
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
			self::$activeSheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
			self::$activeSheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
			self::$activeSheet->getPageSetup()->setFitToPage(false);
			self::$activeSheet->getPageSetup()->setScale(100);
			self::$activeSheet->getPageSetup()->setHorizontalCentered(true);
			
			self::$activeSheet->getPageMargins()->setTop(0.5);
			self::$activeSheet->getPageMargins()->setRight(0.15);
			self::$activeSheet->getPageMargins()->setLeft(0.15);
			self::$activeSheet->getPageMargins()->setBottom(0.25);
			
			//SET COLUMN WIDTHs
			self::$activeSheet->getColumnDimension('A')->setWidth(17);
			self::$activeSheet->getColumnDimension('B')->setWidth(17);
			self::$activeSheet->getColumnDimension('C')->setWidth(17);
			self::$activeSheet->getColumnDimension('D')->setWidth(17);
			self::$activeSheet->getColumnDimension('E')->setWidth(13);
			self::$activeSheet->getColumnDimension('F')->setWidth(15);
			//self::$activeSheet->getColumnDimension('G')->setWidth(40);
			self::$activeSheet->getColumnDimension('H')->setWidth(40);
			
			self::$activeSheet->getRowDimension('5')->setRowHeight(3);
			self::$activeSheet->getRowDimension('16')->setRowHeight(3);
			self::$activeSheet->getRowDimension('19')->setRowHeight(3);
			
			//BORDERS
			$outline = array(
				'borders' => array(
					'outline' => array(
						'style' => PHPExcel_Style_Border::BORDER_HAIR,
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
			
			$grayborders = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('rgb' => '808080'),
					),
				),
			);
			
			
			
			$whitebottom = array(
				'borders' => array(
					'top' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('rgb' => '808080'),
					),
					'bottom' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('rgb' => 'ffffff'),
					),
					'left' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('rgb' => '808080'),
					),
					'right' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('rgb' => '808080'),
					),
				),
			);
			
			$whitetop = array(
				'borders' => array(
					'top' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('rgb' => 'ffffff'),
					),
					'bottom' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('rgb' => '808080'),
					),
					'left' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('rgb' => '808080'),
					),
					'right' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('rgb' => '808080'),
					),
				),
			);
			
			$fillGrey = array(
			        'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => '808080')
			        )
			    );
			    
			//$row = 1;
			for($row=1; $row<=13; $row+=1){
				if($row != 4)
					self::$activeSheet->mergeCells('A'.$row.':H'.$row);
				else
					self::$activeSheet->mergeCells('B'.$row.':H'.$row);
			}
			
			self::$activeSheet->mergeCells('A'.$row.':B'.$row);
			self::$activeSheet->mergeCells('C'.$row.':D'.$row);
			self::$activeSheet->mergeCells('E'.$row.':G'.$row);
			
			$row = $row + 1;
			self::$activeSheet->mergeCells('A'.$row.':B'.$row);
			self::$activeSheet->mergeCells('C'.$row.':D'.$row);
			self::$activeSheet->mergeCells('E'.$row.':G'.$row);
			
			$row = $row + 2;
			self::$activeSheet->mergeCells('B'.$row.':H'.$row);
			
			$row = $row + 1;
			self::$activeSheet->mergeCells('B'.$row.':H'.$row);
			
			//Background Fills
			self::$activeSheet->getStyle('A4:H4')->applyFromArray($fillGrey);
			self::$activeSheet->getStyle('A4:H4')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			
			self::$activeSheet->getStyle('A17:B18')->applyFromArray($fillGrey);
			self::$activeSheet->getStyle('A17:B18')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			self::$activeSheet->getStyle('A17:B18')->getFont()->setBold(true);
			
			//self::$activeSheet->getStyle('A15:H51')->getAlignment()->setIndent(1);
			//self::$activeSheet->getStyle('A15:H51')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			
			self::$activeSheet->getStyle('B17')->getNumberFormat()->setFormatCode('#,##0.00');
			self::$activeSheet->getStyle('B17')->getAlignment()->setIndent(1);
			self::$activeSheet->getStyle('B17')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			
			//Append Data
			self::$activeSheet->getStyle('A1:A2')->getFont()->setBold(true);
			self::$activeSheet->getStyle('A1')->getFont()->setSize(11);
			self::$activeSheet->getStyle('A2')->getFont()->setSize(20);
			self::$activeSheet->SetCellValue('A1', 'SMALL ENTERPRISE TECHNOLOGY UPGRADING PROGRAM');
			self::$activeSheet->SetCellValue('A2', 'Project Payment Detail');
			self::$activeSheet->SetCellValue('A3', 'Project Payment Sheet');
			self::$activeSheet->SetCellValue('A4', 'Project Code:');
			
			self::$activeSheet->getStyle('A4:H4')->getFont()->setBold(true);
			self::$activeSheet->getStyle('B4')->getFont()->setSize(15);
			self::$activeSheet->SetCellValue('B4', $this->project->code);
			
			self::$activeSheet->getStyle('A6')->getFont()->setBold(true);
			self::$activeSheet->SetCellValue('A6', 'Project Title');
			self::$activeSheet->getStyle('A7')->getAlignment()->setIndent(1);
			self::$activeSheet->SetCellValue('A7', $this->project->title);
			
			self::$activeSheet->getStyle('A8')->getFont()->setBold(true);
			self::$activeSheet->SetCellValue('A8', 'Name of Firm');
			self::$activeSheet->getStyle('A9')->getAlignment()->setIndent(1);
			self::$activeSheet->SetCellValue('A9', $this->project->firm_name);

			self::$activeSheet->getStyle('A10')->getFont()->setBold(true);
			self::$activeSheet->SetCellValue('A10', 'Contact Person');
			self::$activeSheet->getStyle('A11')->getAlignment()->setIndent(1);
			self::$activeSheet->SetCellValue('A11', $this->project->contact_person);

			self::$activeSheet->getStyle('A12')->getFont()->setBold(true);
			self::$activeSheet->SetCellValue('A12', 'Business Address');
			self::$activeSheet->getStyle('A13')->getAlignment()->setIndent(1);
			self::$activeSheet->SetCellValue('A13', $this->project->address);
			
			self::$activeSheet->SetCellValue('A14', 'Telephone Number');
			self::$activeSheet->getStyle('A14')->getFont()->setBold(true);
			self::$activeSheet->SetCellValue('A15', $this->project->landline);
			
			self::$activeSheet->SetCellValue('C14', 'Fax Number');
			self::$activeSheet->getStyle('C14')->getFont()->setBold(true);
			self::$activeSheet->SetCellValue('C15', $this->project->fax);
			
			self::$activeSheet->SetCellValue('E14', 'Mobile Number');
			self::$activeSheet->getStyle('E14')->getFont()->setBold(true);
			self::$activeSheet->SetCellValue('A15', $this->project->mobile);
			
			self::$activeSheet->SetCellValue('H14', 'Email Address');
			self::$activeSheet->getStyle('H14')->getFont()->setBold(true);
			self::$activeSheet->SetCellValue('H15', $this->project->email);
			
			self::$activeSheet->SetCellValue('A17', 'Total Project Cost:');
			self::$activeSheet->getStyle('B17')->getFont()->setBold(true);
			self::$activeSheet->getStyle('B17')->getFont()->setSize(14);
			self::$activeSheet->SetCellValue('B17', $this->project->funding->project_cost);
			self::$activeSheet->SetCellValue('A18', 'Payment Detail');
			
			$row = $row + 2;
			self::$activeSheet->SetCellValue('A'.$row, 'PDC Date');
			self::$activeSheet->SetCellValue('B'.$row, 'PDC Amount');
			self::$activeSheet->SetCellValue('C'.$row, 'Date of Payment');
			
			self::$activeSheet->mergeCells('D'.$row.':E'.$row);
			self::$activeSheet->SetCellValue('D'.$row, 'OR / JEV');
			
			self::$activeSheet->SetCellValue('F'.$row, 'Amount Paid');
			
			self::$activeSheet->mergeCells('G'.$row.':H'.$row);
			self::$activeSheet->SetCellValue('G'.$row, 'Remarks');
			self::$activeSheet->getStyle('A'.$row.':G'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			self::$activeSheet->getStyle('A'.$row.':G'.$row)->getFont()->setBold(true); 
			
			$row = $row + 1;
			foreach($this->payments as $payment){
				self::$activeSheet->getStyle('A'.$row)->getAlignment()->setIndent(1);
				self::$activeSheet->SetCellValue('A'.$row, $payment->checkDate);
				
				self::$activeSheet->getStyle('B'.$row)->getNumberFormat()->setFormatCode('#,##0.00');
				self::$activeSheet->getStyle('B'.$row)->getAlignment()->setIndent(1);
				self::$activeSheet->SetCellValue('B'.$row, $payment->receipt->or_amount);	
				
				self::$activeSheet->getStyle('C'.$row)->getAlignment()->setIndent(1);
				//self::$activeSheet->SetCellValue('C'.$row, $payment->receipt->or_date);
				self::$activeSheet->SetCellValue('C'.$row, $payment->paymentDate);
				
				self::$activeSheet->mergeCells('D'.$row.':E'.$row);
				self::$activeSheet->getStyle('D'.$row)->getAlignment()->setIndent(1);
				self::$activeSheet->SetCellValue('D'.$row, 'OR # '.$payment->or.' - '.$payment->receipt->or_date);
				
				self::$activeSheet->getStyle('F'.$row)->getAlignment()->setIndent(1);
				self::$activeSheet->getStyle('F'.$row)->getNumberFormat()->setFormatCode('#,##0.00');
				self::$activeSheet->SetCellValue('F'.$row, $payment->amount_paid);
				
				self::$activeSheet->mergeCells('G'.$row.':H'.$row);
				self::$activeSheet->getStyle('G'.$row)->getAlignment()->setIndent(1);
				self::$activeSheet->SetCellValue('G'.$row, $payment->remarks);
				$row = $row + 1;
			}
			
			$row = $row - 1;
			self::$activeSheet->getStyle('A4'.':H4')->applyFromArray($grayborders);
			self::$activeSheet->getStyle('A17'.':H17')->applyFromArray($whitebottom);
			self::$activeSheet->getStyle('A18'.':H18')->applyFromArray($whitetop);
			self::$activeSheet->getStyle('A6'.':H15')->applyFromArray($allborders);
			self::$activeSheet->getStyle('A20'.':H'.$row)->applyFromArray($allborders);
			
			$row = $row + 2;
			
			self::$activeSheet->SetCellValue('A'.$row, 'Amount Due as of ');
			//self::$activeSheet->getStyle('A'.$row)->getNumberFormat()->setFormatCode('dd/mm/yyyy');
			self::$activeSheet->SetCellValue('B'.$row, date('d M Y'));
			self::$activeSheet->getStyle('C'.$row)->getNumberFormat()->setFormatCode('#,##0.00');
			self::$activeSheet->SetCellValue('C'.$row, $this->totalAmountDue);
			
			
			$row = $row + 1;
			self::$activeSheet->SetCellValue('A'.$row, '% Refund as of ');
			self::$activeSheet->SetCellValue('B'.$row, date('d M Y'));
			self::$activeSheet->getStyle('C'.$row)->getNumberFormat()->setFormatCode('#,##0.00');
			self::$activeSheet->getStyle('C'.$row)->getNumberFormat()->applyFromArray(
				array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00)
			);
			self::$activeSheet->SetCellValue('C'.$row, round((($this->project->totalAmountPaid/$this->project->funding->project_cost)), 4));
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
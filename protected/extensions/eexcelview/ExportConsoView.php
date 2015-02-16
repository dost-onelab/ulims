<?php

Yii::import('zii.widgets.grid.CGridView');
	/**
	* @author Nikola Kostadinov
	* @license GPL
	* @version 0.2
	*/	
	class ExportConsoView extends CGridView
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
		//public $request;
		//public $customer;
		//public $samples;
		public $reports;
		public $header;
		public $year;
		
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
			$this->formatSheet();
			$this->formatPage();
			$this->populateReport();
			
		}

		function formatPage(){
			self::$activeSheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
			self::$activeSheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
			self::$activeSheet->getPageSetup()->setFitToPage(true);
			self::$activeSheet->getPageSetup()->setScale(80);
			//self::$activeSheet->getPageSetup()->setHorizontalCentered(true);
			
			self::$activeSheet->getPageMargins()->setTop(0.5);
			self::$activeSheet->getPageMargins()->setRight(0.25);
			self::$activeSheet->getPageMargins()->setLeft(0.25);
			self::$activeSheet->getPageMargins()->setBottom(0.25);
		}
		
		function formatSheet(){
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
			
			$doublelineOut = array(
				'borders' => array(
					'outline' => array(
						'style' => PHPExcel_Style_Border::BORDER_DOUBLE,
						'color' => array('argb' => '00000000'),
					),
				),
			);
			
			$doublelineBottom = array(
				'borders' => array(
					'bottom' => array(
						'style' => PHPExcel_Style_Border::BORDER_DOUBLE,
						'color' => array('argb' => '00000000'),
					),
				),
			);
			
			$doublelineTop = array(
				'borders' => array(
					'top' => array(
						'style' => PHPExcel_Style_Border::BORDER_DOUBLE,
						'color' => array('argb' => '00000000'),
					),
				),
			);
			
			$grey = array(
		        'fill' => array(
		            'type' => PHPExcel_Style_Fill::FILL_SOLID,
		            'color' => array('rgb' => 'C0C0C0') //CCCCCC
		        )
    		);
    		
    		$orange = array(
		        'fill' => array(
		            'type' => PHPExcel_Style_Fill::FILL_SOLID,
		            'color' => array('rgb' => 'FF9900')
		        )
    		);
			
    		$yellow = array(
		        'fill' => array(
		            'type' => PHPExcel_Style_Fill::FILL_SOLID,
		            'color' => array('rgb' => 'FFDE00')
		        )
    		);
    		
    		$pink = array(
		        'fill' => array(
		            'type' => PHPExcel_Style_Fill::FILL_SOLID,
		            'color' => array('rgb' => 'FFAEAE')
		        )
    		);
    		
    		$lightgreen = array(
		        'fill' => array(
		            'type' => PHPExcel_Style_Fill::FILL_SOLID,
		            'color' => array('rgb' => 'B0E57C')
		        )
    		);
    		
    		$lightblue = array(
		        'fill' => array(
		            'type' => PHPExcel_Style_Fill::FILL_SOLID,
		            'color' => array('rgb' => 'B4D8E7')
		        )
    		);
    		self::$activeSheet->getColumnDimension('A')->setWidth(8);
    		self::$activeSheet->getColumnDimension('B')->setWidth(8);
    		self::$activeSheet->getColumnDimension('C')->setWidth(8);
    		self::$activeSheet->getColumnDimension('D')->setWidth(8);
    		self::$activeSheet->getColumnDimension('E')->setWidth(8);
    		self::$activeSheet->getColumnDimension('F')->setWidth(8);
    		self::$activeSheet->getColumnDimension('G')->setWidth(8);
    		
    		self::$activeSheet->getColumnDimension('H')->setWidth(12);
    		self::$activeSheet->getColumnDimension('J')->setWidth(12);
    		self::$activeSheet->getColumnDimension('L')->setWidth(10);
    		self::$activeSheet->getColumnDimension('M')->setWidth(12);
    		
			self::$activeSheet->mergeCells('A1:M1');
			self::$activeSheet->getStyle('A1:M1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			self::$activeSheet->getStyle('A1')->getFont()->setSize(14);
			self::$activeSheet->getStyle('A1')->getFont()->setBold(true); 
			self::$activeSheet->SetCellValue('A1', 'RSTL IX '.$this->year.' Summary of Accomplishment');
			$line = 3;
			
			for($lab=1;$lab<=4;$lab+=1)
			{
				
				//Month
				$line2 = $line + 3;
				self::$activeSheet->getStyle('A'.$line.':M'.$line2)->getFont()->setSize(8);
				self::$activeSheet->getStyle('A'.$line.':M'.$line2)->getFont()->setBold(true);
				self::$activeSheet->getStyle('A'.$line.':M'.$line2)->applyFromArray($grey);
				
				self::$activeSheet->getStyle('A'.$line.':A'.$line2)->applyFromArray($outline);
				self::$activeSheet->getStyle('A'.$line.':M'.$line2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				self::$activeSheet->SetCellValue('A'.$line, 'Month');
				
				
				
				//Lab
				self::$activeSheet->mergeCells('B'.$line.':M'.$line);
				self::$activeSheet->getStyle('B'.$line.':M'.$line)->applyFromArray($outline);
				
				if($lab == 1){
					self::$activeSheet->getStyle('B'.$line.':M'.$line)->applyFromArray($pink);
				}
				if($lab == 2){
					self::$activeSheet->getStyle('B'.$line.':M'.$line)->applyFromArray($lightgreen);
				}
				if($lab == 3){
					self::$activeSheet->getStyle('B'.$line.':M'.$line)->applyFromArray($lightblue);
				}
				if($lab == 4){
					self::$activeSheet->getStyle('B'.$line.':M'.$line)->applyFromArray($yellow);
				}
				//self::$activeSheet->getStyle('B'.$line.':M'.$line)->applyFromArray($color);
				self::$activeSheet->SetCellValue('B'.$line, strtoupper($this->header[$lab]));
				$line += 1;
				
				//columns
				$line2 = $line + 1;
				self::$activeSheet->getStyle('B'.$line.':C'.$line2)->applyFromArray($outline);
				self::$activeSheet->getStyle('D'.$line.':E'.$line2)->applyFromArray($outline);
				self::$activeSheet->getStyle('F'.$line.':G'.$line2)->applyFromArray($outline);
				self::$activeSheet->getStyle('H'.$line.':I'.$line2)->applyFromArray($orange);
				self::$activeSheet->getStyle('H'.$line.':I'.$line2)->applyFromArray($outline);
				self::$activeSheet->getStyle('J'.$line.':L'.$line)->applyFromArray($yellow);
				self::$activeSheet->getStyle('J'.$line.':L'.$line)->applyFromArray($outline);
				
				$line2 = $line + 3;
				self::$activeSheet->getStyle('M'.$line.':M'.$line2)->applyFromArray($outline);
				
				$line2 = $line + 1;
				
				self::$activeSheet->mergeCells('B'.$line.':C'.$line2);
				self::$activeSheet->mergeCells('D'.$line.':E'.$line2);
				self::$activeSheet->mergeCells('F'.$line.':G'.$line2);
				self::$activeSheet->mergeCells('H'.$line.':I'.$line2);
				self::$activeSheet->mergeCells('J'.$line.':L'.$line);
				self::$activeSheet->SetCellValue('J'.$line, 'Value of Assistance');
				//$line += 1;
				
				//self::$activeSheet->mergeCells('B'.$line.':C'.$line);
				self::$activeSheet->getStyle('B'.$line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				self::$activeSheet->SetCellValue('B'.$line, 'No. of Sample');
				
				//self::$activeSheet->mergeCells('D'.$line.':E'.$line);
				self::$activeSheet->SetCellValue('D'.$line, 'No. of Test');
				
				//self::$activeSheet->mergeCells('F'.$line.':G'.$line);
				self::$activeSheet->SetCellValue('F'.$line, 'No. of Customer');
				
				self::$activeSheet->mergeCells('H'.$line.':I'.$line);
				self::$activeSheet->getStyle('H'.$line.':I'.$line)->getAlignment()->setWrapText(true);
				self::$activeSheet->SetCellValue('H'.$line, 'Income (Actual Fees Collected)');
				
				$line += 1;
				self::$activeSheet->mergeCells('J'.$line.':K'.$line);
				self::$activeSheet->getStyle('J'.$line.':K'.$line)->applyFromArray($outline);
				self::$activeSheet->SetCellValue('J'.$line, 'GRATIS');
				$line += 1;

				self::$activeSheet->getStyle('B'.$line.':K'.$line)->applyFromArray($allborders);
				self::$activeSheet->SetCellValue('A'.$line, $this->year);
				
				self::$activeSheet->SetCellValue('B'.$line, 'NON-SETUP');
				self::$activeSheet->SetCellValue('C'.$line, 'SETUP');
				
				self::$activeSheet->SetCellValue('D'.$line, 'NON-SETUP');
				self::$activeSheet->SetCellValue('E'.$line, 'SETUP');
				
				self::$activeSheet->SetCellValue('F'.$line, 'NON-SETUP');
				self::$activeSheet->SetCellValue('G'.$line, 'SETUP');
				
				self::$activeSheet->SetCellValue('H'.$line, 'NON-SETUP');
				self::$activeSheet->SetCellValue('I'.$line, 'SETUP');
				
				self::$activeSheet->SetCellValue('J'.$line, 'NON-SETUP');
				self::$activeSheet->SetCellValue('K'.$line, 'SETUP');
				
				self::$activeSheet->SetCellValue('L'.$line, '25% Discount');
				self::$activeSheet->SetCellValue('M'.$line, 'GROSS');	
				
				
				
				$line += 1;
				$line2 = $line + 13;
				$line3 = $line + 15;
				//$line3 = $line + 15;
				self::$activeSheet->getStyle('A'.$line.':M'.$line2)->applyFromArray($allborders);
				self::$activeSheet->getStyle('A'.$line.':M'.$line)->applyFromArray($doublelineTop);
				self::$activeSheet->getStyle('B'.$line.':G'.$line3)->getNumberFormat()->setFormatCode('#,##0');
				self::$activeSheet->getStyle('H'.$line.':M'.$line3)->getNumberFormat()->setFormatCode('#,##0.00');
				self::$activeSheet->getStyle('A'.$line.':A'.$line2)->applyFromArray($grey);
								
				self::$activeSheet->getStyle('A'.$line2.':M'.$line2)->getFont()->setBold(true); 
				self::$activeSheet->getStyle('B'.$line2.':M'.$line2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				self::$activeSheet->mergeCells('B'.$line2.':C'.$line2);
				self::$activeSheet->mergeCells('D'.$line2.':E'.$line2);
				self::$activeSheet->mergeCells('F'.$line2.':G'.$line2);
				self::$activeSheet->mergeCells('H'.$line2.':I'.$line2);
				self::$activeSheet->mergeCells('J'.$line2.':L'.$line2);

				$line2 = $line + 11;
				self::$activeSheet->getStyle('A'.$line2.':M'.$line2)->applyFromArray($doublelineBottom);
				
				$line3 = $line2 + 2;
				$line4 = $line2 - 15;
				self::$activeSheet->getStyle('A'.$line4.':M'.$line3)->applyFromArray($doublelineOut);
				
				$line +=15;
			}//end for
			
			
		}
		
		function populateReport(){
			$row = 7;
			foreach($this->reports as $report){
				$month = 1;
				foreach($report as $monthly){
					
					self::$activeSheet->SetCellValue('A'.$row, date("M", mktime(0, 0, 0, $month, 1, $year)));
					
					self::$activeSheet->SetCellValue('B'.$row, $monthly[sampleNSetup]);
					self::$activeSheet->SetCellValue('C'.$row, $monthly[sampleSetup]);
					
					self::$activeSheet->SetCellValue('D'.$row, $monthly[testNSetup]);
					self::$activeSheet->SetCellValue('E'.$row, $monthly[testSetup]);
					
					self::$activeSheet->SetCellValue('F'.$row, $monthly[customerNSetup]);
					self::$activeSheet->SetCellValue('G'.$row, $monthly[customerSetup]);
					
					self::$activeSheet->SetCellValue('H'.$row, $monthly[incomeNSetup]);
					self::$activeSheet->SetCellValue('I'.$row, $monthly[incomeSetup]);
					
					self::$activeSheet->getStyle('J'.$row)->getNumberFormat()->setFormatCode('#,##0.00');
					self::$activeSheet->SetCellValue('J'.$row, $monthly[valueNSetup]);
					self::$activeSheet->SetCellValue('K'.$row, $monthly[valueSetup]);
					
					self::$activeSheet->SetCellValue('L'.$row, $monthly[valueNDiscount]);
					self::$activeSheet->SetCellValue('M'.$row, '=SUM(H'.$row.':L'.$row.')');
					$row += 1;
					$month += 1;
				}
				self::$activeSheet->SetCellValue('A'.$row, 'Subtotal');
				$i = $row -12;
				$j = $row -1;
				self::$activeSheet->SetCellValue('B'.$row, '=SUM(B'.$i.':B'.$j.')');
				self::$activeSheet->SetCellValue('C'.$row, '=SUM(C'.$i.':C'.$j.')');
				self::$activeSheet->SetCellValue('D'.$row, '=SUM(D'.$i.':D'.$j.')');
				self::$activeSheet->SetCellValue('E'.$row, '=SUM(E'.$i.':E'.$j.')');
				self::$activeSheet->SetCellValue('F'.$row, '=SUM(F'.$i.':F'.$j.')');
				self::$activeSheet->SetCellValue('G'.$row, '=SUM(G'.$i.':G'.$j.')');
				self::$activeSheet->SetCellValue('H'.$row, '=SUM(H'.$i.':H'.$j.')');
				self::$activeSheet->SetCellValue('I'.$row, '=SUM(I'.$i.':I'.$j.')');
				self::$activeSheet->SetCellValue('J'.$row, '=SUM(J'.$i.':J'.$j.')');
				self::$activeSheet->SetCellValue('K'.$row, '=SUM(K'.$i.':K'.$j.')');
				self::$activeSheet->SetCellValue('L'.$row, '=SUM(L'.$i.':L'.$j.')');
				self::$activeSheet->SetCellValue('M'.$row, '=SUM(M'.$i.':M'.$j.')');
				
				$row += 1;
				$i = $row - 1;
				self::$activeSheet->SetCellValue('A'.$row, 'TOTAL');
				self::$activeSheet->SetCellValue('B'.$row, '=SUM(B'.$i.':C'.$i.')');
				self::$activeSheet->SetCellValue('D'.$row, '=SUM(D'.$i.':E'.$i.')');
				self::$activeSheet->SetCellValue('F'.$row, '=SUM(F'.$i.':G'.$i.')');
				self::$activeSheet->SetCellValue('H'.$row, '=SUM(H'.$i.':I'.$i.')');
				self::$activeSheet->SetCellValue('J'.$row, '=SUM(J'.$i.':L'.$i.')');
				self::$activeSheet->SetCellValue('M'.$row, '=SUM(H'.$row.':J'.$row.')');
				//Next Table
				$row += 6;
			}
			
			//Summary
			$chemlab = 7;
			$microlab = 26;
			$metrolab = 45;
			for($i=1; $i<=12; $i+=1){
				self::$activeSheet->SetCellValue('A'.$row, date("M", mktime(0, 0, 0, $i, 1, $year)));
				self::$activeSheet->SetCellValue('B'.$row, '=SUM(B'.$chemlab.',B'.$microlab.',B'.$metrolab.')');
				self::$activeSheet->SetCellValue('C'.$row, '=SUM(C'.$chemlab.',C'.$microlab.',C'.$metrolab.')');
				self::$activeSheet->SetCellValue('D'.$row, '=SUM(D'.$chemlab.',D'.$microlab.',D'.$metrolab.')');
				self::$activeSheet->SetCellValue('E'.$row, '=SUM(E'.$chemlab.',E'.$microlab.',E'.$metrolab.')');
				self::$activeSheet->SetCellValue('F'.$row, '=SUM(F'.$chemlab.',F'.$microlab.',F'.$metrolab.')');
				self::$activeSheet->SetCellValue('G'.$row, '=SUM(G'.$chemlab.',G'.$microlab.',G'.$metrolab.')');
				self::$activeSheet->SetCellValue('H'.$row, '=SUM(H'.$chemlab.',H'.$microlab.',H'.$metrolab.')');
				self::$activeSheet->SetCellValue('I'.$row, '=SUM(I'.$chemlab.',I'.$microlab.',I'.$metrolab.')');
				self::$activeSheet->SetCellValue('J'.$row, '=SUM(J'.$chemlab.',J'.$microlab.',J'.$metrolab.')');
				self::$activeSheet->SetCellValue('K'.$row, '=SUM(K'.$chemlab.',K'.$microlab.',K'.$metrolab.')');
				self::$activeSheet->SetCellValue('L'.$row, '=SUM(L'.$chemlab.',L'.$microlab.',L'.$metrolab.')');
				self::$activeSheet->SetCellValue('M'.$row, '=SUM(M'.$chemlab.',M'.$microlab.',M'.$metrolab.')');
				
				$chemlab += 1;
				$microlab += 1;
				$metrolab += 1;
				$row += 1;
			}
			self::$activeSheet->SetCellValue('A'.$row, 'Subtotal');
			$i = $row -12;
			$j = $row -1;
			self::$activeSheet->SetCellValue('B'.$row, '=SUM(B'.$i.':B'.$j.')');
			self::$activeSheet->SetCellValue('C'.$row, '=SUM(C'.$i.':C'.$j.')');
			self::$activeSheet->SetCellValue('D'.$row, '=SUM(D'.$i.':D'.$j.')');
			self::$activeSheet->SetCellValue('E'.$row, '=SUM(E'.$i.':E'.$j.')');
			self::$activeSheet->SetCellValue('F'.$row, '=SUM(F'.$i.':F'.$j.')');
			self::$activeSheet->SetCellValue('G'.$row, '=SUM(G'.$i.':G'.$j.')');
			self::$activeSheet->SetCellValue('H'.$row, '=SUM(H'.$i.':H'.$j.')');
			self::$activeSheet->SetCellValue('I'.$row, '=SUM(I'.$i.':I'.$j.')');
			self::$activeSheet->SetCellValue('J'.$row, '=SUM(J'.$i.':J'.$j.')');
			self::$activeSheet->SetCellValue('K'.$row, '=SUM(K'.$i.':K'.$j.')');
			self::$activeSheet->SetCellValue('L'.$row, '=SUM(L'.$i.':L'.$j.')');
			self::$activeSheet->SetCellValue('M'.$row, '=SUM(M'.$i.':M'.$j.')');
			
			$row += 1;
			$i = $row - 1;
			self::$activeSheet->SetCellValue('A'.$row, 'TOTAL');
			self::$activeSheet->SetCellValue('B'.$row, '=SUM(B'.$i.':C'.$i.')');
			self::$activeSheet->SetCellValue('D'.$row, '=SUM(D'.$i.':E'.$i.')');
			self::$activeSheet->SetCellValue('F'.$row, '=SUM(F'.$i.':G'.$i.')');
			self::$activeSheet->SetCellValue('H'.$row, '=SUM(H'.$i.':I'.$i.')');
			self::$activeSheet->SetCellValue('J'.$row, '=SUM(J'.$i.':L'.$i.')');
			self::$activeSheet->SetCellValue('M'.$row, '=SUM(H'.$row.':J'.$row.')');
			
			
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
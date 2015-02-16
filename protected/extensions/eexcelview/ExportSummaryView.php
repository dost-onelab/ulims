<?php

Yii::import('zii.widgets.grid.CGridView');
	/**
	* @author Nikola Kostadinov
	* @license GPL
	* @version 0.2
	*/	
	class ExportSummaryView extends CGridView
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
		public $requests;
		//public $customer;
		//public $samples;
		//public $summaries;
		//public $header;
		//public $year;
		
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
			//$this->populateReport();
			$allborders = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => '00000000'),
					),
				),
			);
			$row = 8;
			foreach($this->requests as $request){
				self::$activeSheet->getStyle('A'.$row.':S'.$row)->applyFromArray($allborders);
				self::$activeSheet->SetCellValue('A'.$row, $request->requestRefNum);
				self::$activeSheet->getStyle('B'.$row)->getAlignment()->setWrapText(true);
				self::$activeSheet->SetCellValue('B'.$row, $request->customer->customerName);
				self::$activeSheet->getStyle('C'.$row)->getAlignment()->setWrapText(true);
				self::$activeSheet->SetCellValue('C'.$row, $request->customer->address);
				
				self::$activeSheet->getStyle('D'.$row.':E'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				self::$activeSheet->SetCellValue('D'.$row, ($request->customer->typeId == 2) ? '1' : '-');
				self::$activeSheet->SetCellValue('E'.$row, ($request->customer->typeId == 1) ? '1' : '-');
				
				self::$activeSheet->SetCellValue('N'.$row, $request->total);
				self::$activeSheet->getStyle('N'.$row.':T'.$row)->getNumberFormat()->setFormatCode('#,##0.00');
				self::$activeSheet->SetCellValue('O'.$row, (($request->customer->typeId == 2) AND ($request->paymentType == 1)) ? $request->total : '-');
				self::$activeSheet->SetCellValue('P'.$row, (($request->customer->typeId == 1)  AND ($request->paymentType == 1))? $request->total : '-');
				self::$activeSheet->SetCellValue('Q'.$row, (($request->customer->typeId == 2) AND ($request->paymentType == 2)) ? $request->total : '-');
				self::$activeSheet->SetCellValue('R'.$row, (($request->customer->typeId == 1)  AND ($request->paymentType == 2))? $request->total : '-');
				
				self::$activeSheet->SetCellValue('S'.$row, ($request->discount) ? (($request->total / 0.75) * 0.25) : '-');
				
				foreach($request->samps as $sample){
					self::$activeSheet->getStyle('F'.$row)->getAlignment()->setWrapText(true);
					self::$activeSheet->SetCellValue('F'.$row, $sample->sampleName);
					self::$activeSheet->SetCellValue('G'.$row, $sample->sampleCode);
					self::$activeSheet->getStyle('H'.$row.':I'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					self::$activeSheet->SetCellValue('H'.$row, ($request->customer->typeId == 2) ? '1' : '-');
					self::$activeSheet->SetCellValue('I'.$row, ($request->customer->typeId == 1) ? '1' : '-');
					
					foreach($sample->analyses as $test){
						self::$activeSheet->SetCellValue('J'.$row, $test->testName);
						self::$activeSheet->getStyle('K'.$row)->getNumberFormat()->setFormatCode('#,##0.00');
						self::$activeSheet->SetCellValue('K'.$row, $test->fee);
						self::$activeSheet->getStyle('L'.$row.':M'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						self::$activeSheet->SetCellValue('L'.$row, ($request->customer->typeId == 2) ? '1' : '-');
						self::$activeSheet->SetCellValue('M'.$row, ($request->customer->typeId == 1) ? '1' : '-');
						self::$activeSheet->getStyle('A'.$row.':T'.$row)->applyFromArray($allborders);
						$row += 1;
						
					}
					
				}
				$row += 1;
			}
			$lastRow = $row - 1;
			self::$activeSheet->getStyle('A'.$row.':T'.$row)->getFont()->setBold(true); 
			//self::$activeSheet->getStyle('A'.$row.':S'.$row)->applyFromArray($allborders);
			
			self::$activeSheet->getStyle('D'.$row.':E'.$row)->applyFromArray($allborders);
			self::$activeSheet->getStyle('D'.$row.':E'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			self::$activeSheet->SetCellValue('D'.$row, '=SUM(D8:D'.$lastRow.')');
			self::$activeSheet->SetCellValue('E'.$row, '=SUM(E8:E'.$lastRow.')');
			
			self::$activeSheet->getStyle('H'.$row.':I'.$row)->applyFromArray($allborders);
			self::$activeSheet->getStyle('H'.$row.':I'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			self::$activeSheet->SetCellValue('H'.$row, '=SUM(H8:H'.$lastRow.')');
			self::$activeSheet->SetCellValue('I'.$row, '=SUM(I8:I'.$lastRow.')');
			
			self::$activeSheet->getStyle('K'.$row.':S'.$row)->applyFromArray($allborders);
			self::$activeSheet->getStyle('K'.$row)->getNumberFormat()->setFormatCode('#,##0.00');
			self::$activeSheet->SetCellValue('K'.$row, '=SUM(K8:K'.$lastRow.')');
			
			self::$activeSheet->getStyle('L'.$row.':M'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			self::$activeSheet->SetCellValue('L'.$row, '=SUM(L8:L'.$lastRow.')');
			self::$activeSheet->SetCellValue('M'.$row, '=SUM(M8:M'.$lastRow.')');
			
			self::$activeSheet->getStyle('N'.$row.':S'.$row)->getNumberFormat()->setFormatCode('#,##0.00');
			self::$activeSheet->SetCellValue('N'.$row, '=SUM(N8:N'.$lastRow.')');
			self::$activeSheet->SetCellValue('O'.$row, '=SUM(O8:O'.$lastRow.')');
			self::$activeSheet->SetCellValue('P'.$row, '=SUM(P8:P'.$lastRow.')');
			self::$activeSheet->SetCellValue('Q'.$row, '=SUM(Q8:Q'.$lastRow.')');
			self::$activeSheet->SetCellValue('R'.$row, '=SUM(R8:R'.$lastRow.')');
			self::$activeSheet->SetCellValue('S'.$row, '=SUM(S8:S'.$lastRow.')');
		}

		function formatPage(){
			self::$activeSheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
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
    		
    		self::$activeSheet->getStyle('A5:T7')->applyFromArray($allborders);
    		self::$activeSheet->getStyle('A5:T7')->applyFromArray($grey);
    		self::$activeSheet->getStyle('A5:T7')->getFont()->setBold(true); 
    		self::$activeSheet->getStyle('A5:T7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    		self::$activeSheet->getStyle('A5:T7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    		self::$activeSheet->getColumnDimension('A')->setWidth(20);
    		self::$activeSheet->getColumnDimension('B')->setWidth(35);
    		self::$activeSheet->getColumnDimension('C')->setWidth(35);
    		self::$activeSheet->getColumnDimension('D')->setWidth(10);	
    		self::$activeSheet->getColumnDimension('E')->setWidth(10);
    		self::$activeSheet->getColumnDimension('F')->setWidth(25);
    		self::$activeSheet->getColumnDimension('G')->setWidth(10);
    		self::$activeSheet->getColumnDimension('H')->setWidth(10);
    		
    		self::$activeSheet->getColumnDimension('I')->setWidth(10);
    		self::$activeSheet->getColumnDimension('J')->setWidth(35);
    		self::$activeSheet->getColumnDimension('K')->setWidth(12);
    		self::$activeSheet->getColumnDimension('L')->setWidth(10);
    		self::$activeSheet->getColumnDimension('M')->setWidth(10);
    		self::$activeSheet->getColumnDimension('N')->setWidth(12);
    		self::$activeSheet->getColumnDimension('O')->setWidth(12);
    		self::$activeSheet->getColumnDimension('P')->setWidth(12);
    		self::$activeSheet->getColumnDimension('Q')->setWidth(12);
    		self::$activeSheet->getColumnDimension('R')->setWidth(12);
    		self::$activeSheet->getColumnDimension('S')->setWidth(12);  

    		self::$activeSheet->mergeCells('A5:A7');
    		self::$activeSheet->getStyle('A5')->getAlignment()->setWrapText(true);
    		self::$activeSheet->SetCellValue('A5', 'Request Reference Number');
    		
    		self::$activeSheet->mergeCells('B5:E6');
    		self::$activeSheet->SetCellValue('B5', 'Customers');
    		self::$activeSheet->SetCellValue('B7', 'Name of Client');
    		self::$activeSheet->SetCellValue('C7', 'Address');
    		self::$activeSheet->SetCellValue('D7', 'Non-Setup');
    		self::$activeSheet->SetCellValue('E7', 'Setup');
    		
    		self::$activeSheet->mergeCells('F5:I6');
    		self::$activeSheet->SetCellValue('F5', 'Samples');
    		self::$activeSheet->SetCellValue('F7', 'Name');
    		self::$activeSheet->SetCellValue('G7', 'Code');
    		self::$activeSheet->SetCellValue('H7', 'Non-Setup');
    		self::$activeSheet->SetCellValue('I7', 'Setup');
    		
    		self::$activeSheet->mergeCells('J5:M6');
    		self::$activeSheet->SetCellValue('J5', 'Tests');
    		self::$activeSheet->SetCellValue('J7', 'Params');
    		self::$activeSheet->SetCellValue('K7', 'Unit Price');
    		self::$activeSheet->SetCellValue('L7', 'Non-Setup');
    		self::$activeSheet->SetCellValue('M7', 'Setup');
    		
    		self::$activeSheet->mergeCells('N5:S5');
    		self::$activeSheet->SetCellValue('N5', 'Amount');
    		
    		self::$activeSheet->mergeCells('N6:N7');
    		self::$activeSheet->SetCellValue('N6', 'Total');
    		
    		self::$activeSheet->mergeCells('O6:P6');
    		self::$activeSheet->SetCellValue('O6', 'Paid');
    		self::$activeSheet->SetCellValue('O7', 'Non-Setup');
    		self::$activeSheet->SetCellValue('P7', 'Setup');
    		
    		self::$activeSheet->mergeCells('Q6:R6');
    		self::$activeSheet->SetCellValue('Q6', 'Gratis');
    		self::$activeSheet->SetCellValue('Q7', 'Non-Setup');
    		self::$activeSheet->SetCellValue('R7', 'Setup');
    		
    		self::$activeSheet->mergeCells('S6:S7');
    		self::$activeSheet->SetCellValue('S6', '25%');
    		
    		self::$activeSheet->mergeCells('T6:T7');
    		self::$activeSheet->SetCellValue('T6', 'Balance');
    					
		}
		
		function populateReport(){
			$row = 7;
			foreach($this->reports as $report){
				$month = 1;
				foreach($report as $monthly){
					
					self::$activeSheet->SetCellValue('A'.$row, date("M", mktime(0, 0, 0, $month, 1, $year)));
					
					self::$activeSheet->SetCellValue('B'.$row, $monthly['samples']['nonsetup']);
					
					self::$activeSheet->SetCellValue('C'.$row, $monthly['customer']['address']);
					self::$activeSheet->SetCellValue('D'.$row, $monthly['samples']['setup']);
					
					self::$activeSheet->SetCellValue('E'.$row, $monthly['tests']['nonsetup']);
					self::$activeSheet->SetCellValue('F'.$row, $monthly['tests']['setup']);
					
					self::$activeSheet->SetCellValue('G'.$row, $monthly['customers']['nonsetup']);
					self::$activeSheet->SetCellValue('H'.$row, $monthly['customers']['setup']);
					
					self::$activeSheet->SetCellValue('I'.$row, $monthly['income']['nonsetup']);
					self::$activeSheet->SetCellValue('J'.$row, $monthly['income']['setup']);
					
					self::$activeSheet->getStyle('K'.$row)->getNumberFormat()->setFormatCode('#,##0.00');
					self::$activeSheet->SetCellValue('K'.$row, $monthly['value']['gratis_nonsetup']);
					self::$activeSheet->SetCellValue('L'.$row, $monthly['value']['gratis_setup']);
					
					self::$activeSheet->SetCellValue('M'.$row, $monthly['value']['discount']);
					self::$activeSheet->SetCellValue('N'.$row, '=SUM(H'.$row.':L'.$row.')');
					$row += 1;
					$month += 1;
				}
				self::$activeSheet->SetCellValue('A'.$row, 'Subtotal');
				$i = $row -12;
				$j = $row -1;
				self::$activeSheet->SetCellValue('C'.$row, '=SUM(B'.$i.':B'.$j.')');
				self::$activeSheet->SetCellValue('D'.$row, '=SUM(C'.$i.':C'.$j.')');
				self::$activeSheet->SetCellValue('E'.$row, '=SUM(D'.$i.':D'.$j.')');
				self::$activeSheet->SetCellValue('F'.$row, '=SUM(E'.$i.':E'.$j.')');
				self::$activeSheet->SetCellValue('G'.$row, '=SUM(F'.$i.':F'.$j.')');
				self::$activeSheet->SetCellValue('H'.$row, '=SUM(G'.$i.':G'.$j.')');
				self::$activeSheet->SetCellValue('I'.$row, '=SUM(H'.$i.':H'.$j.')');
				self::$activeSheet->SetCellValue('J'.$row, '=SUM(I'.$i.':I'.$j.')');
				self::$activeSheet->SetCellValue('K'.$row, '=SUM(J'.$i.':J'.$j.')');
				self::$activeSheet->SetCellValue('L'.$row, '=SUM(K'.$i.':K'.$j.')');
				self::$activeSheet->SetCellValue('M'.$row, '=SUM(L'.$i.':L'.$j.')');
				self::$activeSheet->SetCellValue('N'.$row, '=SUM(M'.$i.':M'.$j.')');
				
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
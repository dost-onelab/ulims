<?php

Yii::import('zii.widgets.grid.CGridView');
	/**
	* @author Nikola Kostadinov
	* @license GPL
	* @version 0.2
	*/	
	class EExcelViewPrintReceipt extends CGridView
	{
		// PHP Excel Path
		public static $phpExcelPathAlias = 'ext.phpexcel.Classes.PHPExcel';
	
		//the PHPExcel object
		public static $objPHPExcel = null;
		public static $activeSheet = null;
	
		//Document properties
		public $creator = 'Aris Moratalla';
		public $title = null;
		public $subject = 'Subject';
		public $description = '';
		public $category = '';
		
		//config
		public $autoWidth = false;
		public $exportType = 'Excel5';
		public $disablePaging = true;
		public $filename = null; //export FileName ->original value = null
		public $stream = true; //stream to browser

		//data
		//For performance reason, it's good to have it static and populate it once in all the execution
		public static $data = null;
		
		//models
		public $receipt;
		public $collection;
		public $collectionType;
		public $totalInWords;
		public $checks;
		public $agency='DOST';
		//public $paymentMode;
		
		//public $grid_mode;
		
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
			//PAGE SETUP
			self::$activeSheet->getPageMargins()->setLeft(0.35);
			
			//SET COLUMN WIDTHs
			self::$activeSheet->getColumnDimension('A')->setWidth(9);
			self::$activeSheet->getColumnDimension('B')->setWidth(9);
			self::$activeSheet->getColumnDimension('C')->setWidth(10);
			self::$activeSheet->getColumnDimension('D')->setWidth(17);
			
			//SET ROW HEIGHT
			self::$activeSheet->getRowDimension('9')->setRowHeight(17);
			self::$activeSheet->getRowDimension('13')->setRowHeight(25);
			
			//foreach($this->receipt as $res){
				self::$activeSheet->SetCellValue('C9', '               '.date('m/d/Y',strtotime($this->receipt->receiptDate)));
				self::$activeSheet->SetCellValue('B11', '    '.$this->agency);
				self::$activeSheet->SetCellValue('B12', $this->receipt->payor);
				
				//$collectionType = Collectiontype::model()->findByPk($_SESSION['CollectionType']);
				self::$activeSheet->SetCellValue('A15', '    '.$this->receipt->typeOfCollection->natureOfCollection);
				
				$total = 0;
				$row = 16;
				foreach($this->collection as $collect)
				{
					self::$activeSheet->getRowDimension($row)->setRowHeight(17);
					self::$activeSheet->SetCellValue('A'.$row, $collect->nature);
					
					self::$activeSheet->getStyle('D'.$row)->getNumberFormat()->setFormatCode('#,##0.00');
					self::$activeSheet->SetCellValue('D'.$row, $collect->amount);
				
					$row = $row + 1;
					$total = $total + $collect['amount'];
				}
				//self::$activeSheet->getStyle('D27')->getNumberFormat()->setFormatCode('#,##0.00');
				//self::$activeSheet->SetCellValue('D27', $total);
				self::$activeSheet->getStyle('D24')->getNumberFormat()->setFormatCode('#,##0.00');
				self::$activeSheet->SetCellValue('D24', $total);
				
				self::$activeSheet->getRowDimension('25')->setRowHeight(7);
				self::$activeSheet->mergeCells('A26:D27');
				self::$activeSheet->getStyle('A26:D27')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
				self::$activeSheet->getStyle('A26:D27')->getAlignment()->setWrapText(true);
				
				self::$activeSheet->getRowDimension('26')->setRowHeight(24);
				self::$activeSheet->SetCellValue('A26', '                                        '.$this->totalInWords);
				
				if($this->receipt->paymentModeId == 1) {
					self::$activeSheet->SetCellValue('A28', '/');}
				if($this->receipt->paymentModeId == 2) {
					$row = 29;
					foreach($this->checks as $check){
						self::$activeSheet->SetCellValue('A'.$row, '/');
						self::$activeSheet->SetCellValue('B'.$row, '            '.$check->bank.'      '.$check->checknumber.' - '.date('m/d/Y',strtotime($check->checkdate)));
						//self::$activeSheet->SetCellValue('C'.$row, $check->bank);
						//self::$activeSheet->SetCellValue('C'.$row, "    '".$check->checknumber);
						//self::$activeSheet->SetCellValue('C'.$row, '       '.$check->checknumber.' - '.date('m/d/Y',strtotime($check->checkdate)));
						//self::$activeSheet->SetCellValue('D'.$row, '    '.date('m/d/Y',strtotime($check->checkdate)));
						//self::$activeSheet->SetCellValue('E'.$row, date('m/d/Y',strtotime($check->checkdate)));
						self::$activeSheet->getStyle('D'.$row.':E'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$row += 1;
					}
				}
				if($this->receipt->paymentModeId == 3) {
						//self::$activeSheet->SetCellValue('A30', '/');
						//self::$activeSheet->SetCellValue('C30', "'".$res->check_money_number);
						//self::$activeSheet->SetCellValue('D30', date('m/d/Y',strtotime($res->checkdate)));
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

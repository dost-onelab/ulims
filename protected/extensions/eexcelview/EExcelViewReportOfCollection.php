<?php
	Yii::import('zii.widgets.grid.CGridView');

	/**
	* @author Nikola Kostadinov
	* @license MIT License
	* @version 0.3
	*/	
	class EExcelViewReportOfCollection extends CGridView
	{
		//Document properties
		public $creator = 'Nikola Kostadinov';
		public $title = null;
		public $subject = 'Subject';
		public $description = '';
		public $category = '';

		//the PHPExcel object
		public $objPHPExcel = null;
		public $libPath = 'ext.phpexcel.Classes.PHPExcel'; //the path to the PHP excel lib

		//config
		public $autoWidth = true;
		public $exportType = 'Excel5';
		public $disablePaging = true;
		public $filename = null; //export FileName
		public $stream = true; //stream to browser
		public $grid_mode = 'grid'; //Whether to display grid ot export it to selected format. Possible values(grid, export)
		public $grid_mode_var = 'grid_mode'; //GET var for the grid mode
		
		//buttons config
		public $exportButtonsCSS = 'summary';
		public $exportButtons = array('Excel2007');
		public $exportText = 'Export to: ';

		//callbacks
		public $onRenderHeaderCell = null;
		public $onRenderDataCell = null;
		public $onRenderFooterCell = null;
		
		public $minDate;
		public $maxDate;
		public $year;
		
		//mime types used for streaming
		public $mimeTypes = array(
			'Excel5'	=> array(
				'Content-type'=>'application/vnd.ms-excel',
				'extension'=>'xls',
				'caption'=>'Excel(*.xls)',
			),
			'Excel2007'	=> array(
				'Content-type'=>'application/vnd.ms-excel',
				'extension'=>'xlsx',
				'caption'=>'Excel(*.xlsx)',				
			),
			'PDF'		=>array(
				'Content-type'=>'application/pdf',
				'extension'=>'pdf',
				'caption'=>'PDF(*.pdf)',								
			),
			'HTML'		=>array(
				'Content-type'=>'text/html',
				'extension'=>'html',
				'caption'=>'HTML(*.html)',												
			),
			'CSV'		=>array(
				'Content-type'=>'application/csv',			
				'extension'=>'csv',
				'caption'=>'CSV(*.csv)',												
			)
		);

		public function init()
		{
			if(isset($_GET[$this->grid_mode_var]))
				$this->grid_mode = $_GET[$this->grid_mode_var];
			if(isset($_GET['exportType']))
				$this->exportType = $_GET['exportType'];
				
			$lib = Yii::getPathOfAlias($this->libPath).'.php';
			if($this->grid_mode == 'export' and !file_exists($lib)) {
				$this->grid_mode = 'grid';
				Yii::log("PHP Excel lib not found($lib). Export disabled !", CLogger::LEVEL_WARNING, 'EExcelview');
			}
				
			if($this->grid_mode == 'export')
			{			
				$this->title = $this->title ? $this->title : Yii::app()->getController()->getPageTitle();
				$this->initColumns();
				//parent::init();
				//Autoload fix
				spl_autoload_unregister(array('YiiBase','autoload'));             
				Yii::import($this->libPath, true);
				$this->objPHPExcel = new PHPExcel();
				spl_autoload_register(array('YiiBase','autoload'));  
				// Creating a workbook
				$this->objPHPExcel->getProperties()->setCreator($this->creator);
				$this->objPHPExcel->getProperties()->setTitle($this->title);
				$this->objPHPExcel->getProperties()->setSubject($this->subject);
				$this->objPHPExcel->getProperties()->setDescription($this->description);
				$this->objPHPExcel->getProperties()->setCategory($this->category);
			} else
				parent::init();
		}

		public function renderHeader()
		{
			//SET COLUMN WIDTHs
			$this->objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
			$this->objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
			$this->objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
			$this->objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
			$this->objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(14);
			$this->objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(14);
			
			$this->objPHPExcel->getActiveSheet()->mergeCells('A1:F1');
			$this->objPHPExcel->getActiveSheet()->mergeCells('A2:F2');
			$this->objPHPExcel->getActiveSheet()->mergeCells('A3:F3');
			$this->objPHPExcel->getActiveSheet()->getStyle('A1:F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->objPHPExcel->getActiveSheet()->getStyle('E4:F4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			$this->objPHPExcel->getActiveSheet()->getStyle('A4:F4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->objPHPExcel->getActiveSheet()->getStyle('A4:B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->objPHPExcel->getActiveSheet()->SetCellValue('A1', 'REPORT OF COLLECTION & DEPOSITS');
			$this->objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Department of Science and Technology - IX');
			$this->objPHPExcel->getActiveSheet()->SetCellValue('A3', 'For the month of '.date("F", strtotime($this->minDate)).' '.$this->year);
			
			$this->objPHPExcel->getActiveSheet()->SetCellValue('A4', 'DATE');
			$this->objPHPExcel->getActiveSheet()->SetCellValue('B4', 'OR NO.');
			$this->objPHPExcel->getActiveSheet()->SetCellValue('C4', 'NAME OF PAYOR');
			$this->objPHPExcel->getActiveSheet()->SetCellValue('D4', 'NATURE OF COLLECTION');
			$this->objPHPExcel->getActiveSheet()->getStyle('E4:F4')->getAlignment()->setWrapText(true);
			$this->objPHPExcel->getActiveSheet()->SetCellValue('E4', 'COLLECTION BTR');
			$this->objPHPExcel->getActiveSheet()->SetCellValue('F4', 'COLLECTION PROJECT');
			
			$a=0;
			foreach($this->columns as $column)
			{
				$a=$a+1;
				if($column instanceof CButtonColumn)
					$head = $column->header;
				elseif($column->header===null && $column->name!==null)
				{
					if($column->grid->dataProvider instanceof CActiveDataProvider)
						$head = $column->grid->dataProvider->model->getAttributeLabel($column->name);
					else
						$head = $column->name;
				} else
					$head =trim($column->header)!=='' ? $column->header : $column->grid->blankDisplay;

				$cell = $this->objPHPExcel->getActiveSheet()->setCellValue($this->columnName($a)."5" ,$head, true);
				if(is_callable($this->onRenderHeaderCell))
					call_user_func_array($this->onRenderHeaderCell, array($cell, $head));				
			}			
		}

		public function renderBody()
		{
			if($this->disablePaging) //if needed disable paging to export all data
				$this->dataProvider->pagination = false;

			$data=$this->dataProvider->getData();
			$n=count($data);

			if($n>0)
			{
				for($row=0;$row<$n;++$row)
					$this->renderRow($row);
			}
            return $n;
		}

		public function renderRow($row)
		{
			$data=$this->dataProvider->getData();			

			$a=0;
			foreach($this->columns as $n=>$column)
			{
				if($column instanceof CLinkColumn)
				{
					if($column->labelExpression!==null)
						$value=$column->evaluateExpression($column->labelExpression,array('data'=>$data[$row],'row'=>$row));
					else
						$value=$column->label;
				} elseif($column instanceof CButtonColumn)
					$value = ""; //Dont know what to do with buttons
				elseif($column->value!==null) 
					$value=$this->evaluateExpression($column->value ,array('data'=>$data[$row]));
				elseif($column->name!==null) { 
					//$value=$data[$row][$column->name];
					$value= CHtml::value($data[$row], $column->name);
				    $value=$value===null ? "" : $column->grid->getFormatter()->format($value,'raw');
                }             

				$a++;
				$cell = $this->objPHPExcel->getActiveSheet()->setCellValue($this->columnName($a).($row+5) , strip_tags($value), true);				
				if(is_callable($this->onRenderDataCell))
					call_user_func_array($this->onRenderDataCell, array($cell, $data[$row], $value));

					
			/** Apply borders for each row data : Start **/
			$styleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => '00000000'),
					),
				),
			);
			$this->objPHPExcel->getActiveSheet()->getStyle('A'.($row+4).':F'.($row+6))->applyFromArray($styleArray);
			$this->objPHPExcel->getActiveSheet()->getStyle('E'.($row+5))->getNumberFormat()->setFormatCode('#,##0.00');
			$this->objPHPExcel->getActiveSheet()->getStyle('F'.($row+5))->getNumberFormat()->setFormatCode('#,##0.00');
			/** Apply borders for each row data : End **/	
			}				
		}

		public function renderFooter($row)
		{
			$a=0;
			foreach($this->columns as $n=>$column)
			{
				$a=$a+1;
                if($column->footer)
                {
					$footer =trim($column->footer)!=='' ? $column->footer : $column->grid->blankDisplay;

				    $cell = $this->objPHPExcel->getActiveSheet()->setCellValue($this->columnName($a).($row+7) ,$footer, true);
				    if(is_callable($this->onRenderFooterCell))
					    call_user_func_array($this->onRenderFooterCell, array($cell, $footer));				
                }
			} 
			
			//custom footer
			
			$row2 = $row + 4;
			$rowTotal = $row + 5;
			$this->objPHPExcel->getActiveSheet()->setCellValue('E'.($row2+1),'=SUM(E5:E'.($row2).')');
			$this->objPHPExcel->getActiveSheet()->setCellValue('F'.($row2+1),'=SUM(F5:F'.($row2).')');
			$this->objPHPExcel->getActiveSheet()->getStyle('E'.($row2+1))->getNumberFormat()->setFormatCode('#,##0.00');
			$this->objPHPExcel->getActiveSheet()->getStyle('F'.($row2+1))->getNumberFormat()->setFormatCode('#,##0.00');
			
			$row2 += 2;
			$this->objPHPExcel->getActiveSheet()->mergeCells('A'.$row2.':F'.$row2);
			$this->objPHPExcel->getActiveSheet()->getStyle('E4:F4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->objPHPExcel->getActiveSheet()->setCellValue('A'.$row2,'Summary:');
			
			$row2 += 1;
			$this->objPHPExcel->getActiveSheet()->SetCellValue('A'.$row2, 'Undeposited Collections per last report');
			
			$row2 += 1;
			$this->objPHPExcel->getActiveSheet()->SetCellValue('B'.$row2, 'Collection per OR Nos.');
			
			$this->objPHPExcel->getActiveSheet()->getStyle('F'.$row2)->getNumberFormat()->setFormatCode('#,##0.00');
			$this->objPHPExcel->getActiveSheet()->SetCellValue('F'.$row2, '=SUM(E'.$rowTotal.':F'.$rowTotal.')');
			
			$row2 += 1;
			$this->objPHPExcel->getActiveSheet()->SetCellValue('B'.$row2, 'Deposits');
			
			$row2 += 1;
			$this->objPHPExcel->getActiveSheet()->getStyle('D'.$row2.':F'.$row2)->getNumberFormat()->setFormatCode('#,##0.00');
			$this->objPHPExcel->getActiveSheet()->SetCellValue('B'.$row2, date("m/d",strtotime($this->minDate)).' to '.date("m/d/Y",strtotime($this->maxDate)));
			$this->objPHPExcel->getActiveSheet()->SetCellValue('D'.$row2, '=SUM(E'.$rowTotal.':F'.$rowTotal.')');
			$this->objPHPExcel->getActiveSheet()->SetCellValue('F'.$row2, '=SUM(E'.$rowTotal.':F'.$rowTotal.')');
			
			$row2 += 2;
			$this->objPHPExcel->getActiveSheet()->SetCellValue('B'.$row2, 'Undeposited Collections this Report');
			
			$row2 += 2;
			$this->objPHPExcel->getActiveSheet()->mergeCells('A'.$row2.':F'.$row2);
			$this->objPHPExcel->getActiveSheet()->getStyle('A'.$row2)->getAlignment()->setHORIZONTAL(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->objPHPExcel->getActiveSheet()->SetCellValue('A'.$row2, 'CERTIFICATION:');
			
			$row2 += 2;
			$row3 = $row2 + 4;
			$textCert = '     I hereby certify on my official oath that the above is a true statement of all collections received by me during the period stated above for which Official Receipts 0'.$firstOr.' to 0'.$lastOr.' inclusive were actually issued by me in the amounts shown thereon. I also certify that I have not received money from whatever source without having issued the necessary Official receipts in acknowledgement thereof. I certify further that the balance shown above agrees with the balance appearing in my Cash receipts Record.';
			$this->objPHPExcel->getActiveSheet()->mergeCells('A'.$row2.':F'.$row3);
			
			$this->objPHPExcel->getActiveSheet()->getStyle('A'.$row2)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
			$this->objPHPExcel->getActiveSheet()->getStyle('A'.$row2)->getAlignment()->setWrapText(true);
			$this->objPHPExcel->getActiveSheet()->SetCellValue('A'.$row2, $textCert);
		}		

		public function run()
		{
			if($this->grid_mode == 'export')
			{
				$this->renderHeader();
				$row = $this->renderBody();
				$this->renderFooter($row);

				//set auto width
				if($this->autoWidth)
					foreach($this->columns as $n=>$column)
						$this->objPHPExcel->getActiveSheet()->getColumnDimension($this->columnName($n+1))->setAutoSize(true);
				//create writer for saving
				$objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, $this->exportType);
				if(!$this->stream)
					$objWriter->save($this->filename);
				else //output to browser
				{
					if(!$this->filename)
						$this->filename = $this->title;
					$this->cleanOutput();
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Pragma: public');
					header('Content-type: '.$this->mimeTypes[$this->exportType]['Content-type']);
					header('Content-Disposition: attachment; filename="'.$this->filename.'.'.$this->mimeTypes[$this->exportType]['extension'].'"');
					header('Cache-Control: max-age=0');				
					$objWriter->save('php://output');			
					Yii::app()->end();
				}
			} else
				parent::run();
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
		
		public function renderExportButtons()
		{
			foreach($this->exportButtons as $key=>$button)
			{
				$item = is_array($button) ? CMap::mergeArray($this->mimeTypes[$key], $button) : $this->mimeTypes[$button];
				$type = is_array($button) ? $key : $button;
				$url = parse_url(Yii::app()->request->requestUri);
				//$content[] = CHtml::link($item['caption'], '?'.$url['query'].'exportType='.$type.'&'.$this->grid_mode_var.'=export');
				if (key_exists('query', $url))
				    $content[] = CHtml::link($item['caption'], '?'.$url['query'].'&exportType='.$type.'&'.$this->grid_mode_var.'=export');          
				else
				    $content[] = CHtml::link($item['caption'], '?exportType='.$type.'&'.$this->grid_mode_var.'=export');				
			}
			if($content)
				echo CHtml::tag('div', array('class'=>$this->exportButtonsCSS), $this->exportText.implode(', ',$content));	

		}			
		
		/**
		* Performs cleaning on mutliple levels.
		* 
		* From le_top @ yiiframework.com
		* 
		*/
		private static function cleanOutput() 
		{
            for($level=ob_get_level();$level>0;--$level)
            {
                @ob_end_clean();
            }
        }		


	}
	
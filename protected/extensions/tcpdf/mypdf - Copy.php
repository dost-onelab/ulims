<?php
require_once(dirname(__FILE__).'\tcpdf.php');

class mypdf extends TCPDF {
 
    // Load table data from file
    /*public function LoadData($file) {
        // Read file lines
        $lines = file($file);
        $data = array();
        foreach($lines as $line) {
            $data[] = explode(';', chop($line));
        }
        return $data;
    }
    
    // Colored table
    public function ColoredTable($header,$data) {
        // Colors, line width and bold font
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(40, 35, 40, 45);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = 0;
        foreach($data as $row) {
            $this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row[1], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, number_format($row[2]), 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 6, number_format($row[3]), 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill=!$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }*/

    /*public function LoadForm()
    {
        $tbl = '<<<EOD
            <table cellspacing="0" cellpadding="1" border="1">
                <tr>
                    <td rowspan="3">COL 1 - ROW 1<br />COLSPAN 3</td>
                    <td>COL 2 - ROW 1</td>
                    <td>COL 3 - ROW 1</td>
                </tr>
                <tr>
                    <td rowspan="2">COL 2 - ROW 2 - COLSPAN 2<br />text line<br />text line<br />text line<br />text line</td>
                    <td>COL 3 - ROW 2</td>
                </tr>
                <tr>
                   <td>COL 3 - ROW 3</td>
                </tr>

            </table>
            ';
            

            $this->writeHTML($tbl, true, false, false, false, '');
    }*/

    public function Header() 
    {
        if ($this->header_xobjid === false) {
        	$request = Request::model()->findByPk(6);
        	
            // start a new XObject Template
            //ena
            /*$this->header_xobjid = $this->startTemplate($this->w, $this->tMargin);
            $headerfont = $this->getHeaderFont();
            $headerdata = $this->getHeaderData();
            $headerdata = array(
            	'agencyName'=>Yii::app()->params['Agency']['name'],
            	'rstl'=>'<b>'.strtoupper(Yii::app()->params['Agency']['labName']).'</b>',
            	'agencyAddress'=>Yii::app()->params['Agency']['address'],
            	'agencyContactInfo'=>'Contact No. '.Yii::app()->params['Agency']['contacts'],
            	'formTitle'=>'<b>'.Yii::app()->params['FormRequest']['title'].'<b>'
            );*/
            
            /*$this->y = $this->header_margin;
            if ($this->rtl) {
                $this->x = $this->w - $this->original_rMargin;
            } else {
                $this->x = $this->original_lMargin;
            }*/
            /*if (($headerdata['logo']) AND ($headerdata['logo'] != K_BLANK_IMAGE)) {
                $imgtype = TCPDF_IMAGES::getImageFileType(K_PATH_IMAGES.$headerdata['logo']);
                if (($imgtype == 'eps') OR ($imgtype == 'ai')) {
                    $this->ImageEps(K_PATH_IMAGES.$headerdata['logo'], '', '', $headerdata['logo_width']);
                } elseif ($imgtype == 'svg') {
                    $this->ImageSVG(K_PATH_IMAGES.$headerdata['logo'], '', '', $headerdata['logo_width']);
                } else {
                    $this->Image(K_PATH_IMAGES.$headerdata['logo'], '', '', $headerdata['logo_width']);
                }
                $imgy = $this->getImageRBY();
            } else {
                $imgy = $this->y;
            }*/
            //$cell_height = $this->getCellHeight($headerfont[2] / $this->k);
            // set starting margin for text data cell
            /*if ($this->getRTL()) {
                $header_x = $this->original_rMargin + ($headerdata['logo_width'] * 1.1);
            } else {
                $header_x = $this->original_lMargin + ($headerdata['logo_width'] * 1.1);
            }*/
            //$cw = $this->w - $this->original_lMargin - $this->original_rMargin - ($headerdata['logo_width'] * 1.1);
            //$this->SetTextColorArray($this->header_text_color);
            // header title
            //$this->SetFont($headerfont[0], 'B', $headerfont[2] + 1);
            //$this->SetX($header_x);
            //$this->Cell($cw, $cell_height, $headerdata['title'], 0, 1, '', 0, '', 0);
            // header string
            //$this->SetFont($headerfont[0], $headerfont[1], $headerfont[2]);
            //$this->SetX($header_x);
            

            // ena
            /*$this->SetFont('helvetica','',9);
            $this->MultiCell(200, 0, $headerdata['agencyName'], 0, 'C', 0, 1, 5, 8, true, 0, true, true, 0, 'T', false);
            $this->MultiCell(200, 0, $headerdata['rstl'], 0, 'C', 0, 1, 5, 12.25, true, 0, true, true, 0, 'T', false);
            $this->MultiCell(200, 0, $headerdata['agencyAddress'], 0, 'C', 0, 1, 5, 16.50, true, 0, true, true, 0, 'T', false);
            $this->MultiCell(200, 0, $headerdata['agencyContactInfo'], 0, 'C', 0, 1, 5, 20.75, true, 0, true, true, 0, 'T', false);
            
            $this->SetFont('helvetica','',12);
            $this->MultiCell(200, 0, '<br/><br/>'.$headerdata['formTitle'], 0, 'C', 0, 1, 5, 25, true, 0, true, true, 0, 'T', false);
            */
            /*$this->MultiCell(209.75, 0, 
            					 $headerdata['agencyName'].$headerdata['rstl'].$headerdata['agencyAddress'].$headerdata['agencyContactInfo'].$headerdata['formTitle'], 
            					 '', 'C', 0, 1, 0, 7, true, 0, true, true, 0, 'T', false
            				);*/
            
            
            // ena

            /*$this->SetFont('helvetica','',9);

            $class = '
                <style>
                  table {
                    font-style: arial;
                    border: 0.5px solid #000;
                    width: 46%;
                    padding-left: 2px;
                  }
                  table tr{
                    border: 0.5px solid #000;
                  }
                  table tr td{
                    border-bottom: 0.5px solid #000;
                    text-align: left;                    
                  }
                </style>
            ';

            $html = '
                <table>
                    <tr>
                        <td width="80">Req. Ref. No.:</td>
                        <td width="190">'.$request->requestRefNum.'</td>
                    </tr>
                    <tr>
                        <td width="80">Date:</td>
                        <td width="190">'.$request->requestDate.'</td>
                    </tr>
                    <tr>
                        <td width="80">Time:</td>
                        <td width="190">'.$request->requestTime.'</td>
                    </tr>
                </table>
            ';
            $this->writeHTMLCell('','',5,45,$class.$html);

            $this->MultiCell(145, 0, '&nbsp;CUSTOMER:<br/>&nbsp;ADDRESS:', 0, 'L', 0, 1, 5, 62, false, 0, true, true);
            $this->MultiCell(55, 0, ' TEL NO.:', 0, 'L', 0, 1, 150, 62);
            $this->MultiCell(55, 0, ' FAX NO.:', 0, 'L', 0, 1, 150, 66.25);
            
            $this->MultiCell(145, 0, '&nbsp;CUSTOMER:<br/>&nbsp;ADDRESS:', 0, 'L', 0, 1, 5, 62, false, 0, true, true);
            
            $class = '
            	<style>
				  table {
				  	font-style: arial;
				    border: 0.5px solid #000;
				    width: 97.5%;
				  }
        		  th{
        			border: 0.5px solid #000;
        			text-align: center;
        			vertical-align: bottom;
        		  }
        		  td{
        			border: 0.5px solid #000;
        			text-align: center;
        			valign: middle;
        		  }
				</style>
            ';
            
            $html = '
            	<table>
            		<tr>
            			<th width="140">SAMPLE</th>
            			<th width="45">SAMPLE<br/>CODE</th>
            			<th width="114">TEST/CALIBRATION<br/>REQUESTED</th>
            			<th width="112">TEST METHOD</th>
            			<th width="52">NO. OF<br/>SAMPLES/<br/>UNITS</th>
            			<th width="52">UNIT<br/>COST</th>
            			<th width="52">TOTAL</th>
            		</tr>
            	</table>
            ';*/
            //$this->writeHTMLCell('','',5,75,$class.$html);

            /*$this->writeHTMLCell(
            	(float) $w, 
            	(float) $h, 
            	(float) $x, 
            	(float) $y, 
            	(string) $html, 
            	(mixed) $border, 
            	(int) $ln, 
            	(boolean) $fill, 
            	(boolean) $reseth, 
            	(string) $align, 
            	(boolean) $autopadding);
            */
            //$this->Cell(50, 7, 'Req. Ref. No.:', 1, 1, 'L', 0, 0);
            /*$this->Cell(
            	1(float) $w, 
            	2(float) $h, 
            	3(string) $txt, 
            	4(mixed) $border, 
            	5(int) $ln, 
            	6(string) $align, 
            	7(boolean) $fill, 
            	8(mixed) $link, 
            	9(int) $stretch, 
            	10(boolean) $ignore_min_height, 
            	11(string) $calign, 
            	12(string) $valign);
			*/
			/*$this->MultiCell(
				1(float) $w, 
				2(float) $h, 
				3(string) $txt, 
				4(mixed) $border, 
				5(string) $align, 
				6(boolean) $fill, 
				7(int) $ln, 
				8(float) $x, 
				9(float) $y, 
				10(boolean) $reseth, 
				11(int) $stretch, 
				12(boolean) $ishtml, 
				13(boolean) $autopadding, 
				14(float) $maxh, 
				15(string) $valign, 
				16(boolean) $fitcell);       
            */
            //$this->MultiCell($cw, $cell_height, $headerdata['string'], 0, '', 0, 1, '', '', true, 0, true, true, 0, 'T', false);
            // print an ending header line
            //$this->SetLineStyle(array('width' => 0.85 / $this->k, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => $headerdata['line_color']));
            /*$this->SetY((2.835 / $this->k) + max($imgy, $this->y));
            if ($this->rtl) {
                $this->SetX($this->original_rMargin);
            } else {
                $this->SetX($this->original_lMargin);
            }*/
            //$this->Cell(($this->w - $this->original_lMargin - $this->original_rMargin), 0, '', 'T', 0, 'C');
            //$this->endTemplate();
        }
        // print header template
        $x = 0;
        $dx = 0;
        if (!$this->header_xobj_autoreset AND $this->booklet AND (($this->page % 2) == 0)) {
            // adjust margins for booklet mode
            $dx = ($this->original_lMargin - $this->original_rMargin);
        }
        if ($this->rtl) {
            $x = $this->w + $dx;
        } else {
            $x = 0 + $dx;
        }
        $this->printTemplate($this->header_xobjid, $x, 0, 0, 0, '', '', false);
        if ($this->header_xobj_autoreset) {
            // reset header xobject template at each page
            $this->header_xobjid = false;
        }
    }

    /**
     * This method is used to render the page footer.
     * It is automatically called by AddPage() and could be overwritten in your own inherited class.
     * @public
     */
    /*public function Footer() {
        $cur_y = $this->y;
        $this->SetTextColorArray($this->footer_text_color);
        //set style for cell border
        $line_width = (0.85 / $this->k);
        $this->SetLineStyle(array('width' => $line_width, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => $this->footer_line_color));
        //print document barcode
        $barcode = $this->getBarcode();
        if (!empty($barcode)) {
            $this->Ln($line_width);
            $barcode_width = round(($this->w - $this->original_lMargin - $this->original_rMargin) / 3);
            $style = array(
                'position' => $this->rtl?'R':'L',
                'align' => $this->rtl?'R':'L',
                'stretch' => false,
                'fitwidth' => true,
                'cellfitalign' => '',
                'border' => false,
                'padding' => 0,
                'fgcolor' => array(0,0,0),
                'bgcolor' => false,
                'text' => false
            );
            $this->write1DBarcode($barcode, 'C128', '', $cur_y + $line_width, '', (($this->footer_margin / 3) - $line_width), 0.3, $style, '');
        }
        $w_page = isset($this->l['w_page']) ? $this->l['w_page'].' ' : '';
        if (empty($this->pagegroups)) {
            $pagenumtxt = $w_page.$this->getAliasNumPage().' / '.$this->getAliasNbPages();
        } else {
            $pagenumtxt = $w_page.$this->getPageNumGroupAlias().' / '.$this->getPageGroupAlias();
        }
        $this->SetY($cur_y);
        //Print page number
        if ($this->getRTL()) {
            $this->SetX($this->original_rMargin);
            $this->Cell(0, 0, $pagenumtxt, 'T', 0, 'L');
        } else {
            $this->SetX($this->original_lMargin);
            $this->Cell(0, 0, $this->getAliasRightShift().$pagenumtxt, 'T', 0, 'R');
        }
    }*/

}
?>

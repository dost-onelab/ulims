<?php
require_once(dirname(__FILE__).'/tcpdf.php');

class referralPdf extends TCPDF {
 
    var $referral;
    var $customerId;

    public function setReferral($referral) {
        $this->referral = $referral;
    }

    public function setCustomer($customer) {
        $this->customer = $customer;
    }

    public function printRows() {
        $referral = $this->referral;

        $classRows = '
                <style>
                  table {
                    font-style: arial;
                    border-top: 0.5px solid #000;
                    border-left: 0.5px solid #000;
                    width: 60%;
                  }
                  td{
                    border-right: 0.5px solid #000;
                    border-bottom: 0.5px solid #000;
                  }
                </style>
            ';

        $rows = '<table>';
                $sampleCount = 0;
                $subTotal = 0;
                //foreach($request->samps as $sample){
                foreach($referral["samples"] as $sample){

                    $rows .='
                        <tr>
                            <td width="140">'.$sample["sampleName"].'<br/>'.$sample["barcode"].'</td>
                            <td style="width: 45px; text-align: center">'.$sample["sampleCode"].'</td>
                            ';
                            $analysisCount = 0;
                            foreach($sample["analyses"] as $analysis){
                                if($analysisCount != 0){
                                    $rows .='
                                        <tr>
                                        <td width="140"></td>
                                        <td width="45"></td>
                                        <td width="114">'.$analysis["testName"]["testName"].'</td>
                                        <td width="112">'.$analysis["method"].'</td>
                                        <td style="width: 52px; text-align: center">1</td>
                                        <td style="width: 52px; text-align: right">'.Yii::app()->format->formatNumber($analysis["fee"]).'</td>
                                        <td style="width: 52px; text-align: right">'.Yii::app()->format->formatNumber($analysis["fee"]).'</td>
                                        ';
                                }else{
                                    $rows .= '
                                        <td width="114">'.$analysis["testName"]["testName"].'</td>
                                        <td width="112">'.$analysis["method"].'</td>
                                        <td style="width: 52px; text-align: center">1</td>
                                        <td style="width: 52px; text-align: right">'.Yii::app()->format->formatNumber($analysis["fee"]).'</td>
                                        <td style="width: 52px; text-align: right">'.Yii::app()->format->formatNumber($analysis["fee"]).'</td>
                                        ';
                                }
                                $rows .='</tr>';
                                $analysisCount = $analysisCount + 1;
                                $subTotal = $subTotal + $analysis["fee"];
                            }
                           
                            
                            
                            //$rows .='</tr>';
                }
             //$discount = $subTotal * $request->disc->rate/100;
             $discount = $referral['discountAmount'];
			 $total = $subTotal - $discount;
					            
             $rows .='
                                        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
                                        <tr>
	                                        <td></td><td></td><td></td><td></td>
	                                        <td style="width: 52px; text-align: center"></td>
	                                        <td style="width: 52px; text-align: right">Sub-Total</td>
	                                        <td style="width: 52px; text-align: right">'.Yii::app()->format->formatNumber($subTotal).'</td>
                                        </tr>
                                        <tr>
	                                        <td></td><td></td><td></td><td></td>
	                                        <td style="width: 52px; text-align: center"></td>
	                                        <td style="width: 52px; text-align: right">Discount</td>
	                                        <td style="width: 52px; text-align: right">'.Yii::app()->format->formatNumber($discount).'</td>
                                        </tr>
                                        <tr>
	                                        <td></td><td></td><td></td><td></td>
	                                        <td style="width: 52px; text-align: center"></td>
	                                        <td style="text-align: right; font-weight: bold;">TOTAL</td>
	                                        <td style="text-align: right; font-weight: bold;">'.Yii::app()->format->formatNumber($total).'</td>
                                        </tr>';
            $rows .= '</table>';
			$rows .= '<table><tr><td></td></tr><table>';
            $this->SetFont('helvetica', '', 8);
            $this->writeHTMLCell(200, '', 4, '',$classRows.$rows, 0, 2);
			
			
            /*$totals .= '
                <tr>
                    <td></td><td></td><td></td><td></td><td></td>
                    <td style="text-align: right;">Sub-Total</td>
                    <td style="text-align: right;">'.Yii::app()->format->formatNumber($subTotal).'</td>
                </tr>
                <tr>
                    <td></td><td></td><td></td><td></td><td></td>
                    <td style="text-align: right;">Discount</td>
                    <td style="text-align: right;">'.Yii::app()->format->formatNumber($discount).'</td>
                </tr>
                <tr>
                    <td></td><td></td><td></td><td></td><td></td>
                    <td style="text-align: right; font-weight: bold;">TOTAL</td>
                    <td style="text-align: right; font-weight: bold;">'.Yii::app()->format->formatNumber($total).'</td>
                </tr>
            ';*/
            //$this->writeHTMLCell(200,'',5,'',$totals, 0, 2);
            //$this->writeHTMLCell(200,'',4,45,$totals, 0, 2);
            
            ##### 2. BRIEF DESCRIPTION OF SAMPLE/REMARKS #####
            $classDescription = '
                <style>
                  table {
                    font-style: arial;
                    border: 0.5px solid #000;
                    width: 97.5%;
                  }
                </style>
            ';
			$classDescriptionTitle = '
                <style>
                  div {
                  	font-size: 9;
    			  }
                </style>
            ';
			
			/** Sample Description **/
			
            $descriptionTitle = '
                <div><b> 2. BRIEF DESCRIPTION OF SAMPLE/REMARKS</b></div>
            ';
            
            $this->writeHTMLCell(200,'',4,'',$classDescriptionTitle.$descriptionTitle, 0, 2);
            
            $classSampleDescription ='<style>
                  table {
                    font-style: arial;
                    width: 100%;
                  }
                  
                  td{
                    text-align: left;
                    valign: middle;
                  }
                  </style>';
            
            $sampleDescription = '<table><tr><td></td></tr>';
            
            foreach($referral["samples"] as $sample)
            {
            	$sampleDescription .= '<tr><td>'.$sample["barcode"].': '.$sample["description"].'</td></tr>';
            }
            $sampleDescription .= '<tr><td></td></tr></table>';
            
            $this->writeHTMLCell(200,'',5,'',$classSampleDescription.$sampleDescription, 1, 2);
            
            $this->writeHTMLCell(200,'',5,'','<table><tr><td></td></tr><table>', 0, 2);
            
            
            /** Total **/ 
            
            $classTotal = '
                <style>
                  
    			  table {
                    font-style: arial;
                    width: 100%;
                    font-size: 10;
                  }
                  
                  td.total{
                    text-align: left;
                    valign: middle;
                    width: 80px;
                  }
                  td.currency{
                    text-align: center;
                    width: 13px;
                  }
                  td.amount{
                  	border-bottom: 1px solid #000;
                    text-align: right;
                    valign: middle;
                    padding: -10px;
                    width: 75px;
                  }
                </style>
            ';
            
            $totalHTML = '<table><tr><td class="total">TOTAL</td><td class="currency">P</td><td class="amount">'.Yii::app()->format->formatNumber($total).'</td></tr></table>';
            $this->writeHTMLCell(60,'',144.75,232,$classTotal.$totalHTML, 0, 2);
            
    }
 
    public function Header() {

        //$request = Request::model()->findByPk(6);
        $referral = $this->referral;
		//print_r($referral);
        $headerdata = array(
                'agencyName'=>Yii::app()->params['Agency']['name'],
                'rstl'=>'<b>'.strtoupper(Yii::app()->params['Agency']['labName']).'</b>',
                'agencyAddress'=>Yii::app()->params['Agency']['address'],
                'agencyContactInfo'=>'Contact No. '.Yii::app()->params['Agency']['contacts'],
                'formTitle'=>'<b>'.Yii::app()->params['FormRequest']['title'].'<b>'
            );
		
        $this->SetFont('helvetica','',9);
        $this->MultiCell(200, 0, $headerdata['agencyName'], 0, 'C', 0, 1, 5, 8, true, 0, true, true, 0, 'T', false);
        $this->MultiCell(200, 0, $headerdata['rstl'], 0, 'C', 0, 1, 5, 12.25, true, 0, true, true, 0, 'T', false);
        $this->MultiCell(200, 0, $headerdata['agencyAddress'], 0, 'C', 0, 1, 5, 16.50, true, 0, true, true, 0, 'T', false);
        $this->MultiCell(200, 0, $headerdata['agencyContactInfo'], 0, 'C', 0, 1, 5, 20.75, true, 0, true, true, 0, 'T', false);
        
        $this->SetFont('helvetica','',12);
        $this->MultiCell(200, 0, '<br/><br/>'.$headerdata['formTitle'], 0, 'C', 0, 1, 5, 25, true, 0, true, true, 0, 'T', false);
         
        $this->SetFont('helvetica','',9);
        
		
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
                        <td width="80">Referral Code:</td>
                        <td width="190">'.$referral["referralCode"].'</td>
                    </tr>
                    <tr>
                        <td width="80">Date:</td>
                        <td width="190">'.$referral["referralDate"].'</td>
                    </tr>
                    <tr>
                        <td width="80">Time:</td>
                        <td width="190">'.date('g:i A',$referral["referralTime"]).'</td>
                    </tr>
                </table>
            ';
            $this->writeHTMLCell('','',5,45,$class.$html);
			
            ### CUSTOMER ###
            $classCustomer = '
                <style>
                  table {
                    font-style: arial;
                    border: 0.5px solid #000;
                    padding-left: 2px;
                  }
                  td{
                    text-align: left;
                    valign: middle;
                  }
                </style>
            ';
            $customerDetails = '
                <table>
                    <tr>
                        <td width="80">CUSTOMER:</td>
                        <td width="331" style="border-right: 0.5px solid #000;">'.$referral["customer"]["customerName"].'</td>
                        <td width="52">TEL NO.:</td>
                        <td width="104">'.$referral["customer"]["tel"].'</td>
                    </tr>
                    <tr>
                        <td>ADDRESS:</td>
                        <td style="border-right: 0.5px solid #000;">'.$referral["customer"]["houseNumber"].'</td>
                        <td>FAX NO.:</td>
                        <td>'.$referral["customer"]["fax"].'</td>
                    </tr>
                </table>
            ';
            $this->writeHTMLCell('', '', 5, 62, $classCustomer.$customerDetails);
			
            ##### 1. TESTING OR CALIBRATION SERVICE #####
            $classTestingHeader = '
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
                    text-align: left;
                    valign: middle;
                  }
                </style>
            ';

            $testingTitle = '
                <p><b> 1. TESTING OR CALIBRATION SERVICE</b></p>
            ';

            $testingHeader = '
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
            ';
			
            $this->writeHTMLCell('','',5,70.5,$testingTitle);   

            $this->writeHTMLCell('','',5,75,$classTestingHeader.$testingHeader);
    }


    public function Footer() {
        //$this->SetXY(20, 268);
        $referral = $this->referral;

        $this->SetFont('helvetica','',9);

        $classORDetails = '
            <style>
                  table {
                    font-style: arial;
                    padding-left: 2px;
                    border: 0.5px solid #000;
                    //border-left: 0.5px solid #000;
                    width: 97.5%;
                  }
                  td{
                    //border-bottom: 0.5px solid #000;
                    //border-right: 0.5px solid #000;
                    text-align: left;

                    valign: middle;
                  }
            </style>
        ';

        $ORdetails = '
            <table>
                <tr>
                    <td width="50">OR. NO.:</td>
                    <td width="249" style="border-right: 0.5px solid #000;"></td>
                    <td width="112">AMOUNT RECEIVED:</td>
                    <td width="156"></td>
                </tr>
                <tr>
                    <td>DATE:</td>
                    <td style="border-right: 0.5px solid #000;"></td>
                    <td>UNPAID BALANCE:</td>
                    <td></td>
                </tr>
            </table>
        ';

        $this->writeHTMLCell('','',5,240,$classORDetails.$ORdetails);

        ### Report Due ###
        $classReportDue = '
            <style>
                  table {
                    font-style: arial;
                    padding-left: 2px;
                    border: 0.5px solid #000;
                    //border-left: 0.5px solid #000;
                    width: 97.5%;
                  }
                  td{
                    //border-bottom: 0.5px solid #000;
                    //border-right: 0.5px solid #000;
                    text-align: left;

                    valign: middle;
                  }
            </style>
        ';

        $reportDue = '
            <table>
                <tr>
                    <td width="142">REPORT DUE ON:</td>
                    <td width="425">'.date("M. j, Y", strtotime($referral['reportDue'])).'</td>
                </tr>
            </table>
        ';

        $this->writeHTMLCell('','',5,251,$classReportDue.$reportDue);

        ### Signatories ###
        $classSignatories = '
            <style>
                  table {
                    font-style: arial;
                    padding-left: 2px;
                    border: 0.5px solid #000;
                    //border-left: 0.5px solid #000;
                    width: 97.6%;
                  }
                  td{
                    //border-bottom: 0.5px solid #000;
                    //border-right: 0.5px solid #000;
                    text-align: left;

                    valign: middle;
                  }
            </style>
        ';

        $labManager=NULL;
        //if(isset($request->laboratory->manager->user))
            //$labManager=$request->laboratory->manager->user->getFullname();
            $labManager = Lablocal::model()->findByPk($referral['lab_id'])->manager->user->getFullname(); 

        $signatories = '
            <table>
                <tr>
                    <td colspan="3" style="border-bottom: 0.5px solid #000;">DISCUSSED WITH CUSTOMER</td>
                </tr>
                <tr>
                    <td width="189" style="border-right: 0.5px solid #000;">CONFORME:</td>
                    <td width="189" style="border-right: 0.5px solid #000;"></td>
                    <td width="189" style="border-right: 0.5px solid #000;"></td>
                </tr>
                <tr>
                    <td style="border-right: 0.5px solid #000;"></td>
                    <td style="border-right: 0.5px solid #000;"></td>
                    <td style="border-right: 0.5px solid #000;"></td>
                </tr>
                <tr>
                    <td style="border-right: 0.5px solid #000;border-bottom: 0.5px solid #000; text-align: center;">'.$referral["conforme"].'</td>
                    <td style="border-right: 0.5px solid #000;border-bottom: 0.5px solid #000; text-align: center;">'.$referral["receivedBy"].'</td>
                    <td style="border-right: 0.5px solid #000;border-bottom: 0.5px solid #000; text-align: center;">'.$labManager.'</td>
                </tr>
                <tr>
                    <td style="border-right: 0.5px solid #000;border-bottom: 0.5px solid #000; text-align: center;">Customer/Authorized Representative</td>
                    <td style="border-right: 0.5px solid #000;border-bottom: 0.5px solid #000; text-align: center;">Sample/s Received by:</td>
                    <td style="border-right: 0.5px solid #000;border-bottom: 0.5px solid #000; text-align: center;">Sample/s Reviewed by:</td>
                </tr>
                <tr>
                    <td colspan="3">REPORT NO.:</td>
                </tr>
            </table>
        ';

        $this->writeHTMLCell('','',5,257.5,$classSignatories.$signatories);

        $this->SetFont('helvetica', '', 7);

        //$paging = 'Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages();

        //$this->getAliasNumPage()
        //$this->getAliasNbPages()

        $numPage = $this->getAliasNumPage();
        $nbPage = $this->getAliasNbPages();
        $paging = 'Page '.$numPage.' of '.$nbPage;

        $formDetails = '
            <style>
                table {
                    font-style: arial;
                    padding-left: 2px;
                    width: 97.6%;
                  }
                  td{
                    valign: middle;
                    text-align: right;
                  }
            </style>
            <table>
                <tr>
                    <td style="text-align: left">'.$paging.'</td>
                    <td>'.Yii::app()->params["FormRequest"]["number"].'</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Rev. '.Yii::app()->params["FormRequest"]["revNum"].' | '.Yii::app()->params['FormRequest']['revDate'].'</td>
                </tr>
            </table>
        ';
        //'Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages()

        //$this->writeHTMLCell('','',5,281.5,$formDetails);

        $this->writeHTMLCell('','',5,281.5,$formDetails);
		




        $w_page = isset($this->l['w_page']) ? $this->l['w_page'].' ' : '';
        if (empty($this->pagegroups)) {
            $pagenumtxt = $w_page.$this->getAliasNumPage().' / '.$this->getAliasNbPages();
        } else {
            $pagenumtxt = $w_page.$this->getPageNumGroupAlias().' / '.$this->getPageGroupAlias();
        }
        //$this->SetY($cur_y)
        //Print page number
        if ($this->getRTL()) {
            //$this->SetX($this->original_rMargin);
            $this->Cell(0, 0, $pagenumtxt, 'T', 0, 'L');
        } else {
            //$this->SetX($this->original_lMargin);
            $this->Cell(0, 0, $this->getAliasRightShift().$pagenumtxt, '', 0, 'L');
        }

        
        
    }
}
?>

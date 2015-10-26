<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends RController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This propeqrty will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	public function getYear()
	{
		$listYear = array();
		for ($year = date('Y'); $year > 2010; $year = $year - 1) {
			$y = array("index" => $year , "year" => $year);
			array_push($listYear, $y);
		}
		return $listYear;	
	}
	
	public function getMonth()
	{
		$listMonth = array( 
						array('index' => 1, 'month' => 'January'),
						array('index' => 2, 'month' => 'February'),
						array('index' => 3, 'month' => 'March'),
						array('index' => 4, 'month' => 'April'),
						array('index' => 5, 'month' => 'May'),
						array('index' => 6, 'month' => 'June'),
						array('index' => 7, 'month' => 'July'),
						array('index' => 8, 'month' => 'August'),
						array('index' => 9, 'month' => 'September'),
						array('index' => 10, 'month' => 'October'),
						array('index' => 11, 'month' => 'November'),
						array('index' => 12, 'month' => 'December'),
					);
		return $listMonth;	
	}
	
	public function getDay()
	{
		$listDay = array();
		for ($day = 31; $day > 0; $day = $day - 1) {
			$d = array("index" => $day , "day" => $day);
			array_push($listDay, $d);
		}
		return $listDay;	
	}

	public static function getTotal($provider, $colname)
	{
		$total=0;
		foreach($provider->data as $data)
		{
			$t=$data->$colname;
			$total += $t;
		}
		return $total;
	}	
	
	public function yearList($num, $reverse=FALSE){ //number of years to compute backwards
		$yearNow = date("Y");
		$yearFrom = $yearNow - $num; //start from number of years ago
		$yearTo = $yearNow; // end at current year
		//$yearTo = $yearNow - 18; // end at 18 years before current year
		$arrYears = array();
				 foreach (range($yearFrom, $yearTo) as $number) {
				 $arrYears[$number] = $number; 
				 }
		if($reverse)
			$arrYears = array_reverse($arrYears, true);
	
		return $arrYears;
	}

	public function appTitle($moduleName=NULL){
		switch ($moduleName)
		{
			case 'user':
				$appTitle='User Management Module';
			break;
			
			case 'rights':
				$appTitle='Rights Management Module';
			break;
			
			case 'lab':
				$appTitle='Laboratory Information Management System';
			break;
			
			case 'pmis':
				$appTitle='Project Management Information System';
			break;

			case 'leis':
				$appTitle='Laboratory Equipment Information System';
			break;

			case 'cashier':
				$appTitle='Cashiering Information Management System';
			break;
			
			case 'accounting':
				$appTitle='Accounting Information Management System';
			break;
			
			case 'ref':
				$appTitle='Referral System';
			break;
			
			default:
				$appTitle='Admin Module';
			break;
		}
		return $appTitle;
	}
	
	public function getRstlId(){
		return Yii::app()->getModule('user')->user()->profile->getAttribute('pstc');
	}
	
	public function getPersonnel($designationAlias=NULL){
		$personnel = Personnel::model()->find(array(
					'condition' => 'designationAlias = :designationAlias',
				    'params' => array(':designationAlias' => $designationAlias),
				));
				
		return array(
			'name'=>$personnel->name,
			'designation'=>$personnel->designation
		);
	}
	
	public function getBankAccount(){
		$bankAccount = Bankaccount::model()->find(array());
		return array(
			'bankName'=>$bankAccount->bankName,
			'accountNumber'=>$bankAccount->accountNumber
		);
	}
	
	public function convert_number_to_words($number) {
	    
	    $hyphen      = ' ';
	    $conjunction = ' ';
	    $separator   = ' ';
	    $negative    = 'negative ';
	    $decimal     = ' and ';
	    $dictionary  = array(
	        0                   => 'zero',
	        1                   => 'one',
	        2                   => 'two',
	        3                   => 'three',
	        4                   => 'four',
	        5                   => 'five',
	        6                   => 'six',
	        7                   => 'seven',
	        8                   => 'eight',
	        9                   => 'nine',
	        10                  => 'ten',
	        11                  => 'eleven',
	        12                  => 'twelve',
	        13                  => 'thirteen',
	        14                  => 'fourteen',
	        15                  => 'fifteen',
	        16                  => 'sixteen',
	        17                  => 'seventeen',
	        18                  => 'eighteen',
	        19                  => 'nineteen',
	        20                  => 'twenty',
	        30                  => 'thirty',
	        40                  => 'forty',
	        50                  => 'fifty',
	        60                  => 'sixty',
	        70                  => 'seventy',
	        80                  => 'eighty',
	        90                  => 'ninety',
	        100                 => 'hundred',
	        1000                => 'thousand',
	        1000000             => 'million',
	        1000000000          => 'billion',
	        1000000000000       => 'trillion',
	        1000000000000000    => 'quadrillion',
	        1000000000000000000 => 'quintillion'
	    );
	    
	    if (!is_numeric($number)) {
	        return false;
	    }
	    
	    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
	        // overflow
	        trigger_error(
	            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
	            E_USER_WARNING
	        );
	        return false;
	    }
	
	    if ($number < 0) {
	        return $negative . $this->convert_number_to_words(abs($number));
	    }
	    
	    $string = $fraction = null;
	    
	    if (strpos($number, '.') !== false) {
	        list($number, $fraction) = explode('.', $number);
	    }
	    
	    switch (true) {
	        case $number < 21:
	            $string = $dictionary[$number];
	            break;
	        case $number < 100:
	            $tens   = ((int) ($number / 10)) * 10;
	            $units  = $number % 10;
	            $string = $dictionary[$tens];
	            if ($units) {
	                $string .= $hyphen . $dictionary[$units];
	            }
	            break;
	        case $number < 1000:
	            $hundreds  = $number / 100;
	            $remainder = $number % 100;
	            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
	            if ($remainder) {
	                $string .= $conjunction . $this->convert_number_to_words($remainder);
	            }
	            break;
	        default:
	            $baseUnit = pow(1000, floor(log($number, 1000)));
	            $numBaseUnits = (int) ($number / $baseUnit);
	            $remainder = $number % $baseUnit;
	            $string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
	            if ($remainder) {
	                $string .= $remainder < 100 ? $conjunction : $separator;
	                $string .= $this->convert_number_to_words($remainder);
	            }
	            break;
	    }
	    
	    if (null !== $fraction && is_numeric($fraction)) {
	        $string .= $decimal;
	        $words = array();
	        foreach (str_split((string) $fraction) as $number) {
	            $words[] = $dictionary[$number];
	        }
	        $string .= $fraction.'/100';
	    }
	    return strtoupper($string);
	}
	
	function addZeros($count){
		if($count < 10)
			return '000'.$count;
		elseif ($count < 100)
			return '00'.$count;
		elseif ($count < 1000)
			return '0'.$count;
		elseif ($count >= 1000)
			return $count;			
	}
	
	function getServer()
	{
		return Yii::app()->params['API']['url'].Yii::app()->params['API']['version'];
	}
	
	function getNotifications($agency_id)
	{	
		$notifications = RestController::searchResource('notifications', 'recipient_id', 11);
        if(isset($notifications)){
        }
	}
	
    function generateAgencySecret($countLetters = NULL, $countNumbers = NULL)
    {
        if(is_null($countLetters))
        	$countNumbers = 16;
    	
        if(is_null($countNumbers))
        	$countNumbers = 16;
        		
		$agency_code = '';
        $character_set_array = array();
        $character_set_array[] = array('count' => $countLetters, 'characters' => 'abcdefghijklmnopqrstuvwxyz');
        $character_set_array[] = array('count' => $countNumbers, 'characters' => '0123456789');
        $temp_array = array($agency_code);
        foreach ($character_set_array as $character_set) {
            for ($i = 0; $i < $character_set['count']; $i++) {
                $temp_array[] = $character_set['characters'][rand(0, strlen($character_set['characters']) - 1)];
            }
        }
        shuffle($temp_array);
        return strtolower(implode('', $temp_array));
    }
    
    /*function getExternalIP()
    {
	    $externalContent = file_get_contents('http://checkip.dyndns.com/');
		preg_match('/\b(?:\d{1,3}\.){3}\d{1,3}\b/', $externalContent, $m);
		return $m[0];
    }*/
}

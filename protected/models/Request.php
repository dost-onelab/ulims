<?php

/**
 * This is the model class for table "request".
 *
 * The followings are the available columns in table 'request':
 * @property integer $id
 * @property string $requestRefNum
 * @property string $requestId
 * @property string $requestDate
 * @property string $requestTime
 * @property integer $labId
 * @property integer $customerId
 * @property integer $paymentType
 * @property integer $discount
 * @property integer $orId
 * @property double $total
 * @property string $reportDue
 * @property string $conforme
 * @property string $receivedBy
 * @property integer $cancelled
 */
class Request extends CActiveRecord
{
	public $customer_search;
	public $request_count;
	public $sample_count;
	public $total_income;
	public $payment_details;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ulimslab.request';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('requestDate, requestTime, labId, customerId, paymentType, reportDue, conforme, receivedBy', 'required'),
			array('rstl_id, labId, customerId, paymentType, discount, orId, cancelled', 'numerical', 'integerOnly'=>true),
			array('total', 'numerical'),
			array('requestRefNum', 'length', 'max'=>50),
			array('requestId, conforme, receivedBy', 'length', 'max'=>50),
			array('requestTime', 'length', 'max'=>25),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, requestRefNum, requestId, requestDate, requestTime, rstl_id, labId, customerId, paymentType, discount, orId, total, reportDue, conforme, receivedBy, cancelled, from_date, to_date, customer_search', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'rstl'	=> array(self::BELONGS_TO, 'Rstl', 'rstl_id'),
			'laboratory'	=> array(self::BELONGS_TO, 'Lab', 'lab_id'),
			'customer'	=> array(self::BELONGS_TO, 'Customer', 'customerId'),
			'collection' => array(self::STAT, 'Collection', 'request_id', 'select'=> 'SUM(amount)'),
			'receipts' => array(self::HAS_MANY, 'Collection', 'request_id', 'condition' => 'cancelled=0'),
		
			'samps' => array(self::HAS_MANY, 'Sample', 'request_id'),
			'sampleCount' => array(self::STAT, 'Sample', 'request_id', 'condition' => 'cancelled=0'),
        	'anals' => array(self::HAS_MANY, 'Analysis', array('id'=>'sample_id'), 'through'=>'samps', 'order'=>'sample_id ASC, package DESC'),
			//'requestTotal' => array(self::STAT, 'Analysis', '', 'through'=>'samps', 'order'=>'sample_id ASC', 'select'=>'SUM(fee)'),
			
			'disc'	=> array(self::BELONGS_TO, 'Discount', 'discount'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'requestRefNum' => 'Request Ref Num',
			'requestId' => 'Request',
			'requestDate' => 'Request Date',
			'requestTime' => 'Request Time',
			'labId' => 'Lab',
			'customerId' => 'Customers',
			'paymentType' => 'Payment Type',
			'discount' => 'Discount',
			'orId' => 'OR No(s).',
			'orDate' => 'OR Date(s)',
			'amountReceived' => 'Amount Received',
			'balance' => 'Unpaid Balance',
			'total' => 'Total',
			'reportDue' => 'Report Due',
			'conforme' => 'Conforme',
			'receivedBy' => 'Received By',
			'cancelled' => 'Cancelled',
			'blank' => '',
			'customer_search' => 'Customers',
			'sampleName' => 'SAMPLE'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		
		$criteria->with = array('customer');
		$criteria->order = 't.id DESC';
		$criteria->compare('t.id',$this->id);
		//$criteria->compare('t.rstl_id', Yii::app()->getModule('user')->user()->profile->getAttribute('pstc'));
		$criteria->compare('t.rstl_id', Yii::app()->Controller->getRstlId());
		$criteria->compare('customer.customerName', $this->customer_search, true );
		$criteria->compare('requestRefNum',$this->requestRefNum,true);
		$criteria->compare('requestId',$this->requestId,true);
		$criteria->compare('requestDate',$this->requestDate,true);
		$criteria->compare('requestTime',$this->requestTime,true);
		$criteria->compare('labId',$this->labId);
		$criteria->compare('customerId',$this->customerId);
		$criteria->compare('paymentType',$this->paymentType);
		$criteria->compare('discount',$this->discount);
		$criteria->compare('orId',$this->orId);
		$criteria->compare('total',$this->total);
		$criteria->compare('reportDue',$this->reportDue,true);
		$criteria->compare('conforme',$this->conforme,true);
		$criteria->compare('receivedBy',$this->receivedBy,true);
		$criteria->compare('cancelled',$this->cancelled);
		
		return new CActiveDataProvider('Request', array(
		    'criteria'=>$criteria,
		    'sort'=>array(
		        'attributes'=>array(
		            'customer_search'=>array(
		                'asc'=>'customer.customerName',
		                'desc'=>'customer.customerName DESC',
		            ),
		            '*',
		        ),
		    ),
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->ulimsDb;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Request the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function getORs($collections) 
	{
        $tmp = '<div class="raw2">';
        foreach ($collections as $collection) {
            $tmp = $tmp.$collection->receiptid.'-'.$collection->amount.'  ';
        }
        $tmp = $tmp.'</div>';
        return $tmp;
    }
    
	public static function getORsAdminView($collections) 
	{
		$tmp = '<div class="raw2">';
        foreach ($collections as $collection) {
            $tmp .= $collection->receiptid.' - '.Yii::app()->format->formatNumber($collection->amount).'<br/>';
        }
        return $tmp.'</div>';
    }
  
	public static function getORDates($collections) {
        $tmp = '<div class="raw2">';
        foreach ($collections as $collection) {
            $tmp = $tmp.$collection->receipt->receiptDate.'  ';
           
        }
        $tmp = $tmp.'</div>';
        return $tmp;
    }
    
	public static function getBalance($total, $collection) 
	{
        $balance = $total - $collection;
        return $balance;
    }
    
    public function getTestTotal($keys)
	{
        $analysis = Analysis::model()->findAllByPk($keys);
        $requestTotal=0;
        foreach($analysis as $fee)
                $requestTotal+=$fee->fee;
        //$less = $this->getDiscount($requestTotal, $discount);        
        
        return $requestTotal;
	} 
	
	public function getDiscount($keys, $discount)
	{
		$requestTotal = $this->getTestTotal($keys);
		/*if($discount == 1)
			return $requestTotal * 0.25;
		else
			return 0;
		*/	
		if($this->disc)
			return $requestTotal * ($this->disc->rate/100);
		else 
			return 0;
	}
	
	public function getRequestTotal($keys, $discount)
	{
		$requestTotal = $this->getTestTotal($keys);
		if($this->disc)
			$less = $requestTotal * ($this->disc->rate/100);
		else
			$less = 0;
			
		return $requestTotal - $less;
	}
	
	public function beforeSave(){
	   if(parent::beforeSave())
	   {
			if($this->isNewRecord){
				$this->rstl_id = Yii::app()->getModule('user')->user()->profile->getAttribute('pstc');
				$this->requestRefNum = Request::generateRequestRef($_POST['Request']['labId']);
				//$this->requestId = trim(com_create_guid(), '{}');
				$this->requestDate = date('Y-m-d H:i:s',strtotime($_POST['Request']['requestDate']));
				$this->reportDue = date('Y-m-d',strtotime($_POST['Request']['reportDue']));
				$this->cancelled = 0;
		        return true;
			}else{
				$this->requestDate = date('Y-m-d H:i:s',strtotime($_POST['Request']['requestDate']));
				$this->reportDue = date('Y-m-d',strtotime($_POST['Request']['reportDue']));
				return true;
			}
	   }
	   return false;
	}
	
	protected function afterSave(){
		parent::afterSave();
		if($this->isNewRecord){
			$requestCode = new Requestcode;
			 
			$requestCode->requestRefNum = $this->requestRefNum;
			$requestCode->rstl_id = Yii::app()->getModule('user')->user()->profile->getAttribute('pstc');
			$requestCode->labId = $this->labId;
			$codeArray = explode('-',$this->requestRefNum);
			
			/** Old Code: 012014-M-0001-R9 **/
			//$requestCode->number = $codeArray[2];
			
			 /** New Code: R9-092014-CHE-0343 **/
			$requestCode->number = $codeArray[3];
			
			$requestCode->year = date('Y', strtotime($this->requestDate));
			$requestCode->cancelled = 0;
			$requestCode->save();
		}else{
			$this->updateRequestTotal($this->id);
		}
	}
	
	function generateRequestRef($lab){
		$date = date('mY');
		
		//$checkInitializeCode = Request::checkInitializeCode($lab);
		
		/*$count = Requestcode::model()->find(array(
   			'select'=>'*',
			'order'=>'id DESC',
    		'condition'=>'rstl_id = :rstl_id AND labId = :labId AND year = :year',
    		'params'=>array(':rstl_id' => Yii::app()->user->rstlId, ':labId' => $lab, ':year' => date('Y') )
		))->number;	
		
		//if($checkInitializeCode['initialize']){
			//$count = $checkInitializeCode['code'] + 1;	
		//}else{
			$count = $count + 1;
		//}*/
		//$laboratory = Lab::model()->findByPk($lab);
		
		$request = Request::model()->find(array(
   			'select'=>'requestRefNum, rstl_id, labId, requestDate', 
			'order'=>'requestRefNum DESC, requestDate DESC',
    		'condition'=>'rstl_id = :rstl_id AND labId = :labId AND YEAR(requestDate) = :year',
    		'params'=>array(':rstl_id' => Yii::app()->Controller->getRstlId(), ':labId' => $lab, ':year' => date('Y') )
		));
		
		if(isset($request)){
			$requestCode = explode('-', $request->requestRefNum);
			$number = Request::addZeros($requestCode[3] + 1);
			//$number = $requestCode[3];
		}else{
			$initializeCode = Initializecode::model()->find(array(
	   			'select'=>'*',
	    		'condition'=>'rstl_id = :rstl_id AND lab_id = :lab_id AND codeType = :codeType',
	    		'params'=>array(':rstl_id' => Yii::app()->Controller->getRstlId(), ':lab_id' => $lab, ':codeType' => 1 )
			));
			$number = Request::addZeros($initializeCode->startCode + 1);
		}
		
		$labCode = Lab::model()->findByPk($lab);
		$rstl = Rstl::model()->findByPk(Yii::app()->Controller->getRstlId());
		//$requestRefNo = $date.'-'.$labCode->labCode.'-'.$number.'-'.$rstl->code;
		$requestRefNo = $rstl->code.'-'.$date.'-'.$labCode->labCode.'-'.$number;
		
		return $requestRefNo;
		
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
	
	public function updateRequestTotal($id){
		$total = 0;
		$request = Request::model()->findByPk($id);
		foreach($request->anals as $analysis)
		{
			$total = $total + $analysis->fee;
		}
		if($request->disc)
			$total = $total - ($total * $request->disc->rate/100);
		else 	
			$total = $total;
			
		Request::model()->updateByPk($request->id, 
			array('total'=>$total,
			));
	}
	
	public function getChemSamples()
	{
		
		$customerId = $this->customerId;
		$year = date('Y', strtotime($this->requestDate));
		$sample_count = 0;
		
		$minDate = date("Y-m-d", mktime(0, 0, 0, 1, 1, $year));
		$maxDate = date("Y-m-d", mktime(0, 0, 0, 12, 31, $year));
		
		$requests = Request::model()
				->findAll(array(
					'condition' => 'labId = :labId AND customerId = :customerId AND requestDate >= :minDate AND requestDate <= :maxDate AND t.cancelled = :cancelled',
				    'params' => array(':labId' => 1, ':customerId'=> $customerId, ':minDate'=> $minDate, ':maxDate'=> $maxDate, ':cancelled' => 0),
				));
		
		foreach($requests as $request)
		{
			$sample_count += $request->sampleCount;
		}
		return $sample_count;
	}
	
	public function getMicroSamples()
	{
		$customerId = $this->customerId;
		$year = date('Y', strtotime($this->requestDate));
		$sample_count = 0;
		
		$minDate = date("Y-m-d", mktime(0, 0, 0, 1, 1, $year));
		$maxDate = date("Y-m-d", mktime(0, 0, 0, 12, 31, $year));
		
		$requests = Request::model()
				->findAll(array(
					'condition' => 'labId = :labId AND customerId = :customerId AND requestDate >= :minDate AND requestDate <= :maxDate AND t.cancelled = :cancelled',
				    'params' => array(':labId' => 2, ':customerId'=> $customerId, ':minDate'=> $minDate, ':maxDate'=> $maxDate, ':cancelled' => 0),
				));
		
		foreach($requests as $request)
		{
			$sample_count += $request->sampleCount;
		}
		return $sample_count;
	}
	
	public function getChemTests()
	{
		$customerId = $this->customerId;
		$year = date('Y', strtotime($this->requestDate));
		$test_count = 0;
		
		$minDate = date("Y-m-d", mktime(0, 0, 0, 1, 1, $year));
		$maxDate = date("Y-m-d", mktime(0, 0, 0, 12, 31, $year));
		
		$requests = Request::model()
				->findAll(array(
					'condition' => 'labId = :labId AND customerId = :customerId AND requestDate >= :minDate AND requestDate <= :maxDate AND t.cancelled = :cancelled',
				    'params' => array(':labId' => 1, ':customerId'=> $customerId, ':minDate'=> $minDate, ':maxDate'=> $maxDate, ':cancelled' => 0),
				));
		
		foreach($requests as $request)
		{
			foreach($request->samps as $sample)
			{
				$test_count += $sample->analysisCount;
			}
			
		}
		return $test_count;
	}
	
	public function getMicroTests()
	{
		$customerId = $this->customerId;
		$year = date('Y', strtotime($this->requestDate));
		$test_count = 0;
		
		$minDate = date("Y-m-d", mktime(0, 0, 0, 1, 1, $year));
		$maxDate = date("Y-m-d", mktime(0, 0, 0, 12, 31, $year));
		
		$requests = Request::model()
				->findAll(array(
					'condition' => 'labId = :labId AND customerId = :customerId AND requestDate >= :minDate AND requestDate <= :maxDate AND t.cancelled = :cancelled',
				    'params' => array(':labId' => 2, ':customerId'=> $customerId, ':minDate'=> $minDate, ':maxDate'=> $maxDate, ':cancelled' => 0),
				));
		
		foreach($requests as $request)
		{
			foreach($request->samps as $sample)
			{
				$test_count += $sample->analysisCount;
			}
			
		}
		return $test_count;
	}
	
	public function getCustomerRequests()
	{
		
		$customerId = $this->customerId;
		$year = date('Y', strtotime($this->requestDate));
		
		$reqs = '<br/><div class="requestCodes'.$this->customerId.'">';
		
		$minDate = date("Y-m-d", mktime(0, 0, 0, 1, 1, $year));
		$maxDate = date("Y-m-d", mktime(0, 0, 0, 12, 31, $year));
		
		$requests = Request::model()
				->findAll(array(
					'condition' => 'customerId = :customerId AND requestDate >= :minDate AND requestDate <= :maxDate AND t.cancelled = :cancelled',
				    'params' => array(':customerId'=> $customerId, ':minDate'=> $minDate, ':maxDate'=> $maxDate, ':cancelled' => 0),
				));
		
		
		foreach($requests as $request)
		{
				$reqs .= CHtml::link($request->requestRefNum, Yii::app()->createUrl('lms/request/view', array('id'=>$request->id)), array('target'=>'_blank')).' ';
		}
		
		$reqs .= '</div>';
		return $reqs;
	}
	
 	public function getColor() {
        
        $statuscolor='active';
        switch ($this->cancelled) {
            case 1:
                $statuscolor='cancelled';
                break;
        }
        return $statuscolor;
        
    }
    
    public function getPaymentDetails(){
    	$request = Request::model()->findByPk($this->id);
    	
    	$balance = $this->total - $this->collection;
    	
	    switch ($balance) {
		    case 0 :
		        return "Paid";
		        break;
		    case $this->total :
		        return "unPaid";
		        break;
		}
    	//return Yii::app()->format->formatNumber($balance);
    }
    
    public function checkInitializeCode($lab)
    {
    	$code = Initializecode::model()->find(array(
    		'condition'=>'rstl_id=:rstl_id AND lab_id=:labId AND codeType = 1 AND active = 1',
    		'params'=>array(':rstl_id' => Yii::app()->user->rstlId, ':labId' => $lab)
		));	
		
		if(isset($code)){
			$initializeCode = array(
				'initialize' => true,
				'code'	=> $code->startCode
			);
		}else{
			$initializeCode = array(
				'initialize' => false,
				'code'	=> $code->startCode
			);
		}
		
		return $initializeCode;
    } 
}

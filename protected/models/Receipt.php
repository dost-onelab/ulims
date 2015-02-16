<?php

/**
 * This is the model class for table "receipt".
 *
 * The followings are the available columns in table 'receipt':
 * @property integer $id
 * @property integer $receiptId
 * @property string $receiptDate
 * @property integer $paymentModeId
 * @property string $payor
 * @property integer $collectionType
 * @property string $bank
 * @property string $check_money_number
 * @property string $checkdate
 * @property double $total
 * @property integer $project
 * @property integer $cancelled
 */
class Receipt extends CActiveRecord
{
	public $BtrTotal;
	public $ProjectTotal;
	public $DepositTotal;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'receipt';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('receiptId, receiptDate, paymentModeId, payor, collectionType, bank, check_money_number, checkdate, total, project, cancelled', 'required'),
			array('receiptDate, paymentModeId, collectionType, payor, orseries_id', 'required'),
			array('paymentModeId, collectionType, project, orseries_id, cancelled', 'numerical', 'integerOnly'=>true),
			array('receiptId', 'numerical', 'integerOnly'=>false),
			array('total', 'numerical'),
			array('payor', 'length', 'max'=>100),
			array('bank, check_money_number', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, rstl_id, receiptId, receiptDate, paymentModeId, payor, collectionType, bank, check_money_number, checkdate, total, project, cancelled, orderofpayment_id, orseries_id, status', 'safe', 'on'=>'search'),
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
			'orderofpayment'	=> array(self::BELONGS_TO, 'Orderofpayment', 'orderofpayment_id'),		
			'collection' => array(self::HAS_MANY, 'Collection', 'receipt_id'),
			'totalCollection' => array(self::STAT, 'Collection', 'receipt_id', 
										'select'=> 'SUM(amount)', 'condition'=>'cancelled=0'),
			'totalCheck' => array(self::STAT, 'Check', 'receipt_id', 'select'=> 'SUM(amount)'),
			'checks' => array(self::HAS_MANY, 'Check', 'receipt_id'),
			'deposit' => array(self::HAS_ONE, 'Deposit', '', 'on'=>'t.receiptId=deposit.endOr'),
			//'deposit' => array(self::HAS_ONE, 'Deposit', array('receiptId' => 'startOr')),
			'typeOfCollection' => array(self::BELONGS_TO, 'Collectiontype', 'collectionType'),
			'paymentMode' => array(self::BELONGS_TO, 'Paymentmode', 'paymentModeId'),
			'cancelDetails' => array(self::HAS_ONE, 'Cancelledor', 'receiptId'),
			'orseries'=> array(self::BELONGS_TO, 'Orseries', 'orseries_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'receiptId' => 'Receipt',
			'receiptDate' => 'Receipt Date',
			'paymentModeId' => 'Payment Mode',
			'payor' => 'Payor',
			'collectionType' => 'Collection Type',
			'bank' => 'Bank',
			'check_money_number' => 'Check Money Number',
			'checkdate' => 'Checkdate',
			'total' => 'Total',
			'totalCollection' => 'Total Collection',
			'project' => 'Project',
			'orseries_id'=>'O.R. Series',
			'orderofpayment_id'=>'Order of Payment ID',
			'cancelled' => 'Cancelled',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('t.rstl_id', Yii::app()->Controller->getRstlId());
		$criteria->compare('receiptId',$this->receiptId);
		$criteria->compare('receiptDate',$this->receiptDate,true);
		$criteria->compare('paymentModeId',$this->paymentModeId);
		$criteria->compare('payor',$this->payor,true);
		$criteria->compare('collectionType',$this->collectionType);
		$criteria->compare('bank',$this->bank,true);
		$criteria->compare('check_money_number',$this->check_money_number,true);
		$criteria->compare('checkdate',$this->checkdate,true);
		$criteria->compare('total',$this->total);
		$criteria->compare('project',$this->project);
		$criteria->compare('cancelled',$this->cancelled);
		$criteria->order = 'id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->cashierDb;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Receipt the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function beforeSave(){
	   if(parent::beforeSave())
	   {
			if($this->isNewRecord){
				
				$orseriesId=$this->orseries_id;
				$orseries=Orseries::model()->findByPk($orseriesId);
				if($orseries)
					$nextOR=$orseries->nextor;
					
				$this->orderofpayment_id = $_POST['Receipt']['orderofpayment_id'];
				$this->receiptDate = date('Y-m-d', strtotime($_POST['Receipt']['receiptDate']));
				$this->receiptId = $nextOR;
				$this->rstl_id = Yii::app()->Controller->getRstlId();
				$this->cancelled = 0;
				
		        return true;
			}else{
				$this->receiptDate = date('Y-m-d',strtotime($_POST['Receipt']['receiptDate']));
				return true;
			}
	   }
	   return false;
	}
	
	protected function afterSave(){
		parent::afterSave();
		if($this->isNewRecord){
			$this->receiptDate = date('Y-m-d', strtotime($_POST['Receipt']['receiptDate']));
			
			/** Receipt from OP ~ save paymentitems as collection : Start **/
			if($this->orderofpayment_id !=0){
				foreach($this->orderofpayment->paymentitems as $item){
					$collection = new Collection;
					$collection->rstl_id = Yii::app()->Controller->getRstlId();
					$collection->receipt_id = $this->id;
					$collection->request_id = $item->request_id;
					$collection->nature = $item->details;
					$collection->amount = $item->amount;
					$collection->receiptid = $this->receiptId;
					$collection->cancelled = 0;
					$collection->save();
				}

				Orderofpayment::model()->updateByPk($this->orderofpayment->id, 
					array('createdReceipt'=>1)
				);
			}
			/** Receipt from OP ~ save paymentitems as collection : Start **/
			
			$orseriesId=$this->orseries_id;
			$receiptId=$this->receiptId;
			/* use this to increment numeric string with leading zeros*/
			//check length of receiptId
			$lenReceiptId=strlen($receiptId);
			$nextOr=$receiptId+1;
			$lenNextOR=strlen($nextOr);
			if($lenReceiptId!=$lenNextOR){
				//we will set same length of string for start and next
				//in case of leading zeros of start OR
				$nextOr = str_pad($nextOr, $lenReceiptId, 0, STR_PAD_LEFT);
			}
			//update Orseries model with the incremented nextor			
			/*Orseries::model()->updateByPk(
									$orseriesId, //pk
									array('nextor'=>$nextOr),//attributes to be updated
									'rstl_id=:rstlId', //condition
									array(':rstlId'=>Yii::app()->Controller->getRstlId())//params
									);*/
			$criteria=new CDbCriteria;
			$criteria->condition='id=:orseriesId AND rstl_id=:rstlId';
			$criteria->params=array(':orseriesId'=>$orseriesId,':rstlId'=>Yii::app()->Controller->getRstlId());
			$orseries=Orseries::model()->find($criteria);
			if($orseries){
				$orseries->nextor=$nextOr;
				$orseries->save();
			}
			return true;
		}else{
			$this->receiptDate = date('Y-m-d', strtotime($_POST['Receipt']['receiptDate']));
			return true;
		}
	}
	
	function addZeros($number)
	{
		if($count < 1000000)
			return '0'.$number;
		else
			return $number;
	}
	
	function getDays($month){
	
		if($month == 2){
			if($year%4 == 0)
				$days = 29;
			else
				$days = 28; 	
		}
		
		if($month == 4 || $month == 6 || $month == 9 || $month == 11)
			$days = 30;
		
		if($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12)
			$days = 31;
			
		return $days;
	}
	
	function getCollectionBtrTotal($year, $month){
		$minDate = date("Y-m-d", mktime(0, 0, 0, $month, 1, $year));
		$maxDate = date("Y-m-d", mktime(0, 0, 0, $month, Receipt::getDays($month), $year));
		
		$criteria=new CDbCriteria;
		$criteria->order = 'receipt_id DESC, receiptDate DESC';
		$criteria->with = 'collection';
		$criteria->condition = 't.project = 0 AND t.receiptDate >= :minDate AND t.receiptDate <= :maxDate AND t.cancelled = 0 AND collection.cancelled = 0';
		$criteria->select= 'SUM(collection.amount) as BtrTotal';
		$criteria->params = array(':minDate' => $minDate, ':maxDate' => $maxDate);
		$receipt = Receipt::model()->find($criteria);
		
		return $receipt->BtrTotal;
	}
	
	function getCollectionProjectTotal($year, $month){
		$minDate = date("Y-m-d", mktime(0, 0, 0, $month, 1, $year));
		$maxDate = date("Y-m-d", mktime(0, 0, 0, $month, Receipt::getDays($month), $year));
		
		$criteria=new CDbCriteria;
		$criteria->order = 'receipt_id DESC, receiptDate DESC';
		$criteria->with = 'collection';
		$criteria->condition = 't.project = 1 AND t.receiptDate >= :minDate AND t.receiptDate <= :maxDate AND t.cancelled = 0 AND collection.cancelled = 0';
		$criteria->select= 'SUM(collection.amount) as ProjectTotal';
		$criteria->params = array(':minDate' => $minDate, ':maxDate' => $maxDate);
		$receipt = Receipt::model()->find($criteria);
		
		return ($receipt->ProjectTotal == 0) ? '0.0' : $receipt->ProjectTotal;
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

    public function getStatus()
    {    	
    	if($this->cancelled)
    		return array('id'=>0, 'class'=>'link-hand alert alert-danger');
    	
    	return array('id'=>1, 'class'=>'link-hand');	
    } 
	
}

<?php

/**
 * This is the model class for table "referral".
 *
 * The followings are the available columns in table 'referral':
 * @property integer $id
 * @property string $referralCode
 * @property string $referralDate
 * @property integer $receivingAgencyId
 * @property integer $acceptingAgencyId
 * @property integer $lab_id
 * @property integer $customer_id
 * @property integer $paymentType_id
 * @property integer $discount_id
 * @property string $sampleArrivalDate
 * @property string $reportDue
 * @property string $conforme
 * @property string $receivedBy
 * @property integer $cancelled
 * @property integer $status
 * @property string $create_time
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property Sample[] $samples
 */
class Referral extends CFormModel
{
	public $id;
	public $referralCode;
	public $referralDate;
	public $referralTime;
	public $receivingAgencyId;
	public $acceptingAgencyId;
	public $lab_id;
	public $customer_id;
	public $paymentType_id;
	public $discount_id;
	public $sampleArrivalDate;
	public $reportDue;
	public $conforme;
	public $receivedBy;
	public $cancelled;
	public $status;
	public $create_time;
	public $update_time;
	
	public $referralId;
	public $technicalManager;
	public $managerPassword; 
	
	const STATUS_RECEIVED = 1;
	const STATUS_SHIPPED = 2;
	const STATUS_ACCEPTED = 3;
	const STATUS_ONGOING = 4;
	const STATUS_NOT_COMPLETED = 5;
	const STATUS_COMPLETED = 6;
	const STATUS_RELEASED = 7;
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('referralCode, referralDate, receivingAgencyId, acceptingAgencyId, lab_id, customer_id, paymentType_id, discount_id, reportDue, conforme, receivedBy, cancelled, status, create_time, update_time', 'required'),
			array('referralDate, referralTime, lab_id, customer_id, paymentType_id, discount_id, reportDue, conforme, receivedBy', 'required'),
			array('receivingAgencyId, acceptingAgencyId, lab_id, customer_id, paymentType_id, discount_id, cancelled, status', 'numerical', 'integerOnly'=>true),
			array('referralCode, conforme, receivedBy', 'length', 'max'=>50),
			array('referralTime', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, referralCode, referralDate, receivingAgencyId, acceptingAgencyId, lab_id, customer_id, paymentType_id, discount_id, sampleArrivalDate, reportDue, conforme, receivedBy, cancelled, status, create_time, update_time', 'safe', 'on'=>'search'),
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
			'samples' => array(self::HAS_MANY, 'Sample', 'referral_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'referralCode' => 'Referral Code',
			'referralDate' => 'Referral Date',
			'referralTime' => 'Referral Time',
			'receivingAgencyId' => 'Receiving Agency',
			'acceptingAgencyId' => 'Accepting Agency',
			'lab_id' => 'Lab',
			'customer_id' => 'Customer',
			'paymentType_id' => 'Payment Type',
			'discount_id' => 'Discount',
			'sampleArrivalDate' => 'Sample Arrival',
		 	'reportDue' => 'Estimated Due Date',
			'conforme' => 'Conforme',
			'receivedBy' => 'Received By',
			'cancelled' => 'Cancelled',
			'status' => 'Status',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
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
		$criteria->compare('referralCode',$this->referralCode,true);
		$criteria->compare('referralDate',$this->referralDate,true);
		$criteria->compare('referralTime',$this->referralTime,true);
		$criteria->compare('receivingAgencyId',$this->receivingAgencyId);
		$criteria->compare('acceptingAgencyId',$this->acceptingAgencyId);
		$criteria->compare('lab_id',$this->lab_id);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('paymentType_id',$this->paymentType_id);
		$criteria->compare('discount_id',$this->discount_id);
		$criteria->compare('sampleArrivalDate',$this->sampleArrivalDate,true);
		$criteria->compare('reportDue',$this->reportDue,true);
		$criteria->compare('conforme',$this->conforme,true);
		$criteria->compare('receivedBy',$this->receivedBy,true);
		$criteria->compare('cancelled',$this->cancelled);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function itemAlias($type, $code=NULL) {
		$_items = array(
			'StatusReceivingSend' => array(
				self::STATUS_RECEIVED  => 'RECEIVED ',
				self::STATUS_SHIPPED => 'SHIPPED',
			),
			'StatusReceivingRelease' => array(
				self::STATUS_RELEASED => 'RELEASED',
			),
			'StatusAccepting' => array(
				self::STATUS_ACCEPTED => 'ACCEPTED',
				self::STATUS_ONGOING => 'ONGOING',
				self::STATUS_NOT_COMPLETED => 'NOT COMPLETED',
				self::STATUS_COMPLETED => 'COMPLETED',
			),
			'StatusAll' => array(
				self::STATUS_RECEIVED  => 'RECEIVED ',
				self::STATUS_SHIPPED => 'SHIPPED',
				self::STATUS_RELEASED => 'RELEASED',
				self::STATUS_ACCEPTED => 'ACCEPTED',
				self::STATUS_ONGOING => 'ONGOING',
				self::STATUS_NOT_COMPLETED => 'NOT COMPLETED',
				self::STATUS_COMPLETED => 'COMPLETED',
			),
		);
		if (isset($code))
			return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
		else
			return isset($_items[$type]) ? $_items[$type] : false;
	}

	public static function agencyLookUp($type, $agencies) {
		$_items = array(
			'matchingAgencies' => array(
				//self::STATUS_RECEIVED  => 'RECEIVED ',
				//self::STATUS_SHIPPED => 'SHIPPED',
			),
		);
		
		foreach($agencies as $agency)
		{
			array_push($_items['matchingAgencies'], array($agency['id']=>$agency['name']));
		}
		
		return isset($_items[$type]) ? $_items[$type] : false;
	}
	
	/**
	 * @return CDbConnection the database connection used for this class
	 */
	/*public function getDbConnection()
	{
		return Yii::app()->referralDb;
	}*/

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Referral the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function getStatus($status_id)
	{
		$statuses = array(
			'1' => 'RECEIVED',
			'2' => 'SHIPPED',
			'3' => 'ACCEPTED',
			'4' => 'ONGOING',
			'5' => 'NOT_COMPLETED',
			'6' => 'COMPLETED',
			'7' => 'RELEASED',
		);
		
		return $statuses[$status_id];
	} 
	
	public static function owner($receivingAgencyId)
	{
		if($receivingAgencyId == Yii::app()->Controller->getRstlId())
			return true;
		else	
			return false;
	}
	
	public static function recipient($acceptingAgencyId)
	{	
		if($acceptingAgencyId == Yii::app()->Controller->getRstlId())
			return true;
		else	
			return false;
	}
	public static function getCustomerDetails($id)
	{
		$ch = curl_init();
		$url = 'http://'.Yii::app()->Controller->getServer().'/customers/'.$id;
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		
		$data = curl_exec($ch);
		curl_close($ch);
		
		return json_decode($data, true);
	}
	
	public static function getSamples($id)
	{
		$referral = RestController::getViewData('referrals', $id);
		
		return CHtml::listData($referral['samples'], 'id', 'sampleName');
	}
	
	public static function getAnalyses($referral)
	{
		$samples = $referral['samples'];
		$analyses = array();
		
		$ch = curl_init();
		$url = 'http://'.Yii::app()->Controller->getServer().'/referralsampleanalyses/search?referral_id='.$referral['id'];
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		
		$data = curl_exec($ch);
		curl_close($ch);
		
		$results = json_decode($data, true);
			
		return count($results[0]) ? $results : $analyses;
	}
	
	public static function getAgencies($id)
	{
		//return RestController::getCustomData('referrals/agency?id=', $id);
		
		$ch = curl_init();
		$url = 'http://'.Yii::app()->Controller->getServer().'/referrals/agency?id='.$id;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		
		$data = curl_exec($ch);
		curl_close($ch);
		
		$results = json_decode($data, true);
		//return $results;
		return count($results[0]) ? $results : array();
	}
	
	public static function countNewReferrals()
	{
		$newReferrals = RestController::searchResourceMultifields('referrals', 
			array(
				'0'=> array('field'=>'acceptingAgencyId', 'value'=>Yii::app()->Controller->getRstlId()),
				'1'=> array('field'=>'status', 'value'=>0)
			));
		
		if($newReferrals['status'] != 404)
		{
			return count($newReferrals);
		}else{
			return 0;
		}
	}
	
	public static function getReceipts($collections)
	{
		$receipts = '';
		$count = 0;
		foreach ($collections as $collection)
		{
			if($count > 0)
				$receipt .= ', ';
			$receipts .= $collection['receiptNumber'];
			$count += 1;
		}
		return $receipts;
	}
	
	public static function getCollection($collections)
	{
		$totalCollection = 0;
		foreach ($collections as $collection)
		{
			$totalCollection += $collection['amount'];
		}
		return Yii::app()->format->formatNumber($totalCollection);
	}
}

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
			array('requestRefNum, requestId, requestDate, requestTime, labId, customerId, paymentType, discount, orId, total, reportDue, conforme, receivedBy, cancelled', 'required'),
			array('labId, customerId, paymentType, discount, orId, cancelled', 'numerical', 'integerOnly'=>true),
			array('total', 'numerical'),
			array('requestRefNum', 'length', 'max'=>20),
			array('requestId, conforme, receivedBy', 'length', 'max'=>50),
			array('requestTime', 'length', 'max'=>25),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, requestRefNum, requestId, requestDate, requestTime, labId, customerId, paymentType, discount, orId, total, reportDue, conforme, receivedBy, cancelled', 'safe', 'on'=>'search'),
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
			'collection' => array(self::STAT, 'Collection', 'request_id', 'select'=> 'SUM(amount)', 'condition' => 'cancelled=0'),
			'samps' => array(self::HAS_MANY, 'Sample', 'request_id', 'condition' => 'cancelled=0'),
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
			'customerId' => 'Customer',
			'paymentType' => 'Payment Type',
			'discount' => 'Discount',
			'orId' => 'Or',
			'total' => 'Total',
			'reportDue' => 'Report Due',
			'conforme' => 'Conforme',
			'receivedBy' => 'Received By',
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
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
	
	public static function listData()
	{
		return CHtml::listData(Request::model()->findAll(array('order'=>'id DESC')), 
							'id', 'requestRefNum');
	}
	
	public function getBalance(){
		return $this->total - $this->collection;
	}
	
	public static function listDataUnpaid($model=NULL, $customer_id)
	{
		$criteria=new CDbCriteria;
		$criteria->select='id,requestRefNum,total,labId';
		$criteria->condition='rstl_id = :rstl_id AND t.cancelled=0 AND customerId = :customerId';
		$criteria->order='id DESC';
		$criteria->params=array(':rstl_id'=>Yii::app()->Controller->getRstlId(), ':customerId'=>$customer_id);
		$requests=Request::model()->findAll($criteria);
		if($requests){
			foreach ($requests as $request){
				$balance=$request->getBalance();
				if($balance!=0 OR ($model->request_id==$request->id)){ //$model->request_id==$request->id --> needed on update
					$list[] = array(
					'id'=>$request->id,
					'requestRefNum'=>$request->requestRefNum,
					'labId'=>$request->labId,
					'balance'=>$balance
					);
				}
	    	}
		}

		return CHtml::listData($list, 'requestRefNum', 'requestRefNum', 'labId');
	}	
}

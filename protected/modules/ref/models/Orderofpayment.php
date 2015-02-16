<?php

/**
 * This is the model class for table "orderofpayment".
 *
 * The followings are the available columns in table 'orderofpayment':
 * @property integer $id
 * @property integer $agency_id
 * @property string $transactionNum
 * @property integer $collectiontype_id
 * @property string $transactionDate
 * @property integer $customer_id
 * @property double $amount
 * @property string $purpose
 * @property integer $createdReceipt
 *
 * The followings are the available model relations:
 * @property Collectiontype $collectiontype
 * @property Customer $customer
 * @property Agency $agency
 * @property Paymentitem[] $paymentitems
 */
class Orderofpayment extends CActiveRecord
{
	public $customerName;
	public $address;
	public $collectiontype;
	public $paymentitems;
	public $total;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'orderofpayment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('collectiontype_id, transactionDate, customer_id, purpose', 'required'),
			array('id, agency_id, collectiontype_id, customer_id, createdReceipt', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('transactionNum', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, agency_id, transactionNum, collectiontype_id, transactionDate, customer_id, customerName, collectiontype, address, amount, purpose, createdReceipt, paymentitems, total', 'safe', 'on'=>'search'),
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
			//'collectiontype' => array(self::BELONGS_TO, 'Collectiontype', 'collectiontype_id'),
			//'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
			//'agency' => array(self::BELONGS_TO, 'Agency', 'agency_id'),
			//'paymentitems' => array(self::HAS_MANY, 'Paymentitem', 'orderofpayment_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'agency_id' => 'Agency',
			'transactionNum' => 'Transaction Num',
			'collectiontype_id' => 'Collection Type',
			'collectiontype' => 'Collection Type',
			'transactionDate' => 'Transaction Date',
			'customer_id' => 'Customer',
			'amount' => 'Total Amount',
			'purpose' => 'Purpose',
			'createdReceipt' => 'Created Receipt',
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
		$criteria->compare('agency_id',$this->agency_id);
		$criteria->compare('transactionNum',$this->transactionNum,true);
		$criteria->compare('collectiontype_id',$this->collectiontype_id);
		$criteria->compare('transactionDate',$this->transactionDate,true);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('purpose',$this->purpose,true);
		$criteria->compare('createdReceipt',$this->createdReceipt);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->referralDb;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Orderofpayment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

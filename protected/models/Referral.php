<?php

/**
 * This is the model class for table "referral".
 *
 * The followings are the available columns in table 'referral':
 * @property integer $id
 * @property string $referralCode
 * @property string $referralId
 * @property string $referralDate
 * @property string $rstl_ids
 * @property integer $rstl_id
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
class Referral extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'referral';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('referralCode, referralId, referralDate, rstl_ids, rstl_id, labId, customerId, paymentType, discount, orId, total, reportDue, conforme, receivedBy, cancelled', 'required'),
			array('rstl_id, labId, customerId, paymentType, discount, orId, cancelled', 'numerical', 'integerOnly'=>true),
			array('total', 'numerical'),
			array('referralCode, referralId, conforme, receivedBy', 'length', 'max'=>50),
			array('rstl_ids', 'length', 'max'=>25),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, referralCode, referralId, referralDate, rstl_ids, rstl_id, labId, customerId, paymentType, discount, orId, total, reportDue, conforme, receivedBy, cancelled', 'safe', 'on'=>'search'),
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
			'referralId' => 'Referral',
			'referralDate' => 'Referral Date',
			'rstl_ids' => 'Rstl Ids',
			'rstl_id' => 'Rstl',
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
		$criteria->compare('referralCode',$this->referralCode,true);
		$criteria->compare('referralId',$this->referralId,true);
		$criteria->compare('referralDate',$this->referralDate,true);
		$criteria->compare('rstl_ids',$this->rstl_ids,true);
		$criteria->compare('rstl_id',$this->rstl_id);
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
	 * @return Referral the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

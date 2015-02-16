<?php

/**
 * This is the model class for table "paymentitem".
 *
 * The followings are the available columns in table 'paymentitem':
 * @property integer $id
 * @property integer $referral_id
 * @property integer $orderofpayment_id
 * @property string $details
 * @property double $amount
 * @property integer $cancelled
 *
 * The followings are the available model relations:
 * @property Referral $referral
 * @property Orderofpayment $orderofpayment
 */
class Paymentitem extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'onelab.paymentitem';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('referral_id, orderofpayment_id, details, amount', 'required'),
			array('referral_id, orderofpayment_id, cancelled', 'numerical', 'integerOnly'=>true),
			//array('amount', 'numerical'),
			
			array('amount', 'match' ,'pattern' => '/^-?(?:\d+|\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/'),
			array('amount', 'maxValueValidation', 'maxValue'=>$this->maxValue()),
			array('amount', 'minValueValidation', 'minValue'=>1),
			
			array('details', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, referral_id, orderofpayment_id, details, amount, cancelled', 'safe', 'on'=>'search'),
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
			'referral' => array(self::BELONGS_TO, 'Referral', 'referral_id'),
			'orderofpayment' => array(self::BELONGS_TO, 'Orderofpayment', 'orderofpayment_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'referral_id' => 'Referral',
			'orderofpayment_id' => 'Orderofpayment',
			'details' => 'Details',
			'amount' => 'Amount',
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
		$criteria->compare('referral_id',$this->referral_id);
		$criteria->compare('orderofpayment_id',$this->orderofpayment_id);
		$criteria->compare('details',$this->details,true);
		$criteria->compare('amount',$this->amount);
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
		return Yii::app()->referralDb;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Paymentitem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function minValueValidation($attribute, $params)
	{
		if(Yii::app()->format->unformatNumber($this->amount) < 1)
			$this->addError($attribute, $this->getAttributeLabel($attribute).
				" is too small. Minimum value allowed is ". $params['minValue']);
	}
		
	public function maxValueValidation($attribute, $params)
	{
		if(Yii::app()->format->unformatNumber($this->amount) > $params['maxValue'])
			$this->addError($attribute, $this->getAttributeLabel($attribute).
				" is too big. Maximum value allowed is ".$params['maxValue']);
	}
	
	public function maxValue()
	{
		if($this->details){
			$requestRefNum=$this->details;
			$criteria=new CDbCriteria;
			$criteria->select='id,requestRefNum,labId,total';
			$criteria->condition='rstl_id = :rstl_id AND requestRefNum=:requestRefNum AND t.cancelled=0';
			$criteria->params=array(
								':rstl_id'=>Yii::app()->Controller->getRstlId(),
								':requestRefNum'=>$requestRefNum
								);
			$request=Request::model()->find($criteria);
			if($request){
				$balance=$request->getBalance2();
				if($balance==0)//during update
					$balance=$request->total;
				
				return $balance;
			}else{
				return 99999999999999.99;
			}
			
		}else{
			return 0;
		}
	}
}

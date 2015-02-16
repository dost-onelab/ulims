<?php

/**
 * This is the model class for table "paymentitem".
 *
 * The followings are the available columns in table 'paymentitem':
 * @property integer $id
 * @property integer $rstl_id
 * @property integer $orderofpayment_id
 * @property string $details
 * @property double $amount
 * @property integer $cancelled
 */
class Paymentitem extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'paymentitem';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('orderofpayment_id, details, amount', 'required'),
			array('request_id, rstl_id, orderofpayment_id, cancelled', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('amount', 'maxValueValidation', 'parameter'=>$this->maxValue()),
			array('details', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, request_id, rstl_id, orderofpayment_id, details, amount, cancelled', 'safe', 'on'=>'search'),
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
			'orderofpayment'	=> array(self::BELONGS_TO, 'Orderofpayment', 'orderofpayment_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'rstl_id' => 'Rstl',
			'request_id' => 'Request ID',
			'orderofpayment_id' => 'Orderofpayment',
			'details' => 'Details',
			'requestRefNum' => 'Request Reference',
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
		$criteria->compare('rstl_id',$this->rstl_id);
		$criteria->compare('request_id',$this->request_id);
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
		return Yii::app()->accountingDb;
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
	
	public function beforeSave(){
	   if(parent::beforeSave())
	   {
			if($this->isNewRecord){
				$this->rstl_id = Yii::app()->Controller->getRstlId();
		        return true;
			}else{
				return true;
			}
	   }
	   return false;
	}
	
	public function maxValueValidation($attribute, $params)
	{
		if($this->amount > $this->maxValue())
			$this->addError($attribute, $this->getAttributeLabel($attribute)." is too big. Maximum value allowed is ".$this->maxValue());
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
				$balance=$request->getBalance();
				if($balance==0)//during update
					$balance=$request->total;
				
				return $balance;
			}else{
				return '99999999999999.99';
			}
			
		}else{
			return 0;
		}
	}
}

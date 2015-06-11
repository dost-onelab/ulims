<?php

/**
 * This is the model class for table "collection".
 *
 * The followings are the available columns in table 'collection':
 * @property integer $id
 * @property integer $request_id
 * @property integer $receipt_id
 * @property string $nature
 * @property double $amount
 * @property integer $receiptid
 * @property integer $cancelled
 */
class Collection extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'collection';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('request_id, receipt_id, nature, amount, receiptid, cancelled', 'required'),
			array('receipt_id, nature, amount', 'required'),
			array('request_id, referral_id, receipt_id, receiptid, cancelled', 'numerical', 'integerOnly'=>true),
			array('receiptid', 'numerical', 'integerOnly'=>false),
			//array('amount', 'numerical'),
			array('amount', 'match' ,'pattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'),
			array('amount', 'maxValueValidation', 'maxValue'=>$this->maxValue()),
			array('amount', 'minValueValidation', 'minValue'=>1),
			array('nature', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, request_id, receipt_id, nature, amount, receiptid, cancelled', 'safe', 'on'=>'search'),
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
			'receipt'=> array(self::BELONGS_TO, 'Receipt', 'receipt_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'request_id' => 'Request',
			'referral_id' => 'Referral',
			'receipt_id' => 'Receipt',
			'nature' => $this->scenario=='labCollection'?'Request Reference Number':'Nature',
			'amount' => 'Amount',
			'receiptid' => 'Receiptid',
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
		$criteria->compare('request_id',$this->request_id);
		$criteria->compare('referral_id',$this->request_id);
		$criteria->compare('receipt_id',$this->receipt_id);
		$criteria->compare('nature',$this->nature,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('receiptid',$this->receiptid);
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
		return Yii::app()->cashierDb;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Collection the static model class
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
				$this->amount=Yii::app()->format->unformatNumber($this->amount);
				return true;
			}
	   }
	   return false;
	}

	public function minValueValidation($attribute, $params)
	{
		if(Yii::app()->format->unformatNumber($this->amount) < 1)
			$this->addError($attribute, $this->getAttributeLabel($attribute).
				" is too small. Minimum value allowed is ". $params['minValue']);
	}
	
	public function maxValueValidation($attribute, $params)
	{
		if(Yii::app()->format->unformatNumber($this->amount) > $this->maxValue())
			$this->addError($attribute, $this->getAttributeLabel($attribute)." is too big. Maximum value allowed is ".$this->maxValue());
	}
	
	public function maxValue()
	{
		if($this->nature){
			$requestRefNum=$this->nature;
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
				return 99999999999999.99;
			}
			
		}else{
			return 0;
		}
		
	}
	
}

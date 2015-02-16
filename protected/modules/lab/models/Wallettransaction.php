<?php

/**
 * This is the model class for table "wallettransaction".
 *
 * The followings are the available columns in table 'wallettransaction':
 * @property integer $id
 * @property integer $wallet_id
 * @property integer $type
 * @property string $date
 * @property integer $reference
 * @property integer $receipt
 * @property double $amount
 * @property double $balance
 */
class Wallettransaction extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'wallettransaction';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('wallet_id, type, date, reference, receipt, amount, balance', 'required'),
			array('wallet_id, type, reference, receipt', 'numerical', 'integerOnly'=>true),
			array('amount, balance', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, wallet_id, type, date, reference, receipt, amount, balance', 'safe', 'on'=>'search'),
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
			'wallet'	=> array(self::BELONGS_TO, 'Wallet', 'wallet_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'wallet_id' => 'Wallet',
			'type' => 'Type',
			'date' => 'Date',
			'reference' => 'Reference',
			'receipt' => 'Receipt',
			'amount' => 'Amount',
			'balance' => 'Balance',
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
		$criteria->compare('wallet_id',$this->wallet_id);
		$criteria->compare('type',$this->type);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('reference',$this->reference);
		$criteria->compare('receipt',$this->receipt);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('balance',$this->balance);

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
	 * @return Wallettransaction the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

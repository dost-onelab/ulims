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
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ulimscashiering.receipt';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('receiptId, receiptDate, paymentModeId, payor, collectionType, bank, check_money_number, checkdate, total, project, cancelled', 'required'),
			array('receiptId, paymentModeId, collectionType, project, cancelled', 'numerical', 'integerOnly'=>true),
			array('total', 'numerical'),
			array('payor', 'length', 'max'=>100),
			array('bank, check_money_number', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, receiptId, receiptDate, paymentModeId, payor, collectionType, bank, check_money_number, checkdate, total, project, cancelled', 'safe', 'on'=>'search'),
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
			'project' => 'Project',
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
	 * @return Receipt the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

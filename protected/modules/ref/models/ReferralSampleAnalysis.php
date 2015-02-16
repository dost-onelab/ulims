<?php

/**
 * This is the model class for table "referral_sample_analysis".
 *
 * The followings are the available columns in table 'referral_sample_analysis':
 * @property integer $id
 * @property integer $sample_id
 * @property integer $methodReference_id
 * @property double $fee
 * @property integer $referral_id
 * @property string $barcode
 * @property string $sampleName
 * @property string $sampleCode
 * @property string $description
 * @property string $testName
 * @property integer $referralId
 * @property string $method
 * @property string $reference
 */
class ReferralSampleAnalysis extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'referral_sample_analysis';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sample_id, methodReference_id, fee, referral_id, barcode, sampleName, sampleCode, description, testName, method, reference', 'required'),
			array('id, sample_id, methodReference_id, referral_id, referralId', 'numerical', 'integerOnly'=>true),
			array('fee', 'numerical'),
			array('barcode, sampleName', 'length', 'max'=>50),
			array('sampleCode', 'length', 'max'=>20),
			array('testName, method, reference', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sample_id, methodReference_id, fee, referral_id, barcode, sampleName, sampleCode, description, testName, referralId, method, reference', 'safe', 'on'=>'search'),
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
			'sample_id' => 'Sample',
			'methodReference_id' => 'Method Reference',
			'fee' => 'Fee',
			'referral_id' => 'Referral',
			'barcode' => 'Barcode',
			'sampleName' => 'Sample Name',
			'sampleCode' => 'Sample Code',
			'description' => 'Description',
			'testName' => 'Test Name',
			'referralId' => 'Referral',
			'method' => 'Method',
			'reference' => 'Reference',
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
		$criteria->compare('sample_id',$this->sample_id);
		$criteria->compare('methodReference_id',$this->methodReference_id);
		$criteria->compare('fee',$this->fee);
		$criteria->compare('referral_id',$this->referral_id);
		$criteria->compare('barcode',$this->barcode,true);
		$criteria->compare('sampleName',$this->sampleName,true);
		$criteria->compare('sampleCode',$this->sampleCode,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('testName',$this->testName,true);
		$criteria->compare('referralId',$this->referralId);
		$criteria->compare('method',$this->method,true);
		$criteria->compare('reference',$this->reference,true);

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
	 * @return ReferralSampleAnalysis the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

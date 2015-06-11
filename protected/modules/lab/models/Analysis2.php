<?php

/**
 * This is the model class for table "analysis2".
 *
 * The followings are the available columns in table 'analysis2':
 * @property integer $id
 * @property integer $rstl_id
 * @property string $requestId
 * @property integer $sample_id
 * @property string $sampleCode
 * @property string $testName
 * @property string $method
 * @property string $references
 * @property integer $quantity
 * @property double $fee
 * @property integer $testId
 * @property integer $analysisMonth
 * @property integer $analysisYear
 * @property integer $package
 * @property integer $cancelled
 * @property integer $deleted
 */
class Analysis2 extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'analysis2';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rstl_id, requestId, sample_id, sampleCode, testName, method, references, quantity, fee, testId, analysisMonth, analysisYear, package, cancelled, deleted', 'required'),
			array('rstl_id, sample_id, quantity, testId, analysisMonth, analysisYear, package, cancelled, deleted', 'numerical', 'integerOnly'=>true),
			array('fee', 'numerical'),
			array('requestId', 'length', 'max'=>50),
			array('sampleCode', 'length', 'max'=>20),
			array('testName', 'length', 'max'=>200),
			array('method', 'length', 'max'=>150),
			array('references', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, rstl_id, requestId, sample_id, sampleCode, testName, method, references, quantity, fee, testId, analysisMonth, analysisYear, package, cancelled, deleted', 'safe', 'on'=>'search'),
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
			'rstl_id' => 'Rstl',
			'requestId' => 'Request',
			'sample_id' => 'Sample',
			'sampleCode' => 'Sample Code',
			'testName' => 'Test Name',
			'method' => 'Method',
			'references' => 'References',
			'quantity' => 'Quantity',
			'fee' => 'Fee',
			'testId' => 'Test',
			'analysisMonth' => 'Analysis Month',
			'analysisYear' => 'Analysis Year',
			'package' => 'Package',
			'cancelled' => 'Cancelled',
			'deleted' => 'Deleted',
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
		$criteria->compare('requestId',$this->requestId,true);
		$criteria->compare('sample_id',$this->sample_id);
		$criteria->compare('sampleCode',$this->sampleCode,true);
		$criteria->compare('testName',$this->testName,true);
		$criteria->compare('method',$this->method,true);
		$criteria->compare('references',$this->references,true);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('fee',$this->fee);
		$criteria->compare('testId',$this->testId);
		$criteria->compare('analysisMonth',$this->analysisMonth);
		$criteria->compare('analysisYear',$this->analysisYear);
		$criteria->compare('package',$this->package);
		$criteria->compare('cancelled',$this->cancelled);
		$criteria->compare('deleted',$this->deleted);

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
	 * @return Analysis2 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

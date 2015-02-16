<?php

/**
 * This is the model class for table "test".
 *
 * The followings are the available columns in table 'test':
 * @property integer $id
 * @property string $testName
 * @property string $method
 * @property string $references
 * @property double $fee
 * @property integer $duration
 * @property integer $categoryId
 * @property integer $sampleType
 * @property integer $labId
 */
class Test extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'test';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('testName, method, references, fee, duration, categoryId, sampleType, labId', 'required'),
			array('duration, categoryId, sampleType, labId', 'numerical', 'integerOnly'=>true),
			array('fee', 'numerical'),
			array('testName', 'length', 'max'=>200),
			array('method', 'length', 'max'=>150),
			array('references', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, testName, method, references, fee, duration, categoryId, sampleType, labId', 'safe', 'on'=>'search'),
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
			'sampleTypes'	=> array(self::BELONGS_TO, 'Sampletype', 'sampleType'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'testName' => 'Test Name',
			'method' => 'Method',
			'references' => 'References',
			'fee' => 'Fee',
			'duration' => 'Cycle Time',
			'categoryId' => 'Category',
			'sampleType' => 'Sample Type',
			'labId' => 'Lab',
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
		$criteria->compare('testName',$this->testName,true);
		$criteria->compare('method',$this->method,true);
		$criteria->compare('references',$this->references,true);
		$criteria->compare('fee',$this->fee);
		$criteria->compare('duration',$this->duration);
		$criteria->compare('categoryId',$this->categoryId);
		$criteria->compare('sampleType',$this->sampleType);
		$criteria->compare('labId',$this->labId);

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
	 * @return Test the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function listData()
	{
		return CHtml::listData(Test::model()->findAll(), 'id', 'testName');
	}
	
	public static function listData2($sampletype_id)
	{
		//return CHtml::listData(Sampletype::model()->findAll(), 'id', 'sampleType');
		
		return CHtml::listData(Test::model()->findAll(array(
					'condition' => 'sampleType = :sampleType',
				    'params' => array(':sampleType' => $sampletype_id),
					'order'=>'id ASC',
					 
			)),	'id', 'testName');
	}
}

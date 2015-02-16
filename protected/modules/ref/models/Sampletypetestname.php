<?php

/**
 * This is the model class for table "sampletype_testname".
 *
 * The followings are the available columns in table 'sampletype_testname':
 * @property integer $sampletype_id
 * @property integer $testname_id
 * @property string $added_by
 *
 * The followings are the available model relations:
 * @property Sampletype $sampletype
 * @property Testname $testname
 */
class Sampletypetestname extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sampletype_testname';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sampletype_id, testname_id, added_by', 'required'),
			array('sampletype_id, testname_id', 'numerical', 'integerOnly'=>true),
			array('added_by', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('sampletype_id, testname_id, added_by', 'safe', 'on'=>'search'),
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
			'sampletype' => array(self::BELONGS_TO, 'Sampletype', 'sampletype_id'),
			'testname' => array(self::BELONGS_TO, 'Testname', 'testname_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sampletype_id' => 'Sampletype',
			'testname_id' => 'Testname',
			'added_by' => 'Added By',
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

		$criteria->compare('sampletype_id',$this->sampletype_id);
		$criteria->compare('testname_id',$this->testname_id);
		$criteria->compare('added_by',$this->added_by,true);

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
	 * @return SampletypeTestname the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function listDataBySampleType($sampletype_id)
	{
		$testName = RestController::searchResource('sampletypetestnames', 'sampletype_id', $sampletype_id);
		
		return CHtml::listData($testName, 'testname_id', 'testName');
	}
}

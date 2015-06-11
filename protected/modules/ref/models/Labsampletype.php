<?php

/**
 * This is the model class for table "lab_sampletype".
 *
 * The followings are the available columns in table 'lab_sampletype':
 * @property integer $lab_id
 * @property integer $sampletypeId
 * @property string $effective_date
 * @property string $added_by
 *
 * The followings are the available model relations:
 * @property Lab $lab
 * @property Sampletype $sampletype
 */
class Labsampletype extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'lab_sampletype';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lab_id, sampletypeId, effective_date, added_by', 'required'),
			array('lab_id, sampletypeId', 'numerical', 'integerOnly'=>true),
			array('added_by', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('lab_id, sampletypeId, effective_date, added_by', 'safe', 'on'=>'search'),
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
			'lab' => array(self::BELONGS_TO, 'Lab', 'lab_id'),
			'sampletype' => array(self::BELONGS_TO, 'Sampletype', 'sampletypeId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'lab_id' => 'Lab',
			'sampletypeId' => 'Sampletype',
			'effective_date' => 'Effective Date',
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

		$criteria->compare('lab_id',$this->lab_id);
		$criteria->compare('sampletypeId',$this->sampletypeId);
		$criteria->compare('effective_date',$this->effective_date,true);
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
	 * @return Labsampletype the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function listDataByLab($lab_id)
	{
		$sampleType = RestController::searchResource('labsampletypes', 'lab_id', $lab_id);
		
		return CHtml::listData($sampleType, 'sampletypeId', 'sampletype.type');
	}
	
	public static function listData()
	{	
		$labs = RestController::getAdminData('labsampletypes');
		
		return CHtml::listData($labs, 'sampletypeId', 'sampletype.type');
	}
}

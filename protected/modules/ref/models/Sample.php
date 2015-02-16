<?php

/**
 * This is the model class for table "sample".
 *
 * The followings are the available columns in table 'sample':
 * @property integer $id
 * @property integer $referral_id
 * @property integer $sampleType_id
 * @property string $barcode
 * @property string $sampleName
 * @property string $sampleCode
 * @property string $description
 * @property integer $status_id
 * @property string $create_time
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property Analysis[] $analysises
 * @property Referral $referral
 */
class Sample extends CActiveRecord
{
	public $sampleTemplate;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sample';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('referral_id, sampleType_id, barcode, sampleName, sampleCode, description, status_id, create_time, update_time', 'required'),
			array('sampleName, description', 'required'),
			array('referral_id, sampleType_id, status_id', 'numerical', 'integerOnly'=>true),
			array('barcode, sampleName', 'length', 'max'=>50),
			array('sampleCode', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, referral_id, sampleType_id, barcode, sampleName, sampleCode, description, status_id, create_time, update_time', 'safe', 'on'=>'search'),
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
			'analysises' => array(self::HAS_MANY, 'Analysis', 'sample_id'),
			'referral' => array(self::BELONGS_TO, 'Referral', 'referral_id'),
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
			'sampleType_id' => 'Sample Type',
			'barcode' => 'Barcode',
			'sampleName' => 'Sample Name',
			'sampleCode' => 'Sample Code',
			'description' => 'Description',
			'status_id' => 'Status',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
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
		$criteria->compare('sampleType_id',$this->sampleType_id);
		$criteria->compare('barcode',$this->barcode,true);
		$criteria->compare('sampleName',$this->sampleName,true);
		$criteria->compare('sampleCode',$this->sampleCode,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);

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
	 * @return Sample the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function listDataByReferral($samples)
	{	
		//$url = 'http://'.Yii::app()->Controller->getServer().'/API/ulimsLabAPIReadAll.php';
		$url = 'http://'.Yii::app()->Controller->getServer().'/labs';
		$client = curl_init();
	    curl_setopt($client, CURLOPT_URL, $url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($client);
		curl_close($client);
		
		$labs = json_decode($response, true);
		
		return CHtml::listData($labs, 'id', 'labName');
	}
}

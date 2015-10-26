<?php

/**
 * This is the model class for table "customer".
 *
 * The followings are the available columns in table 'customer':
 * @property integer $id
 * @property string $customerName
 * @property string $agencyHead
 * @property integer $region_id
 * @property integer $province_id
 * @property integer $municipalityCity_id
 * @property integer $barangay_id
 * @property string $houseNumber
 * @property string $tel
 * @property string $fax
 * @property string $email
 * @property integer $type_id
 * @property integer $nature_id
 * @property integer $industry_id
 * @property string $create_time
 * @property string $update_time
 */
class Customer extends CFormModel
{
	public $id;
	public $customerName;
	public $agencyHead;
	public $region_id;
	public $province_id;
	public $municipalityCity_id;
	public $barangay_id;
	public $houseNumber;
	public $tel;
	public $fax;
	public $email;
	public $type_id;
	public $nature_id;
	public $industry_id;
	public $created_by, $create_time, $update_time;
	/**
	 * @return string the associated database table name
	 */
	/*public function tableName()
	{
		return 'customer';
	}*/

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('customerName, agencyHead, region_id, province_id, municipalityCity_id, tel, fax, email, type_id, nature_id, industry_id', 'required'),
			array('customerName, agencyHead, region_id, province_id, municipalityCity_id, type_id, nature_id, industry_id', 'required'),
			array('region_id, province_id, municipalityCity_id, barangay_id, type_id, nature_id, industry_id', 'numerical', 'integerOnly'=>true),
			array('customerName, agencyHead, tel, fax, email', 'length', 'max'=>50),
			array('houseNumber', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, customerName, agencyHead, region_id, province_id, municipalityCity_id, barangay_id, houseNumber, tel, fax, email, type_id, nature_id, industry_id, created_by, create_time, update_time', 'safe', 'on'=>'search'),
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
			'customerName' => 'Agency / Customer',
			'agencyHead' => 'Head of Agency',
			'region_id' => 'Region',
			'province_id' => 'Province',
			'municipalityCity_id' => 'Municipality City',
			'barangay_id' => 'Barangay',
			'houseNumber' => 'House/Room # | Bldg/Street | Barangay',
			'tel' => 'Tel',
			'fax' => 'Fax',
			'email' => 'Email',
			'type_id' => 'Type',
			'nature_id' => 'Nature of Business',
			'industry_id' => 'Industry',
			'created_by' => 'Created By',
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
		$criteria->compare('customerName',$this->customerName,true);
		$criteria->compare('agencyHead',$this->agencyHead,true);
		$criteria->compare('region_id',$this->region_id);
		$criteria->compare('province_id',$this->province_id);
		$criteria->compare('municipalityCity_id',$this->municipalityCity_id);
		$criteria->compare('barangay_id',$this->barangay_id);
		$criteria->compare('houseNumber',$this->houseNumber,true);
		$criteria->compare('tel',$this->tel,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('nature_id',$this->nature_id);
		$criteria->compare('industry_id',$this->industry_id);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	/*public function getDbConnection()
	{
		return Yii::app()->referralDb;
	}*/

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Customer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function listData()
	{	
		/*$url = Yii::app()->Controller->getServer().'/customers';
		$client = curl_init();
	    curl_setopt($client, CURLOPT_URL, $url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($client);
		curl_close($client);
		
		$labs = json_decode($response, true);*/
		
		$customers = RestController::getAdminData('customers');
		return CHtml::listData($customers, 'id', 'customerName');
	}
}

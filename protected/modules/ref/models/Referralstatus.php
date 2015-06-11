<?php

/**
 * This is the model class for table "referralstatus".
 *
 * The followings are the available columns in table 'referralstatus':
 * @property integer $referral_id
 * @property string $sampleArrivalDate
 * @property string $shipmentDetails
 * @property integer $status_id
 */
class Referralstatus extends CFormModel
{
	public $agencyName;
	public $referralCode;
	
	public $id, $referral_id, $acceptingAgencyId, $sampleArrivalDate, $shipmentDetails, $status_id;
	
	/**
	 * @return string the associated database table name
	 */
	/*public function tableName()
	{
		return 'referralstatus';
	}*/

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('referral_id, acceptingAgencyId, status_id', 'required'),
			array('referral_id, acceptingAgencyId, sampleArrivalDate, shipmentDetails, status_id', 'required'),
			array('referral_id, status_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('referral_id, acceptingAgencyId, sampleArrivalDate, shipmentDetails, status_id', 'safe', 'on'=>'search'),
			//array('referral_id', 'safe', 'on'=>'search'),
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
			'referral_id' => 'Referral',
			'acceptingAgencyId' => 'Accepting Agency',
			'sampleArrivalDate' => 'Sample Arrival Date',
			'shipmentDetails' => 'Shipment Details',
			'status_id' => 'Status',
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
		$criteria->compare('acceptingAgencyId',$this->acceptingAgencyId);
		$criteria->compare('sampleArrivalDate',$this->sampleArrivalDate,true);
		$criteria->compare('shipmentDetails',$this->shipmentDetails,true);
		$criteria->compare('status_id',$this->status_id);

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
	 * @return Referralstatus the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

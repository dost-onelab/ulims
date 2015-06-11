<?php

/**
 * This is the model class for table "province".
 *
 * The followings are the available columns in table 'province':
 * @property integer $id
 * @property integer $regionId
 * @property string $name
 * @property string $code
 */
class Province extends CFormModel
{
	public $id, $regionId, $name, $code;
	/**
	 * @return string the associated database table name
	 */
	/*public function tableName()
	{
		return 'province';
	}*/

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('regionId, name, code', 'required'),
			array('regionId', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('code', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, regionId, name, code', 'safe', 'on'=>'search'),
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
			'regionId' => 'Region',
			'name' => 'Name',
			'code' => 'Code',
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
		$criteria->compare('regionId',$this->regionId);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('code',$this->code,true);

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
	 * @return Province the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function listData()
	{
		return CHtml::listData(Province::model()->findAll(), 'id', 'name');
	}	
	
	public static function listDataByRegion($id)
	{
		/*return CHtml::listData(Province::model()->findAll(
			array('condition'=>'regionId = :region_id', 'params'=>array(':region_id'=>$id))
		), 'id', 'name');*/
		//$provinces = RestController::getAdminData('provinces');
		$provinces = RestController::searchResource('provinces', 'regionId', $id);
		
		return CHtml::listData($provinces, 'id', 'name');
	}
}

<?php

/**
 * This is the model class for table "methodreference".
 *
 * The followings are the available columns in table 'methodreference':
 * @property integer $id
 * @property integer $testname_id
 * @property string $method
 * @property string $reference
 * @property double $fee
 * @property string $create_time
 * @property string $update_time
 */
class Methodreference extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'methodreference';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('testname_id, method, reference, fee, create_time, update_time', 'required'),
			array('testname_id', 'numerical', 'integerOnly'=>true),
			array('fee', 'numerical'),
			array('method, reference', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, testname_id, method, reference, fee, create_time, update_time', 'safe', 'on'=>'search'),
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
			'testname_id' => 'Testname',
			'method' => 'Method',
			'reference' => 'Reference',
			'fee' => 'Fee',
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
		$criteria->compare('testname_id',$this->testname_id);
		$criteria->compare('method',$this->method,true);
		$criteria->compare('reference',$this->reference,true);
		$criteria->compare('fee',$this->fee);
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
	 * @return Methodreference the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function listDataByTestName($id)
	{
		/*$ch = curl_init();
		$url = 'http://'.Yii::app()->Controller->getServer().'/methodreferences/search?testname_id='.$id;
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		
		$data = curl_exec($ch);
		curl_close($ch);
		
		$methodReferences = json_decode($data, true);*/
		
		$methodReferences = RestController::getCustomData('methodreferences/search?testname_id=', $id);
		
		return CHtml::listData($methodReferences, 'id', 'method');
	}
}

<?php

/**
 * This is the model class for table "package".
 *
 * The followings are the available columns in table 'package':
 * @property integer $id
 * @property integer $testcategory_id
 * @property integer $name
 * @property double $rate
 */
class Package extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'package';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('testcategory_id, name, rate', 'required'),
			array('testcategory_id, sampletype_id', 'numerical', 'integerOnly'=>true),
			array('rate', 'numerical'),
			array('name', 'length', 'max'=>40),
			//array('tests', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, testcategory_id, sampletype_id, name, rate', 'safe', 'on'=>'search'),
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
			'testCategory'	=> array(self::BELONGS_TO, 'Testcategory', 'testcategory_id'),
			'sampleType'	=> array(self::BELONGS_TO, 'Sampletype', 'sampletype_id'),
			//'tests' => array(self::HAS_MANY, 'Test', 'package_id'),
			//'total' => array(self::STAT, 'Test', 'package_id', 'select'=> 'SUM(fee)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'testcategory_id' => 'Test Category',
			'sampletype_id' => 'Sample Type',
			'name' => 'Name',
			'rate' => 'Rate',
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
		$criteria->compare('testcategory_id',$this->testcategory_id);
		$criteria->compare('sampletype_id',$this->sampletype_id);
		$criteria->compare('name',$this->name);
		$criteria->compare('rate',$this->rate);
		$criteria->order = 'id ASC';

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
	 * @return Package the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function beforeSave(){
	   if(parent::beforeSave())
	   {
			$this->tests = implode(',', $_POST['Package']['tests']);
			return true;
	   }
	   return false;
	}
	
	public function getPackageTotal($tests, $rate)
	{
        //$analysis = Analysis::model()->findAllByPk($keys);
        $packageTotal=0;
        
		$tests = explode(',', $tests);
		
		foreach($tests as $test){
			$t = Testforupdate::model()->findByPk($test);
			$packageTotal += $rate * $t->fee;
		}
        
        return $packageTotal;
	}
}

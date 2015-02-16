<?php

/**
 * This is the model class for table "analysis".
 *
 * The followings are the available columns in table 'analysis':
 * @property integer $id
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
 * @property integer $cancelled
 * @property integer $deleted
 */
class Analysis extends CActiveRecord
{
	public $countTest;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'analysis';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('requestId, sample_id, sampleCode, testName, method, references, quantity, fee, testId, analysisMonth, analysisYear, cancelled, deleted', 'required'),
			//array('requestId, sample_id, quantity, fee, testId', 'required'),
			array('requestId, sample_id, quantity, fee', 'required'),
			array('sample_id, quantity, testId, analysisMonth, analysisYear, cancelled, deleted', 'numerical', 'integerOnly'=>true),
			array('fee', 'numerical'),
			array('requestId', 'length', 'max'=>50),
			array('sampleCode', 'length', 'max'=>20),
			array('testName', 'length', 'max'=>200),
			array('method', 'length', 'max'=>150),
			array('references', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, requestId, sample_id, sampleCode, testName, method, references, quantity, fee, testId, analysisMonth, analysisYear, cancelled, deleted, package, countTest', 'safe', 'on'=>'search'),
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
			'sample'	=> array(self::BELONGS_TO, 'Sample', 'sample_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
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
			'cancelled' => 'Cancelled',
			'deleted' => 'Deleted',
			
			'sampleName' => 'SAMPLE',
			'sampleType' => 'Sample Type',
			'testCategory' => 'Test Category',
			
			'rate' => 'Rate',
			'tests' => 'Tests',
			'package' => 'Package'
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
	 * @return Analysis the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function beforeSave(){
	   if(parent::beforeSave())
	   {
			if($this->isNewRecord){
				$this->sampleCode = 
				$this->cancelled = 0;
				$this->deleted = 0;
		        return true;	
			}else{
				$this->testName = Test::model()->findByPk($_POST['Analysis']['testName'])->testName;
				return true;
			}
	   }
	   return false;
	}
	
	protected function afterSave(){
		parent::afterSave();
		$request=new Request;
		$request->updateRequestTotal($this->sample->request->id);
		
		Analysis::model()->updateByPk($this->id, 
			array('sampleCode'=>$this->sample->sampleCode,
			));
	}
	
}

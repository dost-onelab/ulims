<?php

/**
 * This is the model class for table "lab_sampletype_testname_method_service".
 *
 * The followings are the available columns in table 'lab_sampletype_testname_method_service':
 * @property integer $lab_id
 * @property string $labName
 * @property integer $sampleType_id
 * @property string $type
 * @property integer $testName_id
 * @property string $testName
 * @property integer $methodreference_id
 * @property string $method
 * @property string $reference
 * @property double $fee
 * @property integer $agency_id
 */
//class LabSampletypeTestnameMethodService extends CActiveRecord
class Labservice extends CActiveRecord
{
	public $offered;
	
	public function primaryKey(){
            return 'lab_id';
        }
        
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		//return 'lab_sampletype_testname_method_service';
		return 'lab_service';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('method, reference, fee', 'required'),
			array('lab_id, sampleType_id, testName_id, methodreference_id, agency_id', 'numerical', 'integerOnly'=>true),
			array('fee', 'numerical'),
			array('labName', 'length', 'max'=>50),
			array('type', 'length', 'max'=>75),
			array('testName, method, reference', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('lab_id, labName, sampleType_id, type, testName_id, testName, methodreference_id, method, reference, fee, agency_id, offered', 'safe', 'on'=>'search'),
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
			'lab_id' => 'Lab',
			'labName' => 'Lab Name',
			'sampleType_id' => 'Sample Type',
			'type' => 'Type',
			'testName_id' => 'Test Name',
			'testName' => 'Test Name',
			'methodreference_id' => 'Methodreference',
			'method' => 'Method',
			'reference' => 'Reference',
			'fee' => 'Fee',
			'agency_id' => 'Agency',
			'offered' => 'Offered',
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
		$criteria->compare('labName',$this->labName,true);
		$criteria->compare('sampleType_id',$this->sampleType_id);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('testName_id',$this->testName_id);
		$criteria->compare('testName',$this->testName,true);
		$criteria->compare('methodreference_id',$this->methodreference_id);
		$criteria->compare('method',$this->method,true);
		$criteria->compare('reference',$this->reference,true);
		$criteria->compare('fee',$this->fee);
		$criteria->compare('agency_id',$this->agency_id);
		$criteria->group = 'methodreference_id';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function search2()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		/*$criteria=new CDbCriteria;

		$criteria->compare('lab_id',$this->lab_id);
		$criteria->compare('labName',$this->labName,true);
		$criteria->compare('sampleType_id',$this->sampleType_id);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('testName_id',$this->testName_id);
		$criteria->compare('testName',$this->testName,true);
		$criteria->compare('methodreference_id',$this->methodreference_id);
		$criteria->compare('method',$this->method,true);
		$criteria->compare('reference',$this->reference,true);
		$criteria->compare('fee',$this->fee);
		$criteria->compare('agency_id',$this->agency_id);
		$criteria->group = 'methodreference_id';*/
		
		//$agency_id = $_GET['Labservice']['agency_id'];
		//$agency_id = $this->agency_id;
		//echo $agency_id;
		//Resource Address
		//$url = 'http://'.Yii::app()->Controller->getServer().'/labservices/search?agency_id=11';
		$url = 'http://'.Yii::app()->Controller->getServer().'/labservices';	
		//Send Request to Resource
		$client = curl_init();
	    curl_setopt($client, CURLOPT_URL, $url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($client);
		
		$labservices = json_decode($response, true);
		
		$processedServices = Labservice::processResult($labservices); 
		
		return new CArrayDataProvider($processedServices, array(
			//'criteria'=>$criteria,
		));
		
		/*return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));*/
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
	 * @return LabSampletypeTestnameMethodService the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function checkOffered($agencies)
	{
		$offered = false;
		foreach($agencies as $agency)
		{
			if($agency == Yii::app()->Controller->getRstlId())
				$offered = true;
		}
		return $offered;
	}
	
	public static function processResult($sourceArray)
	{
		$newArray = array();
	
	    // Create a new array from the source array. 
	    // We'll use the agency_id as a lookup.
	    foreach($sourceArray as $element) {
	
	        $elementKey = $element['methodreference_id'];
	
	        // Does this brand/model combo already exist?
	        if(!isset($newArray[$elementKey])) {
	            // No - create the new element.
	            $newArray[$elementKey] = array('lab_id'=>$element['lab_id'],
	                                           'labName'=>$element['labName'],
	            								'sampleType_id'=>$element['sampleType_id'], 
									            'type'=>$element['type'], 
									            'testName_id'=>$element['testName_id'],
	            								'testName'=>$element['testName'], 
									            'methodreference_id'=>$element['methodreference_id'], 
									            'method'=>$element['method'],
	            								'reference'=>$element['reference'], 
									            'fee'=>$element['fee'], 
	                                            'agency_id'=>array($element['agency_id']),
	                                           );
	        }
	        else {
	            // Yes - add the agency_id (if it's not already present).
	            if(!in_array($element['agency_id'], $newArray[$elementKey]['agency_id'])) {
	                $newArray[$elementKey]['agency_id'][] = $element['agency_id'];
	            }
	        }
	    }
	    
	    return $newArray;
	}
}

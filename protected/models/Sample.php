<?php

/**
 * This is the model class for table "sample".
 *
 * The followings are the available columns in table 'sample':
 * @property integer $id
 * @property string $sampleCode
 * @property string $sampleName
 * @property string $description
 * @property string $remarks
 * @property string $requestId
 * @property integer $request_id
 * @property integer $sampleMonth
 * @property integer $sampleYear
 * @property integer $cancelled
 */
class Sample extends CActiveRecord
{
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
			//array('sampleCode, sampleName, description, remarks, requestId, request_id, sampleMonth, sampleYear, cancelled', 'required'),
			array('sampleName, description', 'required'),
			array('request_id, sampleMonth, sampleYear, cancelled', 'numerical', 'integerOnly'=>true),
			array('sampleCode', 'length', 'max'=>20),
			array('sampleName, requestId', 'length', 'max'=>50),
			array('remarks', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sampleCode, sampleName, description, remarks, requestId, request_id, sampleMonth, sampleYear, cancelled', 'safe', 'on'=>'search'),
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
			'request'	=> array(self::BELONGS_TO, 'Request', 'request_id'),
			//'analyses'	=> array(self::HAS_MANY, 'Analysis', 'sample_id', 'condition' => 'sampleCode=sampleCode AND cancelled=0 AND deleted=0'),
			//'analysisCount' => array(self::STAT, 'Analysis', 'sample_id', 'condition' => 'sampleCode=sampleCode AND cancelled=0 AND deleted=0'),
			//'analysisTotal' => array(self::STAT, 'Analysis', 'sample_id', 'condition' => 'sampleCode=sampleCode AND cancelled=0 AND deleted=0', 'select'=> 'SUM(fee)'),
			'analysesForGeneration'	=> array(self::HAS_MANY, 'Analysis', 'sample_id', 'condition' => 'cancelled=0 AND deleted=0'),
			'analyses'	=> array(self::HAS_MANY, 'Analysis', 'sample_id', 'condition' => 'cancelled=0 AND deleted=0 AND package!=2'),
			'analysisCount' => array(self::STAT, 'Analysis', 'sample_id', 'condition' => 'cancelled=0 AND deleted=0 AND package!=2'),
			'analysisTotal' => array(self::STAT, 'Analysis', 'sample_id', 'condition' => 'cancelled=0 AND deleted=0'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sampleCode' => 'Sample Code',
			'sampleName' => 'Sample Name',
			'description' => 'Description',
			'remarks' => 'Remarks',
			'requestId' => 'Request',
			'request_id' => 'Request',
			'sampleMonth' => 'Sample Month',
			'sampleYear' => 'Sample Year',
			'cancelled' => 'Cancelled',
			'analyses' => 'Analyses',
			'saveAsTemplate' => 'saveAsTemplate'
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
		$criteria->compare('analyses',$this->analyses,true);
		$criteria->compare('sample.sampleCode',$this->sampleCode,true);
		$criteria->compare('sample.sampleName',$this->sampleName,true);
		$criteria->compare('sample.description',$this->description,true);
		$criteria->compare('sample.remarks',$this->remarks,true);
		$criteria->compare('sample.requestId',$this->requestId,true);
		$criteria->compare('sample.request_id',$this->request_id);
		$criteria->compare('sample.sampleMonth',$this->sampleMonth);
		$criteria->compare('sample.sampleYear',$this->sampleYear);
		$criteria->compare('sample.cancelled',$this->cancelled);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchByRequest($id)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$sort = new CSort();
		$sort->attributes = array(
			'sampleCode'=>array(
			  'asc'=>'sampleCode',
			  'desc'=>'sampleCode desc',
			),			
			'*' //to make all other columns sortable
		);
		$sort->defaultOrder='sample.sampleCode ASC';
		
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('request_id',$id);
		$criteria->compare('analyses',$this->analyses,true);
		$criteria->compare('sample.sampleCode',$this->sampleCode,true);
		$criteria->compare('sample.sampleName',$this->sampleName,true);
		$criteria->compare('sample.description',$this->description,true);
		$criteria->compare('sample.remarks',$this->remarks,true);
		$criteria->compare('sample.requestId',$this->requestId,true);
		$criteria->compare('sample.request_id',$this->request_id);
		$criteria->compare('sample.sampleMonth',$this->sampleMonth);
		$criteria->compare('sample.sampleYear',$this->sampleYear);
		$criteria->compare('sample.cancelled',$this->cancelled);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination'=>false,
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
	 * @return Sample the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function getAnalyses($analyses) 
	{
		        $tmp = '<div class="raw2">';
        foreach ($analyses as $analysis) {
            $tmp = $tmp.$analysis->testName.'';
        }
        $tmp = $tmp.'</div>';
        return $tmp;
    }
    
	public function beforeSave(){
	   if(parent::beforeSave())
	   {
			if($this->isNewRecord){
				$this->cancelled = 0;
		        return true;
			}else{
				//$this->dateEstablished = date('Y-m-d',  strtotime($_POST['Customerprofile']['dateEstablished']));
				//$this->updatedAt = date('Y-m-d');
				return true;
			}
	   }
	   return false;
	}
	
	public function getStatus() {
        
        $statuscolor='white';
        switch ($this->cancelled) {
            case 0:
                $statuscolor='green';
                break;
            case 1:
                $statuscolor='redish';
                break;
        }
        return $statuscolor;
        
    }
	/*
	protected function afterSave(){
		parent::afterSave();
		if($this->isNewRecord){
			$analysis = New Analysis;
			$analysis->requestId = $this->requestId;
			$analysis->sample_id = $this->id;
			$analysis->sampleCode = '-';
			$analysis->testName = '-';
			$analysis->method = '-';
			$analysis->references = '-';
			$analysis->quantity = 1;
			$analysis->fee = 0;
			$analysis->testId = 0;
			$analysis->analysisMonth = $this->sampleMonth;
			$analysis->analysisYear = $this->sampleYear;;
		    $analysis->cancelled = 0;
		    $analysis->deleted = 0;
		    $analysis->save();
		}
	
	}
	*/
}

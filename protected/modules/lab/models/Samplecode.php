<?php

/**
 * This is the model class for table "samplecode".
 *
 * The followings are the available columns in table 'samplecode':
 * @property integer $id
 * @property string $requestId
 * @property integer $labId
 * @property integer $number
 * @property integer $year
 * @property integer $cancelled
 */
class Samplecode extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'samplecode';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rstl_id, labId, number, year', 'required'),
			array('rstl_id, labId, number, year, cancelled', 'numerical', 'integerOnly'=>true),
			array('requestId', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, rstl_id, requestId, labId, number, year, cancelled', 'safe', 'on'=>'search'),
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
			'requestId' => 'Request',
			'labId' => 'Lab',
			'number' => 'Number',
			'year' => 'Year',
			'cancelled' => 'Cancelled',
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
		$criteria->compare('labId',$this->labId);
		$criteria->compare('number',$this->number);
		$criteria->compare('year',$this->year);
		$criteria->compare('cancelled',$this->cancelled);

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
	 * @return Samplecode the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	function generateSampleCode($modelLab, $year){
		$sampleCode = Samplecode::model()->find(array(
	   			'select'=>'*',
				'order'=>'number DESC, id DESC',
	    		'condition'=>'rstl_id = :rstl_id AND labId = :labId AND year = :year AND cancelled = 0',
	    		'params'=>array(':rstl_id' => Yii::app()->Controller->getRstlId(), ':labId' => $modelLab->id, ':year' => $year )
			));
			
		if(isset($sampleCode)){
			return $modelLab->labCode.'-'.Yii::app()->Controller->addZeros($sampleCode->number + 1);
		}else{
			$initializeCode = Initializecode::model()->find(array(
	   			'select'=>'*',
	    		'condition'=>'rstl_id = :rstl_id AND lab_id = :lab_id AND codeType = :codeType',
	    		'params'=>array(':rstl_id' => Yii::app()->Controller->getRstlId(), ':lab_id' => $modelLab->id, ':codeType' => 2)
			));
			$startCode = Yii::app()->Controller->addZeros($initializeCode->startCode + 1);
			return $modelLab->labCode.'-'.$startCode;
		}
	}
}

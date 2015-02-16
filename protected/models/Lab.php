<?php

/**
 * This is the model class for table "lab".
 *
 * The followings are the available columns in table 'lab':
 * @property integer $id
 * @property string $labName
 * @property string $labCode
 * @property integer $status
 */
class Lab extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ulimslab.lab';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('labName, labCode, status', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('labName', 'length', 'max'=>50),
			array('labCode', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, labName, labCode, status', 'safe', 'on'=>'search'),
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
			'manager' => array(self::HAS_ONE, 'Labmanager', 'lab_id'),
			'initializeCode' => array(self::HAS_ONE, 'Initializecode', 'lab_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'labName' => 'Lab Name',
			'labCode' => 'Lab Code',
			'nextRequestCode' => 'Next Request Code | SampleCode',
			'status' => 'Status',
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
		$criteria->compare('labName',$this->labName,true);
		$criteria->compare('labCode',$this->labCode,true);
		$criteria->compare('status',$this->status);

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
	 * @return Lab the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function listData_()
	{
		return CHtml::listData(Lab::model()->findAll(array(
			'order'=>'id ASC', 
			'params'=>array(':status'=>1))
		),	'id', 'labCode');
	}
	
	public static function listLabName()
	{
		return CHtml::listData(Lab::model()->findAll(array(
			'order'=>'id ASC', 
			'params'=>array(':status'=>1))
		),	'id', 'labName');
	}
	
	public static function checkIfInitialized($lab){
		$linkInitialize = Chtml::link('<span class="icon-refresh icon-white"></span> Initialize', '', array(
				'class'=>'btn btn-success btn-small',
                'style'=>'cursor:pointer; font-weight:normal;color:white;',
				'title'=>'Initialize this Laboratory',
                'onClick'=>'js:{
                				if('.$lab->status.'==0){
                					//return false;
                					alert("Please activate this laboratory before initializing.")
                				}else{	
                					initializeCode('.$lab->id.');
                					$("#dialogInitializeCode").dialog("open");
                				}
							}',
                ));
        $request = new Request;
        $samplecode = new Samplecode;                    
		return $lab->initializeCode ? $request->generateRequestRef($lab->id).' / '.$samplecode->generateSampleCode($lab) : $linkInitialize;
	}	

}

<?php

/**
 * This is the model class for table "result".
 *
 * The followings are the available columns in table 'result':
 * @property integer $id
 * @property integer $referral_id
 * @property string $filename
 */
class Result extends CFormModel
{
	public $id;
	public $referral_id;
	public $filename;
	public $uploadFile;
	
	//public $id, $referral_id, $filename, $uploadFile;
	/**
	 * @return string the associated database table name
	 */
	/*public function tableName()
	{
		return 'result';
	}*/

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('referral_id', 'required'),
			array('referral_id', 'numerical', 'integerOnly'=>true),
			array('filename', 'length', 'max'=>500),
			array('uploadFile', 'file', 'types'=>'jpg, pdf, png', 'allowEmpty'=>FALSE,'maxSize' => 1024 * 1024 * 2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, referral_id, filename, uploadFile, test', 'safe', 'on'=>'search'),
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
			'filename' => 'Filename',
			'uploadFile' => 'File',
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
		$criteria->compare('filename',$this->filename,true);

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
	 * @return Result the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

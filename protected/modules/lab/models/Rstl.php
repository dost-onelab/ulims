<?php

/**
 * This is the model class for table "rstl".
 *
 * The followings are the available columns in table 'rstl':
 * @property integer $id
 * @property string $name
 * @property string $code
 */
class Rstl extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ulimsportal.rstl';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, code', 'required'),
			array('name', 'length', 'max'=>50),
			array('code', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, code, region_id', 'safe', 'on'=>'search'),
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
			'region'	=> array(self::BELONGS_TO, 'Region', 'region_id'),
			'labConfig' => array(self::HAS_ONE, 'Configlab', 'rstl_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('code',$this->code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->db;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Rstl the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function listData()
	{
		return CHtml::listData(Rstl::model()->findAll(), 
							'id', 'name');
	}

	public static function getRstlName($rstl_id)
	{
		$rstlArray = array(
				'1' => 'RSTL I',
				'2' => 'RSTL II',
				'3' => 'RSTL III',
				'4' => 'RSTL IVA1',
				'5' => 'RSTL IVA2',
				'6' => 'RSTL IVB',
				'7' => 'RSTL V',
				'8' => 'RSTL VI',
				'9' => 'RSTL VII',
				'10' => 'RSTL VIII',
				'11' => 'RSTL IX',
				'12' => 'RSTL X',
				'13' => 'RSTL XI',
				'14' => 'RSTL XII1',
				'15' => 'RSTL XII2',
				'16' => 'RSTL CAR',
				'17' => 'RSTL CARAGA',
				'18' => 'RSTL ARMM',
				'19' => 'FNRI',
				'20' => 'FPRDI',
				'21' => 'ITDI',
				'22' => 'MIRDC',
				'23' => 'PTRI',
				'24' => 'PNRI',
				'25' => 'IVA3'
			);

		return $rstlArray[$rstl_id];
	}
}

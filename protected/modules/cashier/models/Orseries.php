<?php

/**
 * This is the model class for table "orseries".
 *
 * The followings are the available columns in table 'orseries':
 * @property integer $id
 * @property integer $orcategory_id
 * @property integer $rstl_id
 * @property string $startor
 * @property string $nextor
 * @property string $endor
 * @property integer $status
 */
class Orseries extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'orseries';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('orcategory_id, rstl_id, startor, endor, status', 'required'),
			array('orcategory_id, rstl_id', 'numerical', 'integerOnly'=>true),
			array('startor, endor', 'numerical', 'integerOnly'=>false),
			array('startor, nextor, endor', 'length', 'max'=>50),
			array('name', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, orcategory_id, rstl_id, name, startor, nextor, endor, status, categoryName', 'safe', 'on'=>'search'),
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
			'orcategory'=> array(self::BELONGS_TO, 'Orcategory', 'orcategory_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'orcategory_id' => 'O.R. Category',
			'rstl_id' => 'Rstl',
			'name'=>'Name/ Description/ Purpose',
			'startor' => 'Start O.R.',
			'nextor' => 'Next O.R.',
			'endor' => 'End O.R.',
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
		$criteria->compare('orcategory_id',$this->orcategory_id);
		$criteria->compare('rstl_id',$this->rstl_id);
		$criteria->compare('name',$this->name);
		$criteria->compare('startor',$this->startor,true);
		$criteria->compare('nextor',$this->nextor,true);
		$criteria->compare('endor',$this->endor,true);
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
		return Yii::app()->cashierDb;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Orseries the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function listData($depositType=NULL, $create=NULL)
	{
		$criteria=new CDbCriteria;
		$criteria->with=array('orcategory');
		$criteria->condition='status=:active';
		$criteria->order='t.id ASC';
		$criteria->params=array(':active'=>1);
							
		if($depositType){
			$criteria=new CDbCriteria;
			$criteria->with=array('orseries');
			$criteria->condition='project=:depositType';
			$criteria->group='orseries_id';
			$criteria->params=array(':depositType'=>$depositType);
			$receipts=Receipt::model()->findAll($criteria);
			return CHtml::listData($receipts, 'orseries_id', 'orseries.name', 'orseries.categoryName');
		}
		
		if($depositType==NULL && $create){
			return array();
			}
		//if($create)
			//return array();
		return CHtml::listData(Orseries::model()->findAll($criteria), 
							'id', 'name', 'orcategory.name');
							
	}
	
	protected function beforeSave(){
		if(parent::beforeSave()){
			if(intval($this->nextor) > intval($this->endor)){
				$this->status=0;
			}else{
				$this->status=1;
			}
			return true;
		}
	}

	public function getCategoryName()
	{
		if($this->orcategory_id)
			return $this->orcategory->name;
	}
	
}

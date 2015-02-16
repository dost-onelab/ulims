<?php

/**
 * This is the model class for table "activerecordlog".
 *
 * The followings are the available columns in table 'activerecordlog':
 * @property string $id
 * @property string $description
 * @property string $action
 * @property string $model
 * @property string $idModel
 * @property string $field
 * @property string $creationdate
 * @property string $userid
 */
class ActiveRecordLog extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ActiveRecordLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'activerecordlog';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('creationdate', 'required'),
			array('description', 'length', 'max'=>255),
			array('action', 'length', 'max'=>20),
			array('model, field, userid', 'length', 'max'=>45),
			array('idModel', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, description, action, model, idModel, field, oldAttrib, newAttrib, creationdate, userid', 
					'safe', 'on'=>'search'),
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
			'householdlog'=> array(self::BELONGS_TO, 'Household', 'idModel', 
									'on'=>'t.model="Household"',
									'select'=>'id,householdCode',
									),
			'assistancelog'=> array(self::BELONGS_TO, 'Assistance', 'idModel', 
									'on'=>'t.model="Assistance"',
									'select'=>'id,household_id',
									),
								
			'evacueelog'=> array(self::BELONGS_TO, 'Evacuee', 'idModel', 
									'on'=>'t.model="Evacuee"',
									'select'=>'id,household_id',
									),
									
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Log No.',
			'description' => 'Description',
			'action' => 'Action Done',
			'model' => 'Model',
			'idModel' => 'Id Model',
			'field' => 'Field',
			'oldAttrib' => 'Old Attribute',
			'newAttrib' => 'New Attribute',
			'creationdate' => 'Date/Time',
			'userid' => 'User',
			'evacueelog.household_id'=>'HHID(Evacuee)',
			'assistancelog.household_id'=>'HHID(Assistance)',
			
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('action',$this->action,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('idModel',$this->idModel,true);
		$criteria->compare('field',$this->field,true);
		$criteria->compare('oldAttrib',$this->oldAttrib,true);
		$criteria->compare('newAttrib',$this->newAttrib,true);
		$criteria->compare('creationdate',$this->creationdate,true);
		$criteria->compare('userid',$this->userid,true);

		return new CActiveDataProvider($this, array(
			'sort'=>array(
				'defaultOrder'=>'id DESC',
			  ),
			'criteria'=>$criteria,
			//'pagination'=>array('pageSize'=>$this->count()), //ALL
			//'pagination'=>array('pageSize'=>20), //by 20s			
		));
	}
	
	public function searchHouseholdLogs($id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		
		$criteria->with=array(
						'householdlog'=>array('select'=>'id,householdCode'),
						'assistancelog'=>array('select'=>'id,household_id'),
						'evacueelog'=>array('select'=>'id,household_id')
					);
		//$criteria->together=true;
		$criteria->condition='assistancelog.household_id=:hhId '.
								'OR evacueelog.household_id=:hhId OR '.
								'householdlog.id=:hhId';
		$criteria->params=array(':hhId'=>$id);
		
		$criteria->compare('id',$this->id,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('action',$this->action,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('idModel',$this->idModel,true);
		$criteria->compare('field',$this->field,true);
		$criteria->compare('oldAttrib',$this->oldAttrib,true);
		$criteria->compare('newAttrib',$this->newAttrib,true);
		$criteria->compare('creationdate',$this->creationdate,true);
		$criteria->compare('userid',$this->userid,true);

		return new CActiveDataProvider($this, array(
			'sort'=>array(
				'defaultOrder'=>'t.id DESC',
			  ),
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>$this->count()), //ALL
			//'pagination'=>array('pageSize'=>20), //by 20s			
		));
	}
	
	
}
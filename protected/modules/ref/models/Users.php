<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $activkey
 * @property string $create_at
 * @property string $lastvisit_at
 * @property integer $superuser
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Profiles $profiles
 */
class Users extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, email, create_at', 'required'),
			array('superuser, status', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>20),
			array('password, email, activkey', 'length', 'max'=>128),
			array('lastvisit_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, email, activkey, create_at, lastvisit_at, superuser, status', 'safe', 'on'=>'search'),
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
			'profiles' => array(self::HAS_ONE, 'Profiles', 'user_id'),
			'authassignment' => array(self::HAS_ONE, 'Authassignment', 'userid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'activkey' => 'Activkey',
			'create_at' => 'Create At',
			'lastvisit_at' => 'Lastvisit At',
			'superuser' => 'Superuser',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('activkey',$this->activkey,true);
		$criteria->compare('create_at',$this->create_at,true);
		$criteria->compare('lastvisit_at',$this->lastvisit_at,true);
		$criteria->compare('superuser',$this->superuser);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->db;
	}
	
	public static function listData()
	{
		$users = Users::model()->with(array(
					'profiles'=>array(
						'condition'=>'profiles.pstc = :pstc',
						'params'=>array(':pstc'=>Yii::app()->Controller->getRstlId())
					),
					'authassignment'=>array(
						'condition'=>'authassignment.itemname = :itemname',
						'params'=>array(':itemname'=>'Lab - System Manager')
					),
					))->findAll(array('condition'=>'t.status = 1'));
		
		return CHtml::listData($users,	'id', 'fullname');
	}
	
	public static function listPersonnel()
	{
		$users = Users::model()->with(array(
					'profiles'=>array(
						'condition'=>'profiles.pstc = :pstc',
						'params'=>array(':pstc'=>Yii::app()->Controller->getRstlId())
					),
					'authassignment'=>array(
						'condition'=>'authassignment.itemname = :itemname OR authassignment.itemname = :itemname2',
						'params'=>array(':itemname'=>'Lab - System Manager', ':itemname2'=>'Cashier')
					),
					))->findAll(array('condition'=>'t.status = 1'));
		
		return CHtml::listData($users,	'fullname', 'fullname');
	}
	
	public function getFullname()
	{
		return $this->profiles->firstname.' '.$this->profiles->mi.'. '.$this->profiles->lastname;
	}
	
	function validateTechnicalManager($user_id, $password)
	{
		$user = Users::model()->findByPk($user_id);
		if($user){
			if($user->password === md5($password))
				return true;
			else
				return false;
		}else{
			return false;	
		}
	}
}

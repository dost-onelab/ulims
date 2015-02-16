<?php

/**
 * This is the model class for table "cancelledrequest".
 *
 * The followings are the available columns in table 'cancelledrequest':
 * @property integer $id
 * @property integer $request_id
 * @property string $requestRefNum
 * @property string $reason
 * @property string $cancelDate
 * @property integer $cancelledBy
 */
class Cancelledrequest extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cancelledrequest';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('request_id, requestRefNum, reason', 'required'),
			array('request_id', 'numerical', 'integerOnly'=>true),
			array('requestRefNum, reason', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, request_id, requestRefNum, reason, cancelDate, cancelledBy', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'request_id' => 'Request',
			'requestRefNum' => 'Request Ref Num',
			'reason' => 'Reason',
			'cancelDate' => 'Cancel Date',
			'cancelledBy' => 'Cancelled By',
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
		$criteria->compare('request_id',$this->request_id);
		$criteria->compare('requestRefNum',$this->requestRefNum,true);
		$criteria->compare('reason',$this->reason,true);
		$criteria->compare('cancelDate',$this->cancelDate,true);
		$criteria->compare('cancelledBy',$this->cancelledBy);

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
	 * @return Cancelledrequest the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function beforeSave(){
	   if(parent::beforeSave())
	   {
			if($this->isNewRecord){
				$this->cancelDate = date('Y-m-d',strtotime($_POST['Cancelledrequest']['cancelDate']));
				$this->cancelledBy = Yii::app()->getModule('user')->user()->id;
		        return true;
			}else{
				//$this->reportDue = date('Y-m-d',strtotime($_POST['Cancelledrequest']['reportDue']));
				//$this->cancelledBy = Yii::app()->getModule('user')->user()->id;
				return true;
			}
	   }
	   return false;
	}
	
	protected function afterSave(){
		parent::afterSave();
		if($this->isNewRecord){
			Request::model()->updateByPk($this->request_id, 
				array('cancelled'=>1, 'total'=>0,
				));
			$request = Request::model()->findByPk($this->request_id);
			foreach($request->samps as $samples){
				Sample::model()->updateByPk($samples->id, 
					array('cancelled'=>1,
				));
			}
			foreach($request->anals as $analysis){
				Analysis::model()->updateByPk($analysis->id, 
					array('cancelled'=>1, 'fee'=>0,
				));
			}
			return true;
		}else{
			//$this->updateRequestTotal($this->id);
			return true;
		}
	}
}

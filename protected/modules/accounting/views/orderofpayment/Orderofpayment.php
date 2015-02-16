<?php

/**
 * This is the model class for table "orderofpayment".
 *
 * The followings are the available columns in table 'orderofpayment':
 * @property integer $id
 * @property string $transactionNum
 * @property integer $collectiontype_id
 * @property string $date
 * @property integer $customer_id
 * @property string $customerName
 * @property double $amount
 * @property string $purpose
 */
class Orderofpayment extends CActiveRecord
{

	public $natureOfCollection;
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ulimsaccounting.orderofpayment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('transactionNum, collectiontype_id, date, customer_id, customerName, amount, purpose', 'required'),
			array('collectiontype_id, date, customerName, purpose', 'required'),
			array('rstl_id, collectiontype_id, customer_id', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('transactionNum', 'length', 'max'=>50),
			array('customerName', 'length', 'max'=>250),
			array('address', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, transactionNum, collectiontype_id, date, customer_id, customerName, address, amount, purpose, natureOfCollection', 'safe', 'on'=>'search'),
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
			'paymentitems' => array(self::HAS_MANY, 'Paymentitem', 'orderofpayment_id'),
			'collectiontype'	=> array(self::BELONGS_TO, 'Collectiontype', 'collectiontype_id'),
			'totalPayment' => array(self::STAT, 'Paymentitem', 'orderofpayment_id', 'select'=> 'SUM(amount)', 'condition'=>'cancelled=0'),
			'receipt' => array(self::HAS_ONE, 'Receipt', 'orderofpayment_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'transactionNum' => 'Transaction Num',
			'collectiontype_id' => 'Collectiontype',
			'date' => 'Date',
			'customer_id' => 'Customer',
			'customerName' => 'Customer Name',
			'address' => 'Address',
			'amount' => 'Amount',
			'purpose' => 'Purpose',
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
		
		$criteria->with=array('collectiontype');
		$criteria->compare('id',$this->id);
		$criteria->order = 't.id DESC';
		$criteria->compare('t.rstl_id', Yii::app()->Controller->getRstlId());
		$criteria->compare('transactionNum',$this->transactionNum,true);
		$criteria->compare('collectiontype_id',$this->collectiontype_id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('customerName',$this->customerName,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('purpose',$this->purpose,true);
		$criteria->compare('natureOfCollection', $this->natureOfCollection, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->accountingDb;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Orderofpayment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function beforeSave(){
	   if(parent::beforeSave())
	   {
			if($this->isNewRecord){
				$this->transactionNum = $this->getTransactionNum();
				$this->rstl_id = Yii::app()->Controller->getRstlId();
				$this->date = date('Y-m-d', strtotime($_POST['Orderofpayment']['date']));
		        return true;
			}else{
				//$this->payor = $_POST['receiptPayor'];
				$this->date = date('Y-m-d', strtotime($_POST['Orderofpayment']['date']));
				return true;
			}
	   }
	   return false;
	}
	
	protected function afterSave(){
		parent::afterSave();
		/*if($this->isNewRecord){
			$this->date = date('Y-m-d', strtotime($_POST['Orderofpayment']['date']));;
			return true;
		}else{
			$this->date = date('Y-m-d', strtotime($_POST['Orderofpayment']['date']));;
			return true;
		}*/
	}
	
	function getTransactionNum()
	{
		$criteria=new CDbCriteria;
		$criteria->condition = 'rstl_id ='.Yii::app()->Controller->getRstlId(); 
		$criteria->order = 'id DESC';  
		$lastOP = Orderofpayment::model()->find($criteria);

		if($lastOP){
			$temp = explode('-', $lastOP->transactionNum);
			$count = $temp[2] + 1;
		}else{
			$count = 1;
		}
		
		return date('Y').'-'.date('m').'-'.$this->addZeros(	$count);
	}
	
	function addZeros($count){
		if($count < 10)
			return '000'.$count;
		elseif ($count < 100)
			return '00'.$count;
		elseif ($count < 1000)
			return '0'.$count;
		elseif ($count >= 1000)
			return $count;
	}
	
	function getReferences($id){
		
		$OP = Orderofpayment::model()->findByPk($id);
		$temp = '';
		$count = count($OP->paymentitems);
		foreach($OP->paymentitems as $item){
			$temp .= $item->details;
			$temp .= ($count > 1) ? ', ' : '';
		}
		
		return $temp;
	}
	
	function countForReceipt()
	{
		$OPs = Orderofpayment::model()->findAll(array(
			'condition'=>'createdReceipt = :createdReceipt', 'params'=>array(':createdReceipt'=>0)
		));
		
		return count($OPs);
	}
	
}

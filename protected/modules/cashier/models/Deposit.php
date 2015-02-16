<?php

/**
 * This is the model class for table "deposit".
 *
 * The followings are the available columns in table 'deposit':
 * @property integer $id
 * @property integer $startOr
 * @property integer $endOr
 * @property string $depositDate
 * @property double $amount
 * @property integer $depositType
 */
class Deposit extends CActiveRecord
{
	public $DepositTotal;
	public $override;
	public $endOrOverride;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'deposit';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('startOr, endOr, depositDate, amount, depositType', 'required'),
			array('orseries_id, startOr, endOr, depositDate, amount, depositType', 'required'),
			array('orseries_id, startOr, endOr, depositType', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, startOr, endOr, depositDate, amount, depositType, orseries_id, endOrOverride', 'safe', 'on'=>'search'),
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
			'orseries_id' => 'O.R. Series',
			'startOr' => 'Start O.R.',
			'endOr' => 'End O.R.',
			'depositDate' => 'Deposit Date',
			'amount' => 'Amount',
			'depositType' => 'Deposit Type',
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
		$criteria->compare('t.rstl_id', Yii::app()->Controller->getRstlId());
		$criteria->compare('startOr',$this->startOr);
		$criteria->compare('endOr',$this->endOr);
		$criteria->compare('depositDate',$this->depositDate,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('depositType',$this->depositType);
		$criteria->order = 'id DESC';

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
	 * @return Deposit the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function beforeSave(){
	   if(parent::beforeSave())
	   {
			if($this->isNewRecord){
				$this->rstl_id = Yii::app()->Controller->getRstlId();
				$this->depositDate = date('Y-m-d', strtotime($_POST['Deposit']['depositDate']));
				return true;
			}else{
				$this->depositDate = date('Y-m-d', strtotime($_POST['Deposit']['depositDate']));				
				return true;
			}
	   }
	   return false;
	}	
	
	public function getLastOr($depositType)
	{
		$endReceipt = array();
		
		$start = Deposit::getFirstOr($depositType);
		
		$receipt = Receipt::model()->findByAttributes(
			array('receiptId'=>$start)
		);
		
		$modelReceipts = Receipt::model()->findAll(array(
			'condition' => 'id >= :id AND project = :project AND rstl_id = :rstl_id',
			'params' => array(':id' => $receipt->id, ':project' => $receipt->project, ':rstl_id'=> Yii::app()->Controller->getRstlId()),
		));
		
		$y = array("index" => '' , "receipt" => '');
			array_push($endReceipt, $y);		
				
		foreach($modelReceipts as $modelReceipt){
			$y = array("index" => $modelReceipt->receiptId , "receipt" => $modelReceipt->receiptId);
			array_push($endReceipt, $y);
		}		
				
		return $endReceipt;		
	}
	
	public function getLastOrJSON($depositType)
	{
		$endReceipt = array();
		
		$start = Deposit::getFirstOr($depositType);
		
		$receipt = Receipt::model()->findByAttributes(
			array('receiptId'=>$start)
		);

		$modelReceipts = Receipt::model()->findAll(array(
					'condition' => 'id >= :id AND project = :project AND project = :project AND rstl_id = :rstl_id',
					'params' => array(':id' => $receipt->id, ':project' => $depositType, ':rstl_id'=> Yii::app()->Controller->getRstlId()),
				));
				
		$modelReceipts = CHtml::listdata($modelReceipts, 'receiptId', 'receiptId');
		
		$endReceipts .=  CHtml::tag('option', array('value'=>''),CHtml::encode($name),true);
		
		foreach($modelReceipts as $value=>$name){
			$endReceipts .= CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
		}		

		return $endReceipts;		
	}
	
	public function getFirstOr($depositType)
	{
		$depositExist = Deposit::model()->find(array(
					'condition' => 'depositType = :depositType AND rstl_id = :rstl_id',
				    'params' => array(':depositType' => $depositType, ':rstl_id'=> Yii::app()->Controller->getRstlId()),
				));
		
		$lastDepositOr = Deposit::model()->find(array(
					'condition' => 'depositType = :depositType AND rstl_id = :rstl_id',
				    'params' => array(':depositType' => $depositType, ':rstl_id'=> Yii::app()->Controller->getRstlId()),
					'order' => 'depositDate DESC, id DESC',
					'limit' => 1,
				));
				
		if(isset($lastDepositOr)){
			$lastReceiptOrId = Receipt::model()->find(array(
					'condition' => 'receiptId = :receiptId',
				    'params' => array(':receiptId' => $lastDepositOr->endOr),
			))->id;
			
			$startOr = Receipt::model()->find(array(
					'condition' => 'id > :id AND project = :project AND rstl_id = :rstl_id',
				    'params' => array(':id' => $lastReceiptOrId, ':project' => $depositType, ':rstl_id'=> Yii::app()->Controller->getRstlId()),
					'order' => 'id ASC',
			));
		}else{
			$lastReceiptOrId = Receipt::model()->find(array(
					'condition' => 'rstl_id = :rstl_id',
				    'params' => array(':rstl_id'=> Yii::app()->Controller->getRstlId()),
				    'order' => 'id ASC',
			))->id;
			
			$startOr = Receipt::model()->find(array(
					'condition' => 'id = :id AND project = :project AND rstl_id = :rstl_id',
				    'params' => array(':id' => $lastReceiptOrId, ':project' => $depositType, ':rstl_id'=> Yii::app()->Controller->getRstlId()),
					'order' => 'id ASC',
			));
		}
		
		if($startOr)
			$start = $startOr->receiptId;
		
		return $start;
		
	}

	public function getFirstOrBySeries($orseriesId, $project=0)
	{
		$lastDepositOr = Deposit::model()->find(array(
					'condition' => 'orseries_id = :orseriesId AND depositType=:depositType AND rstl_id = :rstl_id',
				    'params' => array(':orseriesId' => $orseriesId, ':depositType'=>$project,
										':rstl_id'=> Yii::app()->Controller->getRstlId()),
					'order' => 'depositDate DESC, id DESC',
				));
				
		if(isset($lastDepositOr)){
			$lastReceiptOrId = Receipt::model()->find(array(
					'condition' => 'receiptId = :receiptId',
				    'params' => array(':receiptId' => $lastDepositOr->endOr),
			))->id;
			
			$startOr = Receipt::model()->find(array(
					'condition' => 'id > :id AND orseries_id = :orseriesId AND rstl_id = :rstl_id',
				    'params' => array(':id' => $lastReceiptOrId, ':orseriesId' => $orseriesId, ':rstl_id'=> Yii::app()->Controller->getRstlId()),
					'order' => 'id ASC',
			));
		}else{
			
			$startOr = Receipt::model()->find(array(
					'condition' => 'project = :project AND orseries_id = :orseriesId AND rstl_id = :rstl_id',
				    'params' => array(':project' => $project, ':orseriesId' => $orseriesId, ':rstl_id'=> Yii::app()->Controller->getRstlId()),
					'order' => 'id ASC'
			));
		}
		
		if($startOr)
			$start = $startOr->receiptId;
		
		return $start;
		
	}

	public function getLastOrJSONBySeries($orseriesId, $project=0)
	{
		$endReceipt = array();
		
		$start = Deposit::getFirstOrBySeries($orseriesId, $project);
		
		$receipt = Receipt::model()->findByAttributes(
			array('receiptId'=>$start)
		);

		$modelReceipts = Receipt::model()->findAll(array(
					'condition' => 'id >= :id AND orseries_id = :orseriesId AND project=:project AND rstl_id=:rstl_id',
					'params' => array(':id' => $receipt->id, ':orseriesId' => $orseriesId,
										':project'=>$project, ':rstl_id'=> Yii::app()->Controller->getRstlId()),
				));
				
		$modelReceipts = CHtml::listdata($modelReceipts, 'receiptId', 'receiptId');
		
		$endReceipts .=  CHtml::tag('option', array('value'=>''),CHtml::encode($name),true);
		
		foreach($modelReceipts as $value=>$name)
			$endReceipts .= CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);		

		return $endReceipts;		
	}
	
	function getDepositTotal($year, $month){
		$receipt=new Receipt;
		$minDate = date("Y-m-d", mktime(0, 0, 0, $month, 1, $year));
		$maxDate = date("Y-m-d", mktime(0, 0, 0, $month, $receipt->getDays($month), $year));
		
		$criteria=new CDbCriteria;
		$criteria->order = 'receiptDate ASC';
		$criteria->with = 'deposit';
		$criteria->condition = 't.receiptDate >= :minDate AND t.receiptDate <= :maxDate';
		$criteria->select= 'SUM(deposit.amount) as DepositTotal';
		$criteria->params = array(':minDate' => $minDate, ':maxDate' => $maxDate);
		$receipt = Receipt::model()->find($criteria);
		
		return ($receipt->DepositTotal == 0) ? '0.0' : $receipt->DepositTotal;
	}
	
 	public function getColor() {
        
        $statuscolor='active';
        switch ($this->cancelled) {
            case 1:
                $statuscolor='cancelled';
                break;
        }
        return $statuscolor;
        
    }
	
}

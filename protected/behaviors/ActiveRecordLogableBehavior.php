<?php
//How to log changes of ActiveRecords
//http://www.yiiframework.com/wiki/9/how-to-log-changes-of-activerecords/
//Written by: pfth
//Updated by: camac
class ActiveRecordLogableBehavior extends CActiveRecordBehavior
{
    private $_oldattributes = array();
 
    public function afterSave($event)
    {
        if (!$this->Owner->isNewRecord) {
 
            // new attributes
            $newattributes = $this->Owner->getAttributes();
            $oldattributes = $this->getOldAttributes();
 
            // compare old and new
            foreach ($newattributes as $name => $value) {
                if (!empty($oldattributes)) {
                    $old = $oldattributes[$name];
                } else {
                    $old = '';
                }
 				
				/* modified by rbg
				 * check if values are date,
				 * in case date is unchanged.
				*/
				$isDate=1;
				$dateNew= explode("-", $value);
				if (is_numeric($dateNew[0]) AND is_numeric($dateNew[1]) AND is_numeric($dateNew[2]))
					$dateNew=$isDate;

				$dateOld= explode("/", $old);
				if (is_numeric($dateOld[0]) AND is_numeric($dateOld[1]) AND is_numeric($dateOld[2]))
					$dateOld=$isDate;
				
				/* modified by rbg
				 * check if values are zero(0) or blank,
				 * 0=blank.
				*/
				//$isBlank=1;
				//if($value==""||$value==NULL)
				//	$valueNew=$isBlank;
				
				//if($old==0)
				//	$valueOld=$isBlank;
				
				//if($valueNew==$valueOld)
				//	$value=$old;
				
				if($dateNew==$dateOld){ //old and new are dates
					//we will compare dates
					$newDate=strtotime($value);
					$oldDate=strtotime($old);
					
				if ($newDate != $oldDate) {
						//$changes = $name . ' ('.$old.') => ('.$value.'), ';
	 
						$log=new ActiveRecordLog;
						$log->description=  'User ' . Yii::app()->user->Name 
												. ' updated ' . $name . ' from ' 
												//. get_class($this->Owner) 
												//. '[' . $this->Owner->getPrimaryKey() .']'
												. $old
												. ' -> ['. date('m/d/Y',strtotime($value)) .']' ;
						$log->action=       'UPDATE';
						$log->model=        get_class($this->Owner);
						$log->idModel=      $this->Owner->getPrimaryKey();
						$log->field=        $name;
						$log->oldAttrib=    $old;
						$log->newAttrib=    date('m/d/Y',strtotime($value));
						$log->creationdate= new CDbExpression('NOW()');
						$log->userid=       Yii::app()->user->id;
						$log->save();
					}
				}else{
					if ($value != $old) {
						//$changes = $name . ' ('.$old.') => ('.$value.'), ';
	 
						$log=new ActiveRecordLog;
						$log->description=  'User ' . Yii::app()->user->Name 
												. ' updated ' . $name . ' from ' 
												//. get_class($this->Owner) 
												//. '[' . $this->Owner->getPrimaryKey() .']'
												. $old
												. ' -> ['. $value .']' ;
						$log->action=       'UPDATE';
						$log->model=        get_class($this->Owner);
						$log->idModel=      $this->Owner->getPrimaryKey();
						$log->field=        $name;
						$log->oldAttrib=    $old;
						$log->newAttrib=    $value;
						$log->creationdate= new CDbExpression('NOW()');
						$log->userid=       Yii::app()->user->id;
						$log->save();
					}
				}
            }
        } else {
			$newattributes = $this->Owner->getAttributes();
			foreach ($newattributes as $name => $value) {
				if ($name=="name"){
					$val=$value;
				}
			}
			
            $log=new ActiveRecordLog;
            $log->description=  'User ' . Yii::app()->user->Name 
                                    . ' created ' . get_class($this->Owner) 
                                    . ' [' . $this->Owner->getPrimaryKey() .']';
									//. ' - ['. $val .']' ;
            $log->action=       'CREATE';
            $log->model=        get_class($this->Owner);
            $log->idModel=      $this->Owner->getPrimaryKey();
            $log->field=        '';
			$log->oldAttrib=    '';
			$log->newAttrib=    '';
            $log->creationdate= new CDbExpression('NOW()');
            $log->userid=       Yii::app()->user->id;
            $log->save();
        }
    }
 
	 public function beforeSave($event) {
		$attr = $this->getOldAttributes();
		if(!$this->Owner->isNewRecord && empty($attr)) {
			$thisModel = call_user_func(array(get_class($this->Owner), 'model'));
			$this->_oldattributes = $thisModel->findByPk($this->owner->getPrimaryKey())->attributes;
		}
	 
		return parent::beforeSave($event);
	}
	 
    public function afterDelete($event)
    {
        $log=new ActiveRecordLog;
        $log->description=  'User ' . Yii::app()->user->Name . ' deleted ' 
                                . get_class($this->Owner) 
                                . '[' . $this->Owner->getPrimaryKey() .'].';
        $log->action=       'DELETE';
        $log->model=        get_class($this->Owner);
        $log->idModel=      $this->Owner->getPrimaryKey();
        $log->field=        '';
        $log->creationdate= new CDbExpression('NOW()');
        $log->userid=       Yii::app()->user->id;
        $log->save();
    }
 
    public function afterFind($event)
    {
        // Save old values
        $this->setOldAttributes($this->Owner->getAttributes());
    }
 
    public function getOldAttributes()
    {
        return $this->_oldattributes;
    }
 
    public function setOldAttributes($value)
    {
        $this->_oldattributes=$value;
    }
}
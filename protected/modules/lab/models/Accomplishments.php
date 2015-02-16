<?php

class Accomplishments extends CFormModel
//class Accomplishments extends CActiveRecord 
{

    public $labId;
    public $year;  
    public $minDate;

    public function rules() {
		return array(
    		array('labId, year', 'required'),
    		array('labId, year', 'safe', 'on'=>'search'),
    	);
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
            return array(
                    'labId'=>'Laboratory',
                    'year'=>'Year',
            );
    }

}
?>

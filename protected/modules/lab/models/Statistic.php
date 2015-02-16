<?php

class Statistic extends CFormModel
//class Accomplishments extends CActiveRecord 
{

    public $labId;
    public $year;  

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
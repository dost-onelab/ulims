<?php
/**
 * FileDoc: 
 * Controller for BarcodeGenerator
 * This is an extension controller to generate a standard / traditional barcode (as images). 
 *  
 * PHP version 5.3
 * 
 * @category Extensions
 * @package  barcodegenerator
 * @author   144key
 * 
 */ 
Yii::import('ext.barcodegenerator.*');

/**
 * ClassDoc:
 * Controller for BarcodeGenerator
 * This is an extension controller to generate a standard / traditional barcode (as images). 
 *  
 * PHP version 5.3
 * 
 * @category Extensions
 * @package  barcodegenerator
 * @author   144key
 * 
 */
class BarcodeGeneratorController extends CExtController
{

    /**
     * Yii filters for controller
     * 
     * @return array - action filters
     */
    public function filters() 
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Rules for widget access
     * 
     * @return array - yii access rules array
     */
    public function accessRules() 
    {
        return array(
            array('allow',
                'actions' => array('GenerateBarcode'),
                'users' => array('*'),
            )
        );
    }

    /**
     * (AJAX Action) 
     * Action to get generated barcode as Image
     */
    public function actionGenerateBarcode() 
    {
		$inputCode = Yii::app()->request->getParam("code", "");
		$bc = new BarcodeGenerator;
		$bc->init('png');
		$bc->build($inputCode);
    }
}

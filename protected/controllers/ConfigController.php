<?php

class ConfigController extends Controller
{

	public $layout='//layouts/column2';
	
	// Uncomment the following methods and override them if needed
	
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		/*return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);*/
		return array('rights');
	}
	/*
	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
	
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Lab');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionAdmin()
	{
		
		$rstlId = Yii::app()->Controller->getRstlId();		
		$rstl = Rstl::model()->findByPk($rstlId);
		
		/* Lab Config*/		
		$activeLabDataProvider = new CActiveDataProvider('Lab');
		
		$criteria = new CDbCriteria;
		$criteria->with = array('manager');	
		$criteria->compare('status',1);		
				
		$labManagerDataProvider = new CActiveDataProvider('Lab', 
			array('criteria'=>$criteria, 'pagination'=>false
	    ));
	    
	    $criteriaDiscount = new CDbCriteria;
	    $discountsDataProvider = new CActiveDataProvider('Discount', 
			array('criteria'=>$criteriaDiscount, 'pagination'=>false
	    ));		
		/* End Lab Config*/
		
		/* Cashier Config*/
		$orseries=new Orseries;
		if(isset($_GET['Orseries'])){
			$orseries->attributes=$_GET['Orseries'];
		}else{
			$orseries->status=1;//only active series
		}
		/* End Cashier Config*/
					
		/* Cashier Config*/
		$bankaccountDataProvider = new CActiveDataProvider('Bankaccount',array(
					'criteria'=>array('order'=>'id ASC')
					));
		/* End Cashier Config*/			
		
					
		/* Personnel Config*/
		$signatoriesDataProvider = 	new CActiveDataProvider('Personnel',array(
					'criteria'=>array('order'=>'name ASC')
					));		
		/* End Personnel Config*/		
		
		/* Test Data (Truncate option)*/
		//$tableSchema=Helper::tableSchema('dbName','tableName');
		$ulimsLabTables=array(
			array('tableName'=>'request', 'model'=>new Request,
				'numRows'=>Request::model()->count(),
				'size'=>Helper::tableSchema('ulimslab','request')->size.' KiB'),
			array('tableName'=>'sample', 'model'=>new Sample,
				'numRows'=>Sample::model()->count(),
				'size'=>Helper::tableSchema('ulimslab','sample')->size.' KiB'),
			array('tableName'=>'analysis', 'model'=>new Analysis,
				'numRows'=>Analysis::model()->count(),
				'size'=>Helper::tableSchema('ulimslab','analysis')->size.' KiB'),
			array('tableName'=>'requestcode', 'model'=>new Requestcode,
				'numRows'=>Requestcode::model()->count(),
				'size'=>Helper::tableSchema('ulimslab','requestcode')->size.' KiB'),
			array('tableName'=>'samplecode', 'model'=>new Samplecode,
				'numRows'=>Samplecode::model()->count(),
				'size'=>Helper::tableSchema('ulimslab','samplecode')->size.' KiB'),
			array('tableName'=>'generatedrequest', 'model'=>new Generatedrequest,
				'numRows'=>Generatedrequest::model()->count(),
				'size'=>Helper::tableSchema('ulimslab','generatedrequest')->size.' KiB'),
			array('tableName'=>'initializecode', 'model'=>new Initializecode,
				'numRows'=>Initializecode::model()->count(),
				'size'=>Helper::tableSchema('ulimslab','initializecode')->size.' KiB'),
		);
		$ulimsLabAffectedTables=new CArrayDataProvider($ulimsLabTables);

		$ulimsCashieringTables=array(
			array('tableName'=>'receipt', 'model'=>new Receipt,
				'numRows'=>Receipt::model()->count(),
				'size'=>Helper::tableSchema('ulimscashiering','receipt')->size.' KiB'),
			array('tableName'=>'collection', 'model'=>new Collection,
				'numRows'=>Collection::model()->count(),
				'size'=>Helper::tableSchema('ulimscashiering','collection')->size.' KiB'),
			array('tableName'=>'check', 'model'=>new Check,
				'numRows'=>Check::model()->count(),
				'size'=>Helper::tableSchema('ulimscashiering','check')->size.' KiB'),
		);
		$ulimsCashieringAffectedTables=new CArrayDataProvider($ulimsCashieringTables);

		$ulimsAccountingTables=array(
			array('tableName'=>'orderofpayment', 'model'=>new Orderofpayment,
				'numRows'=>Orderofpayment::model()->count(),
				'size'=>Helper::tableSchema('ulimsaccounting','orderofpayment')->size.' KiB'),
			array('tableName'=>'paymentitem', 'model'=>new Paymentitem,
				'numRows'=>Paymentitem::model()->count(),
				'size'=>Helper::tableSchema('ulimsaccounting','paymentitem')->size.' KiB'),
		);
		$ulimsAccountingAffectedTables=new CArrayDataProvider($ulimsAccountingTables);

		$affectedTables=CMap::mergeArray(
        					$ulimsLabTables,
							$ulimsCashieringTables,
							$ulimsAccountingTables
						);
		
		/* End Test Data (Truncate option)*/						
		$this->render('admin',array(
			//'model'=>$lab,
			'activeLabDataProvider'=>$activeLabDataProvider,
			'labManagerDataProvider'=>$labManagerDataProvider,
			'discountsDataProvider'=>$discountsDataProvider,
			'signatoriesDataProvider'=>$signatoriesDataProvider,
			'rstl'=>$rstl,
			'orseries'=>$orseries,
			'bankaccountDataProvider'=>$bankaccountDataProvider,
			'affectedTables'=>$affectedTables,
			'ulimsLabAffectedTables'=>$ulimsLabAffectedTables,
			'ulimsCashieringAffectedTables'=>$ulimsCashieringAffectedTables,
			'ulimsAccountingAffectedTables'=>$ulimsAccountingAffectedTables,			
		));
	}
	
	public function actionActivateLab($id){
		Lab::model()->updateByPk($id, 
			array('status'=>1, 
			));
	}
	
	public function actionDeactivateLab($id){
		Lab::model()->updateByPk($id, 
			array('status'=>0, 
			));
	}

	
	public function actionActivateDiscount($id){
		Discount::model()->updateByPk($id, 
			array('status'=>1, 
			));
	}
	
	public function actionDeactivateDiscount($id){
		Discount::model()->updateByPk($id, 
			array('status'=>0, 
			));
	}
	
	public function actionSaveAPISettings()
	{
		$apisettings=dirname(__FILE__).'/../config/api-settings.ini';
		$apisettings_array = parse_ini_file($apisettings, true);
		$apisettingsarr=array();
		
		$apisettingsarr['API']=array(
								'url'=>$_POST['API']['url'],
								'version'=>$_POST['API']['version'],
								'proxy_url'=>$_POST['API']['proxy_url'],
								'proxy_port'=>$_POST['API']['proxy_port'],
								'proxy_user'=>$_POST['API']['proxy_user'],
								'proxy_pass'=>$_POST['API']['proxy_pass'],
								'api_secret'=>$_POST['API']['api_secret']);
		
		if($this->write_ini_file($apisettingsarr, $apisettings, TRUE)){
			$this->redirect('admin');
		}
	}
	
	public function actionSaveSettings()
	{		
		
		
		$settings=dirname(__FILE__).'/../config/site-settings.ini';
		$settings_array = parse_ini_file($settings, true);
		$settingsarr=array();
		
		$settingsarr['Agency']=array(
								'name'=>$_POST['Agency']['name'], 
								'address'=>$_POST['Agency']['address'], 
								'contacts'=>$_POST['Agency']['contacts'],
								'shortName'=>$_POST['Agency']['shortName'],
								'labName'=>$_POST['Agency']['labName']);
								
		/*$settingsarr['FormRequest']=array(
								'title'=>$_POST['FormRequest']['title'], 
								'number'=>$_POST['FormRequest']['number'], 
								'revNumDate'=>$_POST['FormRequest']['revNumDate']);*/
								
		$settingsarr['Dashboard']=array(
									'title'=>$_POST['Dashboard']['title'], 
									'description'=>$_POST['Dashboard']['description']);
		//for images we will get the filename and upload to images folder
		$officialLogo=CUploadedFile::getInstanceByName('Agency[logo]');
		$labSidebarImg=CUploadedFile::getInstanceByName('Lab[sidebarImage]');
		$cashierSidebarImg=CUploadedFile::getInstanceByName('Cashier[sidebarImage]');
		$accountingSidebarImg=CUploadedFile::getInstanceByName('Accounting[sidebarImage]');
		
		//$uploaddir="\\images\\";
		$settingsarr['Lab']=array('sidebarImage'=>Yii::app()->params['Lab']['sidebarImage']);
		$settingsarr['Cashier']=array('sidebarImage'=>Yii::app()->params['Cashier']['sidebarImage']);
		$settingsarr['Accounting']=array('sidebarImage'=>Yii::app()->params['Accounting']['sidebarImage']);
		
		if($officialLogo){
			$fNameOfficialLogo=Helper::RemoveAccent($officialLogo->name);
			$officialLogo->saveAs('images/'.$fNameOfficialLogo);
			$settingsarr['Agency']+=array('logo'=>$fNameOfficialLogo);
		}
		if($labSidebarImg){
			$fNameLabSidebarImg=Helper::RemoveAccent($labSidebarImg->name);
			$labSidebarImg->saveAs('images/'.$fNameLabSidebarImg);
			$settingsarr['Lab']=array('sidebarImage'=>$fNameLabSidebarImg);
		}
		if($cashierSidebarImg){
			$fNameCashierSidebarImg=Helper::RemoveAccent($cashierSidebarImg->name);
			$cashierSidebarImg->saveAs('images/'.$fNameCashierSidebarImg);
			$settingsarr['Cashier']=array('sidebarImage'=>$fNameCashierSidebarImg);
		}
		if($accountingSidebarImg){
			$fNameAccountingSidebarImg=Helper::RemoveAccent($accountingSidebarImg->name);
			$accountingSidebarImg->saveAs('images/'.$fNameAccountingSidebarImg);
			$settingsarr['Accounting']=array('sidebarImage'=>$fNameAccountingSidebarImg);
		}
		
		//$settingsarr['Region']=array('id'=>$_POST['Region']['id']);
		//$settingsarr['ProgramStart']=array('year'=>$_POST['ProgramStart']['year']);
		//$settingsarr['Allowips_admin']=array_merge($allowips_admin,$defaultIpsToAllow);
		
		//we will write the $settings array to settings.ini file
		//to use this settings values, we need to configure our config/main.php file
		//under the params configuration
		if($this->write_ini_file($settingsarr, $settings, TRUE)){
			//echo CJSON::encode(array('message'=>'Settings Saved.'));
			//exit;
			$this->redirect('admin');
		}
		
	}

	public function actionSaveFormSettings()
	{		
		$settings=dirname(__FILE__).'/../config/form-settings.ini';
		$settings_array = parse_ini_file($settings, true);
		$settingsarr=array();
		
		$settingsarr['FormRequest']=array(
								'title'=>$_POST['FormRequest']['title'], 
								'number'=>$_POST['FormRequest']['number'], 
								'revNum'=>$_POST['FormRequest']['revNum'],
								'revDate'=>$_POST['FormRequest']['revDate']);

		$settingsarr['FormOrderofpayment']=array(
								'title'=>$_POST['FormOrderofpayment']['title'], 
								'number'=>$_POST['FormOrderofpayment']['number'], 
								'revNum'=>$_POST['FormOrderofpayment']['revNum'],
								'revDate'=>$_POST['FormOrderofpayment']['revDate']);
		
		$formRequestLogoLeft=CUploadedFile::getInstanceByName('FormRequest[logoLeft]');
		$formRequestLogoRight=CUploadedFile::getInstanceByName('FormRequest[logoRight]');
		$formOrderofpaymentLogoLeft=CUploadedFile::getInstanceByName('FormOrderofpayment[logoLeft]');
		$formOrderofpaymentLogoRight=CUploadedFile::getInstanceByName('FormOrderofpayment[logoRight]');
		
		/*$settingsarr['FormRequest']+=array(
								'logoLeft'=>Yii::app()->params['FormRequest']['logoLeft'],
								'logoRight'=>Yii::app()->params['FormRequest']['logoRight']);*/
		/*$settingsarr['FormOrderofpayment']+=array(
								'logoLeft'=>Yii::app()->params['FormOrderofpayment']['logoLeft'],
								'logoRight'=>Yii::app()->params['FormOrderofpayment']['logoRight']);*/
		
		if($formRequestLogoLeft){
			//$fNameLogoLeft=Helper::RemoveAccent($formRequestLogoLeft->name);
			$ext = pathinfo($formRequestLogoLeft->name, PATHINFO_EXTENSION);
			$fNameLogoLeft='rq_logo_left.'.$ext;
			$formRequestLogoLeft->saveAs('images/'.$fNameLogoLeft);
			$settingsarr['FormRequest']+=array('logoLeft'=>$fNameLogoLeft);
		}else{
			$settingsarr['FormRequest']+=array('logoLeft'=>Yii::app()->params['FormRequest']['logoLeft']);
		}

		if($formRequestLogoRight){
			//$fNameLogoRight=Helper::RemoveAccent($formRequestLogoRight->name);
			$ext = pathinfo($formRequestLogoRight->name, PATHINFO_EXTENSION);
			$fNameLogoRight='rq_logo_right.'.$ext;
			$formRequestLogoRight->saveAs('images/'.$fNameLogoRight);
			$settingsarr['FormRequest']+=array('logoRight'=>$fNameLogoRight);
		}else{
			$settingsarr['FormRequest']+=array('logoRight'=>Yii::app()->params['FormRequest']['logoRight']);
		}

		if($formOrderofpaymentLogoLeft){
			//$fNameLogoLeft=Helper::RemoveAccent($formOrderofpaymentLogoLeft->name);
			$ext = pathinfo($formOrderofpaymentLogoLeft->name, PATHINFO_EXTENSION);
			$fNameLogoLeft='op_logo_left.'.$ext;		
			$formOrderofpaymentLogoLeft->saveAs('images/'.$fNameLogoLeft);
			$settingsarr['FormOrderofpayment']+=array('logoLeft'=>$fNameLogoLeft);
		}else{
			$settingsarr['FormOrderofpayment']+=array('logoLeft'=>Yii::app()->params['FormOrderofpayment']['logoLeft']);
		}

		if($formOrderofpaymentLogoRight){
			//$fNameLogoRight=Helper::RemoveAccent($formOrderofpaymentLogoRight->name);
			$ext = pathinfo($formRequestLogoRight->name, PATHINFO_EXTENSION);
			$fNameLogoRight='op_logo_right.'.$ext;			
			$formOrderofpaymentLogoRight->saveAs('images/'.$fNameLogoRight);
			$settingsarr['FormOrderofpayment']+=array('logoRight'=>$fNameLogoRight);
		}else{
			$settingsarr['FormOrderofpayment']+=array('logoRight'=>Yii::app()->params['FormOrderofpayment']['logoRight']);
		}
									
		//we will write the $settings array to form-settings.ini file
		//to use this settings values, we need to configure our config/main.php file
		//under the params configuration
		if($this->write_ini_file($settingsarr, $settings, TRUE)){
			//echo CJSON::encode(array('message'=>'Settings Saved.'));
			//exit;
			$this->redirect('admin');
		}
		
	}
	
	public function actionTruncate(){
		$str_var = $_POST["str_var"];
		$affectedTablesArray = unserialize(base64_decode($str_var));
		if($affectedTablesArray){
			foreach($affectedTablesArray as $affectedTable){
				$affectedTable['model']->getDbConnection()->createCommand()->truncateTable($affectedTable['tableName']);
			}
			
			echo CJSON::encode(array(
				'status'=>"Tables successfully truncated!",
				'affectedTablesArray'=>$affectedTablesArray,
				'affectedTables'=>$affectedTables
			));			
			exit;
		}
		echo CJSON::encode(array(
			'status'=>"Nothing to truncate.",
		));		
		
		
	}
	//function used to save settings in an ini file
	function write_ini_file($assoc_arr, $path, $has_sections=FALSE) {
		$content = "";
		if ($has_sections) {
			foreach ($assoc_arr as $key=>$elem) {
				$content .= "[".$key."]\n";
				foreach ($elem as $key2=>$elem2) {
					if(is_array($elem2))
					{
						for($i=0;$i<count($elem2);$i++)
						{
							$content .= $key2."[] = \"".$elem2[$i]."\"\n";
						}
					}
					else if($elem2=="") $content .= $key2." = \n";
					else $content .= $key2." = \"".$elem2."\"\n";
				}
			}
		}
		else {
			foreach ($assoc_arr as $key=>$elem) {
				if(is_array($elem))
				{
					for($i=0;$i<count($elem);$i++)
					{
						$content .= $key2."[] = \"".$elem[$i]."\"\n";
					}
				}
				else if($elem=="") $content .= $key2." = \n";
				else $content .= $key2." = \"".$elem."\"\n";
			}
		}
	 
		if (!$handle = fopen($path, 'w')) {
			return false;
		}
		if (!fwrite($handle, $content)) {
			return false;
		}
		fclose($handle);
		return true;
	}
	
	public function actionRemoveImage(){
		
		if(isset($_POST['imagefile'])){
	
			$imagePath=getcwd().'/images/'.$_POST['imagefile'];
			$settings=dirname(__FILE__).'/../config/form-settings.ini';
			$settings_array = parse_ini_file($settings, true);

			$settingsarr=array();
			
			$formRequestLogoLeft=Yii::app()->params['FormRequest']['logoLeft'];
			if($_POST['FormRequest']['logoLeft']=='')
				$formRequestLogoLeft="";

			$formRequestLogoRight=Yii::app()->params['FormRequest']['logoRight'];
			if($_POST['FormRequest']['logoRight']=='')
				$formRequestLogoRight="";			
			
			$formOrderofpaymentLogoLeft=Yii::app()->params['FormOrderofpayment']['logoLeft'];
			if($_POST['FormOrderofpayment']['logoLeft']=='')
				$formOrderofpaymentLogoLeft="";

			$formOrderofpaymentLogoRight=Yii::app()->params['FormOrderofpayment']['logoRight'];
			if($_POST['FormOrderofpayment']['logoRight']=='')
				$formOrderofpaymentLogoRight="";			
			
			$settingsarr['FormRequest']=array(
									'title'=>$_POST['FormRequest']['title'], 
									'number'=>$_POST['FormRequest']['number'], 
									'revNum'=>$_POST['FormRequest']['revNum'],
									'revDate'=>$_POST['FormRequest']['revDate'],
									'logoLeft'=>$formRequestLogoLeft,
									'logoRight'=>$formRequestLogoRight,
									);
	
			$settingsarr['FormOrderofpayment']=array(
									'title'=>$_POST['FormOrderofpayment']['title'], 
									'number'=>$_POST['FormOrderofpayment']['number'], 
									'revNum'=>$_POST['FormOrderofpayment']['revNum'],
									'revDate'=>$_POST['FormOrderofpayment']['revDate'],
									'logoLeft'=>$formOrderofpaymentLogoLeft,
									'logoRight'=>$formOrderofpaymentLogoRight,									
									);
			
			if($this->write_ini_file($settingsarr, $settings, TRUE)){
				unlink($imagePath);
				echo CJSON::encode(array(
					'msg'=>'success',
					'divclass'=>$_POST['divclass'],
					'inputname'=>$_POST['inputname'],
					));
				exit;
			}			
		}
	
		echo CJSON::encode(array('msg'=>'failure'));
		exit;
	}
	
	/*
	public function replace_key($find, $replace, $array) {
	 $arr = array();
	 foreach ($array as $key => $value) {
	  if ($key == $find) {
	   $arr[$replace] = $value;
	  } else {
	   $arr[$key] = $value;
	  }
	 }
	 return $arr;
	}

	public function replace_val($find, $replace, $array) {
	 $arr = array();
	 foreach ($array as $key => $value) {
	  if ($key == $find) {
	   $arr[$key] = $replace;
	  } else {
	   $arr[$key] = $value;
	  }
	 }
	 return $arr;
	}
	*/

}
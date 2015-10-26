<?php
//read params values from api-settings.ini file
$apiSettingsFile = dirname(__FILE__).'/api-settings.ini';
$apiSettings_array = parse_ini_file($apiSettingsFile,true);

//read params values from site-settings.ini file
$siteSettingsFile = dirname(__FILE__).'/site-settings.ini';
$siteSettings_array = parse_ini_file($siteSettingsFile,true);

$formSettingsFile = dirname(__FILE__).'/form-settings.ini';
$formSettings_array = parse_ini_file($formSettingsFile,true);

$agencyKey = array('keyPath'=>dirname(__FILE__).'/agency.secret');

return CMap::mergeArray(
		$apiSettings_array,
        $siteSettings_array,
		$formSettings_array,
		$agencyKey,
        array(
            'adminEmail'=>'red_x88@yahoo.com',
        )
    )
;
?>
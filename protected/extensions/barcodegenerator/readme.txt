INSTALLATION AND SAMPLE USAGES
==============================

[1] Download 'barcodegenerator_v1_0_1.zip', extract and copy folder 'barcodegenerator' to your extensions folder (protected/extensions)

[2] In /protected/config/main.php :
	'controllerMap' => array(
		// ...
		'barcodegenerator' => array(
			'class' => 'ext.barcodegenerator.BarcodeGeneratorController',
		),
	),
	
[3] Now You Can Call action of this extension like this (in browser, assume your yii apps folder is /sampleapps) :
http://localhost/sampleapps/barcodegenerator/generatebarcode?code=1234567890ABCDEF

[4] For further usage, you can attach on any html img tag :
<img src="http://localhost/sampleapps/barcodegenerator/generatebarcode?code=1234567890ABCDEF">

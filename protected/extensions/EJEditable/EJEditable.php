<?php

/**
 * Yii extension wrapping the jQuery Plugin "Jeditable" from Mika Tuupola
 * {@link http://www.appelsiini.net/projects/jeditable}
 * 
 * @author C.Yildiz (aka c@cba) <c@cba-solutions.org>
 * @copyright Copyright &copy; 2014 C.Yildiz
 * @license Licensed under MIT license. http://choosealicense.com/licenses/mit/
 * @version 1.0
 *
 */
Yii::import('zii.widgets.jui.CJuiWidget');

/**
 * Base class.
 */
class EJEditable extends CJuiWidget
{
	/**
	 * @var string the 'url', first parameter for the Jeditable plugin.
	 */
	public $url;
	/**
	 * @var string the identifier of the editable elements.
	 */
	public $jquerySelector = ".editable";
	public $attribute;
	/**
	 * @var boolean whether or not all data-attributes of the editable elements should be added to the POST request 
	 * (by being concatenated to the "submitdata" parameter of the Jeditable plugin)
	 */
	public $submitDataAttributes = true;
	/**
	 * @var array the options for the Jeditable plugin
	 */
	public $options = array();

	public function init()
	{
		// Put together options for jeditable
		$options_default = array(
			'placeholder'=>'',
			'select'=>true, // the value of the input field will be selected
		);
		$par = array_merge($options_default, $this->options);
		$this->options = $par;
		
		if(empty($this->url)) $this->url = $this->controller->createUrl('updateAttribute');
		
		Yii::app()->clientScript->registerCoreScript('jquery');
		$cs = Yii::app()->getClientScript();
		$assets = Yii::app()->getAssetManager()->publish(dirname(__FILE__) . '/assets');
		$cs->registerScriptFile($assets . '/js/jquery.jeditable.mini.js'); 	
		// ^--- old jeidtable script from 2012, works with Yii 1.1.9
		
		//$cs->registerScriptFile($assets . '/js/jquery.jeditable.js'); 	
		// ^--- new jeditable script from 2014 (GitHub), "callback" parameter did not work with Yii 1.1.9
		// ^--- cba-todo: test and use this with newest Yii version...

		parent::init();
	}

	/**
	 * Run this widget.
	 * This method registers necessary javascript and renders the needed HTML code.
	 */
	public function run()
	{
		$jsoptions = CJavaScript::encode($this->options, true);
		
		// recursively merge `data_attr` into `options` with $.extend(true,...)
		$extend_submitdata_code = "";
		if($this->submitDataAttributes == true) {
			$extend_submitdata_code = "
				var data_attr = {'submitdata':{}};
				$.each($(this).data(), function(i,e) {
					data_attr['submitdata'][i] = e;
				});
				$.extend(true, options, data_attr); 
			";
		}
		$add_attribute_code = "";
		if(!empty($this->attribute)) {
			$add_attribute_code = "
				if(!('attribute' in options['submitdata'])) {
					options['submitdata']['attribute'] = '{$this->attribute}';
				}
			";
		}
		
		$jscode = "function init_editable(jquerySelector) {
			$(jquerySelector).each( function(item) {
				var url = '{$this->url}';
				var options = {$jsoptions}; 
				{$extend_submitdata_code} 
				{$add_attribute_code}
				$(this).editable(url, options);
			});
		}";
		Yii::app()->getClientScript()->registerScript(__CLASS__ . "_{$this->jquerySelector}", $jscode, CClientScript::POS_HEAD);
		
		// Register js-code that initializes editables when page has loaded and is ready
		Yii::app()->clientScript->registerScript(
			"init_editables",
			"init_editable('{$this->jquerySelector}'); ",
			CClientScript::POS_READY
		);
	}
}

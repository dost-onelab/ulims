<?php
/**
 * EFineUploader class file.
 * This extension is a wrapper of https://github.com/Widen/fine-uploader
 *
 * @author Vladimir Papaev <kosenka@gmail.com>
 * @version 0.1
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

/**
        How to use:

        view:
$this->widget('ext.EFineUploader.EFineUploader',
 array(
       'id'=>'FineUploader',
       'config'=>array(
                       'autoUpload'=>true,
                       'request'=>array(
                                        'endpoint'=>'/files/upload',// OR $this->createUrl('files/upload'),
                                        'params'=>array('YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken),
                                       ),
                       'retry'=>array('enableAuto'=>true,'preventRetryResponseProperty'=>true),
                       'chunking'=>array('enable'=>true,'partSize'=>100),//bytes
                       'callbacks'=>array(
                                          'onComplete'=>"js:function(id, name, response){  }",
                                          //'onError'=>"js:function(id, name, errorReason){ }",
                                         ),
                       'validation'=>array(
                                           'allowedExtensions'=>array('jpg','jpeg'),
                                           'sizeLimit'=>2 * 1024 * 1024,//maximum file size in bytes
                                           'minSizeLimit'=>2*1024*1024,// minimum file size in bytes
                                          ),
                       'messages'=>array(
                                         'typeError'=>"Ð¤Ð°Ð¹Ð» {file} Ð¸Ð¼ÐµÐµÑ‚ Ð½ÐµÐ²ÐµÑ€Ð½Ð¾Ðµ Ñ€Ð°Ñ�ÑˆÐ¸Ñ€ÐµÐ½Ð¸Ðµ. Ð Ð°Ð·Ñ€ÐµÑˆÐµÐ½Ñ‹ Ñ„Ð°Ð¹Ð»Ñ‹ Ñ‚Ð¾Ð»ÑŒÐºÐ¾ Ñ� Ñ€Ð°Ñ�ÑˆÐ¸Ñ€ÐµÐ½Ð¸Ñ�Ð¼Ð¸: {extensions}.",
                                         'sizeError'=>"Ð Ð°Ð·Ð¼ÐµÑ€ Ñ„Ð°Ð¹Ð»Ð° {file} Ð²ÐµÐ»Ð¸Ðº, Ð¼Ð°ÐºÑ�Ð¸Ð¼Ð°Ð»ÑŒÐ½Ñ‹Ð¹ Ñ€Ð°Ð·Ð¼ÐµÑ€ {sizeLimit}.",
                                         'minSizeError'=>"Ð Ð°Ð·Ð¼ÐµÑ€ Ñ„Ð°Ð¹Ð»Ð° {file} Ð¼Ð°Ð», Ð¼Ð¸Ð½Ð¸Ð¼Ð°Ð»ÑŒÐ½Ñ‹Ð¹ Ñ€Ð°Ð·Ð¼ÐµÑ€ {minSizeLimit}.",
                                         'emptyError'=>"{file} is empty, please select files again without it.",
                                         'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                                        ),
                      )
      ));

        controller:

        public function actionUpload()
        {
                $tempFolder=Yii::getPathOfAlias('webroot').'/upload/temp/';

                mkdir($tempFolder, 0777, TRUE);
                mkdir($tempFolder.'chunks', 0777, TRUE);

                Yii::import("ext.EFineUploader.qqFileUploader");

                $uploader = new qqFileUploader();
                $uploader->allowedExtensions = array('jpg','jpeg');
                $uploader->sizeLimit = 2 * 1024 * 1024;//maximum file size in bytes
                $uploader->chunksFolder = $tempFolder.'chunks';

                $result = $uploader->handleUpload($tempFolder);
                $result['filename'] = $uploader->getUploadName();
                $result['folder'] = $webFolder;

                $uploadedFile=$tempFolder.$result['filename'];

                header("Content-Type: text/plain");
                $result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
                echo $result;
                Yii::app()->end();
        }

*/
class EFineUploader extends CWidget
{
        public $version="3.4.1";
        public $id="fineUploader";
	public $config=array();
	public $css=null;
        
        public function run()
        {
		if(empty($this->config['request']['endpoint']))
		{
		      throw new CException('EFineUploader: param "request::endpoint" cannot be empty.');
                }

		if(!is_array($this->config['validation']['allowedExtensions']))
		{
		      throw new CException('EFineUploader: param "validation::allowedExtensions" must be an array.');
                }

		if(empty($this->config['validation']['sizeLimit']))
		{
		      throw new CException('EFineUploader: param "validation::sizeLimit" cannot be empty.');
                }

                unset($this->config['element']);

                echo '<div id="'.$this->id.'"><noscript><p>Please enable JavaScript to use file uploader.</p></noscript></div>';

		$assets = dirname(__FILE__).'/assets';
                $baseUrl = Yii::app()->assetManager->publish($assets);

                $fJs=(YII_DEBUG)?$baseUrl."/jquery.fineuploader-{$this->version}.js":$baseUrl."/jquery.fineuploader-{$this->version}.min.js";
                Yii::app()->clientScript->registerScriptFile($fJs, CClientScript::POS_HEAD);

                $this->css=(!empty($this->css))?$this->css:$baseUrl."/fineuploader-{$this->version}.css";
                Yii::app()->clientScript->registerCssFile($this->css);

		$config = array(
                                'element'=>'js:document.getElementById("'.$this->id.'")',
                                'debug'=>false,
                                'multiple'=>false
                               );
		$config = array_merge($config, $this->config);
		//$config['params']=$postParams;
		$config = CJavaScript::encode($config);
                Yii::app()->getClientScript()->registerScript("FineUploader_".$this->id, "var FineUploader_".$this->id." = new qq.FineUploader($config);",CClientScript::POS_LOAD);
	}


}
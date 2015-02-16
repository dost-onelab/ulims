<?php
class RestController extends CApplicationComponent {
 
	public static function getAdminData($resource)
	{
	    //Resource Address
	    //http://dost-onelab.com/onelab/api/web/v1
		$url = Yii::app()->Controller->getServer().'/'.$resource;
		//$url = 'http://dost-onelab.com/onelab/api/web/v1/referrals';
		
		$response = Yii::app()->curl->get($url);
		
		$arrayResponse = json_decode($response, true);
	 
	    return $arrayResponse;
	}
	
	public static function getViewData($resource, $resource_id, $expand = NULL)
	{
	    //Resource Address
		$url = Yii::app()->Controller->getServer().'/'.$resource.'/'.$resource_id.'?expand='.$expand;
		
		$response = Yii::app()->curl->get($url);
		
		$arrayResponse = json_decode($response, true);
	 
	    return $arrayResponse;
	}

	public static function postData($resource, $postFields) 
	{
	    //Resource Address
		$url = Yii::app()->Controller->getServer().'/'.$resource;
		
		$response = Yii::app()->curl->post($url, $postFields);
		
		$arrayResponse = json_decode($response, true);
	 
	    return $arrayResponse;
	}

	public static function putData($resource, $postFields, $resource_id) 
	{
	    //Resource Address
		$url = Yii::app()->Controller->getServer().'/'.$resource.'/'.$resource_id;
		
		$response = Yii::app()->curl->put($url, $postFields);
		
		$arrayResponse = json_decode($response, true);
	 
	    return $arrayResponse;
	}
	
	public static function getCustomData($custom_resource_url, $resource_id)
	{
		//Resource Address
		$url = Yii::app()->Controller->getServer().'/'.$custom_resource_url.$resource_id;
		
		//Send Request to Resource
		$client = curl_init();
	    curl_setopt($client, CURLOPT_URL, $url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($client);
		curl_close($client);
		
		$arrayResponse = json_decode($response, true);
	 
	    //return $arrayResponse;
	    return count($arrayResponse[0]) ? $arrayResponse : array();
	}
	
	public static function searchResource($resource, $field, $fieldValue)
	{
		// Resource Address
		$url = Yii::app()->Controller->getServer().'/'.$resource.'/search?'.$field.'='.$fieldValue;
		
		$response = Yii::app()->curl->get($url);
		
		$arrayResponse = json_decode($response, true);
	 
	    //return $arrayResponse;
	    return count($arrayResponse[0]) ? $arrayResponse : array();
	}
	
	public static function searchResourceMultifields($resource, $params)
	{
		$searchParams = '';
		$paramsCount = 0;
		foreach($params as $param){
			$searchParams .= (($paramsCount == 0) ? '' : '&').$param['field'].'='.$param['value'];
			$paramsCount += 1;
		}
		// Resource Address
		//$url = Yii::app()->Controller->getServer().'/'.$resource.'/search?'.$searchParams;
		$url = 'http://localhost/onelab/api/web/v1/orderofpayments/search?id=44&createdReceipt=0';
		$response = Yii::app()->curl->get($url);
		
		$arrayResponse = json_decode($response, true);
	 
	    return $arrayResponse;
	    //return count($arrayResponse[0]) ? $arrayResponse : array();
	}

	public static function deleteData($resource, $resource_id)
	{
		//Resource Address
		$url = Yii::app()->Controller->getServer().'/'.$resource.'/'.$resource_id;
		
		$response = Yii::app()->curl->delete($url);
		
		$arrayResponse = json_decode($response, true);
	 
	    return $arrayResponse;
	}
}
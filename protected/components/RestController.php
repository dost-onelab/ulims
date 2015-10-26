<?php
class RestController extends CApplicationComponent {
 
	public static function getAdminData($resource)
	{
	    //Resource Address
	    //http://dost-onelab.com/onelab/api/web/v1
		$url = Yii::app()->Controller->getServer().'/'.$resource;
		//$url = 'http://dost-onelab.com/onelab/api/web/v1/referrals';
		
		$accesstoken = Yii::app()->user->accessToken;
		//$auth = array('token: '.$accesstoken->token, 'agency_id :'.Yii::app()->Controller->getRstlId());
		$auth = array('token: '.$accesstoken->token);
		$response = Yii::app()->curl->setOptions(array(CURLOPT_HTTPHEADER => $auth))->get($url);
		
		//$response = Yii::app()->curl->setOption(CURLOPT_HTTPHEADER, $auth)->get($url);

		$arrayResponse = json_decode($response, true);
	 
	    return $arrayResponse;
	}

	public static function getViewData($resource, $resource_id, $expand = NULL)
	{
	    //Resource Address
		$url = Yii::app()->Controller->getServer().'/'.$resource.'/'.$resource_id.'?expand='.$expand;
		
		$accesstoken = Yii::app()->user->accessToken;
		$auth = array('token: '.$accesstoken->token);
		$response = Yii::app()->curl->setOptions(array(CURLOPT_HTTPHEADER => $auth))->get($url);
		
		$arrayResponse = json_decode($response, true);
	 
	    return $arrayResponse;
	}

	public static function postData($resource, $postFields) 
	{
	    //Resource Address
		$url = Yii::app()->Controller->getServer().'/'.$resource;

		$accesstoken = Yii::app()->user->accessToken;
		$auth = array('token: '.$accesstoken->token);
		$response = Yii::app()->curl->setOptions(array(CURLOPT_HTTPHEADER => $auth))->post($url, $postFields);
		
		$arrayResponse = json_decode($response, true);
	 
	    return $arrayResponse;
	}

	public static function putData($resource, $postFields, $resource_id) 
	{
	    //Resource Address
		$url = Yii::app()->Controller->getServer().'/'.$resource.'/'.$resource_id;
		
		$accesstoken = Yii::app()->user->accessToken;
		$auth = array('token: '.$accesstoken->token);
		$response = Yii::app()->curl->setOptions(array(CURLOPT_HTTPHEADER => $auth))->put($url, $postFields);		
		
		$arrayResponse = json_decode($response, true);
	 
	    return $arrayResponse;
	}
	
	public static function getCustomData($custom_resource_url, $resource_id)
	{
		//Resource Address
		$url = Yii::app()->Controller->getServer().'/'.$custom_resource_url.$resource_id;
		
		$accesstoken = Yii::app()->user->accessToken;
		$auth = array('token: '.$accesstoken->token, 'sender: '.Users::model()->findByPk(Yii::app()->user->id)->fullname);
		$response = Yii::app()->curl->setOptions(array(CURLOPT_HTTPHEADER => $auth))->get($url);
		
		$arrayResponse = json_decode($response, true);
	 
	    return $arrayResponse;
	    //return count($arrayResponse[0]) ? $arrayResponse : array();
	}
	
	public static function postStatus($custom_resource_url, $resource_id)
	{
		//Resource Address
		$url = Yii::app()->Controller->getServer().'/'.$custom_resource_url.$resource_id;
		
		$accesstoken = Yii::app()->user->accessToken;
		$auth = array('token: '.$accesstoken->token);
		$response = Yii::app()->curl->setOptions(array(CURLOPT_HTTPHEADER => $auth))->get($url);
		
		$arrayResponse = json_decode($response, true);
	 
	    return $arrayResponse;
	    //return count($arrayResponse[0]) ? $arrayResponse : array();
	}
	
	public static function searchResource($resource, $field, $fieldValue)
	{
		// Resource Address
		$url = Yii::app()->Controller->getServer().'/'.$resource.'/search?'.$field.'='.$fieldValue;
		
		$accesstoken = Yii::app()->user->accessToken;
		$auth = array('token: '.$accesstoken->token);
		$response = Yii::app()->curl->setOptions(array(CURLOPT_HTTPHEADER => $auth))->get($url);
		
		//$response = Yii::app()->curl->get($url);
		
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
		$url = Yii::app()->Controller->getServer().'/'.$resource.'/search?'.$searchParams;
		$response = Yii::app()->curl->get($url);
		
		$arrayResponse = json_decode($response, true);
	 
	    //return $arrayResponse;
	    return count($arrayResponse[0]) ? $arrayResponse : array();
	}

	public static function deleteData($resource, $resource_id)
	{
		//Resource Address
		$url = Yii::app()->Controller->getServer().'/'.$resource.'/'.$resource_id;
		
		$accesstoken = Yii::app()->user->accessToken;
		$auth = array('token: '.$accesstoken->token);
		$response = Yii::app()->curl->setOptions(array(CURLOPT_HTTPHEADER => $auth))->delete($url);
		
		$arrayResponse = json_decode($response, true);
	 
	    return $arrayResponse;
	}
	
    public static function verifyAgencyKey($id)
    {
		$url = Yii::app()->Controller->getServer()."/users/verifyagency?agency_id=".$id;
		
		if(file_exists(Yii::app()->params['keyPath']))
		{
			$agency_key = file_get_contents(Yii::app()->params['keyPath']);
			$auth = array('agencykey:'.$agency_key);
			$response = Yii::app()->curl->setOptions(array(CURLOPT_HTTPHEADER => $auth))->get($url);
			return json_decode($response);
		}else{
			return false;
		}
    }
    
	public static function checkApiAccess()
	{
		if(isset(Yii::app()->user->accessToken))
		{
			$url = Yii::app()->Controller->getServer().'/users/validatetoken';
			
			$accesstoken = Yii::app()->user->accessToken;
			$auth = array('token: '.$accesstoken->token);
			$response = Yii::app()->curl->setOptions(array(CURLOPT_HTTPHEADER => $auth))->get($url);
			$res = json_decode($response);
			if($res->code != 100)
				Yii::app()->Controller->redirect(array('referral/authenticate'));
			else 
				return $res;
			
		}else{
			Yii::app()->Controller->redirect(array('referral/authenticate'));
		}
	}
}
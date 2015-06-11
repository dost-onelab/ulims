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
		//$response = Yii::app()->curl->get($url);
		
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
		//$response = Yii::app()->curl->post($url, $postFields);
		
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
		//$response = Yii::app()->curl->put($url, $postFields);
		
		$arrayResponse = json_decode($response, true);
	 
	    return $arrayResponse;
	}
	
	public static function getCustomData($custom_resource_url, $resource_id)
	{
		//Resource Address
		$url = Yii::app()->Controller->getServer().'/'.$custom_resource_url.$resource_id;
		
		$response = Yii::app()->curl->get($url);
		
		$arrayResponse = json_decode($response, true);
	 
	    //return $arrayResponse;
	    return count($arrayResponse[0]) ? $arrayResponse : array();
	}
	
	public static function searchResource($resource, $field, $fieldValue)
	{
		// Resource Address
		$url = Yii::app()->Controller->getServer().'/'.$resource.'/search?'.$field.'='.$fieldValue;
		//$url = 'http://localhost/onelab/api/web/v1/notifications/search?recipient_id=11';
		
		$response = Yii::app()->curl->get($url);
		
		$arrayResponse = json_decode($response, true);
	 
	    return $arrayResponse;
	    //return count($arrayResponse[0]) ? $arrayResponse : array();
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
		//$url = 'http://localhost/onelab/api/web/v1/orderofpayments/search?id=44&createdReceipt=0';
		$response = Yii::app()->curl->get($url);
		
		$arrayResponse = json_decode($response, true);
	 
	    return $arrayResponse;
	    //return count($arrayResponse[0]) ? $arrayResponse : array();
	}

	public static function deleteData($resource, $resource_id)
	{
		//Resource Address
		$url = Yii::app()->Controller->getServer().'/'.$resource.'/'.$resource_id;
		
		$accesstoken = Yii::app()->user->accessToken;
		$auth = array('token: '.$accesstoken->token);
		$response = Yii::app()->curl->setOptions(array(CURLOPT_HTTPHEADER => $auth))->delete($url);
		//$response = Yii::app()->curl->delete($url);
		
		$arrayResponse = json_decode($response, true);
	 
	    return $arrayResponse;
	}
	
	//public function requestForAccessToken()
    //{
        /*
         * with username and password to login apiHost for user/id's access_token
         * after the basic authentication 
         * token will be generated at the api server end
         */
        /*$username = $this->_user->username;
        $password = $this->_user->password_hash;
        $id = $this->_user->id;
        $apiHost = Yii::$app->params['restapi']['apiHost']; 

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiHost.'/users/'.$id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_USERPWD, $username.':'.$password);
        $response = curl_exec($ch);
        curl_close($ch);
        $user = json_decode($response);
        print_R($user->access_token);exit;
    }*/
	
    /*public function requestForAccessToken2()
    {
    	$username = 'adm-0808';
		$password = 'sfasdfafasdf';
		$id = Yii::app()->Controller->getRstlId();
		$apiHost = 'http://localhost/onelab/api/web/v1/users/accesstoken?id='.$id;
		
		$response = Yii::app()->curl->setOptions(array(CURLOPT_USERPWD => $username . ':' . $password))->get($apiHost);
    	return $response;
    }*/
    	
    public static function verifyAgencyKey($id)
    {
		//$url = 'http://localhost/onelab/api/web/v1/users/verifyagency?agency_id='.$id;
		$url = Yii::app()->Controller->getServer().'/users/verifyagency?agency_id='.$id;
		
		$agency_key = file_get_contents(Yii::app()->params['keyPath']);
		$auth = array('Authorization: '.$agency_key);
		$response = Yii::app()->curl->setOption(CURLOPT_HTTPHEADER, $auth)->get($url);
		return json_decode($response);
    }
    
	public static function downloadFile()
	{
		
	}
	
	public static function checkApiAccess()
	{
		if(isset(Yii::app()->user->accessToken))
		{
			//$url = 'http://localhost/onelab/api/web/v1/users/validatetoken';
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
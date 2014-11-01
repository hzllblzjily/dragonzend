<?php

require_once APPLICATION_PATH.'/helpers/easemob/EasemobHelper.php';
require_once APPLICATION_PATH.'/helpers/CurlHelper/CurlRequest.php';
require_once APPLICATION_PATH.'/models/cachemodel/Easemob_Access_Token_Cache.php';
class EasemobService{
    
    
    protected $logger;
    protected $dbAdapter;
    
    protected $requestUrl;
    protected $requestMethod;
    protected $requestData;
    
    
    public function __construct(){
        $this->logger = Zend_Registry::get('log');
        $this->logger->setEventItem('controller', 'EasemobService' );
        $this->dbAdapter = Zend_Registry::get('dbAdapter');
        
    }
    

    
    //获取access token
    public function getAccessToken($forceReget = false){
        //先读缓存并比较失效时间
        $accessCache = new Easemob_Access_Token_Cache("access_token");
        $cacheRes = $accessCache->load();
        if($cacheRes){
            //查看缓存失效时间
            $expire_in = $cacheRes['expires_in'];
            $get_time = $cacheRes['get_time'];
            $now_time = time();
            if(($expire_in - ($now_time - $get_time)) > 30){
                //返回缓存的token
                $access_token = $cacheRes['access_token'];
                if(!$forceReget){
                    return $access_token;
                }
                
            }
            //过期重新请求
        }
        
        $curlRequest = new CurlRequest();

        $application_ini = constant("APPLICATION_PATH").DIRECTORY_SEPARATOR.'configs'.DIRECTORY_SEPARATOR.'application.ini';
        $easeConfig = new Zend_Config_Ini($application_ini, "easemob");
        $easeConfig = $easeConfig->toArray();
        $organName = $easeConfig['organName'];
        $appName = $easeConfig['appName'];
        $clientId = $easeConfig['clientId'];
        $clientSecret = $easeConfig['clientSecret'];
        $curlRequest->url("https://a1.easemob.com/".$organName."/".$appName."/token");
        $curlRequest->data(array('grant_type'=>'client_credentials','client_id'=>$clientId,'client_secret'=>$clientSecret),true);
        $responseData = $curlRequest->post();
        if($responseData['status'] == 0){
        	//出错
        	$this->logger->log('get access token from easemob return curl error = '.$responseData['data'],Zend_Log::ERR);
        	return null;
        }
        $responseData = EasemobHelper::resolveResponse($responseData['data']);
        if($responseData['status'] != 1){
            //出错
            $this->logger->log('get access token from easemob return error = '.$responseData['message'],Zend_Log::ERR);
            return null;
        }else{
            $jsonArr = $responseData['data'];

            //记录缓存access token
            $arr = $jsonArr;
            $arr['get_time'] = time();
            $accessCache->setData($arr);
            $accessCache->saveData();
           	return $arr['access_token'];
            
        }
        
        
    }
    
    
    public function registerUser($userName,$password){
    	$curlRequest = new CurlRequest();
    	$accessToken = $this->getAccessToken();
    	$curlRequest->header(array("Authorization: Bearer ".$accessToken));
    	$application_ini = constant("APPLICATION_PATH").DIRECTORY_SEPARATOR.'configs'.DIRECTORY_SEPARATOR.'application.ini';
    	$easeConfig = new Zend_Config_Ini($application_ini, "easemob");
    	$easeConfig = $easeConfig->toArray();
    	$organName = $easeConfig['organName'];
    	$appName = $easeConfig['appName'];
    	$curlRequest->url("https://a1.easemob.com/".$organName."/".$appName."/users");
    	$curlRequest->data(array('username'=>$userName,'password'=>$password),true);
    	$responseData = $curlRequest->post();
        if($responseData['status'] == 0){
        	//出错
        	$this->logger->log('registerUser return curl error = '.$responseData['data'],Zend_Log::ERR);
        	return null;
        }
        $responseData = EasemobHelper::resolveResponse($responseData['data']);
        if($responseData['status'] != 1){
            //出错
            $this->logger->log('registerUser return error = '.$responseData['message'],Zend_Log::ERR);
            return null;
        }else{
            $jsonArr = $responseData['data'];
			return $jsonArr;
            
        }
    	
    }
    
    
    
    public function batchregister($dataArray){
    	$curlRequest = new CurlRequest();
    	$accessToken = $this->getAccessToken();
    	$curlRequest->header(array("Authorization: Bearer ".$accessToken));
    	$application_ini = constant("APPLICATION_PATH").DIRECTORY_SEPARATOR.'configs'.DIRECTORY_SEPARATOR.'application.ini';
    	$easeConfig = new Zend_Config_Ini($application_ini, "easemob");
    	$easeConfig = $easeConfig->toArray();
    	$organName = $easeConfig['organName'];
    	$appName = $easeConfig['appName'];
    	$curlRequest->url("https://a1.easemob.com/".$organName."/".$appName."/users");
    	$curlRequest->data($dataArray,true);
    	$responseData = $curlRequest->post();
    	if($responseData['status'] == 0){
    		//出错
    		$this->logger->log('registerUser return curl error = '.$responseData['data'],Zend_Log::ERR);
    		return null;
    	}
    	$responseData = EasemobHelper::resolveResponse($responseData['data']);
    	if($responseData['status'] != 1){
    		//出错
    		$this->logger->log('registerUser return error = '.$responseData['message'],Zend_Log::ERR);
    		return null;
    	}else{
    		$jsonArr = $responseData['data'];
    		return $jsonArr;
    	
    	}
    }
    
    
    
    public function getUser($userName){
    	$curlRequest = new CurlRequest();
    	$accessToken = $this->getAccessToken();
    	$curlRequest->header(array("Authorization: Bearer ".$accessToken));
    	$application_ini = constant("APPLICATION_PATH").DIRECTORY_SEPARATOR.'configs'.DIRECTORY_SEPARATOR.'application.ini';
    	$easeConfig = new Zend_Config_Ini($application_ini, "easemob");
    	$easeConfig = $easeConfig->toArray();
    	$organName = $easeConfig['organName'];
    	$appName = $easeConfig['appName'];
    	$curlRequest->url("https://a1.easemob.com/".$organName."/".$appName."/users/".$userName);
    	$responseData = $curlRequest->get();
    	if($responseData['status'] == 0){
    		//出错
    		$this->logger->log('registerUser return curl error = '.$responseData['data'],Zend_Log::ERR);
    		return null;
    	}
    	$responseData = EasemobHelper::resolveResponse($responseData['data']);
    	if($responseData['status'] != 1){
    		//出错
    		$this->logger->log('registerUser return error = '.$responseData['message'],Zend_Log::ERR);
    		return null;
    	}else{
    		$jsonArr = $responseData['data'];
    		return $jsonArr;
    		 
    	}
    }
    
    
    
    
    public function changepassword($userName,$newpassword){
    	$curlRequest = new CurlRequest();
    	$accessToken = $this->getAccessToken();
    	$curlRequest->header(array("Authorization: Bearer ".$accessToken));
    	$application_ini = constant("APPLICATION_PATH").DIRECTORY_SEPARATOR.'configs'.DIRECTORY_SEPARATOR.'application.ini';
    	$easeConfig = new Zend_Config_Ini($application_ini, "easemob");
    	$easeConfig = $easeConfig->toArray();
    	$organName = $easeConfig['organName'];
    	$appName = $easeConfig['appName'];
    	$curlRequest->url("https://a1.easemob.com/".$organName."/".$appName."/users/".$userName."/password");
    	$curlRequest->data(array("newpassword"=>$newpassword),true);
    	$responseData = $curlRequest->put();
    	if($responseData['status'] == 0){
    		//出错
    		$this->logger->log('registerUser return curl error = '.$responseData['data'],Zend_Log::ERR);
    		return null;
    	}
    	$responseData = EasemobHelper::resolveResponse($responseData['data']);
    	if($responseData['status'] != 1){
    		//出错
    		$this->logger->log('registerUser return error = '.$responseData['message'],Zend_Log::ERR);
    		return null;
    	}else{
    		$jsonArr = $responseData['data'];
    		return $jsonArr;
    		 
    	}
    }
 
    
    
    
    public function delete($userName){
    	$curlRequest = new CurlRequest();
    	$accessToken = $this->getAccessToken();
    	$curlRequest->header(array("Authorization: Bearer ".$accessToken));
    	$application_ini = constant("APPLICATION_PATH").DIRECTORY_SEPARATOR.'configs'.DIRECTORY_SEPARATOR.'application.ini';
    	$easeConfig = new Zend_Config_Ini($application_ini, "easemob");
    	$easeConfig = $easeConfig->toArray();
    	$organName = $easeConfig['organName'];
    	$appName = $easeConfig['appName'];
    	$curlRequest->url("https://a1.easemob.com/".$organName."/".$appName."/users/".$userName);
    	$responseData = $curlRequest->delete();
    	if($responseData['status'] == 0){
    		//出错
    		$this->logger->log('registerUser return curl error = '.$responseData['data'],Zend_Log::ERR);
    		return null;
    	}
    	$responseData = EasemobHelper::resolveResponse($responseData['data']);
    	if($responseData['status'] != 1){
    		//出错
    		$this->logger->log('registerUser return error = '.$responseData['message'],Zend_Log::ERR);
    		return null;
    	}else{
    		$jsonArr = $responseData['data'];
    		return $jsonArr;
    		 
    	}
    }
   
    public function batchDelete($limit){
    	$curlRequest = new CurlRequest();
    	$accessToken = $this->getAccessToken();
    	$curlRequest->header(array("Authorization: Bearer ".$accessToken));
    	$application_ini = constant("APPLICATION_PATH").DIRECTORY_SEPARATOR.'configs'.DIRECTORY_SEPARATOR.'application.ini';
    	$easeConfig = new Zend_Config_Ini($application_ini, "easemob");
    	$easeConfig = $easeConfig->toArray();
    	$organName = $easeConfig['organName'];
    	$appName = $easeConfig['appName'];
    	$curlRequest->url("https://a1.easemob.com/".$organName."/".$appName."/users?limit=".$limit);
    	$responseData = $curlRequest->delete();
    	if($responseData['status'] == 0){
    		//出错
    		$this->logger->log('registerUser return curl error = '.$responseData['data'],Zend_Log::ERR);
    		return null;
    	}
    	$responseData = EasemobHelper::resolveResponse($responseData['data']);
    	if($responseData['status'] != 1){
    		//出错
    		$this->logger->log('registerUser return error = '.$responseData['message'],Zend_Log::ERR);
    		return null;
    	}else{
    		$jsonArr = $responseData['data'];
    		return $jsonArr;
    		 
    	}
    }
     
    
    
    
    
}
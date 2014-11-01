<?php

require_once APPLICATION_PATH.'/helpers/Social/libweibo-master/config.php';
require_once APPLICATION_PATH.'/helpers/Social/libweibo-master/saetv2.ex.class.php';

class WeiboHelper {

	static function upload( $status, $pic_path, $access_token, $lat = NULL, $long = NULL ){
	    $logger = Zend_Registry::get('log');
	    $c = new SaeTClientV2( WB_AKEY , WB_SKEY , $access_token );
	    $response = $c->upload($status, $pic_path);
	    if($response === false)
	    {
	    	//表明是网络错误
	    	$logger->log("upload reponse is false",Zend_Log::ERR);
	    	return false;
	    }
	    else
	    {
	    	if(isset($response['error']))
	    	{
	    		//表明微博返回错误
	    		$logger->log("upload reponse is error = ".$response['error']." error code = ".$response['error_code'],Zend_Log::ERR);
	    		return $response;
	    	}
	    	else
	    	{
	    		return $response;
	    	}
	    
	    }
	}
	
	static function showUser($uid,$access_token)
	{
		$logger = Zend_Registry::get('log');
		$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $access_token );
		$response = $c->show_user_by_id($uid);
		
		if($response === false)
		{
			//表明是网络错误
			$logger->log("showUser reponse is false",Zend_Log::ERR);
			return false;
		}
		else
		{
			if(isset($response['error']))
			{
				//表明微博返回错误
				$logger->log("showUser reponse is error = ".$response['error']." error code = ".$response['error_code'],Zend_Log::ERR);
				return $response;
			}
			else
			{
				return $response;
			}
				
		}
	}
	
	static function getWeiboUid($access_token)
	{
		$logger = Zend_Registry::get('log');
		$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $access_token );
		$response = $c->get_uid();
		if($response === false)
		{
			//表明是网络错误
			$logger->log("getWeiboUid reponse is false",Zend_Log::ERR);
			return false;
		}
		else
		{
			if(isset($response['error']))
			{
				//表明微博返回错误
				$logger->log("getWeiboUid reponse is error = ".$response['error']." error code = ".$response['error_code'],Zend_Log::ERR);
				return $response;
			}
			else
			{
				$uid = $response['uid'];
				if($uid == null)
				{
					$logger->log("getWeiboUid reponse is invalid = ".$response,Zend_Log::ERR);
					return $response;
				}
				else 
				{
					$logger->log("getWeiboUid reponse user uid = ".$uid,Zend_Log::DEBUG);
					return $uid;
				}
			}
			
		}
	}
	
	static function convertCity($city)
	{
		$arr = array('北京' ,'天津','河北','山西','内蒙古','辽宁','吉林','黑龙江','上海','江苏','浙江','安徽','福建','江西','山东',
				'河南','湖北','湖南','广东','广西','海南','重庆','四川','贵州','云南','西藏','陕西','甘肃','青海','宁夏','新疆','台湾',
				'香港','澳门','其他','海外');
		
		foreach($arr as $key=>$value)
		{
			if(strstr($city,$value))
			{
				return $value;
			}
		}
		return false;
	}
// 	static function getAccessToken($access_token)
// 	{
		
// 		$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $access_token );
// 		//$ms  = $c->home_timeline(); // done
// 		$uid_get = $c->get_uid();
// 		$uid = $uid_get['uid'];
// 		$user_message = $c->show_user_by_id( $uid);//根据ID获取用户等基本信息
		
		
		
//  		$parts=parse_url("https://api.weibo.com/oauth2/get_token_info");
// 		$arr = array("access_token"=>$access_token);
// 		$postData = http_build_query($arr);
// 		$ch = curl_init();
// 		curl_setopt($ch, CURLOPT_URL, parts);
// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// 		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
// 		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
// 		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
// 		curl_setopt($ch, CURLOPT_POST, TRUE);
// 		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
// 		curl_setopt($ch, CURLOPT_HEADERFUNCTION, array($this, 'getHeader'));
// 		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
// 		curl_setopt($ch, CURLOPT_USERAGENT, "Sae T OAuth2 v0.1");
// 		curl_setopt($ch, CURLOPT_ENCODING, "");
// 		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
// 		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		
		


// 		$response = curl_exec($ch);
// 		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
// 		$http_code = curl_getinfo($ch, CURLINFO_SSL_VERIFYRESULT);
		
		
// 		$responseInfo = curl_getinfo($ch);
		
// 		$fp = fsockopen($parts['host'],
// 				isset($parts['port'])?$parts['port']:80,
// 				$errno, $errstr, 30);
		
// 		$out = "POST ".$parts['path']." HTTP/1.1\r\n";
// 		$out.= "Host: ".$parts['host']."\r\n";
// 		//$out.= "Content-Type: application/json\r\n";
// 		$out.= "Content-Length: ".strlen($json)."\r\n";
// 		$out.= "Connection: Close\r\n\r\n";
// 		if (isset($json)) $out.= $json;
		
// 		fwrite($fp, $out);
		
		
// 		while (!feof($fp)) {
//     	   $line = fgets($fp, 4096);

			
//         }
//         fclose($fp);
//	}
	
	static function isAccessTokenInValid($errorCode){
	    if($errorCode == 21327 || $errorCode == 21332 || $errorCode == 21315){
	        return true;
	    }else{
	        return false;
	    }
	}
	
	function getHeader($ch, $header) {
		$i = strpos($header, ':');
		if (!empty($i)) {
			$key = str_replace('-', '_', strtolower(substr($header, 0, $i)));
			$value = trim(substr($header, $i + 2));
			//$this->http_header[$key] = $value;
		}
		return strlen($header);
	}

}

?>
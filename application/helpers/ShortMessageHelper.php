<?php

class ShortMessageHelper {
	
	//发送短信验证码
	//$telPhone是数据库对应telphone内容
	//如果调用接口出错返回 false
	public static function PostShortMessage($telPhone, $identity)
	{
		$content = "您的验证码是：".$identity."。请不要把验证码泄露给其他人。如非本人操作，可不用理会！";
		$url = constant("APPLICATION_PATH").DIRECTORY_SEPARATOR.'configs'.DIRECTORY_SEPARATOR.'application.ini';
		$msgconfig = new Zend_Config_Ini($url, "shortmessage");
		$msgconfig = $msgconfig->toArray();
		$requestUrl = $msgconfig['targeturl'];
		$account = $msgconfig['account'];
		$passwd = $msgconfig['passwd'];
		
		$post_data = "account=".$account."&password=".$passwd."&mobile=".$telPhone."&content=".rawurlencode($content);
		$logger = Zend_Registry::get('log');
		$logger->log($content.','.$telPhone,Zend_Log::DEBUG);
		$returnStr = ShortMessageHelper::Post($post_data, $requestUrl);
		$logger->log("return str = ".$returnStr,Zend_Log::DEBUG);
		return $returnStr;
	}
	
	public static function PostShortMessage_v1($telPhone, $value , $type)
	{
		$content = '';
		
		if ($type == 1){
			$content = "您的资料我们已经审核通过，欢迎使用。";
		}else if ($type == 2){
			$content = "您的资料未能符合我们的审核要求，原因：".$value."。请重新注册账号，谢谢！";
		}else if ($type == 3){
			$content = "我们收到了您的反馈。".$value."。非常感谢！";
		}else if ($type == 4){
			$content = "我们收到了您被用户举报的通知。原因:".$value."。经过调查，我们决定暂时禁用您的账号。如有异议，请联系我们，谢谢！";
		}
		
		$url = constant("APPLICATION_PATH").DIRECTORY_SEPARATOR.'configs'.DIRECTORY_SEPARATOR.'application.ini';
		$msgconfig = new Zend_Config_Ini($url, "shortmessage");
		$msgconfig = $msgconfig->toArray();
		$requestUrl = $msgconfig['targeturl'];
		$account = $msgconfig['account'];
		$passwd = $msgconfig['passwd'];
	
		$post_data = "account=".$account."&password=".$passwd."&mobile=".$telPhone."&content=".rawurlencode($content);
		$logger = Zend_Registry::get('log');
		$logger->log($content.','.$telPhone,Zend_Log::DEBUG);
		$returnStr = ShortMessageHelper::Post($post_data, $requestUrl);
		$logger->log("return str = ".$returnStr,Zend_Log::DEBUG);
		return $returnStr;
	}

	public static function Post($curlPost,$url){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_NOBODY, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
		$return_str = curl_exec($curl);
		curl_close($curl);
		return $return_str;
	}
	

}

?>
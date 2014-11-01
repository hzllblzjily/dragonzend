<?php


require_once APPLICATION_PATH.'/helpers/CommonHelper.php';


if (!function_exists('getallheaders'))
{
	function getallheaders()
	{
		$headers = '';
		foreach ($_SERVER as $name => $value)
		{
			if (substr($name, 0, 5) == 'HTTP_')
			{
				$headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
			}
		}
		return $headers;
	}
}

class HttpHelper
{
	
	static function getRequestPayload()
	{
		$str =  file_get_contents('php://input');
		$str = urldecode($str);
		return $str;
	}
	
	static public function getHttpHeader(){
		//$headers = apache_request_headers();
		$headers = getallheaders();
	    //$headers = $_SERVER;
		return $headers;
	}
	
	
	static public function isLocalIp(){
	    $url = constant("APPLICATION_PATH").DIRECTORY_SEPARATOR.'configs'.DIRECTORY_SEPARATOR.'application.ini';
	    $cacheconfig = new Zend_Config_Ini($url, "pushSrcIP");
	    $cacheconfig = $cacheconfig->toArray();
	    $srcIP = $cacheconfig['sourceIP'];
	    
	    //$sourceIP = $_SERVER['REMOTE_ADDR'];
	    $sourceIP = CommonHelper::getip();
	    if($srcIP != $sourceIP && $sourceIP != '127.0.0.1' && $sourceIP != '::1')
	    {
            return false;
	    }
	    return true;
	}
}




?>
<?php

require_once APPLICATION_PATH .'/helpers/oss-helper/sdk.class.php';
require_once APPLICATION_PATH .'/helpers/AuthenticationMgr.php';
class AttachmentHelper {
    
    static public function mkAttachmentDir($route){
        $baseRoute = self::getFileBaseRoute();
        $fileArr = explode("/", $route);
        $dirRoute = $baseRoute;
        foreach ($fileArr as $key=>$value){
            $dirRoute = $dirRoute.'/'.$value;

            try {
            	if( !is_dir($dirRoute) ){
            		mkdir( $dirRoute , 0777);
            	}
            } catch (Exception $e) {
            	echo nl2br($e->__toString());
            	exit();
            }
            
        }
    }
    static public function getFileBaseRoute(){

        $baseRoute = constant("APPLICATION_PATH").'/../attachment';
        return $baseRoute;
        
    }
    
	//其中会根据年月日时分制作出文件路径，若不存在对应目录会自动创建，为方便扩展，精确到分钟级别
	static public function generateFileRoute(){

	    $baseRoute = self::getFileBaseRoute();
	    

		$year = date('Y');
		$month = date('m');
		$day = date('d');
		//$hour = date('G');
		//$minute = date('i');
		
		$index = 0;
		while($index < 3){
			switch ($index){
				case 0:{
					$endRoute = DIRECTORY_SEPARATOR.$year;
					break;
				}
				case 1:{
					$endRoute .= DIRECTORY_SEPARATOR.$month;
					break;
				}
				case 2:{
					$endRoute .= DIRECTORY_SEPARATOR.$day;
					break;
				}
// 				case 3:{
// 					$endRoute .= DIRECTORY_SEPARATOR.$hour;
// 					break;
// 				}
// 				case 4:{
// 					$endRoute .= DIRECTORY_SEPARATOR.$minute;
// 					break;
// 				}
			

			}
		    $fullRoute = $baseRoute.$endRoute;
			try {
				if( !is_dir($fullRoute) ){
					mkdir( $fullRoute , 0777);
				}
			} catch (Exception $e) {
				echo nl2br($e->__toString());
				exit();
			}
			$index++;
			
		}
		return $endRoute.DIRECTORY_SEPARATOR;
	}
	
	static public function uploadFileToAliOSS($fileLocalPath, $ossKeyPath){
		$url = constant("APPLICATION_PATH").DIRECTORY_SEPARATOR.'configs'.DIRECTORY_SEPARATOR.'application.ini';
		$ossconfig = new Zend_Config_Ini($url, "ossservice");
		$ossconfig = $ossconfig->toArray();
		
		$oss_sdk_service = new ALIOSS($ossconfig['accessKey'],$ossconfig['accessKeySecret'], $ossconfig['hostNameinternal']);
		//$oss_sdk_service = new ALIOSS($ossconfig['accessKey'],$ossconfig['accessKeySecret'], $ossconfig['hostName']);
		//设置是否打开curl调试模式
		$oss_sdk_service->set_debug_mode(FALSE);
		$bucket = $ossconfig['bucket'];
		$object = $ossKeyPath;
		
		$response = $oss_sdk_service->upload_file_by_file($bucket,$object,$fileLocalPath);
		return $response;
	}
	
	static public function downloadFileFromAliOSS($ossKeyPath){
		$url = constant("APPLICATION_PATH").DIRECTORY_SEPARATOR.'configs'.DIRECTORY_SEPARATOR.'application.ini';
		$ossconfig = new Zend_Config_Ini($url, "ossservice");
		$ossconfig = $ossconfig->toArray();
		
		//$oss_sdk_service = new ALIOSS($ossconfig['accessKey'],$ossconfig['accessKeySecret'], $ossconfig['hostName']);
		$oss_sdk_service = new ALIOSS($ossconfig['accessKey'],$ossconfig['accessKeySecret'], $ossconfig['hostNameinternal']);
		//设置是否打开curl调试模式
		$oss_sdk_service->set_debug_mode(FALSE);
		$bucket = $ossconfig['bucket'];
		$object = $ossKeyPath;
		
		$response = $oss_sdk_service->get_object($bucket,$object,null);
		return $response;
	}
	
	static public function downloadFileToPathFromAliOSS($ossKeyPath,$filePath){
		$url = constant("APPLICATION_PATH").DIRECTORY_SEPARATOR.'configs'.DIRECTORY_SEPARATOR.'application.ini';
		$ossconfig = new Zend_Config_Ini($url, "ossservice");
		$ossconfig = $ossconfig->toArray();
	
		//$oss_sdk_service = new ALIOSS($ossconfig['accessKey'],$ossconfig['accessKeySecret'], $ossconfig['hostName']);
		$oss_sdk_service = new ALIOSS($ossconfig['accessKey'],$ossconfig['accessKeySecret'], $ossconfig['hostNameinternal']);
		//设置是否打开curl调试模式
		$oss_sdk_service->set_debug_mode(FALSE);
		$bucket = $ossconfig['bucket'];
		$object = $ossKeyPath;
		$options = array(
				ALIOSS::OSS_FILE_DOWNLOAD => $filePath
				//ALIOSS::OSS_CONTENT_TYPE => 'txt/html',
		);
		
		$response = $oss_sdk_service->get_object($bucket,$object,$options);
		return $response;
	}
	
	static public function dbBackToAliOSS($fileLocalPath, $ossKeyPath){
		$url = constant("APPLICATION_PATH").DIRECTORY_SEPARATOR.'configs'.DIRECTORY_SEPARATOR.'application.ini';
		$ossconfig = new Zend_Config_Ini($url, "ossservice");
		$ossconfig = $ossconfig->toArray();
	
		//$oss_sdk_service = new ALIOSS($ossconfig['accessKey'],$ossconfig['accessKeySecret'], $ossconfig['hostName']);
		$oss_sdk_service = new ALIOSS($ossconfig['accessKey'],$ossconfig['accessKeySecret'], $ossconfig['hostNameinternal']);
		//设置是否打开curl调试模式
		$oss_sdk_service->set_debug_mode(FALSE);
		$bucket = $ossconfig['dbbucket'];
		$object = $ossKeyPath;
	
		$response = $oss_sdk_service->upload_file_by_file($bucket,$object,$fileLocalPath);
		return $response;
	}
	
	
	static public function echoFile($filePath,$fileName,$mimeType,$fileSize,$isInline){
        header("Content-type:".$mimeType);
        if($isInline){
            //在线打开
            header("Content-disposition:inline;filename=\"".$fileName."\"");
        }else{
            header("Content-disposition:attachment;filename=\"".$fileName."\"");
        }
	    if ($range = getenv('HTTP_RANGE')){
	        // 当有偏移量的时候，采用206的断点续传头
            $range = explode('=', $range); 
            $range = $range[1]; 

            header("HTTP/1.1 206 Partial Content"); 
            header("Date: " . gmdate("D, d M Y H:i:s") . " GMT"); 
            header("Last-Modified: ".gmdate("D, d M Y H:i:s", filemtime($filePath))." GMT"); 
            header("Accept-Ranges: bytes"); 
            header("Content-Length:".($fileSize - $range)); 
            header("Content-Range: bytes ".$range.($fileSize-1)."/".$fileSize); 
            header("Connection: close"."\n\n"); 
        } 
        else { 
            header("Content-Length:".$fileSize."\n\n"); 
            //加上last modify供浏览器缓存
            header("Last-Modified: ".gmdate("D, d M Y H:i:s", filemtime($filePath))." GMT");
            $lastModified = filemtime($filePath);
            //$s = $_SERVER;
            if(array_key_exists('HTTP_IF_MODIFIED_SINCE',$_SERVER)){
                $since = $_SERVER['HTTP_IF_MODIFIED_SINCE'];
                $sinceTick = strtotime($since);  
                if($sinceTick >= $lastModified){
                    header('HTTP/1.1 304');
                    return;
                } 
            }
            $range = 0; 
        }
        self::loadFile($filePath);               
    }
    
    static public function loadFile($filename, $retbytes = true) {
        $buffer = '';
        $cnt =0;        
        $handle = fopen($filename, 'rb');
        if ($handle === false) {
          return false;
        }
        while (!feof($handle)) {
          $buffer = fread($handle, 1024*1024);
          echo $buffer;
          ob_flush();
          flush();
          if ($retbytes) {
            $cnt += strlen($buffer);
          }
        }
        $status = fclose($handle);
        if ($retbytes && $status) {
          return $cnt; // return num. bytes delivered like readfile() does.
        }
        return $status;
	}
	
	
}

?>
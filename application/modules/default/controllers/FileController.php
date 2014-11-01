<?php

require_once APPLICATION_PATH.'/controllers/We_Base_Action_Controller.php';
require_once APPLICATION_PATH.'/helpers/AuthenticationMgr.php';
require_once APPLICATION_PATH.'/helpers/WeException.php';
require_once APPLICATION_PATH.'/helpers/AttachmentHelper.php';
require_once APPLICATION_PATH.'/models/servicemodel/Attachments.php';
require_once APPLICATION_PATH.'/helpers/CurlHelper/CurlRequest.php';

class FileController extends We_Base_Action_Controller
{

    public function init()
    {
        parent::init();
        /* Initialize action controller here */
        $this->_helper->viewRenderer->setNoRender(true);
        header('Content-type:application/json; charset=utf-8');
    }

    public function downloadAction(){
        $id = $this->getRequest()->getParam('id');
        $type = $this->getRequest()->getParam("type");   //origin,medium,thumb
        
        try{
            $attachment = new Attachments();
            $attachment->id = $id;
            $attachment = $attachment->get();
            if($attachment == null){
                $this->logger->log('no attachment id = '.$id.' find when download',Zend_Log::ERR);
                throw new WeException(20103);
            }
            $baseRoute = AttachmentHelper::getFileBaseRoute();
            
            if($type == 'origin'){
                $cacheFilePartRoute = $attachment->originFileRoute;
                $fileSize = $attachment->originFileSize;

            }else if($type == 'medium'){
                $cacheFilePartRoute = $attachment->mediumFileRoute;
                $fileSize = $attachment->mediumFileSize;
            }else if($type == 'thumb'){
                $cacheFilePartRoute = $attachment->thumbFileRoute;
                $fileSize = $attachment->thumbFileSize;
            }else{
                $this->logger->log('unknown type = '.$type,Zend_Log::ERR);
                throw new WeException(20508);
            }
            $cacheFileRoute = $baseRoute.$cacheFilePartRoute;
            if(file_exists($cacheFileRoute)){
                //有缓存，直接输出
                AttachmentHelper::echoFile($cacheFileRoute, $attachment->fileName, $attachment->contentType, $fileSize, true);
            }else{
                //抓oss
                $fileArr = explode('/', $cacheFilePartRoute);
                $ossKeyPath = $fileArr[count($fileArr) - 1];
                //先创建文件夹
                $dirRoute = '';
                for($i = 1; $i < count($fileArr) - 1; $i++){
                    $dirRoute = $dirRoute.$fileArr[$i].'/';
                }
                AttachmentHelper::mkAttachmentDir($dirRoute);
                $tmpGuid = CommonHelper::create_uuid();
                $tmpFullPath = AttachmentHelper::generateFileRoute().$tmpGuid;
                $tmpFullPath = AttachmentHelper::getFileBaseRoute().$tmpFullPath;
                //把文件写到临时文件内
                $response = AttachmentHelper::downloadFileToPathFromAliOSS($ossKeyPath,$tmpFullPath);
                if(!$response->isOK()){
                    $this->logger->log("downloadFileFromAliOSS response = ".$response, Zend_Log::ERR);
                    throw new WeException(20507);
                }
                if(file_exists($cacheFileRoute)){
                    //文件存在了，说明另一个线程已写，则直接删除临时文件
                    unlink($tmpFullPath);
                }else{
                    //改名
                    rename($tmpFullPath, $cacheFileRoute);
                }
                AttachmentHelper::echoFile($cacheFileRoute, $attachment->fileName, $attachment->contentType, $fileSize, true);
            }
            
            
        }catch ( WeException $e ) {
			//$this->dbAdapter->rollback ();
			$this->forward ( 'exception', 'global', '', array (
					'exception' => $e 
			) );
		} catch ( OSS_Exception $e ) {
			//$this->dbAdapter->rollback ();
			$this->logger->log('oss exception appears'.$e, Zend_Log::ERR);
			$e = new WeException(20506);
			$this->forward ( 'exception', 'global', '', array (
					'exception' => $e
			) );
		}catch ( Exception $e ) {
			//$this->dbAdapter->rollback ();
			$e = new WeException ();
			$this->forward ( 'exception', 'global', '', array (
					'exception' => $e 
			) );
		}
        
    }
    
    
    public function uploadAction(){
        try {
        	$this->dbAdapter->beginTransaction();
        		
        	//判断http request中是否有file
        	if (!isset ( $_FILES ['image'] ['name'] ) || !isset ( $_FILES ['image'] ['tmp_name'] ) ||
        	!isset ( $_FILES ['image'] ['type'] ) || !isset ( $_FILES ['image'] ['size'] ) ||
        	!isset ( $_FILES ['image'] ['error'] )) {
        		$this->logger->log('uploadfile is illegal', Zend_Log::ERR);
        		$e = new WeException(20501);
        		throw $e;
        	}
        	
        	//判断是否有传输错误
        	if ( $_FILES ['image'] ['error'] != 0) {
        	    //$iconImage =  $_FILES ['image'];
        		$this->logger->log('file transfer failed error = '.$_FILES['image']['error'], Zend_Log::ERR);
        		$e = new WeException(20502);
        		throw $e;
        	}
        	
	    	$iconImage =  $_FILES ['image'];
	    	//判断大小是否超过规定 10M
	    	if ( $iconImage['size'] > MAX_FILE_UPLOAD_SIZE || $iconImage['size'] < 0) {
	    		$this->logger->log('file size is too big', Zend_Log::ERR);
	    		$e = new WeException(20503);
	    		throw $e;
	    				
	    	}
	    	//不能上传空文件
	    	if ( $iconImage['size'] == 0) {
	    		$this->logger->log('file size is equal to zero', Zend_Log::ERR);
	    		$e = new WeException(20504);
	    		throw $e;
	    	}
	    			
	    	//判断图片类型是否符合规则
	    	if ($iconImage['type'] != 'image/jpeg' && $iconImage['type'] != 'image/jpg' && $iconImage['type'] != 'image/png') {
	    		$this->logger->log('file type is illegal = '.$iconImage['type'], Zend_Log::ERR);
	    		$e = new WeException(20505);
	    		throw $e;
	    	}
	    			
	    	//获取文件信息
	    	$fileDir = $iconImage['tmp_name'];
	    	$fileType = $iconImage['type'];
	    	$fileSize = $iconImage['size'];
	    	$fileName = $iconImage['name'];
	    			
	    			
	    	
	    	//调用servicemodel将图片插入数据库
	    	//暂时实现
	    	$attach = new Attachments();
	    	$attach_id = $attach->uploadFile($fileDir, $fileType, $fileName, $fileSize, "activities", $activity->id,"image",true);

        	$this->dbAdapter->commit();
        		
        	$returnValue = array('id'=>$attach_id);
        	$returnValue = json_encode($returnValue, JSON_UNESCAPED_UNICODE);
        	echo $returnValue;
        	exit ();
        } catch ( WeException $e ) {
        	$this->dbAdapter->rollback ();
        	$this->forward ( 'exception', 'global', '', array (
        			'exception' => $e
        	) );
        } catch ( OSS_Exception $e ) {
        	$this->dbAdapter->rollback ();
        	$this->logger->log('oss exception appears'.$e, Zend_Log::ERR);
        	$e = new WeException (20506);
        	$this->forward ( 'exception', 'global', '', array (
        			'exception' => $e
        	) );
        }catch ( Exception $e ) {
        	$this->dbAdapter->rollback ();
        	$e = new WeException ();
        	$this->forward ( 'exception', 'global', '', array (
        			'exception' => $e
        	) );
        }
    }

    


}


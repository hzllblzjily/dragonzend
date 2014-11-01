<?php

require_once APPLICATION_PATH.'/controllers/We_Base_Rest_Controller.php';
require_once APPLICATION_PATH.'/helpers/AuthenticationMgr.php';
require_once APPLICATION_PATH.'/helpers/CommonHelper.php';
require_once APPLICATION_PATH.'/helpers/WeException.php';
abstract class We_Base_Easemob_Rest_Controller extends We_Base_Rest_Controller
{
	
	public function init()
	{
		parent::init();
		
		$this->_helper->viewRenderer->setNoRender(false);
		header('Content-type:application/json; charset=utf-8');
		
		if(!AuthenticationMgr::isEasemobModule()){
			$this->logger->log('no permission to visit easemob module',Zend_Log::ERR);
			throw new WeException(40101);
		}
		
		//做请求ip判断，不是指定ip的全部退出
		if(!HttpHelper::isLocalIp()){
			$sourceIP = CommonHelper::getip();
			$this->logger->log ('remote source ip is invalid = '.$sourceIP, Zend_Log::ERR );
			echo "no permission by remote ip = ".$sourceIP;
			exit();
		}
	}
}


?>
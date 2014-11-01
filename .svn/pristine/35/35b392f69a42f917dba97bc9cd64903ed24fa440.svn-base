<?php

require_once APPLICATION_PATH.'/helpers/HttpHelper.php';
require_once APPLICATION_PATH.'/helpers/AuthenticationMgr.php';
require_once APPLICATION_PATH.'/helpers/WeException.php';
require_once APPLICATION_PATH.'/controllers/We_Base_Action_Controller.php';

class We_Base_Backend_Action_Controller extends We_Base_Action_Controller{

	protected $isDashboardLogin = false;
    
    
    public function init(){
        
        parent::init();
        
        $this->_helper->viewRenderer->setNoRender(false);
        header('Content-type:text/html; charset=utf-8');
        
        
        if(!AuthenticationMgr::isBackendModule()){
            $this->logger->log('no permission to visit backend module',Zend_Log::ERR);
            throw new WeException(30108);
        }
        
        $currentAdminInfo = AuthenticationMgr::getAuthInfo();
        
        if($currentAdminInfo===null )
        {
        	//admin还未登录或登录已过期
        	$this->isDashboardLogin = false;
        	$controllerName = $this->getRequest()->getControllerName();
        	$actionName = $this->getRequest()->getActionName();
        	if($controllerName == 'connection'){
        
        	}else{
        		$this->redirect("/connection/enterlogin");
        	}
        
        	return;
        
        }
        else
        {
        
        	$this->isDashboardLogin = true;
        		
        }
    }
    
    
    
}


?>
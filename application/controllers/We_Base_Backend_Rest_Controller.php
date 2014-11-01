<?php

require_once APPLICATION_PATH.'/helpers/HttpHelper.php';
require_once APPLICATION_PATH.'/helpers/AuthenticationMgr.php';
require_once APPLICATION_PATH.'/helpers/WeException.php';
require_once APPLICATION_PATH.'/controllers/We_Base_Rest_Controller.php';


//后台管理对应的资源
class We_Base_Backend_Rest_Controller extends We_Base_Rest_Controller{

    
    
    public function init(){
        
        parent::init();
        
        $this->_helper->viewRenderer->setNoRender(false);
        header('Content-type:text/html; charset=utf-8');
        
        
        if(!AuthenticationMgr::isBackendModule()){
            $this->logger->log('no permission to visit backend module',Zend_Log::ERR);
            throw new WeException(30108);
        }
        
    }
    

    
    
}


?>
<?php

require_once APPLICATION_PATH.'/helpers/HttpHelper.php';

class We_Base_Action_Controller extends Zend_Controller_Action{
    protected $logger;
    protected $dbAdapter;
    protected $isUseSessionContext = false;
    
    
    public function init(){
        
        $this->dbAdapter = Zend_Registry::get('dbAdapter');
        $this->logger = Zend_Registry::get('log');
        $this->logger->setEventItem('controller', $this->_request->getControllerName() );
        $this->logger->setEventItem('action', $this->_request->getActionName() );
        
        
        parent::init();
        
    }
    
 
    
    
}


?>
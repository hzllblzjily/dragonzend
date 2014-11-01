<?php

require_once APPLICATION_PATH.'/helpers/HttpHelper.php';

class We_Base_Rest_Controller extends Zend_Rest_Controller{
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
    

    
    /**
     * The index action handles index/list requests; it should respond with a
     * list of the requested resources.
     */
    public function indexAction(){

    }
    
    /**
     * The get action handles GET requests and receives an 'id' parameter; it
     * should respond with the server resource state of the resource identified
     * by the 'id' value.
    */
    public function getAction(){
 
    }
    
    /**
     * The head action handles HEAD requests and receives an 'id' parameter; it
     * should respond with the server resource state of the resource identified
     * by the 'id' value.
    */
    public function headAction(){

    }
    
    /**
     * The post action handles POST requests; it should accept and digest a
     * POSTed resource representation and persist the resource state.
    */
    public function postAction(){

    }
    
    /**
     * The put action handles PUT requests and receives an 'id' parameter; it
     * should update the server resource state of the resource identified by
     * the 'id' value.
    */
    public function putAction(){

    }
    
    /**
     * The delete action handles DELETE requests and receives an 'id'
     * parameter; it should update the server resource state of the resource
     * identified by the 'id' value.
    */
    public function deleteAction(){

    }
    
    
    
}


?>
<?php

require_once APPLICATION_PATH.'/helpers/HttpHelper.php';
require_once APPLICATION_PATH.'/models/servicemodel/Users.php';
require_once APPLICATION_PATH.'/models/servicemodel/Lawyers.php';
require_once APPLICATION_PATH.'/helpers/AuthenticationMgr.php';
require_once APPLICATION_PATH.'/controllers/We_Base_Action_Controller.php';

class We_Base_Api_Action_Controller extends We_Base_Action_Controller{

    public function init(){
        
        parent::init();
        
        $this->_helper->viewRenderer->setNoRender(true);
        header('Content-type:application/json; charset=utf-8');
        
        if(!AuthenticationMgr::isApiModule()){
            $this->logger->log('no permission to visit api module',Zend_Log::ERR);
        	throw new WeException(20106);
        }
        
    }
    
    public function validLogin(){
        $token = AuthenticationMgr::getAuthInfo();
        if($token == null){
            throw new WeException(20105);
        }
        AuthenticationMgr::$isActAsRoot = true;
        $user_id = Users::getUserIdByToken($token);
        if($user_id == 0){
            throw new WeException(20105);
        }
        $users = new Users();
        $users->id = $user_id;
        $users = $users->get();
        if($users == null){
        	throw new WeException(20105);
        }else if($users->disabled_flag == 1){
            throw new WeException(20107);
        }
        AuthenticationMgr::$isActAsRoot = false;
        return $user_id;
    }
    
    public function validLayerLogin(){
    	$token = AuthenticationMgr::getAuthInfo();
    	if($token == null){
    		throw new WeException(20105);
    	}
    	AuthenticationMgr::$isActAsRoot = true;
    	$user_id = Lawyers::getUserIdByToken($token);
    	if($user_id == 0){
    		throw new WeException(20105);
    	}
    	$users = new Lawyers();
    	$users->id = $user_id;
    	$users = $users->get();
    	if($users == null){
    		throw new WeException(20105);
    	}else if($users->disabled_flag == 1){
    		throw new WeException(20107);
    	}else if($users->isApproved == 0){
    		throw new WeException(20108);
    	}
    	AuthenticationMgr::$isActAsRoot = false;
    	return $user_id;
    }
    
    
}


?>
<?php


class AuthenticationMgr{
    
    
    static public $isActAsRoot = false;    //不管disabled_flag
    
    //以超级管理员方式访问
    public static function actAsRoot(){
        AuthenticationMgr::$isActAsRoot = true;
    }
    
    
    public static function disableActAsRoot(){
    	AuthenticationMgr::$isActAsRoot = false;
    }
    
    
    //api, backend
    public static function getModuleName(){
        $moduleName =  Zend_Registry::get("moduleName");
        return $moduleName;
    }
    
    
    //api返回auth-token，backend返回currentadmininfo,没有则都返回null
    public static function getAuthInfo(){
        $moduleName = AuthenticationMgr::getModuleName();
        if($moduleName == 'api'){
            $token = null;
            if(Zend_Registry::isRegistered("Auth-Token")){
            	$token = Zend_Registry::get("Auth-Token");
            }
            return $token;
        }
        if($moduleName == 'backend'){
        	$adminInfo = AdminSessionContext::getCurrentAdminInfo();
        	return $adminInfo;
//             return null;
//             Zend_Session::start();
//             $adminSession = new Zend_Session_Namespace(ADMIN_SESSION_NAMESPACE);
//             $adminSessionContext = $adminSession->__get(ADMIN_SESSION_CONTEXT);
//             if($adminSessionContext == null){
//             	return null;
//             }else{
//                 $adminUserInfo = $adminSessionContext->currentAdminInfo;
//                 return $adminUserInfo;
//             }
        }
    }
    
    public static function isApiModule(){
        $moduleName = AuthenticationMgr::getModuleName();
        if($moduleName == 'api'){
            return true;
        }
        return false;
 
    }
    public static function isBackendModule(){
        $moduleName = AuthenticationMgr::getModuleName();
        if($moduleName == 'backend'){
        	return true;
        }
        return false;
  
    }
    
    public static function isEasemobModule(){
        $moduleName = AuthenticationMgr::getModuleName();
        if($moduleName == 'easemob'){
        	return true;
        }
        return false;
    }
    
}



?>
<?php

require_once APPLICATION_PATH.'/helpers/AuthenticationMgr.php';

//header('Content-Type: text/html; charset=UTF-8');


$url = constant("APPLICATION_PATH").DIRECTORY_SEPARATOR.'configs'.DIRECTORY_SEPARATOR.'application.ini';
$weiboConfig = new Zend_Config_Ini($url, "Weibo");

$weiboConfig = $weiboConfig->toArray();
if(AuthenticationMgr::isApiModule()){
    define( "WB_AKEY" , $weiboConfig['apiAppId'] );
    define( "WB_SKEY" , $weiboConfig['apiAppSecret']  );
    define( "WB_CALLBACK_URL" , $weiboConfig['apiCallback'] );
}else if(AuthenticationMgr::isBackendModule()){
    define( "WB_AKEY" , $weiboConfig['bkAppId'] );
    define( "WB_SKEY" , $weiboConfig['bkAppSecret']  );
    define( "WB_CALLBACK_URL" , $weiboConfig['bkCallback'] );
}else{
    define( "WB_AKEY" , $weiboConfig['apiAppId'] );
    define( "WB_SKEY" , $weiboConfig['apiAppSecret']  );
    define( "WB_CALLBACK_URL" , $weiboConfig['apiCallback'] );
}


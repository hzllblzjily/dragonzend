<?php

require_once APPLICATION_PATH.'/models/servicemodel/Notifications.php';
require_once APPLICATION_PATH.'/models/servicemodel/Users.php';
require_once APPLICATION_PATH.'/models/servicemodel/Lawyers.php';
require_once APPLICATION_PATH.'/helpers/CommonHelper.php';

class NotificationHelper
{

	static function pushNotification($notification)
	{
	    $notification = $notification->create();
	    $str = null;
	    $deviceToken = "";
	    $url = constant ( "APPLICATION_PATH" ) . DIRECTORY_SEPARATOR . 'configs' . DIRECTORY_SEPARATOR . 'application.ini';
	    $serverconfig = new Zend_Config_Ini ( $url, "servercommunication" );
	    $serverconfig = $serverconfig->toArray ();
	    $servertoken = $serverconfig['servertoken'];
	    
	    $urlConfig = new Zend_Config_Ini ( $url, "server" );
	    $urlConfig = $urlConfig->toArray ();
	    $apiUrl = $urlConfig['apidomainName'];
	    
	    switch($notification->msgType){
	    	case 1:
	    	    $str = $notification->creatorLawyer->userName." 律师回复了您";
	    	    $deviceToken = $notification->msgToUser->deviceToken;
	    	    if($deviceToken != null){
	    	        //CommonHelper::send($str, $deviceToken, 1, false);
	    	        CommonHelper::curl_post_async_form($apiUrl."v1/push/push", "count=1&servertoken=".$servertoken."&str=".$str."&deviceToken=".$deviceToken."&type=用户");
	    	    }
	    	    break;
	    	case 2:
	    	    $str = $notification->creatorUser->userName." 回复了您";
	    	    $deviceToken = $notification->msgToLawyer->deviceToken;
	    	    if($deviceToken != null){
	    	    	//CommonHelper::sendlawyer($str, $deviceToken, 1, false);
	    	    	CommonHelper::curl_post_async_form($apiUrl."v1/push/push", "count=1&servertoken=".$servertoken."&str=".$str."&deviceToken=".$deviceToken."&type=律师");
	    	    }
	    	    break;
	    	case 3:
	    	    $str = $notification->creatorLawyer->userName." 律师向您发起了委托确认";
	    	    $deviceToken = $notification->msgToUser->deviceToken;
	    	    if($deviceToken != null){
	    	    	CommonHelper::curl_post_async_form($apiUrl."v1/push/push", "count=1&servertoken=".$servertoken."&str=".$str."&deviceToken=".$deviceToken."&type=用户");
	    	    }
	    	    break;
	    	case 4:
	    	    if($notification->msgOption == 1){
	    	        $str = "您的委托确认已通过审核";
	    	    }else{
	    	        $str = "您的委托确认未通过审核，请重新提交您的委托确认，或者致电联系我们";
	    	    }
	    	    $deviceToken = $notification->msgToLawyer->deviceToken;
	    	    if($deviceToken != null){
	    	    	CommonHelper::curl_post_async_form($apiUrl."v1/push/push", "count=1&servertoken=".$servertoken."&str=".$str."&deviceToken=".$deviceToken."&type=律师");
	    	    }
	    	   	break;
	    	case 5:
	    	    if($notification->msgOption == 1){
	    	        $str = $notification->creatorLawyer->userName." 律师的委托确认已通过审核。请您对ta的服务结果做出评价";
	    	    }else{
	    	        $str = $notification->creatorLawyer->userName." 律师的委托确认未通过审核";
	    	    }
	    	    $deviceToken = $notification->msgToUser->deviceToken;
	    	    if($deviceToken != null){
	    	    	CommonHelper::curl_post_async_form($apiUrl."v1/push/push", "count=1&servertoken=".$servertoken."&str=".$str."&deviceToken=".$deviceToken."&type=用户");
	    	    }
	    	    break;
	    	case 6:
	    	    if($notification->msgOption == 1){
	    	    	$str = $notification->creatorUser->userName." 接受了您的委托确认";
	    	    }else{
	    	    	$str = $notification->creatorUser->userName." 拒绝了您的委托确认";
	    	    }
	    	    $deviceToken = $notification->msgToLawyer->deviceToken;
	    	    if($deviceToken != null){
	    	    	CommonHelper::curl_post_async_form($apiUrl."v1/push/push", "count=1&servertoken=".$servertoken."&str=".$str."&deviceToken=".$deviceToken."&type=律师");
	    	    }
	    	    break;
	    	case 7:
	    	    $str = $notification->creatorUser->userName." 对您的服务进行了评价";
	    	    $deviceToken = $notification->msgToLawyer->deviceToken;
	    	    if($deviceToken != null){
	    	    	CommonHelper::curl_post_async_form($apiUrl."v1/push/push", "count=1&servertoken=".$servertoken."&str=".$str."&deviceToken=".$deviceToken."&type=律师");
	    	    }
	    	    break;
	    	case 8:
	    	   	$str = "平台广播：".$notification->msgOptionContent;
	    	   	if($notification->msgTo_type == "用户"){
	    	   	    $deviceToken = $notification->msgToUser->deviceToken;
	    	   	    if($deviceToken != null){
	    	   	    	CommonHelper::curl_post_async_form($apiUrl."v1/push/push", "count=1&servertoken=".$servertoken."&str=".$str."&deviceToken=".$deviceToken."&type=用户");
	    	   	    }
	    	   	}else if($notification->msgTo_type == "律师"){
	    	   	    $deviceToken = $notification->msgToLawyer->deviceToken;
	    	   	    if($deviceToken != null){
	    	   	    	CommonHelper::curl_post_async_form($apiUrl."v1/push/push", "count=1&servertoken=".$servertoken."&str=".$str."&deviceToken=".$deviceToken."&type=律师");
	    	   	    }
	    	   	}
	    	   	break;
	    }
	    
	}


}


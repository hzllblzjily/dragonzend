<?php

require_once APPLICATION_PATH.'/helpers/Admin/CurrentAdminInfo.php';
require_once APPLICATION_PATH.'/helpers/WeException.php';

class AdminSessionContext
{
	public $currentAdminInfo;
	
	public static function getCurrentAdminInfo()
	{
		Zend_Session::start();
		
		$authSession = new Zend_Session_Namespace('Zend_Auth');
		$adminSession = new Zend_Session_Namespace(ADMIN_SESSION_NAMESPACE);
		if($adminSession->__get(ADMIN_SESSION_CONTEXT)===null )
		{
            return null;
		}
		else
		{
			$session = $adminSession->__get(ADMIN_SESSION_CONTEXT);

			return $session->currentAdminInfo;
		}
	}
}

<?php

require_once APPLICATION_PATH.'/controllers/We_Base_EasemobAction_Controller.php';
require_once APPLICATION_PATH.'/helpers/easemob/EasemobService.php';
require_once APPLICATION_PATH.'/helpers/HttpHelper.php';
class Easemob_UsersController extends We_Base_EasemobAction_Controller
{
	public function init(){
		parent::init();
		
	}
	
	
	public function registerAction(){
		$userName = $this->getRequest()->getParam('username');
		$password = $this->getRequest()->getParam('password');
		$srv = new EasemobService();
		$return = $srv->registerUser($userName, $password);
		$return = json_encode($return);
		echo $return;
	}
	
	public function batchregisterAction(){
		$payload = HttpHelper::getRequestPayload();
		$usersArr = json_decode($payload,true);

		
		$srv = new EasemobService();
		$return = $srv->batchregister($usersArr);
		$return = json_encode($return);
		echo $return;
	}
	
	
	public function getuserAction(){
		$userName = $this->getRequest()->getParam('username');
		$srv = new EasemobService();
		$return = $srv->getUser($userName);
		$return = json_encode($return);
		echo $return;
	}
	
	public function changepasswordAction(){
		$password = $this->getRequest()->getParam('newpassword');
		$userName = $this->getRequest()->getParam('username');
		$srv = new EasemobService();
		$return = $srv->changepassword($userName,$password);
		$return = json_encode($return);
		echo $return;
	}
	
	public function deleteuserAction(){
		$userName = $this->getRequest()->getParam('username');
		$srv = new EasemobService();
		$return = $srv->delete($userName);
		$return = json_encode($return);
		echo $return;
	}
	
	public function batchdeleteAction(){
		$limit = $this->getRequest()->getParam('limit');
		$srv = new EasemobService();
		$return = $srv->batchDelete($limit);
		$return = json_encode($return);
		echo $return;
	}
	
}




?>
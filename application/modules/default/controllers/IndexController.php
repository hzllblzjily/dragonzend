<?php

require_once APPLICATION_PATH.'/controllers/We_Base_Action_Controller.php';
require_once APPLICATION_PATH.'/helpers/AuthenticationMgr.php';

require_once APPLICATION_PATH.'/helpers/CurlHelper/CurlRequest.php';

class IndexController extends We_Base_Action_Controller
{

    public function init()
    {
        /* Initialize action controller here */

        if(AuthenticationMgr::isBackendModule()){
            //返回首页
            header('Content-type:text/html; charset=utf-8');
            $this->_helper->viewRenderer->setNoRender(false);
        }
        
        

    }

    public function indexAction()
    {
        try
        {
            if(!AuthenticationMgr::isBackendModule()){
                throw new WeException(30108);
            }
        }catch (WeException $e) { //首先捕weException
 
        	$this->forward('exception','global', '',array('exception'=>$e));
        } catch (Exception $e) {
        	throw $e;
        }
        
        
    }


}


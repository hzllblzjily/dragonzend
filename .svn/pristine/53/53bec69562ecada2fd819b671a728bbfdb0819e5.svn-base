<?php



class GlobalController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }
    
    
    public function exceptionAction()
    {

    	$param = $this->getRequest ()->getParam ( 'exception' );

    	$param->getErrorCode();
    	$param->getErrorMessage();
    	echo json_encode ( $param,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES );
    	header('HTTP/1.0 500');
    	exit ();

    }




    
}


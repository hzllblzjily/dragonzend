<?php

require_once APPLICATION_PATH .'/helpers/WeException.php';
require_once APPLICATION_PATH .'/helpers/CommonHelper.php';
require_once APPLICATION_PATH .'/helpers/AuthenticationMgr.php';

class ErrorController extends Zend_Controller_Action
{
    protected $logger;
    public function errorAction()
    {
        $this->logger = Zend_Registry::get('log');
        
        $errors = $this->_getParam('error_handler');
        if (!$errors || !$errors instanceof ArrayObject) {
        	$this->view->message = 'You have reached the error page';
        	return;
        }
        
     
        $exception = $errors->exception;
        if($exception instanceof WeException)
        {
            $this->logger->log('error controller receive a WeException, errorCode = '.$exception->getErrorCode(),Zend_Log::ERR);
            if($exception->getErrorCode() == 0){
                if(AuthenticationMgr::isApiModule()){
                    $this->forward('exception','global', '',array('exception'=>$errors->exception));
                    return;
                }
                // application error
                $this->getResponse()->setHttpResponseCode(500);
                $this->view->message = '应用出现错误，请联系管理员';
                $this->logger->log('ip = '.CommonHelper::getip().
                		',error controller receive a exception, errorMsg = '.$exception->getMessage().' error trace = '.
                		$exception->getTraceAsString().' request params controller = '.$errors->request->getParams()['controller'].'
        	        action = '.$errors->request->getParams()['action'],Zend_Log::ERR);
                //暂时处理
                //$this->renderScript('error/404.phtml');
                //break;
                if ($this->getInvokeArg('displayExceptions') == true) {
                	$this->view->exception = $errors->exception;
                }
                
                $this->view->request = $errors->request;
                
            }else{
                //weexception application系统错误,以json方式返回错误信息
                $this->forward('exception','global', '',array('exception'=>$errors->exception));
            }

        }
        else
        {
            //非api application系统错误，以网页形式返回错误信息
            switch ($errors->type) {
            	case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            	case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            	case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
            		// 404 error -- controller or action not found
            		$this->getResponse()->setHttpResponseCode(404);
            		$this->view->message = '请求的网页不存在';
            		$this->logger->log('ip = '.CommonHelper::getip().
            				',error controller receive a exception, errorMsg = '.$exception->getMessage().' error trace = '.
            				$exception->getTraceAsString().' request params controller = '.$errors->request->getParams()['controller'].'
        	        action = '.$errors->request->getParams()['action'],Zend_Log::WARN);
            		$this->renderScript('error/404.phtml');
            		//$this->renderScript('/404.html');
            		break;
            	default:
            		// application error
            		$this->getResponse()->setHttpResponseCode(500);
            		$this->view->message = '应用出现错误，请联系管理员';
            		$this->logger->log('ip = '.CommonHelper::getip().
            				',error controller receive a exception, errorMsg = '.$exception->getMessage().' error trace = '.
            				$exception->getTraceAsString().' request params controller = '.$errors->request->getParams()['controller'].'
        	        action = '.$errors->request->getParams()['action'],Zend_Log::ERR);
            		//暂时处理
            		//$this->renderScript('error/404.phtml');
            		break;
            }
            
            
            // conditionally display exceptions
            if ($this->getInvokeArg('displayExceptions') == true) {
            	$this->view->exception = $errors->exception;
            }
            
            $this->view->request = $errors->request;
            
        
        }
    }

    


}


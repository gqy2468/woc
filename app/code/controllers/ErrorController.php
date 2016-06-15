<?php
/**
 * 错误控制器
 * 
 * @author     yjzzj.com 
 * @date       2011-10-19 
 * @version    1.2 
 */



class ErrorController extends Action
{
    public function errorAction()
    {
        $errors = $this->_getParam('error_handler');
        switch ($errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                // 404 error -- controller or action not found                
                $this->getResponse()->setRawHeader('HTTP/1.1 404 Not Found');
                $this->view->title = 'HTTP/1.1 404 Not Found';
                break;
            default:
                // application error; display error page, but don't change status code
                $this->view->title = 'Application Error';
                break;
        }
        $this->view->message = $errors->exception;
    }
}

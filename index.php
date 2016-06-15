<?php
/**
 * 系统入口
 * 
 * @author     yjzzj.com 
 * @date       2011-10-19
 * @version    1.2 
 */

set_include_path('./library' . PATH_SEPARATOR . get_include_path());
require_once "Zend/Loader.php";
require_once 'app/Initializer.php';
require_once 'app/Smarty.php';
Zend_Loader::registerAutoload(); 
Zend_Session::start();
$frontController = Zend_Controller_Front::getInstance();
$frontController->registerPlugin(new Initializer());
$frontController->throwExceptions(true);
$frontController->dispatch(); 
?>
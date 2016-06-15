<?php
/**
 * Zend_Controller_Action继承类
 * 
 * @author     yjzzj.com 
 * @date       2011-10-19 
 * @version    1.2 
 */

class Action extends Zend_Controller_Action {
	protected $_user;
	protected $_db;
	protected $_engine;
	
	public function init(){
		$this->_db = Zend_Registry::get("db");
		$this->_engine = Zend_Registry::get("engine");
		$this->_user = Zend_Auth::getInstance()->getIdentity();
		$auth = Zend_Auth::getInstance ();
		if (!$auth->hasIdentity()) {
			if ($this->getRequest()->getControllerName() !== 'auth') $this->_redirect ( "/auth/login" );
		}
		if ($this->_engine !== 'smarty') {
			if ($this->getRequest()->getControllerName() == 'auth') $this->_helper->layout->disableLayout();
		}
		$this->view = Zend_Registry::get("views");
		$perm = new Perm($auth->getIdentity());
		$this->view->permission = $perm->getPerm();
		$this->view->user = $auth->getIdentity();
		$this->view->u = $this->_user;
		$this->view->t = $this->getSiteType();
		$this->view->r = Zend_Registry::get("root");
	}

	protected function getSiteType(){
		$t = new User_Type();
		return $t->fetchAll()->toArray();
	}
}

?>

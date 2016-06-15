<?php
/**
 * 登录认证
 * 
 * @author     yjzzj.com 
 * @date       2011-10-19 
 * @version    1.2 
 */

class AuthController extends Action {

	public function indexAction(){
	}
	
	public function loginAction(){
		$this->view->msgName = "";
		$this->view->msgPass = "";
		$this->view->msgError = "";
		$request = $this->getRequest();
		if($request->isPost()){
			$f = new Zend_Filter_StripTags();
			$validator = new Zend_Validate_EmailAddress();
			$str_name = trim($f->filter($request->getPost('name')));
			$str_password = trim($f->filter($request->getPost('password')));
			if($str_name == ""){
				$this->view->msgName = "必填选项不能留空";
			}
			if($this->view->msgName == ""){
				if($str_password == ""){
					$this->view->msgPass = "必填选项不能留空";
				}
			}
			if($this->view->msgName == "" && $this->view->msgPass == ""){
				$authAdapter = new Zend_Auth_Adapter_DbTable($this->_db);
				$authAdapter->setTableName("users")
							->setIdentityColumn("name")
							->setCredentialColumn("pass");
				$authAdapter->setIdentity($str_name)
							->setCredential($str_password);
				$auth = Zend_Auth::getInstance();
				$result = $auth->authenticate($authAdapter);
				if($result->isValid()){
					$storage = $auth->getStorage();
					$storage->write($authAdapter->getResultRowObject(null,'pass'));
					$this->_redirect("/index/index");
				}else{
					$this->view->msgError = "用户名或密码错误";
				}
			}
			$this->view->Name = $str_name;
		}
	}
	
	public function logoutAction(){
		Zend_Auth::getInstance()->clearIdentity();
		$this->_redirect("/auth/login");
	}
}

?>
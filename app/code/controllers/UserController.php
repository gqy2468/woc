<?php
/**
 * 用户管理控制器
 * 
 * @author     yjzzj.com 
 * @date       2011-10-19 
 * @version    1.2 
 */

class UserController extends Action {
	
	public function preDispatch() {
		$this->view->userlist = "class='active'";	
		if($this->_engine !== "smarty"){
			$response = $this->getResponse ();
			$response->insert ( "sidebar", $this->view->render ( "sidebar.phtml" ) );
		}
	}
	
	public function indexAction(){
		$this->_redirect('/user/list');
	}
	
	public function addAction(){
		$this->view->msgName = "";
		$this->view->msgPass = "";
		$this->view->msgrepass = "";
		$this->view->msgEmail = "";
		$this->view->msgTelephone = "";
		$request = $this->getRequest();
		if($request->getPost()){
			$f = new Zend_Filter_StripTags();
			$name = trim($f->filter($request->getPost('name')));
			$pass = trim($f->filter($request->getPost('pass')));
			$repass = trim($f->filter($request->getPost('repass')));
			$email = trim($f->filter($request->getPost('email')));
			$tel = trim($f->filter($request->getPost('tel')));
			$status = trim($f->filter($request->getPost('status')));
			$role = trim($f->filter($request->getPost('role')));
			$pduct = trim($f->filter($request->getPost('product')));
			$this->view->name = $name;
			$this->view->pass = $pass;
			$this->view->repass = $repass;
			$this->view->email = $email;
			$this->view->tel = $tel;
			try{
				$rs = new User_Role();
				$product = new User_Type();
				$this->view->pt = $this->view->pt = $product->fetchAll()->toArray();
				$this->view->rs = $rs->fetchAll()->toArray();
			}catch(Zend_Db_Table_Exception $e){
				throw new Zend_Db_Table_Exception($e);
			}
			if($name == ""){
				$this->view->msgName = "必填选项不能留空";
			}else if(strlen($name) > 64){
				$this->view->msgName = "输入字符不要大于64位";
			}
			if($pass == ""){
				$this->view->msgPass = "必填选项不能留空";
			}else if(strlen($pass) < 6){
				$this->view->msgPass = "密码太短";
			}
			if($repass != $pass){
				$this->view->msgRepass ="两次密码输入不一致";
			}
			$validate = new Zend_Validate_EmailAddress();
			if($email == ""){
				$this->view->msgEmail = "必填选项不能留空";
			}else if(!$validate->isValid($email)){
				$this->view->msgEmail = "请输入合法的电子邮箱";
			}else if(strlen($email) >64){
				$this->view->msgEmail ="输入字符不要大于64位";
			}
			if($tel == ""){
				$this->view->msgTelephone = "必填选项不能留空";
			}else if (strlen($tel) >20){
				$this->view->msgTelephone = "输入字符不要大于20位";
			}
			if($this->view->msgName == "" && $this->view->msgPass == "" && $this->view->msgrepass == "" && $this->view->msgEmail == "" && $this->view->msgTelephone == ""){
				$arr_role = explode('|',$role);
				$arr_product = explode('|',$pduct);
				$ptid = $arr_product[1];
				$pname = $arr_product[0];
				$rid = $arr_role[1];
				$rname = $arr_role[0];
				$arr_user = array(
					'name' => $name,
					'pass' => $pass,
					'email' => $email,
					'telphone' => $tel,
					'status' => $status,
					'created' => time(),
					'access' =>time(),
					'login' =>time(),
					'ip' =>$_SERVER['REMOTE_ADDR'],
					'rid' => $rid,
					'rname' => $rname,
					'ptid' => $ptid,
					'pname' => $pname
				);
				try{
					$user = new User();
					$user->insert($arr_user);
					$this->_redirect('/user/list');
				}catch (Zend_Db_Table_Exception $e){
					throw new Zend_Db_Table_Exception($e);
				}
			}
		}else{
			try{
				$rs = new User_Role();
				$product = new User_Type();
				$this->view->pt = $product->fetchAll()->toArray();
				$this->view->rs = $rs->fetchAll()->toArray();
			}catch(Zend_Db_Table_Exception $e){
				throw new Zend_Db_Table_Exception($e);
			}
		}
	}
	
	public function editAction(){
		$this->view->msgName = "";
		$this->view->msgPass = "";
		$this->view->msgrepass = "";
		$this->view->msgEmail = "";
		$this->view->msgTelephone = "";
		$request = $this->getRequest();
		$uid = $request->getParam('id');
		if($request->getPost()){
			$f = new Zend_Filter_StripTags();
			$name = trim($f->filter($request->getPost('name')));
			$pass = trim($f->filter($request->getPost('pass')));
			$repass = trim($f->filter($request->getPost('repass')));
			$email = trim($f->filter($request->getPost('email')));
			$tel = trim($f->filter($request->getPost('tel')));
			$status = trim($f->filter($request->getPost('status')));
			$role = trim($f->filter($request->getPost('role')));
			$pduct = trim($f->filter($request->getPost('product')));
			$this->view->name = $name;
			$this->view->pass = $pass;
			$this->view->repass = $repass;
			$this->view->email = $email;
			$this->view->tel = $tel;
			try{
				$rs = new User_Role();
				$user = new User();
				$product = new User_Type();
				$this->view->pt = $this->view->pt = $product->fetchAll()->toArray();
				$where = $user->getDefaultAdapter()->quoteInto('uid=?',$uid);
				$this->view->usr = $user->fetchAll($where)->toArray();
				$this->view->rs = $rs->fetchAll()->toArray();
			}catch(Zend_Db_Table_Exception $e){
				throw new Zend_Db_Table_Exception($e);
			}
			if($name == ""){
				$this->view->msgName = "必填选项不能留空";
			}else if(strlen($name) > 64){
				$this->view->msgName = "输入字符不要大于64位";
			}
			if($pass != ""){
				if(strlen($pass) < 6){
					$this->view->msgPass = "密码太短";
				}
				if($repass != $pass){
					$this->view->msgRepass ="两次密码输入不一致";
				}
			}
			$validate = new Zend_Validate_EmailAddress();
			if($email == ""){
				$this->view->msgEmail = "必填选项不能留空";
			}else if(!$validate->isValid($email)){
				$this->view->msgEmail = "请输入合法的电子邮箱";
			}else if(strlen($email) >64){
				$this->view->msgEmail ="输入字符不要大于64位";
			}
			if($tel == ""){
				$this->view->msgTelephone = "必填选项不能留空";
			}else if (strlen($tel) >20){
				$this->view->msgTelephone = "输入字符不要大于20位";
			}
			if($this->view->msgName == "" && $this->view->msgPass == "" && $this->view->msgrepass == "" && $this->view->msgEmail == "" && $this->view->msgTelephone == ""){
				$arr_role = explode('|',$role);
				$arr_product = explode('|',$pduct);
				$ptid = $arr_product[1];
				$pname = $arr_product[0];
				$rid = $arr_role[1];
				$rname = $arr_role[0];
				$arr_user = array(
					'name' => $name,
					'email' => $email,
					'telphone' => $tel,
					'status' => $status,
					'created' => time(),
					'access' =>time(),
					'login' =>time(),
					'ip' =>$_SERVER['REMOTE_ADDR'],
					'rid' => $rid,
					'rname' => $rname,
					'ptid' => $ptid,
					'pname' => $pname
				);
				if($pass != ""){
					$arr_user['pass'] = $pass;
				}
				try{
					$user = new User();
					$where = $user->getDefaultAdapter()->quoteInto('uid=?',$uid);
					$user->update($arr_user, $where);
					$this->_redirect('/user/list');
				}catch (Zend_Db_Table_Exception $e){
					throw new Zend_Db_Table_Exception($e);
				}
			}
		}else{
			try{
				$rs = new User_Role();
				$user = new User();
				$product = new User_Type();
				$this->view->pt = $product->fetchAll()->toArray();
				$where = $user->getDefaultAdapter()->quoteInto('uid=?',$uid);
				$this->view->usr = $user->fetchAll($where)->toArray();
				$this->view->rs = $rs->fetchAll()->toArray();
			}catch(Zend_Db_Table_Exception $e){
				throw new Zend_Db_Table_Exception($e);
			}
		}		
	}
	
	public function listAction(){
		$paginator = "";
		$request = $this->getRequest();
		$numPerPage = 15;
		$page = trim ($request->getParam('page'));
		if($page == ""){
			$page = 0;
		}else{
			$page = (int)$page;
		}
		$list = new User();
		if(!$paginator){
			$paginator = Zend_Paginator::factory($list->listUser());
		}
		$paginator->setCurrentPageNumber($page)->setItemCountPerPage($numPerPage);
		$this->view->paginator = $paginator;
		Zend_Paginator::setDefaultScrollingStyle('Sliding');
		Zend_View_Helper_PaginationControl::setDefaultViewPartial('my_pagination_control.phtml');
		$this->view->pages = $paginator->getPages();
		$paginator->setView($this->view);	
	}
	
	public function deleteAction(){
		$request = $this->getRequest();
		$id = $request->getParam("id");
		$this->_helper->viewRenderer->setNoRender();
		if($id != ""){
			$rs = new User();
			try{
				$where = $rs->getDefaultAdapter()->quoteInto('uid=?',$id);
				$rs->delete($where);
				$this->_redirect("/user/list");	
			}catch (Zend_Db_Table_Exception $e){
				throw new Zend_Db_Table_Exception($e);
			}
		}		
	}
}

?>